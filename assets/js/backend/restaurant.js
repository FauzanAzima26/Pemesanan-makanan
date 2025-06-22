$(document).ready(function () {
  const tableElement = document.getElementById("restaurant-data");
  const getDataUrl = tableElement.dataset.getDataUrl;

  // Inisialisasi DataTable tanpa serverSide
  const table = $("#restaurant-table").DataTable({
    ajax: {
      url: getDataUrl,
      type: "GET",
      dataSrc: "data", // sesuai output controller
    },
    columns: [
      { data: "no" },
      { data: "owner" },
      { data: "name" },
      { data: "address" },
      { data: "status" },
      {
        data: "actions",
        orderable: false,
        searchable: false,
      },
    ],
  });
});
