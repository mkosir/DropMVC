<?php

namespace DroplineMVC\Core;

/**
 * Class Router
 */
class Router
{
    private $route;
    private $controller;
    private $action;
    private $id;

    /**
     * Router constructor.
     * @param array $route
     */
    public function __construct(array $route = array('controller'=>'', 'action'=>'', 'id'=>''))
    {
        $this->route = $route;

        // If there is no controller (root url), create "home" controller
        if ($route['controller'] == "") {
            $this->controller = 'Home';
        } else {
            $this->controller = $route['controller'];
        }
        // If there is no action, create "index" action
        if ($route['action'] == "") {
            $this->action = 'index';
        } else {
            $this->action = $route['action'];
        }
        $this->id = $route['id'];

        // Necessary addition for namespaces - e.g. 'DroplineMVC\Controllers\Home'
        $this->controller = NS_MAIN . "\\" . NS_CONTROLLERS . "\\" . $this->controller;
        print_r($this->controller);
    }

    // Kind of factory method (not pattern)
    public function createController()
    {
        // Check if class exists
        if (class_exists($this->controller)) {
            $parents = class_parents($this->controller); // Get base class Controller
            // Check if parent controller is "Controller" (in namespace "core")
            if (in_array(NS_MAIN . "\\" . NS_CORE . "\\" . "Controller", $parents)) {
                // Check if class/controller has method/action
                if (method_exists($this->controller, $this->action)) {
                    return new $this->controller($this->action, $this->id); // Constructor of the controller
                } else {
                    // Method Does Not Exist
                    throw new \Exception('Method "' . $this->action . '" does not exist.', 404);
                }
            } else {
                // Base controller Does Not Exist
                throw new \Exception('Base controller does not exist.', 404);
            }
        } else {
            // Controller Class Does Not Exist
            throw new \Exception('Controller class "' . $this->controller . '" does not exist.', 404);
        }
    }
}