$(document).ready(function() {
    $("body").on("click", ".btn-update-password", function() {
        $("#modal-update-password").modal("show");
    });

    $("body").on("mousedown", ".view-password", function() {
        $(this).closest("div").find("input").prop("type", "text");
    });

    $("body").on("mouseup", ".view-password", function() {
        $(this).closest("div").find("input").prop("type", "password");
    });

    $("body").on("click", ".btn-save-password", function() {
        var current_password = $("#current-password").val();
        var new_password     = $("#new-password").val();
        var confirm_password = $("#confirm-new-password").val();
        var error            = false;
        var base_url         = $(".base-url").val();

        if(current_password.length == 0) {
            alertify.alert(getMessageType("invalid", "Update Password"), "Invalid input of Current Password.");

            error = true;
            return false;
        }

        if(new_password.length == 0) {
            alertify.alert(getMessageType("invalid", "Update Password"), "Invalid input of New Password.");

            error = true;
            return false;
        }

        if(confirm_password.length == 0) {
            alertify.alert(getMessageType("invalid", "Update Password"), "Invalid input of Confirm New Password.");

            error = true;
            return false;
        }

        if(confirm_password != new_password) {
            alertify.alert(getMessageType("invalid", "Update Password"), "New Password and Confirm New Password mismatched.");

            error = true;
            return false;
        }

        if(!error) {
            $.ajax({
                url  : base_url + "Dashboard/updateEmployeePassword",
                type : 'POST',
                data :{
                    'tm_hr_token'      : $("#frm-update-password").find("input[name='tm_hr_token']").val(),
                    'current_password' : current_password,
                    'new_password'     : new_password,
                    'confirm_password' : confirm_password
                },
                success: function(result) {
                    data = JSON.parse(result);

                    if(data.error == true) {
                        alertify.alert(getMessageType("invalid", "Update Password"), data.message);
                    } else {
                        $("#modal-update-password").modal("hide");

                        alertify.alert(getMessageType("success", "Update Password"), data.message);
                    }
                }
            });
        }
    });

    function getMessageType(type, title) {
        result = '<i class="text-info glyphicon glyphicon-info-sign"></i> ';

        if(type == 'invalid') {
            result = '<i class="text-red glyphicon glyphicon-exclamation-sign"></i> ';
        }

        if(type == 'error') {
            result = '<i class="text-green glyphicon glyphicon-info-sign"></i> ';
        }

        result = result + " " + title;

        return result;
    }
});
