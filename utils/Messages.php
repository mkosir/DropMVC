<?php

namespace DroplineMVC\Utils;

/**
 * Class Messages
 * @package DropLine\Utils
 *
 * Helper function for storing a message into session variable.
 * Preconditions: session must already be created, Bootstrap 4 library must be loaded for message formatting.
 */
class Messages
{
    /**
     * Set message into a session variable.
     * If parameter $textAsArray is set, then $text parameter is ignored.
     *
     * @param string $text
     * @param $type
     * @param array $textAsArray
     */
    public static function setMsg(string $text, $type, array $textAsArray = null)
    {
        if (is_null($textAsArray)) {
            if ($type === \MSG::USER_ERROR) {
                $_SESSION[\MSG::USER_ERROR] = $text;
            } elseif ($type === \MSG::USER_SUCCESS){
                $_SESSION[\MSG::USER_SUCCESS] = $text;
            } elseif (($type === \MSG::DEVELOPMENT_ERROR) and (ERROR_DISPLAY === true)){
                $_SESSION[\MSG::DEVELOPMENT_ERROR] = $text;
            }
        } else {
            $_SESSION['textAsArray'] = true;
            if ($type === \MSG::USER_ERROR) {
                $_SESSION[\MSG::USER_ERROR] = $textAsArray;
            } elseif ($type === \MSG::USER_SUCCESS){
                $_SESSION[\MSG::USER_SUCCESS] = $textAsArray;
            } elseif (($type === \MSG::DEVELOPMENT_ERROR) and (ERROR_DISPLAY === true)){
                $_SESSION[\MSG::DEVELOPMENT_ERROR] = $textAsArray;
            }
        }
    }

    public static function display()
    {
        // One line text.
        if (!isset($_SESSION['textAsArray'])) {
            if (isset($_SESSION[\MSG::USER_ERROR])) {
                echo '<div class="alert alert-danger">' . Encode::html($_SESSION[\MSG::USER_ERROR]) . '</div>';
                unset($_SESSION[\MSG::USER_ERROR]);
            }
            if (isset($_SESSION[\MSG::USER_SUCCESS])) {
                echo '<div class="alert alert-success">' . Encode::html($_SESSION[\MSG::USER_SUCCESS]) . '</div>';
                unset($_SESSION[\MSG::USER_SUCCESS]);
            }
            if (isset($_SESSION[\MSG::DEVELOPMENT_ERROR])) {
                echo '<div class="alert alert-warning">' . Encode::html($_SESSION[\MSG::DEVELOPMENT_ERROR]) . "</br>[Development messages - ON]" . '</div>';
                unset($_SESSION[\MSG::DEVELOPMENT_ERROR]);
            }
        }

        // Text as an array.
        if (isset($_SESSION['textAsArray'])) {
            if (isset($_SESSION[\MSG::USER_ERROR])) {
                echo '<div class="alert alert-danger">';
                self::displayTextArray($_SESSION[\MSG::USER_ERROR]);
                echo '</div>';
                unset($_SESSION[\MSG::USER_ERROR]);
            }
            if (isset($_SESSION[\MSG::USER_SUCCESS])) {
                echo '<div class="alert alert-success">';
                self::displayTextArray($_SESSION[\MSG::USER_SUCCESS]);
                echo '</div>';
                unset($_SESSION[\MSG::USER_SUCCESS]);
            }
            if (isset($_SESSION[\MSG::DEVELOPMENT_ERROR])) {
                echo '<div class="alert alert-warning">';
                self::displayTextArrayDevelopment($_SESSION[\MSG::DEVELOPMENT_ERROR]);
                echo '</div>';
                unset($_SESSION[\MSG::DEVELOPMENT_ERROR]);
            }
            unset($_SESSION['textAsArray']);
        }
    }

    private static function displayTextArray($sessionVarArray)
    {
        echo '<ul style="display: table-cell;">';
        foreach ($sessionVarArray as $msg)
        {
            echo '<li>' . Encode::html($msg) . '</li>';
        }
        echo '</ul>';
    }

    private static function displayTextArrayDevelopment($sessionVarArray)
    {
        // When displaying development message error is always the same size
        if (sizeof($sessionVarArray) != 6) {
            // Array length not OK
            throw  new  \Exception("Array length not OK, expected length 6, actual value: " . sizeof($sessionVarArray) . ". Method Messages::displayTextArrayDevelopment().", 500);
        }

        echo "<h3>" . Encode::html($sessionVarArray[0]) . "</h3>";
        echo "<p>"  . Encode::html($sessionVarArray[1]) . "</p>";
        echo "<p>"  . Encode::html($sessionVarArray[2]) . "</p>";
        echo "<p>"  . Encode::html($sessionVarArray[3]) . "<pre>" . Encode::html($sessionVarArray[4]) . "</pre></p>";
        echo "<p>"  . Encode::html($sessionVarArray[5]) . "</p>";

        echo "</br>[Development messages - ON]";
    }
}