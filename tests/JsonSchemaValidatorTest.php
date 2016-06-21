<?php  

use Json\Validation\JsonSchemaValidator;
use Json\Validation\Validators\StringValueValidator;
use Json\Validation\Validators\NumericValueValidator;
use Json\Validation\Validators\ObjectValidator;
use Json\Validation\Utils\ArrayUtil;

class JsonSchemaValidatorTest extends \PHPUnit_Framework_TestCase
{

	private $uow; 
	
	public function setup()
	{
		$this->uow = new JsonSchemaValidator();
	}

	/**
	 * @expectedException Json\Validation\Exceptions\InvalidJsonPayloadException
	 */
	public function test_InvalidJsonPayload_ShouldThrowExpcetion()
	{
		// $this->markTestSkipped();
		$jsonPayload = "dummy text";
		$schema = [
			"title" => new StringValueValidator()
		];

		$this->uow->validate( $jsonPayload, $schema );
	}

	/**
	 * @expectedException Json\Validation\Exceptions\NotExistsPropertyException
	 */
	public function test_NotExistsProperty_ShouldthrowException()
	{
		// $this->markTestSkipped();
		$jsonPayload = '{"id" : 1}';
		$schema = [
			"title" => new StringValueValidator()
		];

		$this->uow->validate( $jsonPayload, $schema );
	}

	public function test_ValidaJsonPayload_ShouldPass()
	{
		// $this->markTestSkipped();
		$jsonPayload = '{"name" : "fake name"}';
		$schema = [
			"name" => new StringValueValidator()
		];

		$this->uow->validate( $jsonPayload, $schema );
	}

	/**
	 * @expectedException Json\Validation\Exceptions\EmptyPayloadException
	 */
	public function test_EmptyJsonPayload_ShouldThrowException()
	{
		$jsonPayload = "{}";
		$schema = [
			"title" => new StringValueValidator()
		];

		$this->uow->validate( $jsonPayload, $schema );
	}

	public function test_ValidJsonApiSpec_ShouldPass()
	{
		$jsonPayload = <<<EOL
			{
			  "data": {
			    "type": "articles",
			    "attributes": {
			      "title": "JSON Api with PHP",
			      "content": "Fake Content"
			    }
			  }
			}
EOL;
		$schema = [
			'data' => new ObjectValidator(),
			'data.attributes' => new ObjectValidator(),
			'data.attributes.title' => new StringValueValidator(),
			'data.attributes.content' => new StringValueValidator(),
			'data.attributes.content' => new StringValueValidator(),
		];
		
		$this->uow->validate($jsonPayload, $schema);
	}

	public function test_ValidDeepNestedPayload_ShouldPass()
	{
		$jsonPayload = <<<EOL
			{
			  "data": {
			    "type": "articles",
			    "attributes": {
			      "item1":{
			      	"item2":{
			      		"item3":{
			      			"item4":{
			      				"title": "Fake Content"
			      			}
			      		}
			      	}
			      },
			      "content": "Fake Content"
			    }
			  }
			}
EOL;
		$schema = [
			'data' => new ObjectValidator(),
			'data.attributes' => new ObjectValidator(),
			'data.attributes.item1.item2.item3.item4' => new ObjectValidator(),
			'data.attributes.item1.item2.item3.item4.title' => new StringValueValidator(),
			'data.attributes.content' => new StringValueValidator(),
		];
		
		$this->uow->validate($jsonPayload, $schema);
	}

	/**
	 * @expectedException Json\Validation\Exceptions\EmptySchemaException
	 */
	public function test_EmptySchema_ShouldThrowException()
	{
		$jsonPayload = '{"id": 1}';
		$this->uow->validate( $jsonPayload, [] );
	}
}