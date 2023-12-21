<?php

namespace sip\Controller;

include "Traits/ApiResponseFormatter.php";
include "Models/OrderModel.php";

use sip\Models\Order;
use sip\Traits\ApiResponseFormatter;

class OrderController {

    use ApiResponseFormatter;

    public function index() {
        $orderModel = new Order();
        $response = $orderModel->findAll();
        return $this->apiResponse(200, "success", $response);
    }

    public function getById($id) {
        $orderModel = new Order();
        $response = $orderModel->findById($id);
        return $this->apiResponse(200, "success", $response);
    }

    public function insert() {

        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);

        if (json_last_error()) {
            return $this->apiResponse(400, "error invalid input", null);
        }

        $orderModel = new Order();
        $response = $orderModel->create([
            "customer_id" => $inputData['customer_id'],
            "product" => $inputData['product'],
            "quantity" => $inputData['quantity'],
        ]);

        return $this->apiResponse(200, "success", $response);
    }

    public function update($id) {

        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);

        if (json_last_error()) {
            return $this->apiResponse(400, "error invalid input", null);
        }

        $orderModel = new Order();
        $response = $orderModel->update([
            "customer_id" => $inputData['customer_id'],
            "product" => $inputData['product'],
            "quantity" => $inputData['quantity'],
        ], $id);

        return $this->apiResponse(200, "success", $response);
    }

    public function delete($id) {
        $orderModel = new Order();
        $response = $orderModel->destroy($id);
        return $this->apiResponse(200, "success", $response);
    }
}
