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
            $data = [];

            //STUDY
            $data['id']                 = intval($study->id);
            $data['title']              = $study->name;
            $data['description']        = $study->description;
            $data['start_date']         = $study->accessible_from;
            $data['end_date']           = $study->accessible_until;
            $data['finalupload_date']   = $study->uploadable_until;

            $data['state']  = $study->studystate->code == 'DESIGN' ? 'DRAFT' : 'PUBLISHED';

            //SUBSTUDIES
            $substudies = [];

            foreach ($study->substudies as $substudy)
            {
                $ss_data = [];

                $ss_data['id']          = intval($substudy->id_in_study);
                $ss_data['title']       = $substudy->name;
                $ss_data['description'] = $substudy->description;
                $ss_data['trigger']     = $substudy->getTrigger();
                $ss_data['trigger_interval']    = $substudy->getTriggerInterval();

                //SURVEY PERIOD
                $surveyperiods = [];
                foreach ($substudy->surveyperiods as $surv_per)
                {
                    $sp_data = [];

                    $sp_data['id']          = count($surveyperiods) + 1;
                    $sp_data['start_date']  = $surv_per->start_date;
                    $sp_data['end_date']    = $surv_per->end_date;
                    $sp_data['days']        = $surv_per->getWeekdays();

                    $surveyperiods[ count($surveyperiods) + 1]   = $sp_data;
                }
                $ss_data['surveyperiods']   = $surveyperiods;

                //QUESTION GROUPS
                $questiongroups = [];
                foreach ($substudy->questiongroups as $qg)
                {
                    $qg_data = [];

                    $qg_data['id']          = $qg->id_in_substudy;
                    $qg_data['name']        = $qg->name;
                    $qg_data['seq_id']      = $qg->sequence_indicator;
                    $qg_data['random_order']    = (boolean) $qg->random_questionorder;
                    //QUESTIONS




                    //RULES

                    $questiongroups[count($questiongroups) + 1] = $qg_data;
                }
                $ss_data['questiongroups']   = $questiongroups;

                $substudies[count($substudies) +1] = $ss_data;
            }
            $data['substudies']     = $substudies;
            return $data;
        }

    }