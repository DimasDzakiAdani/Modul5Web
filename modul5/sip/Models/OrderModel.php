<?php

namespace sip\Models;

include "Config/DatabaseConfig.php";

use sip\Config\DatabaseConfig;
use mysqli;

class Order extends DatabaseConfig
{
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database_name, $this->port);
        if ($this->conn->connect_error) {
            die("Connection Failed: " . $this->conn->connect_error);
        }
    }

    public function findAll()
    {
        $sql = "SELECT * FROM orders";
        $result = $this->conn->query($sql);
        $this->conn->close();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM orders WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $this->conn->close();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    public function create($data)
    {
        $customerId = $data['customer_id'];
        $product = $data['product'];
        $quantity = $data['quantity'];

        $query = "INSERT INTO orders (customer_id, product, quantity) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iss", $customerId, $product, $quantity);
        $stmt->execute();
        $this->conn->close();
    }

    public function update($data, $id)
    {
        $customerId = $data['customer_id'];
        $product = $data['product'];
        $quantity = $data['quantity'];

        $query = "UPDATE orders SET customer_id = ?, product = ?, quantity = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("issi", $customerId, $product, $quantity, $id);
        $stmt->execute();
        $this->conn->close();
    }

    public function destroy($id)
    {
        $query = "DELETE FROM orders WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $this->conn->close();
    }
}
