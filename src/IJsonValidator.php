<?php namespace Json\Validation;

interface IJsonValidator
{
	public function validate( $attribute, $value );
}