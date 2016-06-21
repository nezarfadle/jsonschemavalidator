<?php  namespace Json\Validation\Exceptions;

class InvalidJsonPayloadException extends \Exception
{
	public function __construct()
	{
		parent::__construct("invalid json payload");
	}
	
}