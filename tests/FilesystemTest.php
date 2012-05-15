<?php

use Illuminate\Filesystem\Filesystem;

class FilesystemTest extends PHPUnit_Framework_TestCase {

	public function testGetRetrievesFiles()
	{
		file_put_contents(__DIR__.'/file.txt', 'Hello World');
		$files = new Filesystem;
		$this->assertEquals('Hello World', $files->get(__DIR__.'/file.txt'));
	}

}