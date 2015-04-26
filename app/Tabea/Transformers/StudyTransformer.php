<?php namespace Tabea\Transformers;


/**
 * Created by PhpStorm.
 * User: lankin
 * Date: 12/04/15
 * Time: 20:39
 */

    class StudyTransformer extends Transformer{

        public function transform($study)
        {
            $s_data = [];

            //STUDY
            $s_data['id']                 = intval($study->id);
            $s_data['title']              = $study->name;
            $s_data['description']        = $study->description;
            $s_data['version']            = $study->updated_at->toDateTimeString();
            $s_data['start_date']         = $study->accessible_from->toDateTimeString();
            $s_data['end_date']           = $study->accessible_until->toDateTimeString();
            $s_data['finalupload_date']   = $study->uploadable_until->toDateTimeString();


            $s_data['state']  = $study->studystate->code == 'DESIGN' ? 'DRAFT' : 'PUBLISHED';

            //SUBSTUDIES
            $substudies = [];

            foreach ($study->substudies as $substudy)
            {
                $ss_data = [];

                $ss_data['id']          = intval($substudy->id_in_study);
                $ss_data['title']       = $substudy->name;
                $ss_data['description'] = $substudy->description;
                $ss_data['version']     = $substudy->updated_at->toDateTimeString();
                $ss_data['trigger']     = $substudy->getTrigger();
                $ss_data['trigger_interval']    = $substudy->getTriggerInterval();

                $ss_data['trigger_signals']     = $substudy->getSurveyTimes();

                //QUESTION GROUPS
                $questiongroups = [];
                foreach ($substudy->questiongroups as $qg)
                {
                    $qg_data = [];

                    $qg_data['id']          = intval($qg->id_in_substudy);
                    $qg_data['name']        = $qg->name;
                    $qg_data['version']     = $qg->updated_at->toDateTimeString();
                    $qg_data['seq_id']      = intval($qg->sequence_indicator);
                    $qg_data['random_order']    = (boolean) $qg->random_questionorder;
                    $qg_data['questions']   = [];

                    //RULES
                    if ($qg->rules && count($qg->rules) > 0)
                    {
                        $qg_data['rules'] = [];
                        foreach($qg->rules as $rule)
                        {
                            $r_data = [];
                            $r_data['question_id']      = intval($rule->question_id);
                            $r_data['answer_value']     = $rule->getAnswerCode();

                            $qg_data['rules'][] = $r_data;
                        }
                    }

                    //QUESTIONS
                    foreach($qg->questions as $q)
                    {
                        $q_data = [];
                        $q_data['id']                   = intval($q->id);
                        $q_data['id_in_questiongroup']  = intval($q->id_in_questiongroup);
                        $q_data['seq_id']               = intval($q->sequence_indicator);
                        $q_data['version']              = $q->updated_at->toDateTimeString();
                        $q_data['tpye']                 = $q->questiontype->code;
                        $q_data['mandatory']            = (boolean) $q->answer_required;
                        $q_data['text']                 = $q->text;

                        //RESTRICTIONS
                        if($q->questionrestriction)
                        {
                            if ($q->min_numeric || $q->min_integer)
                            {
                                $q_data['min']      =   $q->min_numeric ? $q->min_numeric : $q->min_integer;
                            }
                            if ($q->max_numeric || $q->max_integer)
                            {
                                $q_data['max']      =   $q->max_numeric ? $q->max_numeric : $q->max_integer;
                            }
                            if ($q->step_numeric || $q->step_integer)
                            {
                                $q_data['step']      =   $q->step_numeric ? $q->step_numeric : $q->step_integer;
                            }
                        }

                        //OPTIONS
                        if ($q->optiongroup)
                        {
                            $op_data = [];
                            foreach($q->optiongroup->optionchoices as $oc)
                            {
                                $oc_data = [];
                                $oc_data['code']        = $oc->code;
                                $oc_data['description'] = $oc->description;
                                $oc_data['value']       = $oc->value;

                                $op_data[count($op_data) + 1] = $oc_data;
                            }
                            $q_data['options'] = $oc_data;
                        }

                        $qg_data['questions'][] = $q_data;
                    }

                    $questiongroups[] = $qg_data;
                }
                $ss_data['questiongroups']   = $questiongroups;

                $substudies[] = $ss_data;
            }
            $s_data['substudies']     = $substudies;
            $data['study'] = $s_data;

            return $data;
        }

    }