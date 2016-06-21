<?php  

use Json\Validation\JsonValidatorsRunner;
use Json\Validation\Validators\JsonStringValueValidator;
use Json\Validation\Validators\JsonNumericValueValidator;
use Json\Validation\Validators\JsonObjectValidator;
use Json\Validation\Utils\ArrayUtil;

class JsonValidatorsRunnerTest extends \PHPUnit_Framework_TestCase
{

	private $uow; 
	
	public function setup()
	{
		$this->uow = new JsonValidator();
	}

	/**
	 * @expectedException Json\Validation\Exceptions\InvalidJsonPayloadException
	 */
	public function test_InvalidJsonPayload_ShouldThrowExpcetion()
	{
		// $this->markTestSkipped();
		$jsonPayload = "dummy text";
		$schema = [
			"title" => new JsonStringValueValidator()
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
			"title" => new JsonStringValueValidator()
		];

		$this->uow->validate( $jsonPayload, $schema );
	}

	public function test_ValidaJsonPayload_ShouldPass()
	{
		// $this->markTestSkipped();
		$jsonPayload = '{"name" : "fake name"}';
		$schema = [
			"name" => new JsonStringValueValidator()
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
			"title" => new JsonStringValueValidator()
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
			'data' => new JsonObjectValidator(),
			'data.attributes' => new JsonObjectValidator(),
			'data.attributes.title' => new JsonStringValueValidator(),
			'data.attributes.content' => new JsonStringValueValidator(),
			'data.attributes.content' => new JsonStringValueValidator(),
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
			'data' => new JsonObjectValidator(),
			'data.attributes' => new JsonObjectValidator(),
			'data.attributes.item1.item2.item3.item4' => new JsonObjectValidator(),
			'data.attributes.item1.item2.item3.item4.title' => new JsonStringValueValidator(),
			'data.attributes.content' => new JsonStringValueValidator(),
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