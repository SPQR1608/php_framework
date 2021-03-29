<?php


define("DEBUG", 1);

class NotFoundException extends Exception
{
    public function __construct($message = "", $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

class ErrorHandler
{
    public function __construct()
    {
        if (DEBUG) {
            error_reporting(-1);
        } else {
            error_reporting(0);
        }
        set_error_handler([$this, 'errorHandler']);
        ob_start();
        register_shutdown_function([$this, 'fataErrorHandler']);
        set_exception_handler([$this, 'exceptionHandler']);
    }

    public function errorHandler($errno, $errstr, $errfile, $errline)
    {
        $this->writeLog($errstr, $errfile, $errline, $errno);
        $this->displayError($errno, $errstr, $errfile, $errline);
        return true;
    }

    public function fataErrorHandler()
    {
        $error = error_get_last();
        if (!empty($error) && $error['type'] & ( E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR))
        {
            $this->writeLog($error['message'], $error['file'], $error['line'], $error['type']);
            ob_end_clean();
            $this->displayError($error['type'], $error['message'], $error['file'], $error['line']);
        } else {
            ob_end_flush();
        }
    }

    public function exceptionHandler($e)
    {
        $this->writeLog( $e->getMessage(), $e->getFile(),$e->getLine(), $e->getCode());
        $this->displayError('Exception', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    public function writeLog($errstr, $errfile, $errline, $errno = 0)
    {
        error_log("[". date('Y-m-d H:i:s') . "] Текст ошибки: {$errstr} | Файл: {$errfile} | Строка: {$errline}\n========================\n", 3, __DIR__ . '/errors.log');
    }

    protected function displayError($errno, $errstr, $errfile, $errline, $response = 500)
    {
        http_response_code($response);

        if (DEBUG) {
            require 'views/dev.php';
        } else {
            require 'views/prod.php';
        }
        die;
    }
}

new ErrorHandler();

//test();
/*try {
    if (empty($test)) {
        throw new Exception('OOOOPPPS');
    }
} catch (Exception $e) {
    var_dump($e);
}*/

//throw new NotFoundException('Page not found');

//throw new Exception('OOOOPPPS', 404);