<?php namespace Tabea\Forms;

use Laracasts\Validation\FormValidator;

class BaseForm extends FormValidator {

    public function setRules($key, $value)
    {
        $this->rules[$key] = $value;
    }

    public function getRules($key)
    {
        return $this->rules[$key];
    }

}