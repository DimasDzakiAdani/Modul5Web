<?php

namespace sip\Controller;

include "Traits/ApiResponseFormatter.php";
include "Models/CustomerModel.php";

use sip\Models\Customer;
use sip\Traits\ApiResponseFormatter;

class CustomerController {

    use ApiResponseFormatter;

    public function index() {
        $customerModel = new Customer();
        $response = $customerModel->findAll();
        return $this->apiResponse(200, "success", $response);
    }

    public function getById($id) {
        $customerModel = new Customer();
        $response = $customerModel->findById($id);
        return $this->apiResponse(200, "success", $response);
    }

    public function insert() {

        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);

        if (json_last_error()) {
            return $this->apiResponse(400, "error invalid input", null);
        }

        $customerModel = new Customer();
        $response = $customerModel->create([
            "name" => $inputData['name'],
            "email" => $inputData['email'],
        ]);

        return $this->apiResponse(200, "success", $response);
    }

    public function update($id) {

        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);

        if (json_last_error()) {
            return $this->apiResponse(400, "error invalid input", null);
        }

        $customerModel = new Customer();
        $response = $customerModel->update([
            "name" => $inputData['name'],
            "email" => $inputData['email'],
        ], $id);

        return $this->apiResponse(200, "success", $response);
    }

    public function delete($id) {
        $customerModel = new Customer();
        $response = $customerModel->destroy($id);
        return $this->apiResponse(200, "success", $response);
    }
}
