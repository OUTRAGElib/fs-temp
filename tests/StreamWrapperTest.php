<?php


namespace OUTRAGElib\Validate\Tests;

require __DIR__."/../vendor/autoload.php";

use \OUTRAGElib\Filesystem\TemporaryFilesystemStreamWrapper;
use \PHPUnit\Framework\TestCase;


class StreamWrapperTest extends TestCase
{
	/**
	 *	Initialise the stream wrapper
	 */
	public function testStreamWrapperRegistration()
	{
		$this->assertTrue(stream_wrapper_register("test", TemporaryFilesystemStreamWrapper::class));
	}
	
	
	/**
	 *	Test file writing functionality
	 */
	public function testStreamWrapperWriting()
	{
		$input = "HELLO THIS IS A SUCCESSFUL TEST";
		
		$fp = fopen("test://unit-test.txt", "w+");
		
		$this->assertInternalType("resource", $fp);
		
		fwrite($fp, $input);
		fclose($fp);
		
		$this->assertEquals($input, file_get_contents("test://unit-test.txt"));
	}
}