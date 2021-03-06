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
            $s_data['version']            = intval($study->version);
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
                $ss_data['version']     = intval($substudy->version);
                $ss_data['trigger']     = $substudy->getTrigger();

                $ss_data['trigger_signals']     = $substudy->getSurveyTimes();

                //QUESTION GROUPS
                $questiongroups = [];
                foreach ($substudy->questiongroups as $qg)
                {
                    $qg_data = [];

                    $qg_data['id']          = intval($qg->id_in_substudy);
                    $qg_data['name']        = $qg->name;
                    $qg_data['description'] = $qg->description;
                    $qg_data['version']     = intval($qg->version);
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
                        $q_data['version']              = intval($q->version);
                        $q_data['type']                 = $q->questiontype->code;
                        $q_data['mandatory']            = (boolean) $q->answer_required;
                        $q_data['text']                 = $q->text;

                        //RESTRICTIONS
                        if ($q->questionrestriction) {
                            if ($q->questionrestriction->min_numeric || $q->questionrestriction->min_integer) {
                                $q_data['min'] = $q->questionrestriction->min_numeric ? $q->questionrestriction->min_numeric : $q->questionrestriction->min_integer;
                            } else {
                                $q_data['min'] = false;
                            }

                            if ($q->questionrestriction->max_numeric || $q->questionrestriction->max_integer) {
                                $q_data['max'] = $q->questionrestriction->max_numeric != NULL ? $q->questionrestriction->max_numeric : $q->questionrestriction->max_integer;
                            } else {
                                $q_data['max'] = false;
                            }
                            if ($q->questionrestriction->step_numeric || $q->questionrestriction->step_integer) {
                                $q_data['step'] = $q->questionrestriction->step_numeric != NULL ? $q->questionrestriction->step_numeric : $q->questionrestriction->step_integer;
                            } else {
                                $q_data['step'] = false;
                            }
                        }
                        else
                        {
                            $q_data['min']  = false;
                            $q_data['max']  = false;
                            $q_data['step'] = false;
                        }

                        //OPTIONS
                        if ($q->optiongroup)
                        {

                            $q_data['options'] = [];
                            foreach($q->optiongroup->optionchoices as $oc)
                            {
                                $oc_data = [];
                                $oc_data['code']        = $oc->code;
                                $oc_data['description'] = $oc->description;
                                $oc_data['value']       = $oc->value;

                                $q_data['options'][] = $oc_data;
                            }

                        }

                        $qg_data['questions'][] = $q_data;
                    }

                    $questiongroups[] = $qg_data;
                }
                $ss_data['questiongroups']   = $questiongroups;

                $substudies[] = $ss_data;
            }
            $s_data['substudies']     = $substudies;


            return $s_data;
        }

    }