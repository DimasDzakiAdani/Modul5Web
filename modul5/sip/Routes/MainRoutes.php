<?php

namespace sip\Routes;

include_once "Controller/CustomerController.php";
include_once "Controller/OrderController.php";

use sip\Controller\CustomerController;
use sip\Controller\OrderController;

class MainRoutes {
    public function handle($method, $path) {

        // Handle Customer Routes
        if ($method === 'GET' && $path === '/api/customer') {
            $customerController = new CustomerController();
            echo $customerController->index();
        }

        if ($method === 'GET' && strpos($path, '/api/customer/') === 0) {
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 1];
            $customerController = new CustomerController();
            echo $customerController->getById($id);
        }

        if ($method === 'POST' && $path === '/api/customer') {
            $customerController = new CustomerController();
            echo $customerController->insert();
        }

        if ($method === 'PUT' && strpos($path, '/api/customer/') === 0) {
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 1];
            $customerController = new CustomerController();
            echo $customerController->update($id);
        }

        if ($method === 'DELETE' && strpos($path, '/api/customer/') === 0) {
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 1];
            $customerController = new CustomerController();
            echo $customerController->delete($id);
        }

        // Handle Order Routes
        if ($method === 'GET' && $path === '/api/order') {
            $orderController = new OrderController();
            echo $orderController->index();
        }

        if ($method === 'GET' && strpos($path, '/api/order/') === 0) {
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 1];
            $orderController = new OrderController();
            echo $orderController->getById($id);
        }

        if ($method === 'POST' && $path === '/api/order') {
            $orderController = new OrderController();
            echo $orderController->insert();
        }

        if ($method === 'PUT' && strpos($path, '/api/order/') === 0) {
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 1];
            $orderController = new OrderController();
            echo $orderController->update($id);
        }

        if ($method === 'DELETE' && strpos($path, '/api/order/') === 0) {
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 1];
            $orderController = new OrderController();
            echo $orderController->delete($id);
        }
    }
}
