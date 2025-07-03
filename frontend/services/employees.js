var EmployeesService = {
  delete_employee: async function ($employee_id) {
    // TODO: Implement delete employee functionality
    console.log("Delete employee with id:", $employee_id);
    RestClient.delete(
      "employee/delete/${employee_id}",
      {},
      function (response) {
        console.log(response);
      }
    );
  },
  edit_employee: async function (employee_id) {
    // TODO: Implement edit employee functionality
    console.log("Edit employee with id:", employee_id);
    new bootstrap.Modal(document.getElementById("edit-employee-modal")).show();
  },
};
