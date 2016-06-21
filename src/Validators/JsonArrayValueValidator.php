<?php namespace Json\Validation\Validators;

use Json\Validation\IJsonValidator;

class JsonArrayValueValidator implements IJsonValidator
{
    public function validate( $attribute, $value )
    {
        if( !is_array( $value )) { 
			throw new \InvalidArgumentException(  $attribute . ": is not valid array" );
        }
    }
}
