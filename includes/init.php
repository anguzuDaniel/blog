<?php
spl_autoload_register(function ($class) {
    require_once dirname(__DIR__) . "/classes/{$class}.php";
});

session_start();
require_once dirname(__DIR__) . "/config.php";

function errorHandler($level, $message, $file, $line)
{
    throw new ErrorException($message, 0, $level, $file, $line);
}

function exceptionHandler($exception)
{
    if (SHOW_ERROR_DETAIL) {
        # code...
        echo "<h1>An error occured</h1>";
        echo "<p>UnCaught execption:'" . get_class($exception) . "'</p>";
        echo "<p>:'" . $exception->getMessage() . "'</p>";
        echo "<p>Stak Trace: <pre>'" . $exception->getTraceForTrace() . "'</pre></p>";
        echo "<p>In file'" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";
    } else {
        echo "<h1>An error occured</h1>";
        echo "<p>Please try again later</p>";
    }

    exit;
}

set_error_handler('errorHandler');
set_error_handler('exceptionHandler');
