"use strict";

$(document).ready(function () {
    $('.datatable').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "pageLength": 15,
        "lengthMenu": [10, 25, 30, 50, 100, 15],
    });
});




