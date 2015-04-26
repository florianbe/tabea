<?php

class Question extends \Eloquent {
    protected $fillable = [];
    protected $table = 'questions';

    public static function boot()
    {
        parent::boot();

        // Attach event handler, on saving
        Question::saving(function($question)
        {
            //Touch associated models
            $question->questiongroup->substudy->study->touch();
            $question->questiongroup->substudy->touch();
            $question->questiongroup->touch();
        });
    }

    public function QuestionGroup()
    {
        return $this->belongsTo('QuestionGroup', 'questiongroup_id');
    }

    public function QuestionType()
    {
        return $this->belongsTo('QuestionType', 'questiontype_id');
    }

    public function QuestionRestriction()
    {
        return $this->hasOne('QuestionRestriction', 'question_id');
    }

    public function OptionGroup()
    {
        return $this->belongsTo('OptionGroup', 'optiongroup_id');
    }

    public function Rules()
    {
        return $this->hasMany('Rule', 'question_id');
    }

    public function GetOptionGroupCode()
    {
        if ($this->optiongroup == null)
        {
            return null;
        }
        else
        {
            if ($this->optiongroup->is_predefined)
            {
                return $this->optiongroup->code;
            }
            else
            {
                return "SELF";
            }
        }
    }

    public function GetSelfDefValues()
    {
        if ($this->optiongroup == null || $this->optiongroup->is_predefined)
        {
            return null;
        }
        else
        {
            $selfdefoptions = "";
            foreach($this->optiongroup->optionchoices as $choice)
            {
                $selfdefoptions = $selfdefoptions  . $choice->value . ";" . $choice->description . PHP_EOL;
            }
            return $selfdefoptions;
        }
    }

    public function delete()
    {
        $counter = 1;

        foreach ($this->questiongroup->questions as $q)
        {
            if ($q->id != $this->id)
            {
                $q->sequence_indicator = $counter;
                $q->save();
                $counter = $counter + 1;
            }
        }

        if ($this->questionrestriction != null)
        {
            $this->questionrestriction->delete();
        }


        if ($this->optiongroup != null && $this->optiongroup->is_predefined == false)
        {

            $og = $this->optiongroup;
            $this->optiongroup_id = null;
            $this->save();
            $og->delete();

        }

        if ($this->rules != null)
        {
            foreach ($this->rules as $rule)
            {
                $rule->delete();
            }
        }

        return parent::delete();
    }

    public function copy_to_questiongroup(QuestionGroup $target_questiongroup)
    {
        $question = new Question;

        $question->shortname = $this->shortname;
        $question->text = $this->text;
        $question->sequence_indicator = $this->sequence_indicator;
        $question->id_in_questiongroup = $this->id_in_questiongroup;
        $question->answer_required = $this->answer_required;
        $question->QuestionType()->associate($this->questiontype);
        $question->QuestionGroup()->associate($target_questiongroup);

        if ($this->optiongroup != null)
        {
            if ($this->optiongroup->is_predefined)
            {
                $question->OptionGroup()->associate($this->optiongroup);
            }
            else
            {
                $optiongroup = new OptionGroup;
                $optiongroup->code = $this->optiongroup->code;
                $optiongroup->is_predefined = $this->optiongroup->is_predefined;
                $optiongroup->as_dropdown = $this->optiongroup->as_dropdown;
                $optiongroup->save();

                foreach ($this->optiongroup->optionchoices as $oc)
                {
                    $optionchoice = new OptionChoice;
                    $optionchoice->code = $oc->code;
                    $optionchoice->description = $oc->description;
                    $optionchoice->value = $oc->value;

                    $optionchoice->OptionGroup()->associate($optiongroup);
                    $optionchoice->save();
                }
                $question->OptionGroup()->associate($optiongroup);
            }
        }

        $question->save();

        if ($this->questionrestriction != null)
        {
            $questionrestriction = new QuestionRestriction;
            $questionrestriction->min_numeric = $this->questionrestriction->min_numeric;
            $questionrestriction->max_numeric = $this->questionrestriction->max_numeric;
            $questionrestriction->step_numeric = $this->questionrestriction->step_numeric;
            $questionrestriction->min_integer = $this->questionrestriction->min_integer;
            $questionrestriction->max_integer = $this->questionrestriction->max_integer;
            $questionrestriction->step_integer = $this->questionrestriction->step_integer;

            $questionrestriction->Question()->associate($question);
            $questionrestriction->save();

        }

    }

}