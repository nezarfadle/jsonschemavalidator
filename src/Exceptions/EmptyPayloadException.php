<?php  namespace Json\Validation\Exceptions;

class EmptyPayloadException extends \Exception
{
	public function __construct()
	{
		parent::__construct("empty payload");
	}
	
}