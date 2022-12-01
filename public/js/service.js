$(document).ready(function () {
    
//DATATABLE INDEX
    $('#itable').DataTable({
        ajax: {
            url: "/api/service/all",
            dataSrc: ""
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
            text: 'Add Service',
            className: 'btn btn-dark glyphicon glyphicon-list-alt',
            action: function (e, dt, node, config) {
                $("#iform").trigger("reset");
                $('#itemModal').modal('show');
                $('#itemUpdate').hide();


            }
        },
        ],
        columns: [
            { data: 'service_id' },
            { data: 'description' },
            { data: 'price' },
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
                        data.service_id +
                        "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:30px' ></i></a><a href='#' class='deletebtn' data-id=" + data.service_id + "><i class='fa-solid fa-trash-can' style='font-size:30px; color:red; margin-left:20px;'></a></i>";
                },
            },

        ]
    })//end datatables

//CREATE
    $("#itemSubmit").on("click", function (e) {
        e.preventDefault();
        // var data = $("#iform").serialize();
        var data = $('#iform')[0];
        console.log(data);
        let formData = new FormData(data);

        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }

        $.ajax({
            type: "post",
            url: "/api/service",
            data: formData,
            contentType: false,
            processData: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",

            success: function (data) {
                console.log(data);

                $("#itemModal").modal("hide");
                window.location.reload();
                var $itable = $('#itable').DataTable();
                $itable.row.add(data.item).draw(false);
            },

            error: function (error) {
                console.log(error);
            }
        })
    });

//EDIT FETCH
    $("#itable tbody").on("click", "a.editBtn", function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#editItemModal').modal('show');
        $.ajax({
            type: "GET",
            url: "api/service/" + id + "/edit",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function(data){
                   console.log(data);
                   $("#sservice_id").val(data.service_id);
                   $("#sdescription").val(data.description);
                   $("#sprice").val(data.price);
                   $("#simg_path").val(data.img_path);
                },
                error: function(){
                    console.log('AJAX load did not work');
                    alert("error");
                }
            });
        });//end edit fetch










        
        $("#updatebtnItem").on('click', function(e) {
            e.preventDefault();
            var id = $('#sservice_id').val();
            //var data = $("#updateItemform").serialize();
            console.log(data);

            var table =$('#itable').DataTable();
            var cRow = $("tr td:contains(" + id + ")").closest('tr');
            var data =$("#ayform").serialize();

            $.ajax({
                type: "PUT",
                url: "api/service/"+ id,
                data: data,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    // $('#editItemModal').each(function(){
                    //         $(this).modal('hide'); });

                    $('#editItemModal').modal("hide");
                    table.row(cRow).data(data).invalidate().draw(false);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });//end update

//DELETE
    //     $("#itable tbody").on("click", "a.deletebtn", function (e) {
    //         var table = $('#itable').DataTable();
    //         var id = $(this).data('id');
    //         var $row = $(this).closest('tr');
    //         console.log(id);

    //         e.preventDefault();
    //         bootbox.confirm({
    //             message: "Do you want to delete this item",
    //             buttons: {
    //                 confirm: {
    //                     label: "Yes",
    //                     className: "btn-success",
    //                 },
    //                 cancel: {
    //                     label: "No",
    //                     className: "btn-danger",
    //                 },
    //             },
    //             callback: function (result) {
    //                 if (result)
    //                     $.ajax({
    //                         type: "DELETE",
    //                         url: "/api/service/" + id,
    //                         headers: {
    //                             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
    //                                 "content"
    //                             ),
    //                         },
    //                         dataType: "json",
    //                         success: function (data) {
    //                             console.log(data);
    //                             // bootbox.alert('success');
    //                             // $tr.find("td").fadeOut(2000, function () {
    //                             //     $tr.remove();
    //                             $row.fadeOut(4000, function(){
    //                                 table.row($row).remove().draw(false)
    //                             });
    //                             bootbox.alert(data.success)

    //                         },
    //                         error: function (error) {
    //                             console.log(error);
    //                         },
    //                     });
    //             },
    //         });
    //     });





    // $('#itable tbody').on('click', 'a.editBtn'), function
    // (e) {
    //     e.preventDefault();
    //     var id = $(this).data('id');
    //     $('#itemModal').modal('show');
    //     $.ajax({
    //         type: "GET",
    //         url: "/api/service" + id + '/edit',
    //         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    //         dataType: "json",
    //         success: function (data) {
    //             console.log(data);
    //             $('itemId').val(data.item_id)
    //             $('#desc').val(data.description)
    //             $('#sell').val(data.sell_price)
    //             $('#cost').val(data.cost_price)
    //         },
    //         error: function (error) {
    //             console.log(error);
    //         }
    //     });
    // }

    // $('#itemUpdate').on('click', function(e) {

    // })
}); //Document.ready end