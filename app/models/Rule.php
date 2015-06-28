<?php

class Rule extends \Eloquent
{
    protected $fillable = [];
    protected $table = 'rules';

    public static function boot()
    {
        parent::boot();

        // Attach event handler, on saving
        Rule::saving(function($rule)
        {
            $rule->version = $rule->version ? $rule->version + 1 : 1;
            $rule->questiongroup->save();
        });
    }

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
            return $this->answer_boolean == true ? "JA" : "NEIN";
        }
        else
        {
            return $this->question->optiongroup->optionchoices->find($this->optionchoice_id)->value;
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

                            $dropddowndata[$qg_count]['questions'][$q_count]['answers'][2]['id'] = 9;
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


    public function copy_to_questiongroup(QuestionGroup $target_questiongroup)
    {
        $rule = new Rule;

        $source_qg = $target_questiongroup->substudy->questiongroups->filter(function($qg) {
            return $qg->id_in_substudy == $this->question->questiongroup->id_in_substudy;
        })->first();

        $source_q = $source_qg->questions->filter(function($q) {
            return $q->id_in_questiongroup == $this->question->id_in_questiongroup;
        })->first();

        $rule->id_in_questiongroup = $this->id_in_questiongroup;

        $rule->Question()->associate($source_q);

        $rule->QuestionGroup()->associate($target_questiongroup);

        $rule->is_answer_boolean = $this->is_answer_boolean;

        $rule->save();

        if($rule->is_answer_boolean)
        {
            $rule->answer_boolean = $this->answer_boolean;
        }
        else
        {
            foreach($rule->question->optiongroup->optionchoices as $choice)
            {
                if ($choice->code == $this->optionchoice->code)
                {
                    $rule->OptionChoice()->associate($choice);
                    $rule->save();
                    break;
                }
            }
        }

        $rule->save();
    }
}