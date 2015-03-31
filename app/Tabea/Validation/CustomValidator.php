<?php namespace Tabea\Validation;

class CustomValidator extends \Illuminate\Validation\Validator {

    /**
     * Validate if the date is before a given date.
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
     * Validate if the date is after a given date.
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

    /**
     * Validate if the provided step is between the min and max values
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @param  array   $parameters
     * @return bool
     */
    protected function validateStepBetween($attribute, $value, $parameters)
    {
        $param1 = floatval(array_get($this->data, $parameters[0]));
        $param2 = floatval(array_get($this->data, $parameters[1]));

        if (floatval($value) > max($param1, $param2))
        {
            return false;
        }
        if (!((max($param1, $param2) - min($param1, $param2)) % floatval($value) == 0))
        {
            return false;
        }

        return true;

    }

    /**
     * Validate if the provided maximum is greater than the provided minimum
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @param  array   $parameters
     * @return bool
     */
    protected function validateGreaterThan($attribute, $value, $parameters)
    {
        $param1 = floatval(array_get($this->data, $parameters[0]));


        return ( floatval($value) > $param1 );
    }



    /**
     * Validate if the provided list of user defined options
     * has the correct format: datavalue;text_to_display - one item per line
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @param  array   $parameters
     * @return bool
     */
    protected function validateUserdefinedOptions($attribute, $value, $parameters)
    {
        $lines = preg_split( '/\r\n|\r|\n/', $value);

        $answer_counter = 0;
        foreach ($lines as $line)
        {
            if (strlen($line) > 0)
            {
                if (count(explode(';', $line)) <> 2)
                {return false;}
                $answer_counter = $answer_counter + 1;
            }
        }
        if ($answer_counter < intval(array_get($this->data, $parameters[0])))
        {
            return false;
        }

        return true;
    }

}