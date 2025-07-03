<?php

class ExamDao
{

    private $connection;
    private static $servername = "localhost";
    private static $username = "root";
    private static $password = "";
    private static $dbName = "classicmodels";

    /**
     * constructor of dao class
     */
    public function __construct()
    {
        try {

            $this->connection = new PDO(
                "mysql:host=" . self::$servername . ";dbname=" . self::$dbName,
                self::$username,
                self::$password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );

            echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    /** TODO
     * Implement DAO method used to get employees performance report
     */
    public function employees_performance_report()
    {
        $sql = $this->connection->prepare(
            "select e.employeeNumber as id, concat(e.firstName, ' ', e.lastName) as full_name, e.email as email,
            sum(p.amount) as total
            from employees e
            INNER JOIN customers c ON c.salesRepEmployeeNumber = e.employeeNumber
            INNER JOIN payments p ON c.customerNumber = c.customerNumber
            group by id
            ;"
        );
        $sql->execute();
        return $sql->fetchAll();
    }

    /** TODO
     * Implement DAO method used to delete employee by id
     */
    public function delete_employee($employee_id)
    {
        $query = "DELETE FROM employees WHERE employeeNumber = :employee_id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':employee_id', $employee_id);
        $stmt->execute();
    }

    /** TODO
     * Implement DAO method used to edit employee data
     */
    public function edit_employee($employee_id, $data)
    {
        $query = "
        UPDATE employees 
        SET firstName = :first_name, lastName = :last_name, email = :email 
        WHERE employeeNumber = :employee_id
    ";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':first_name', $firstName);
        $stmt->bindParam(':last_name', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':employee_id', $employee_id);
        $stmt->execute();

        $query = "SELECT * FROM employees WHERE employeeNumber = :employee_id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':employee_id', $employee_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /** TODO
     * Implement DAO method used to get orders report
     */
    public function get_orders_report()
    {
        $sql = $this->connection->prepare(
            "select p.productName, od.quantityOrdered,  od.priceEach, od.orderNumber as order_number,
                    sum(od.quantityOrdered * od.priceEach) as total_amount
                    from products p
                    inner join orderdetails od ON od.productCode = p.productCode
                    group by p.productName, od.quantityOrdered,  od.priceEach, order_number;"
        );
        $sql->execute();
        return $sql->fetchAll();
    }

    /** TODO
     * Implement DAO method used to get all products in a single order
     */
    public function get_order_details($order_id)
    {
        $sql = $this->connection->prepare(
            "select p.productName AS product_name, od.quantityOrdered as quantity,  od.priceEach as price_each
                    from products p
                    inner join orderdetails od ON od.productCode = p.productCode
                    where od.orderNumber = " . $order_id . ";"
        );
        $sql->execute();
        return $sql->fetchAll();
    }
}
// $dao = new ExamDao();
// $dao->delete_employee(1056); // Example usage