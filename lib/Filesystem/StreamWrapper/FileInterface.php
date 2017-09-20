<?php


namespace OUTRAGElib\Filesystem\StreamWrapper;


interface FileInterface
{
	/**
	 *	Files: rename from one file to another
	 */
	public function rename($path_from, $path_to);
	
	
	/**
	 *	Remove file from interface
	 */
	public function unlink($path);
	
	
	/**
	 *	Files: Does some stats
	 */
	public function url_stat($path, $flags);
}