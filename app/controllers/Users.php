<?php

namespace DroplineMVC\Controllers;

use DroplineMVC\Core\Controller;
use DroplineMVC\Utils\HTTP;
use DroplineMVC\Core\View;
use DroplineMVC\Utils\Messages;

class Users extends Controller
{
    protected function register()
    {
        $model = new \DroplineMVC\Models\User();

        if (HTTP::reqIsGET()) {
            View::render($this->className, $this->action, null, true);
        }

        if (HTTP::reqIsPOST()) {
            // Sanitize POST
            // Sanitize reserved characters in HTML (<,>,&,") - test <strong>text</strong> -> text
            // Sanitize XSS - test <script>alert('Gotcha!')</script>
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            list($status, $data) = $model->addUser($post);

            // Data handling success
            if ($status === \ModelReturnStatus::SUCCESS) {
                Messages::setMsg('User ' . $data['name'] . ' successfully created.', \MSG::USER_SUCCESS);
                // Redirect to login page if user is successfully created
                HTTP::headerRedirectTo('/users/login');
                // Data handling failure
            } elseif ($status === \ModelReturnStatus::FAILURE_GENERAL) {
                Messages::setMsg('Problem occurred when trying to register a new user.', \MSG::USER_ERROR);
                HTTP::headerRedirectTo('/users/register');
                // Validation failure
            } elseif ($status === \ModelReturnStatus::FAILURE_VALIDATION) {
                View::render($this->className, $this->action, $data, true);
            }
        }
    }

    protected function login()
    {
        $model = new \DroplineMVC\Models\User();

        if (HTTP::reqIsGET()) {
            View::render($this->className, $this->action, null, true);
        }

        if (HTTP::reqIsPOST()) {
            // Sanitize POST
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            list($status, $data) = $model->getUserByEmail($post['email']);

            // Data handling success
            if ($status === \ModelReturnStatus::SUCCESS) {
                // Check if password input matches the hashed password in the database
                if (password_verify($post['password'], $data['password'])) {
                    $_SESSION['is_logged_in'] = true;
                    $_SESSION['user_data'] = array(
                        "id" => $data['id'],
                        "name" => $data['name'],
                        "email" => $data['email']
                    );
                    HTTP::headerRedirectTo('/drops');
                    // password not correct
                } else {
                    Messages::setMsg('Incorrect Login', \MSG::USER_ERROR);
                    View::render($this->className, $this->action, $data, true);
                }
                // Data handling failure
            } elseif ($status === \ModelReturnStatus::FAILURE_GENERAL) {
                Messages::setMsg('Problem occurred when trying to login user.', \MSG::USER_ERROR);
                HTTP::headerRedirectTo('/users/login');
                // Validation failure
            } elseif ($status === \ModelReturnStatus::FAILURE_VALIDATION) {
                HTTP::headerRedirectTo('/users/login');
            }
        }
    }

    protected function logout()
    {
        unset($_SESSION['is_logged_in']);
        unset($_SESSION['user_data']);
        session_destroy();
        // Redirect to main page
        HTTP::headerRedirectTo('/');
    }
}