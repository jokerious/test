$(document).ready(function() {
    $('[data-toggle="tm-tooltip"]').tooltip();

    $(".date-picker").datepicker({
        todayHighlight: true,
        autoclose: true,
        closeOnDateSelect: true
    });

    $("body").on("click", ".btn-add-employee", function() {
        $("#modal-add-employee").modal("show");
    });

    $("body").on("click", ".btn-employee-save", function() {
        var form_data = $("#form-add-employee").find(':not(input[name=tm_hr_token])').serializeArray();
        var base_url  = $(".base-url").val();

        $.ajax({
            url  : base_url + "employee/insertEmployee",
            type : 'POST',
            data :{
                'tm_hr_token' : $("#form-add-employee").find("input[name='tm_hr_token']").val(),
                'data' : form_data
            },
            success: function(result) {
                data = JSON.parse(result);

                if(data.error == true) {
                    alertify.alert(getMessageType("invalid") + "Employee Add", data.message);
                } else {
                    alertify.alert(getMessageType("success") + "Employee Add",
                                   data.message,
                                   function() {
                                    location.reload();
                                   });

                    $("#form-add-employee").trigger("reset");
                }
            }
        });
    });

    $("body").on("input", "#employee-first-name", function() {
        var first_name = $(this).val();
        var last_name  = $("#employee-last-name").val();
        var username   = "";


        if(first_name.length > 0) {
            username = first_name.charAt(0) + last_name;
        }

        $("#employee-username").val(username);
        $("#employee-password").val(username);
    });

    $("body").on("input", "#employee-last-name", function() {
        var first_name = $("#employee-first-name").val();
        var last_name  = $(this).val();
        var username   = "";


        if(first_name.length > 0) {
            username = first_name.charAt(0) + last_name;
        }

        $("#employee-username").val(username.replace(/\s+/g, ''));
        $("#employee-password").val(username.replace(/\s+/g, ''));
    });

    $("body").on("click", ".toggle-password", function() {
        $(this).toggleClass("fa-eye fa-eye-slash");

        var input = $($(this).closest("div").find("input"));

        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

    function getMessageType(type) {
        result = '<i class="text-info glyphicon glyphicon-info-sign"></i> ';

        if(type == 'invalid') {
            result = '<i class="text-red glyphicon glyphicon-exclamation-sign"></i> ';
        }

        if(type == 'error') {
            result = '<i class="text-green glyphicon glyphicon-info-sign"></i> ';
        }

        return result;
    }

    $("body").on("click", ".date-picker-icon", function() {
        $(this).closest("div").find(".date-picker").datepicker("show");
    });

    $("body").on("click", ".emp-row", function() {
        $(".emp-row").removeClass("emp-row-selected");
        $(this).toggleClass("emp-row-selected");
    });

    $("body").on("dblclick", ".emp-row", function() {
        var emp_id = $(this).data("emp-detail");

        $("#employee-id").val(emp_id);

        $("#frm-emp-profile").submit();
    });
});