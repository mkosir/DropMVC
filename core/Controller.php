<?php

namespace DroplineMVC\Core;

use DroplineMVC\Utils\Messages;
use DroplineMVC\Utils\HTTP;

/**
 * Class Drop
 */
abstract class Controller
{
    protected $className;
    protected $id;
    protected $action;

    /**
     * Drop constructor.
     * @param $action
     * @param $id
     */
    public function __construct($action, $id)
    {
        $this->action = $action;
        $this->id = $id;

        // Get just class name (without namespaces) - e.g. 'Drop\Controllers\Home'
        $this->className = (new \ReflectionClass($this))->getShortName(); // Home = (Drop\Controllers\Home)->getShortName()
    }

    public function __call($name, $arguments)
    {
        $method = $name . 'Action';

        // Execute code before Action
        if ($this->before() !== false) {
            call_user_func_array([$this, $method], $arguments);
            // Execute code after Action
            $this->after();
        }
    }

    public function executeAction()
    {
        // Call method (action) inside child class - e.g. this->index();
        return $this->{$this->action}();
    }

    private function before()
    {
        if ($this->viewsAuthorization() and $this->viewsLoginDenied()) {
            return true;
        } else {
            return false;
        }
    }

    private function viewsAuthorization(): bool
    {
        // Requested view
        $reqView = strtolower($this->className . '/' . $this->action);

        // Views that needs "login" user rights
        $viewsAuthLogin = array("drops/add", "drops/edit");

        // For authorized views check if user is logged in
        if (in_array($reqView, $viewsAuthLogin)) {
            if (!isset($_SESSION['is_logged_in'])) {
                Messages::setMsg('Authorization failed. Higher user rights required.', \MSG::USER_ERROR);
                // Redirect to index view of requested class
                HTTP::headerRedirectTo('/');
            }
        }
        return true;
    }

    /**
     * Certain views logged in user must not access.
     *
     * @return bool
     */
    private function viewsLoginDenied(): bool
    {
        // Requested page
        $reqView = strtolower($this->className . '/' . $this->action);

        // Views where access is denied if user is logged in
        $viewsLoginDenied = array("users/login", "users/register");

        // For authorization pages check if user is logged in
        if (in_array($reqView, $viewsLoginDenied)) {
            if (isset($_SESSION['is_logged_in'])) {
                // Redirect to index page of requested class
                HTTP::headerRedirectTo('/');
                return false;
            }
        }
        return true;
    }

    private function after()
    {
        // Write a message to a log
    }
}