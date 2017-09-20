<?php


require "./vendor/autoload.php";

stream_wrapper_register("test", \OUTRAGElib\Filesystem\TemporaryFilesystemStreamWrapper::class);


file_put_contents("test://apple/1.txt", microtime());
file_put_contents("test://strawberry/2.txt", microtime());
file_put_contents("test://strawberry/3.txt", microtime());
file_put_contents("test://strawberry/4.txt", microtime());
file_put_contents("test://strawberry/5.txt", microtime());
file_put_contents("test://strawberry/6.txt", microtime());

var_dump(file_get_contents("test://strawberry/6.txt"));
exit;