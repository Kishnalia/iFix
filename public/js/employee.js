//DATATABLE INDEX
$("#etable").DataTable({
    ajax: {
        url: "/api/employee/all",
        dataSrc: "",
    },
    dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
    buttons: [{
        extend: 'pdf',
        className: 'btn btn-dark glyphicon glyphicon-file'
    },
    {
        extend: 'excel',
        className: 'btn btn-dark glyphicon glyphicon-list-alt'
    },
    {
        text: "Add Employee",
        className: 'btn btn-dark glyphicon glyphicon-list-alt',
        action: function (e, dt, node, config) {
            $("#eform").trigger("reset");
            $("#eModal").modal("show");
            // $('#eUpdate').hide();
            // $('#eSubmit').show();
            // $('#email').show();
            // $('#password').show();
            // $('#image').show();
            // $('#lemail').show();
            // $('#lpassword').show();
            // $('#llpassword').show();
            // $('#password-confirm').show();
            // $('#limage').show();
            // $('#img_path').show();
        },
    },
    ],
    columns: [
        { data: 'employee_id' },
        { data: 'title' },
        { data: 'lname' },
        { data: 'fname' },
        { data: 'addressline' },
        { data: 'town' },
        { data: 'zipcode' },
        { data: 'phone' },
        {
            data: null,
            render: function (data, type, row) {
                console.log(data.img_path)
                return `<img src= "/storage/${data.img_path}" style='border:solid 5px;' height="130px" width="130px">`;
            }
        },
        {
            data: null,
            render: function (data, type, row) {
                return "<a href='#' class='editBtn' id='editbtn' data-id=" +
                    data.employee_id +
                    "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:30px' ></i></a><a href='#' class='deletebtn' data-id=" + data.employee_id + "><i class='fa-solid fa-trash-can' style='font-size:30px; color:red; margin-left:10px;'></a></i>";
            },
        },
    ]
});

//CREATE
$("#eSubmit").on("click", function (e) {
    e.preventDefault();
    var data = $('#eform')[0];
    console.log(data);
    let formData = new FormData(data);
    console.log(formData);
    for (var pair of formData.entries()) {
        console.log(pair[0] + ',' + pair[1]);
    }

    $.ajax({
        type: "POST",
        url: "/api/employee",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            $('#eModal').modal("hide");
            window.location.reload();
            var $ctable = $('#etable').DataTable();
            $itable.row.add(data.item).draw(false);
            $ctable.ajax.reload();
        },
        error: function (error) {
            console.log(error)
        }
    })

});

//EDIT FETCH
$("#etable tbody").on("click", "a.editBtn", function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#editEmployeeModal').modal('show');

    $.ajax({
        type: "GET",
        url: "api/employee/" + id + "/edit",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            $("#eemployee_id").val(data.employee_id);
            $("#etitle").val(data.title);
            $("#efname").val(data.fname);
            $("#elname").val(data.lname);
            $("#eaddressline").val(data.addressline);
            $("#etown").val(data.town);
            $("#ezipcode").val(data.zipcode);
            $("#ephone").val(data.phone);
            // $("#euploads").val(data.img_path);
        },
        error: function () {
            console.log('AJAX load did not work');
            alert("error");
        }
    });
});

//EDIT BUTTON  
$("#eUpdate").on('click', function(e) {
    e.preventDefault();
    var id = $('#eemployee_id').val();
    // var data = $("#editform").serialize();
    console.log(data);

    var table =$('#etable').DataTable();
    var cRow = $("tr td:contains(" + id + ")").closest('tr');
    var data =$("#editform").serialize();

    $.ajax({
        type: "PUT",
        url: "api/employee/"+ id,
        data: data,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: "json",
        success: function(data) {
            console.log(data);
            // $('#editItemModal').each(function(){
            //         $(this).modal('hide'); });

            // $('#editCustomerModal').modal("hide");
            bootbox.alert("EMPLOYEE UPDATED SUCCESSFULLY!");
            $('#editEmployeeModal').modal("hide");

            // window.location.reload();
            table.row(cRow).data(data).invalidate().draw(false);
        },
        error: function(error) {
            console.log(error);
        }
    });
});

//DELETE
$("#etable tbody").on("click", 'a.deletebtn', function (e) {

    var table = $('#etable').DataTable();
    var id = $(this).data("id");
    var $row = $(this).closest("tr");

    console.log(id);
    e.preventDefault();
    bootbox.confirm({
        message: "Do you want to delete this employee?",
        buttons: {
            confirm: {
                label: "yes",
                className: "btn-success",
            },
            cancel: {
                label: "no",
                className: "btn-danger",
            },
        },
        callback: function (result) {
            console.log(result);
            if (result)
                $.ajax({
                    type: "DELETE",
                    url: "/api/employee/" + id,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        // bootbox.alert('success');
                        $row.fadeOut(4000, function () {
                            table.row($row).remove().draw(false);
                        });
                        // bootbox.alert(data.success);
                        bootbox.alert("EMPLOYEE DELETED SUCCESSFULLY!");

                    },
                    error: function (error) {
                        console.log("error");
                    },
                });
        },
    });
});