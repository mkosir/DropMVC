<?php

namespace DroplineMVC\Controllers;

use DroplineMVC\Core\Controller;
use DroplineMVC\Core\View;
use DroplineMVC\Utils\HTTP;
use DroplineMVC\Utils\Messages;

class Drops extends Controller
{
    protected function index()
    {
        $model = new \DroplineMVC\Models\Drop();
        list($status, $data) = $model->getDrops();

        // Data handling success
        if ($status === \ModelReturnStatus::SUCCESS) {
            View::render($this->className, $this->action, $data, true);
            // Data handling failure
        } elseif ($status === \ModelReturnStatus::FAILURE_GENERAL) {
            Messages::setMsg('Problem occurred when trying to display drops.', \MSG::USER_ERROR);
            HTTP::headerRedirectTo('/drops');
        }
    }

    protected function show()
    {
        $model = new \DroplineMVC\Models\Drop();
        list($status, $data) = $model->getDrop($this->id);

        // Data handling success
        if ($status === \ModelReturnStatus::SUCCESS) {
            View::render($this->className, $this->action, $data, true);
            // Data handling failure
        } elseif ($status === \ModelReturnStatus::FAILURE_GENERAL) {
            Messages::setMsg('Problem occurred when trying to display drop with ID: #' . $this->id, \MSG::USER_ERROR);
            HTTP::headerRedirectTo('/drops');
        }
    }

    protected function delete()
    {
        $model = new \DroplineMVC\Models\Drop();
        list($status, $data) = $model->deleteDrop($this->id, $_SESSION['user_data']['id']);

        // Data handling success
        if ($status === \ModelReturnStatus::SUCCESS) {
            Messages::setMsg('Drop with ID: #' . $this->id . ' successfully deleted.', \MSG::USER_SUCCESS);
            // Data handling failure
        } elseif ($status === \ModelReturnStatus::FAILURE_GENERAL) {
            Messages::setMsg('Problem occurred when trying to delete drop with ID: #' . $this->id, \MSG::USER_ERROR);
            // Validation failure
        } elseif ($status === \ModelReturnStatus::FAILURE_VALIDATION) {

        }
        HTTP::headerRedirectTo('/drops');
    }

    protected function add()
    {
        $model = new \DroplineMVC\Models\Drop();

        if (HTTP::reqIsGET()) {
            View::render($this->className, $this->action, null, true);
        }

        if (HTTP::reqIsPOST()) {
            // Sanitize POST
            // Sanitize reserved characters in HTML (<,>,&,") - test <strong>text</strong> -> text
            // Sanitize XSS - test <script>alert('Gotcha!')</script>
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            list($status, $data) = $model->addDrop($post);

            // Data handling success
            if ($status === \ModelReturnStatus::SUCCESS) {
                Messages::setMsg('Drop successfully created.', \MSG::USER_SUCCESS);
                HTTP::headerRedirectTo('/drops');
                // Data handling failure
            } elseif ($status === \ModelReturnStatus::FAILURE_GENERAL) {
                Messages::setMsg('Problem occurred when trying to create drop.', \MSG::USER_ERROR);
                HTTP::headerRedirectTo('/drops');
                // Validation failure
            } elseif ($status === \ModelReturnStatus::FAILURE_VALIDATION) {
                View::render($this->className, $this->action, $data, true);
            }
        }
    }

    protected function edit()
    {
        $model = new \DroplineMVC\Models\Drop();

        // Validation - Current logged in user can only edit drops he created
        $drop_user_id = $model->getDrop($this->id)[1]['user_id'];
        if ($_SESSION['user_data']['id'] !== $drop_user_id) {
            Messages::setMsg('You can only edit drops you have created!', \MSG::USER_ERROR);
            HTTP::headerRedirectTo('/drops');
        }

        if (HTTP::reqIsGET()) {
            list($status, $data) = $model->getDrop($this->id, true);

            // Data handling success
            if ($status === \ModelReturnStatus::SUCCESS) {
                View::render($this->className, $this->action, $data, true);
                // Data handling failure
            } elseif ($status === \ModelReturnStatus::FAILURE_GENERAL) {
                Messages::setMsg('Problem occurred when trying to edit drop with ID: #' . $this->id, \MSG::USER_ERROR);
                HTTP::headerRedirectTo('/drops');
            }
        }

        if (HTTP::reqIsPOST()) {
            // Sanitize POST
            // Sanitize reserved characters in HTML (<,>,&,") - test <strong>text</strong> -> text
            // Sanitize XSS - test <script>alert('Gotcha!')</script>
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            list($status, $data) = $model->updateDrop($this->id, $post);

            // Data handling success
            if ($status === \ModelReturnStatus::SUCCESS) {
                Messages::setMsg('Drop with ID: #' . $this->id . ' successfully updated.', \MSG::USER_SUCCESS);
                HTTP::headerRedirectTo('/drops');
                // Data handling failure
            } elseif ($status === \ModelReturnStatus::FAILURE_GENERAL) {
                Messages::setMsg('Problem occurred when trying to edit drop with ID: #' . $this->id, \MSG::USER_ERROR);
                HTTP::headerRedirectTo('/drops');
                // Validation failure
            } elseif ($status === \ModelReturnStatus::FAILURE_VALIDATION) {
                View::render($this->className, $this->action, $data, true);
            }
        }
    }
}