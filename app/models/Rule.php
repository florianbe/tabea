<?php

class Rule extends \Eloquent
{
    protected $fillable = [];
    protected $table = 'rules';

    public function QuestionGroup()
    {
        return $this->belongsTo('QuestionGroup', 'questiongroup_id');
    }

    public function Question()
    {
        return $this->belongsTo('Question', 'question_id');
    }

    public function OptionChoice()
    {
        return $this->belongsTo('OptionChoice', 'optionchoice_id');
    }

    public function getAnswerText()
    {
        if ($this->is_answer_boolean)
        {
            return $this->answer_boolean == true ? trans('pagestrings.yes') : trans('pagestrings.no');
        }
        else
        {
            return $this->question->optiongroup->optionchoices->find($this->optionchoice_id)->description;
        }
    }

    public function getAnswerCode()
    {
        if ($this->is_answer_boolean)
        {
            return $this->answer_boolean == true ? "1" : "0";
        }
        else
        {
            return $this->question->optiongroup->optionchoices->find($this->optionchoice_id)->code;
        }
    }

    public static function getDropDownData(Substudy $substudy, $questiongroup_sequence_indicator)
    {
        $dropddowndata[0]['id'] = 0;
        $dropddowndata[0]['name'] = '...';
        $dropddowndata[0]['questions'][0]['id'] = 0;
        $dropddowndata[0]['questions'][0]['text'] = '...';
        $dropddowndata[0]['questions'][0]['answers']['0']['id'] = 0;
        $dropddowndata[0]['questions'][0]['answers']['0']['text']= '...';

        $qg_count = 1;
        foreach ($substudy->questiongroups as $qg)
        {
            if ($qg->sequence_indicator < $questiongroup_sequence_indicator)
            {
                $dropddowndata[$qg_count]['id'] = $qg->id_in_substudy;
                $dropddowndata[$qg_count]['name'] = $qg->shortname . ': ' . $qg->name;

                $q_count = 1;
                foreach ($qg->questions as $q)
                {
                    if ($q->questiontype->code == 'SINGLECHOICE' || $q->questiontype->code == 'MULTICHOICE' || $q->questiontype->code == 'BOOLEAN' )
                    {
                        $dropddowndata[$qg_count]['questions'][$q_count]['id'] = $q->id_in_questiongroup;
                        $dropddowndata[$qg_count]['questions'][$q_count]['text'] = $q->shortname . ': ' . $q->text;

                        if($q->questiontype->code == 'BOOLEAN')
                        {
                            $dropddowndata[$qg_count]['questions'][$q_count]['answers'][1]['id'] = 1;
                            $dropddowndata[$qg_count]['questions'][$q_count]['answers'][1]['text'] = trans('pagestrings.yes');

                            $dropddowndata[$qg_count]['questions'][$q_count]['answers'][2]['id'] = 2;
                            $dropddowndata[$qg_count]['questions'][$q_count]['answers'][2]['text'] = trans('pagestrings.no');

                        }
                        else
                        {
                            $a_count = 1;
                            foreach ($q->optiongroup->optionchoices as $c)
                            {
                                $dropddowndata[$qg_count]['questions'][$q_count]['answers'][$a_count]['id'] = $c->code;
                                $dropddowndata[$qg_count]['questions'][$q_count]['answers'][$a_count]['text'] = $c->description;
                                $a_count = $a_count + 1;
                            }
                        }
                        $q_count = $q_count + 1;
                    }
                }
                $qg_count = $qg_count + 1;
            }
        }

        $dd_data['questiongroups'] = $dropddowndata;

        return $dd_data;
    }
}