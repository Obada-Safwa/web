<?php

class ExamDao {

    private $conn;

    /**
     * constructor of dao class
     */
    public function __construct(){
        try {
            $host = "db1.ibu.edu.ba";
            $username = "webmakeup_24";
            $password = "web24makePWD";
            $dbname = "webmakeup";
            $port = 3306;

            $this->conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          echo "Connected successfully";
        } catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
        }
    }

    /** TODO
     * Implement DAO method used to get employees performance report
     */
    public function employees_performance_report(){
      $query = "
      SELECT 
          e.employeeNumber AS id, 
          CONCAT(e.firstName, ' ', e.lastName) AS full_name, 
          e.email,
          SUM(p.amount) AS total 
      FROM 
          employees e
      JOIN 
          customers c ON e.employeeNumber = c.salesRepEmployeeNumber
      JOIN 
          payments p ON c.customerNumber = p.customerNumber
      GROUP BY 
          e.employeeNumber, e.firstName, e.lastName
  ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    /** TODO
     * Implement DAO method used to delete employee by id
     */
    public function delete_employee($employee_id) {
      $query = "DELETE FROM employees WHERE employeeNumber = :employee_id";
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':employee_id', $employee_id);
      $stmt->execute();
    }

    /** TODO
     * Implement DAO method used to edit employee data
     */
    public function edit_employee($employee_id, $data){

      $firstName = isset($data['firstName']) ? $data['firstName'] : null;
      $lastName = isset($data['lastName']) ? $data['lastName'] : null;
      $email = isset($data['email']) ? $data['email'] : null;

      $query = "
      UPDATE employees 
      SET firstName = :first_name, lastName = :last_name, email = :email 
      WHERE employeeNumber = :employee_id
  ";
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':first_name', $firstName);
      $stmt->bindParam(':last_name', $lastName);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':employee_id', $employee_id);
      $stmt->execute();

  $query = "SELECT * FROM employees WHERE employeeNumber = :employee_id";
  $stmt = $this->conn->prepare($query);
  $stmt->bindParam(':employee_id', $employee_id);
  $stmt->execute();
  return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /** TODO
     * Implement DAO method used to get orders report
     */
    public function get_orders_report(){
      $query = "
        SELECT 
            o.orderNumber AS order_number,
            SUM(od.quantityOrdered * od.priceEach) AS total_amount
        FROM 
            orders o 
        JOIN 
            orderdetails od ON o.orderNumber = od.orderNumber
        GROUP BY 
            o.orderNumber
    ";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** TODO
     * Implement DAO method used to get all products in a single order
     */
    public function get_order_details($order_id){
      $query = "
        SELECT 
            p.productName AS product_name, 
            od.quantityOrdered AS quantity, 
            od.priceEach AS price_each 
        FROM 
            orderdetails od 
        JOIN 
            products p ON od.productCode = p.productCode 
        WHERE 
            od.orderNumber = :order_id
    ";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':order_id', $order_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
