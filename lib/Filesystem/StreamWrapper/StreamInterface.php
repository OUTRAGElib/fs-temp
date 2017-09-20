<?php


namespace OUTRAGElib\Filesystem\StreamWrapper;


interface StreamInterface
{
	/**
	 *	Streams: Open a stream
	 */
	public function stream_open($path, $mode, $options, &$opened_path);
	
	
	/**
	 *	Streams: Read stream
	 */
	public function stream_read($count);
	
	
	/**
	 *	Streams: Is stream EOF?
	 */
	public function stream_eof();
	
	
	/**
	 *	Streams: Seek the stream
	 */
	public function stream_seek($offset, $whence = \SEEK_SET);
	
	
	/**
	 *	Streams: Tell the stream(?)
	 */
	public function stream_tell();
	
	
	/**
	 *	Streams: Does some stats
	 */
	public function stream_stat();
	
	
	/**
	 *	Streams: Writes contents to the currently open stream
	 */
	public function stream_write($data);
	
	
	/**
	 *	Streams: Truncates the stream to a supplied length
	 */
	public function stream_truncate($new_size);
	
	
	/**
	 *	Streams: Flush stream, sync contents
	 */
	public function stream_flush();
	
	
	/**
	 *	Streams: Close stream
	 */
	public function stream_close();
}