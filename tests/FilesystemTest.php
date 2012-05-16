<?php

use Illuminate\Filesystem;

class FilesystemTest extends PHPUnit_Framework_TestCase {

	public function testGetRetrievesFiles()
	{
		file_put_contents(__DIR__.'/file.txt', 'Hello World');
		$files = new Filesystem;
		$this->assertEquals('Hello World', $files->get(__DIR__.'/file.txt'));
		@unlink(__DIR__.'/file.txt');
	}


	public function testPutStoresFiles()
	{
		$files = new Filesystem;
		$files->put(__DIR__.'/file.txt', 'Hello World');
		$this->assertEquals('Hello World', file_get_contents(__DIR__.'/file.txt'));
		@unlink(__DIR__.'/file.txt');
	}


	public function testDeleteRemovesFiles()
	{
		file_put_contents(__DIR__.'/file.txt', 'Hello World');
		$files = new Filesystem;
		$files->delete(__DIR__.'/file.txt');
		$this->assertFalse(file_exists(__DIR__.'/file.txt'));
		@unlink(__DIR__.'/file.txt');
	}


	public function testDeleteDirectory()
	{
		mkdir(__DIR__.'/foo');
		file_put_contents(__DIR__.'/foo/file.txt', 'Hello World');
		$files = new Filesystem;
		$files->deleteDirectory(__DIR__.'/foo');
		$this->assertFalse(is_dir(__DIR__.'/foo'));
		$this->assertFalse(file_exists(__DIR__.'/foo/file.txt'));
	}


	public function testCleanDirectory()
	{
		mkdir(__DIR__.'/foo');
		file_put_contents(__DIR__.'/foo/file.txt', 'Hello World');
		$files = new Filesystem;
		$files->cleanDirectory(__DIR__.'/foo');
		$this->assertTrue(is_dir(__DIR__.'/foo'));
		$this->assertFalse(file_exists(__DIR__.'/foo/file.txt'));
		@rmdir(__DIR__.'/foo');
	}


	public function testFilesMethod()
	{
		mkdir(__DIR__.'/foo');
		file_put_contents(__DIR__.'/foo/1.txt', '1');
		file_put_contents(__DIR__.'/foo/2.txt', '2');
		mkdir(__DIR__.'/foo/bar');
		$files = new Filesystem;
		$this->assertEquals(array(__DIR__.'/foo/1.txt', __DIR__.'/foo/2.txt'), $files->files(__DIR__.'/foo'));
		unset($files);
		@unlink(__DIR__.'/foo/1.txt');
		@unlink(__DIR__.'/foo/2.txt');
		@rmdir(__DIR__.'/foo/bar');
		@rmdir(__DIR__.'/foo');
	}

}