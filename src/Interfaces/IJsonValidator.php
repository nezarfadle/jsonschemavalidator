<?php namespace Json\Validation\Interfaces;

interface IJsonValidator
{
	public function validate( $propertyName, $value );
}