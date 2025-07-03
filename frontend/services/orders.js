var OrdersService = {
  get_orders_report: function () {
    // TODO: Implement get orders report functionality
    RestClient("orders/report", (response) => {
      const tableBody = document.querySelector("#customer-meals tbody");
      tableBody.innerHTML = ""; // Clear previous rows
      response.forEach((order) => {
        const row = document.createElement("tr");
        row.innerHTML = `
          <td class="text-center">
            <button
              type="button"
              class="btn btn-success"
              data-bs-toggle="modal"
              data-bs-target="#order-details-modal"
              data-bs-id="${order.order_number}"
            >
              Details
            </button>
          </td>
          <td>${order.order_number}</td>
          <td>${order.total_amount}</td>
        `;
        tableBody.appendChild(row);
      });
    });
  },
  get_order_details: async function (order_id) {
    // TODO: Implement get order details functionality
    console.log("Get order details with id:", order_id);
  },
};
