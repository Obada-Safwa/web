var EmployeesService = {
    delete_employee: async function(employee_id) {
        if (
          confirm(
            "Do you want to delete employee with the id " + employee_id + "?"
          ) == true
        ) {
    const response = await fetch(`../backend/rest/employee/delete/${employee_id}`, {
      method: 'DELETE',
    });
    const htmlText = await response.text();
    alert(htmlText);
        }
    },
    edit_employee: async function(employee_id){
      try {
        const response = await fetch(`../backend/rest/employees/performance`);
        const employees = await response.json();
  
        const employee = employees.find(emp => emp.id === employee_id);
        if (!employee) {
          throw new Error(`Employee with id ${employee_id} not found.`);
        }

        fullName = employee.full_name.trim();
        const parts = fullName.split(/\s+/);
        let firstName = parts.slice(0, -1).join(' ');
        let lastName = parts.slice(-1).join(' ');

        document.getElementById('customer_id').value = employee.id;
        document.getElementById('first_name').value = firstName;
        document.getElementById('last_name').value = lastName;
        document.getElementById('email').value = employee.email;
  
        new bootstrap.Modal(document.getElementById('edit-employee-modal')).show();
      } catch (error) {
        console.error('Error fetching or displaying employee data:', error);
        alert('Error: Unable to fetch or display employee data');
      }
    }
}