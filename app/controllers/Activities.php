<?php
namespace DroplineMVC\Controllers;

use DroplineMVC\Core\Controller;
use DroplineMVC\Utils\HTTP;
use DroplineMVC\Core\View;
use DroplineMVC\Utils\Messages;

class Activities extends Controller
{
    protected function index()
    {
        $model = new \DroplineMVC\Models\Activity();
        list($status, $data) = $model->getActivities();

        // Data handling success
        if ($status === \ModelReturnStatus::SUCCESS) {
            View::render($this->className, $this->action, $data, true);
            // Data handling failure
        } elseif ($status === \ModelReturnStatus::FAILURE_GENERAL) {
            Messages::setMsg('Problem occurred when trying to display activities.', \MSG::USER_ERROR);
            //HTTP::headerRedirectTo(ROOT_URL . 'activities');
            View::render($this->className, $this->action, $data, true);
        }
    }
}