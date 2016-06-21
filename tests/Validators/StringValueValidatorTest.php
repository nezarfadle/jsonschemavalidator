<?php  

use Json\Validation\Validators\StringValueValidator;

class StringValueValidatorTest extends \PHPUnit_Framework_TestCase
{

	
	public function test_ValidStringValue_ShouldPass()
	{
		$uow = new StringValueValidator();
		$uow->validate( 'fake attributeName', "dummy text");
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function test_InvalidStringValue_ShouldThrowException()
	{
		$uow = new StringValueValidator();
		$uow->validate( 'fake attributeName', 1);
	}

}