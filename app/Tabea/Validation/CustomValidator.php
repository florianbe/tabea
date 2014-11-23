<?php namespace Tabea\Validation;

class CustomValidator extends \Illuminate\Validation\Validator {

    /**
     * Validate the date is before a given date.
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @param  array   $parameters
     * @return bool
     */
    protected function validate_before($attribute, $value, $parameters)
    {
        if( isset( $this->attributes[ $parameters[0] ] ) )
        {
            $value_to_compare = $this->attributes[ $parameters[0] ];

        }
        else
        {
            $value_to_compare = $parameters[0];
        }

        return ( strtotime( $value ) < strtotime( $value_to_compare ) );

    }

    /**
     * Validate the date is after a given date.
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @param  array   $parameters
     * @return bool
     */
    protected function validate_after($attribute, $value, $parameters)
    {
        if( isset( $this->attributes[ $parameters[0] ] ) )
        {

            $value_to_compare = $this->attributes[ $parameters[0] ];

        }
        else
        {

            $value_to_compare = $parameters[0];

        }

        return ( strtotime( $value ) > strtotime( $value_to_compare ) );

    }
}