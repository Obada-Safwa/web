<?php
require_once __DIR__ . "/../dao/ExamDao.php";

class ExamService
{
    protected $dao;

    public function __construct()
    {
        $this->dao = new ExamDao();
    }

    /** TODO
     * Implement service method used to get employees performance report
     */
    public function employees_performance_report()
    {
        // TODO: Implement employee performance report
        return $this->dao->employees_performance_report();
    }

    /** TODO
     * Implement service method used to delete employee by id
     */
    public function delete_employee($employee_id)
    {
        // TODO: Implement delete employee
        return $this->dao->delete_employee($employee_id);
    }

    /** TODO
     * Implement service method used to edit employee data
     */
    public function edit_employee($employee_id, $data)
    {
        // TODO: Implement edit employee
        return $this->dao->edit_employee($employee_id, $data);
    }

    /** TODO
     * Implement service method used to get orders report
     */
    public function get_orders_report()
    {
        // TODO: Implement get orders report
        return $this->dao->get_orders_report();
    }

    /** TODO
     * Implement service method used to get all products in a single order
     */
    public function get_order_details($order_id)
    {
        // TODO: Implement get order details
        return $this->dao->get_order_details($order_id);
    }
}
