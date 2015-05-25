<?php

class QuestionGroup extends \Eloquent {
    protected $fillable = [];
    protected $table = 'questiongroups';

    public static function boot()
    {
        parent::boot();

        // Attach event handler, on saving
        QuestionGroup::saving(function($questiongroup)
        {
            $questiongroup->substudy->save();
            $questiongroup->version = $questiongroup->version ? $questiongroup->version + 1 : 1;

        });
    }

    public function SubStudy()
    {
        return $this->belongsTo('SubStudy', 'substudy_id');
    }

    public function Questions()
    {
        return $this->hasMany('Question', 'questiongroup_id', 'id')->orderBy('sequence_indicator', 'ASC');
    }

    public function Rules()
    {
        return $this->hasMany('Rule', 'questiongroup_id');
    }

    public function delete()
    {
        if ($this->questions != null)
        {
            foreach ($this->questions as $que)
            {
                $que->delete();
            }
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

    public function copy_to_substudy(Substudy $target_substudy)
    {
        $questiongroup = new QuestionGroup;
        $questiongroup->id_in_substudy = $this->id_in_substudy;
        $questiongroup->name = $this->name;
        $questiongroup->shortname = $this->shortname;
        $questiongroup->description = $this->description;
        $questiongroup->comment = $this->comment;
        $questiongroup->sequence_indicator = $this->sequence_indicator;
        $questiongroup->random_questionorder = $this->random_questionorder;

        $questiongroup->SubStudy()->associate($target_substudy);
        $questiongroup->save();

        foreach ($this->questions as $question)
        {
            $question->copy_to_questiongroup($questiongroup);
        }

        foreach ($this->rules as $rule)
        {
            $rule->copy_to_questiongroup($questiongroup);
        }

        $questiongroup->save();

    }

}