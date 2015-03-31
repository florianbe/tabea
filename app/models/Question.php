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
        if ($this->optiongroup && !($this->optiongroup->is_predefined))
        {
            $this->optiongroup->delete();
        }
        if ($this->questionrestriction)
        {
            $this->questionrestriction->delete();
        }

        return parent::delete();
    }

}