$(document).ready(function() {
    $('[data-toggle="tm-tooltip"]').tooltip();

    vm = initVue();

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

    $("body").on("click", ".update-employee-profile ", function() {
        var base_url = $(".base-url").val();

        $.ajax({
            url  : base_url + "employee/getEmployeeInfo",
            type : 'POST',
            data :{
                'tm_hr_token' : $("#frm-update-employee-profile").find("input[name='tm_hr_token']").val(),
                'employee_id' : $("#employee-id").val()
            },
            success: function(result) {
                data = JSON.parse(result);
                
                if(data.first_name.length > 0) {
                    vm.first_name          = data.first_name;
                    vm.middle_name         = data.middle_name;
                    vm.last_name           = data.last_name;
                    vm.gender              = data.gender;
                    vm.birth_date          = data.birth_date;
                    vm.address             = data.address;
                    vm.phone_number        = data.phone_number;
                    vm.email_address       = data.email_address;
                    vm.bank_account_number = data.bank_account_number;
                    vm.sss_number          = data.sss_number;
                    vm.hdmf_number         = data.hdmf_number;
                    vm.philhealth_number   = data.philhealth_number;

                    $("#modal-update-employee-profile").modal("show");
                }
            }
        });
    });

    function initVue() {
        var vm = new Vue({
            el: '#frm-update-employee-profile',
            data: {
                first_name         : "",
                middle_name        : "",
                last_name          : "",
                gender             : "",
                birth_date         : "",
                address            : "",
                phone_number       : "",
                email_address      : "",
                bank_account_number: "",
                sss_number         : "",
                hdmf_number        : "",
                philhealth_number  : ""
            }
        });

        return vm;
    }

    $("body").on("click", ".btn-employee-update", function() {
        data                        = {};
        data["first_name"]          = vm.first_name;
        data["middle_name"]         = vm.middle_name;
        data["last_name"]           = vm.last_name;
        data["gender"]              = vm.gender;
        data["birth_date"]          = vm.birth_date;
        data["address"]             = vm.address;
        data["phone_number"]        = vm.phone_number;
        data["email_address"]       = vm.email_address;
        data["bank_account_number"] = vm.bank_account_number;
        data["sss_number"]          = vm.sss_number;
        data["hdmf_number"]         = vm.hdmf_number;
        data["philhealth_number"]   = vm.philhealth_number;

        console.log(data); return false;
    });
});
