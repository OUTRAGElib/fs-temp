<?php


namespace OUTRAGElib\Filesystem;

use \Exception;
use \OUTRAGElib\Filesystem\StreamWrapper\FileInterface;
use \OUTRAGElib\Filesystem\StreamWrapper\StreamInterface;


class TemporaryFilesystemStreamWrapper implements FileInterface, StreamInterface
{
	/**
	 *	Context options
	 */
	public $context;
	
	
	/**
	 *	What path is currently being accessed?
	 */
	protected $path;
	
	
	/**
	 *	What resource is currently being used?
	 *	Can be an array, who knows?
	 */
	protected $resource = null;
	
	
	/**
	 *	A list of resources - used for linking our local names to the
	 *	files stored in the temp directory
	 */
	protected static $pointer_tree = [];
	
	
	/**
	 *	Let's create a stream. No file writing necessary here
	 */
	public function stream_open($path, $mode, $options, &$opened_path)
	{
		$this->path = $path;
		$this->resource = fopen($this->getLocalFilesystemPath($path), $mode);
		
		return is_resource($this->resource);
	}
	
	
	/**
	 *	Streams: Read stream
	 */
	public function stream_read($count)
	{
		return fread($this->resource, $count);
	}
	
	
	/**
	 *	Streams: Is stream EOF?
	 */
	public function stream_eof()
	{
		return feof($this->resource);
	}
	
	
	/**
	 *	Streams: Seek the stream
	 */
	public function stream_seek($offset, $whence = \SEEK_SET)
	{
		return fseek($this->resource, $offset, $whence) !== -1;
	}
	
	
	/**
	 *	Streams: Tell the stream(?)
	 */
	public function stream_tell()
	{
		return ftell($this->resource);
	}
	
	
	/**
	 *	Streams: Does some stats
	 */
	public function stream_stat()
	{
		return fstat($this->resource);
	}
	
	
	/**
	 *	Streams: Writes contents to the currently open stream
	 */
	public function stream_write($data)
	{
		return fwrite($this->resource, $data);
	}
	
	
	/**
	 *	Streams: Truncates the stream to a supplied length
	 */
	public function stream_truncate($new_size)
	{
		return ftruncate($this->resource, $new_size);
	}
	
	
	/**
	 *	Streams: Flush stream, sync contents
	 */
	public function stream_flush()
	{
		return fflush($this->resource);
	}
	
	
	/**
	 *	Streams: Close stream
	 */
	public function stream_close()
	{
		return fclose($this->resource);
	}
	
	
	/**
	 *	Streams: Cast? the stream
	 */
	public function stream_cast($cast_as)
	{
		return $this->resource;
	}
	
	
	/**
	 *	Files: rename from one file to another
	 */
	public function rename($path_from, $path_to)
	{
		if(isset(static::$pointer_tree[$path_to]))
			$this->unlink($path_to);
		
		static::$pointer_tree[$path_to] = static::$pointer_tree[$path_from];
		
		unset(static::$pointer_tree[$path_from]);
		return true;
	}
	
	
	/**
	 *	Remove file from interface
	 */
	public function unlink($path)
	{
		if(isset(static::$pointer_tree[$path_to]))
		{
			if(is_resource(static::$pointer_tree[$path_to]))
				fclose(static::$pointer_tree[$path_to]);
			
			unset(static::$pointer_tree[$path_to]);
		}
		
		return true;
	}
	
	
	/**
	 *	Files: Does some stats
	 */
	public function url_stat($path, $flags)
	{
		if($result = $this->getLocalFilesystemPath($path))
			return stat($result);
		
		return [];
	}
	
	
	/**
	 *	Returns an instance of a resource, based on something
	 *
	 *	The educated folk will notice that this will end up leaving a pointer hanging - the
	 *	intention is to never, ever use this pointer - but, keep it languishing in existance
	 */
	protected function getLocalFilesystemPath($path)
	{
		if(!isset(static::$pointer_tree[$path]))
			static::$pointer_tree[$path] = tmpfile();
		
		if($metadata = stream_get_meta_data(static::$pointer_tree[$path]))
			return $metadata["uri"];
		
		return null;
	}
}