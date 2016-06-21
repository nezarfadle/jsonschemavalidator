<?php  

use Json\Validation\Validators\JsonArrayValueValidator;

class JsonArrayValueValidatorTest extends \PHPUnit_Framework_TestCase
{

	public function test_ValidArrayValue_ShouldPass()
	{
		$uow = new JsonArrayValueValidator();
		$uow->validate( 'fake attributeName', array() );
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function test_InvalidArrayValue_ShouldThrowException()
	{
		$uow = new JsonArrayValueValidator();
		$uow->validate( 'fake attributeName', 'dummy text');
	}

	
}