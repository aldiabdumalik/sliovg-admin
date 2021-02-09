$(document).ready(function () {
  const baseurl = $(".baseurl").data("baseurl");
  const table = $("#datatable-cari-render").DataTable({
    retrieve: true,
    destroy: true,
  });
  $("#datepicker-inline")
    .datepicker()
    .on("changeDate", function (e) {
      $("#datatable-cari-render").DataTable({
        destroy: true,
        searching: false,
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
          url: `${baseurl}report/getDate/${e.format(0, "yyyy-mm-dd")}`,
          type: "POST",
        },
        columnDefs: [
          {
            targets: [0],
            orderable: false,
          },
        ],
      });
    });
});
