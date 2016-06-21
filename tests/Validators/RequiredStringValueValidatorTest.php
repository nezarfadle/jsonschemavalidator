<?php  

use Json\Validation\Validators\RequiredStringValueValidator;

class RequiredStringValueValidatorTest extends \PHPUnit_Framework_TestCase
{

	
	public function test_ValidStringValue_ShouldPass()
	{
		$uow = new RequiredStringValueValidator();
		$uow->validate( 'fake attributeName', "dummy text");
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function test_EmptyStringValue_ShouldThrowException()
	{
		$uow = new RequiredStringValueValidator();
		$uow->validate( 'fake attributeName', '');
	}

}