<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password'
    ];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');


	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
    
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function studiesAuthored()
    {
        return $this->hasMany('Study', 'author_id', 'id');
    }

    public function studyrequests()
    {
        return $this->hasMany('StudyRequest');
    }

    public function hasAccessToStudy(Study $study)
    {
        if(count($study->users->find($this)) > 0 || ($this->is_admin) || ($this == $study->author))
        {
            return true;
        }
        return false;
    }

    public function studiesAll()
    {
        return $this->belongsToMany('Study', 'user_study', 'user_id', 'study_id')->withPivot('is_contributor')->withTimestamps();
    }

    public function studiesContributing()
    {
        return $this->belongsToMany('Study', 'user_study', 'user_id', 'study_id')->withPivot('is_contributor')->where('is_contributor', '=', '1');
    }

    public function studiesReadable()
    {
        return $this->belongsToMany('Study', 'user_study', 'user_id', 'study_id')->withPivot('is_contributor')->where('is_contributor', '=', '0');
    }

    public function isContributorToStudy(Study $study)
    {
        if(count($study->contributors->find($this)) > 0)
        {
            return true;
        }
        return false;
    }

    public function hasWriteAccessToStudy(Study $study)
    {
        if(count($study->contributors->find($this)) > 0 || ($this->is_admin) || ($this == $study->author))
        {
            return true;
        }
        return false;
    }

    public function hasRequestForStudy(Study $study)
    {
        foreach ($study->studyRequests as $studyRequest)
        {
            if ($studyRequest->requestingUser == $this) {
                return true;
            }
        }
        return false;
    }
}
