<?php namespace Illuminate;

class FileNotFoundException extends \Exception {}

class Filesystem {

	/**
	 * Get the contents of a file.
	 *
	 * @param  string  $path
	 * @return string
	 */
	public function get($path)
	{
		if (file_exists($path)) return file_get_contents($path);

		throw new FileNotFoundException("File does not exist at path {$path}");
	}

	/**
	 * Write the contents of a file.
	 *
	 * @param  string  $path
	 * @param  string  $contents
	 * @return int
	 */
	public function put($path, $contents)
	{
		return file_put_contents($path, $contents, LOCK_EX);
	}

	/**
	 * Delete the file at a given path.
	 *
	 * @param  string  $path
	 * @return bool
	 */
	public function delete($path)
	{
		return unlink($path);
	}

}