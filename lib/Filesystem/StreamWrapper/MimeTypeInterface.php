<?php


namespace OUTRAGElib\Filesystem\StreamWrapper;


interface MimeTypeInterface
{
	/**
	 *	Set the MIME type of the file in question
	 */
	public function setMimeType($mime_type);
	
	
	/**
	 *	Retrieves the MIME type of the file in question
	 */
	public function getMimeType();
}