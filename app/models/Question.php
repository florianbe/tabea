<?php

class Question extends \Eloquent {
    protected $fillable = [];
    protected $table = 'questions';

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

}