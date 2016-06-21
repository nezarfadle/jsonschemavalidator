<?php  

use Json\Validation\Validators\JsonStringValueValidator;

class JsonStringValueValidatorTest extends \PHPUnit_Framework_TestCase
{

	
	public function test_ValidStringValue_ShouldPass()
	{
		$uow = new JsonStringValueValidator();
		$uow->validate( 'fake attributeName', "dummy text");
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function test_InvalidStringValue_ShouldThrowException()
	{
		$uow = new JsonStringValueValidator();
		$uow->validate( 'fake attributeName', 1);
	}

}