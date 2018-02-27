<?php

namespace DroplineMVC\Utils;

/**
 * Class ErrorHandler
 *
 * Error and exception handler.
 * Display errors on the screen or save it into a file.
 *
 * @package DroplineMVC\Utils
 */
class ErrorHandler
{
    /**
     * Error handler. Convert all errors to exceptions by throwing an ErrorException.
     *
     * @param $level - Error level
     * @param $message - Error message
     * @param $file - Filename the error was raised in
     * @param $line - Line number in the file
     * @throws \ErrorException
     */
    public static function errorHandler($level, $message, $file, $line)
    {
        if (error_reporting() !== 0) {  // to keep the @ operator working
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }

    /**
     * Exception handler.
     *
     * @param $exception
     *
     * @return void
     */
    public static function exceptionHandler($exception)
    {
        if (ERROR_DISPLAY === true) {
            $textArray =[];
            $textArray[] = "Error occurred";
            $textArray[] = "Uncaught exception: '" . get_class($exception) . "'";
            $textArray[] = "Message: '" . $exception->getMessage() . "'" ;
            $textArray[] = "Stack trace: ";
            $textArray[] = $exception->getTraceAsString();
            $textArray[] = "Thrown in '" . $exception->getFile() . "' on line " . $exception->getLine();

            Messages::setMsg('', \MSG::DEVELOPMENT_ERROR, $textArray);
        }

        if (ERROR_FILE === true) {
        // Set the location of the log file
        $log = '../logs/' . date('Y-m-d') . '.txt';
        ini_set('error_log', $log);

        $message = "\n\nError occurred\n";
        $message .= "Uncaught exception: '" . get_class($exception) . "'\n";
        $message .= "Message: '" . $exception->getMessage() . "'\n";
        $message .= "Stack trace: " . $exception->getTraceAsString() . "\n";
        $message .= "Thrown in '" . $exception->getFile() . "' on line " . $exception->getLine() . "\n";

        // Write a message to the log file
        error_log($message);
        }

        // Display error page
        switch ($exception->getCode()) {
            // 404 - Not Found
            case 404:
                http_response_code(404);
                \DroplineMVC\Core\View::render('error', 'error404', null, true);
                break;
            // 500 - Internal Server Error
            case 500:
                http_response_code(500);
                \DroplineMVC\Core\View::render('error', 'error500', null, true);
                break;
            default:
                http_response_code(500);
                \DroplineMVC\Core\View::render('error', 'error500', null, true);
                break;
        }
    }
}