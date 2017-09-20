<?php


namespace OUTRAGElib\Filesystem\StreamWrapper;


interface DirectoryInterface
{
	/**
	 *	Directories: Read the contents of a directory
	 */
	public function dir_opendir($path, $options);
	
	
	/**
	 *	Directories: Retrieve the next item in the file listing
	 */
	public function dir_readdir();
	
	
	/**
	 *	Directories: Rewinds the file listing
	 */
	public function dir_rewinddir();
	
	
	/**
	 *	Directories: Rewinds the file listing
	 */
	public function dir_closedir();
	
	
	/**
	 *	Create a directory
	 */
	public function mkdir($path, $mode, $options);
	
	
	/**
	 *	Remove folder from interface
	 */
	public function rmdir($path, $options);
}