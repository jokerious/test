$(document).ready(function() {
    manageEvaluationNav();

    $('#table-evalute-ongoing').DataTable();
    $('#table-evalute-finished').DataTable();
    $('#table-evalute-expired').DataTable();
    
    $(".date-picker").datepicker({
        todayHighlight: true,
        autoclose: true,
        closeOnDateSelect: true
    });

    $("body").on("click", "#btn-create-evaluation", function() {
        getCreateEvaluationData();

        $("#modal-create-evaluation").modal("show");
    });

    function getCreateEvaluationData() {
        var url             = $(".base-url").val() + "evaluation/getCreateEvaluationData";
        var department      = $("#sel-eval-department").val();
        var department_head = "";
        var department_emp  = "";

        $("#sel-dep-head").prop("disabled", true);
        $("#sel-dep-emp").prop("disabled", true);
        $("#sel-dep-head").html("");
        $("#sel-dep-emp").html("");

        $.ajax({
            url  : url,
            type : 'POST',
            data :{
                'tm_hr_token' : $("#create-eval-token").val(),
                'department'  : department
            },
            success: function(result) {
                data = JSON.parse(result);

                if(data.employee_list.length > 0) {
                    $(data.employee_list).each(function(key, value) {
                        if(value.employee_type == 'Department Head') {
                            department_head += "<option class='ucfirst' value='" + value.employee_id + "'>" + value.last_name + ", " + value.first_name + " " + value.middle_name + "</option>";
                        } else {
                            department_emp  += "<option class='ucfirst' value='" + value.employee_id + "'>" + value.last_name + ", " + value.first_name + " " + value.middle_name + "</option>";
                        }
                    });

                    if(department_head.length > 0) {
                        $("#sel-dep-head").html(department_head);
                        $("#sel-dep-head").prop("disabled", false);
                    }

                    if(department_emp.length > 0) {
                        $("#sel-dep-emp").html(department_emp);
                        $("#sel-dep-emp").prop("disabled", false);
                    }

                }
            }
        });
    }

    $("body").on("change", "#sel-eval-department", function() {
        getCreateEvaluationData();
    });

    $("body").on("click", ".btn-create-evaluation", function() {
        var dep_head = $("#sel-dep-head").val();
        var dep_emp  = $("#sel-dep-emp").val();
        var error    = false;

        if(dep_head == null) {
            alertify.alert(getMessageType("invalid", "Create Evaluation"), "Please choose department head from the list.");
            error = true;
        }

        if(dep_emp == null) {
            alertify.alert(getMessageType("invalid", "Create Evaluation"), "Please choose employee from the list.");
            error = true;
        }

        if(!error) {
            createEvaluation();
        }
    });

    function getMessageType(type, title = "") {
        result = '<i class="text-info glyphicon glyphicon-info-sign"></i> ';

        if(type == 'invalid') {
            result = '<i class="text-red glyphicon glyphicon-exclamation-sign"></i> ';
        }

        if(type == 'info') {
            result = '<i class="text-green glyphicon glyphicon-info-sign"></i> ';
        }

        result += " " + title;

        return result;
    }

    function createEvaluation() {
        var dep_head        = $("#sel-dep-head").val();
        var dep_emp         = $("#sel-dep-emp").val();
        var department      = $("#sel-eval-department").val();
        var expiry_date     = $("#evaluation-expiry-date").val();
        var evaluation_type = $("#evalution-type").val();
        var url             = $(".base-url").val() + "evaluation/createEvaluation";

        $.ajax({
            url  : url,
            type : 'POST',
            data :{
                'tm_hr_token'    : $("#form-evaluate-employee").find("input[name='tm_hr_token']").val(),
                'dep_head'       : dep_head,
                'dep_emp'        : dep_emp,
                'department'     : department,
                'expiry_date'    : expiry_date,
                'evaluation_type': evaluation_type
            },
            success: function(result) {
                data = JSON.parse(result);

                if(data.error == true) {
                    alertify.alert(getMessageType("error", "Create Evaluation"), data.message);
                } else {
                    alertify.alert(getMessageType("info", "Create Evaluation"),
                                   data.message,
                                   function() {
                                        $("#modal-create-evaluation").modal("hide");
                                        location.reload();
                                   });
                }
            }
        });
    }

    $("body").on("click", ".tr-evaluate", function() {
        $(".tr-evaluate").removeClass("tr-evaluate-selected");

        $(this).addClass("tr-evaluate-selected");
    });

    $("body").on("click", ".btn-evaluate", function() {
        var evaluation_id = $(this).data("evaluation-id");
        
        if(typeof(evaluation_id) != "undefined" && evaluation_id != "") {
            $("#frm-evaluation").find("#evaluation-id").val(evaluation_id);

            $("#frm-evaluation").submit();
        }
    });

    function manageEvaluationNav() {
        var position = $(".nav-eval.active").position();
        var width    = $(".nav-eval.active").width();
        var text     = $(".nav-eval.active").text();

        $(".nav-active").html("<strong>"+text+"</strong>");
        $(".nav-active").css("width", (width+2) +'%');
        $(".nav-active").css("display", "block");
    }

    $("body").on("click", ".nav-eval", function() {
        var nav_position = $(".nav-active").position();
        var position     = $(this).position();
        var width        = $(this).width();
        var text         = $(this).text();
        var current_nav  = $(this).data("nav-num");

        $(".nav-active").html("<strong>"+text+"</strong>");
        $(".nav-active").css("width", (width+25) +'px');

        if(nav_position.left > position.left) {
            $(".nav-active").animate({left:"+" + (position.left)},200);
        } else {
            $(".nav-active").animate({left:"+" + (position.left+40)},200);
        }

        $(".nav-active").animate({left:"+" + (position.left+20)},200);

        if(current_nav == 7) {
            $(".btn-eval-next").hide();
            $(".btn-eval-finish").show();
        } else {
            $(".btn-eval-next").show();
            $(".btn-eval-finish").hide();
        }
    });

    $("body").on("click", ".btn-eval-next", function() {
        var current_nav = $(".nav-eval.active").data("nav-num");

        if(current_nav+1 == 7) {
            $(".btn-eval-finish").show();
            $(".btn-eval-next").hide();
        } else {
            $(".btn-eval-finish").hide();
            $(".btn-eval-next").show();
        }

        $('.nav-eval[data-nav-num="' + (current_nav+1) + '"]').find(".eval-a").trigger("click");
    });

    $("body").on("click", ".btn-eval-prev", function() {
        var current_nav = $(".nav-eval.active").data("nav-num");

        if(current_nav < 8) {
            $(".btn-eval-finish").hide();
            $(".btn-eval-next").show();
        } else {
            $(".btn-eval-finish").show();
            $(".btn-eval-next").hide();
        }

        $('.nav-eval[data-nav-num="' + (current_nav-1) + '"]').find(".eval-a").trigger("click");
    });

    $("body").on("click", ".btn-eval-finish", function(event) {
        event.preventDefault();

        var evaluation      = [];
        var comments        = [];
        var recommendations = [];
        var error           = false;
        var $this           = $(this);

        $("#frm-evaluation").find(".eval-page-container").each(function(key, container) {
            var radio_checked = $(container).find("input:radio:checked").val();
            
            if(typeof(radio_checked) == "undefined") {
                var page_container = $(container).closest(".tab-pane").attr("id");

                alertify.alert("<i class='fas fa-exclamation-triangle text-red'></i> Employee Evaluation", "All Evaluation Aspects are required.", function() {
                    $(".eval-a[href='#"+page_container+"']").trigger("click");
                });

                error = true;
                return false;
            }

            if(!error) {
                evaluation.push(radio_checked);

                $(container).find("textarea").each(function(textarea, textarea_value){
                    if($(textarea_value).data("type") == "comment") {
                        comments.push({[$(textarea_value).data("attr-id")]  : $(textarea_value).val()});
                    }

                    if($(textarea_value).data("type") == "recommendation") {
                        recommendations.push({[$(textarea_value).data("attr-id")]  : $(textarea_value).val()});
                    }
                });
            }
        });

        if(evaluation.length > 0 && !error) {
            //$this.button('loading');

            submitEvaluation(evaluation, $this, comments, recommendations);
        }
    });

    function submitEvaluation(evaluation, $this, comments, recommendations) {
        var url           = $(".base-url").val();
        var evaluation_id = $(".evaluation-id").val();
        var token         = $("#frm-evaluation").find("input[name='tm_hr_token']").val()

        if(evaluation.length > 0) {
            $.ajax({
                url  : url + 'evaluation/processEvaluation',
                type : 'POST',
                data :{
                    'tm_hr_token'     : token,
                    'evaluation'      : evaluation,
                    'evaluation_id'   : evaluation_id,
                    'comments'        : comments,
                    'recommendations' : recommendations
                },
                success: function(result) {
                    data = JSON.parse(result);

                    $this.button('reset');

                    if(data.error == false) {
                        alertify.alert("<i class='fas fa-info-circle text-green'></i> Employee Evaluation", data.message, function() {
                            window.location.replace(url + 'evaluation/myEvaluation');
                        });
                    } else {
                        alertify.alert("<i class='fas fa-exclamation-triangle text-red'></i> Employee Evaluation", data.message);
                    }
                }
            });
        }
    }

    $("body").on("click", ".btn-return-evaluation", function() {
        var url = $(".base-url").val();

        window.location.replace(url + 'evaluation/myEvaluation');
    });

    $("body").on("click", ".btn-finish-eval", function() {
        var evaluation_list_id = $(this).closest(".tbl-eval-row").data("eval-list");
        var url                = $(".base-url").val();
        var token              = $(this).data("csrf-token");
        var total              = 0;
        //var evaluation_detail  = $(this).closest(".eval-container").find(".eval-evaluated").html() + ' by ' + $(this).closest(".eval-container").find(".eval-evaluator").html();
        var evaluation_detail  = $(this).closest(".eval-container").find(".eval-evaluated").html();

        $("#evaluation-detail").val(evaluation_detail)
        $.ajax({
            url  : url + 'evaluation/getEmployeeEvaluationResult',
            type : 'POST',
            data :{
                'tm_hr_token'        : token,
                'evaluation_list_id' : evaluation_list_id
            },
            success: function(result) {
                data = JSON.parse(result);

                if(typeof(data[0]) != "undefined") {
                    $.each(data, function(key, value) {
                        $(".rating-" + value.attr_id).html(value.rating);
                        $(".rating-num-" + value.attr_id).html(value.rating_value);
                        $(".comments-" + value.attr_id).html(value.evaluator_comments);
                        $(".recommendations-" + value.attr_id).html(value.evaluator_recommendations);

                        total = total + parseInt(value.rating_value);
                    });

                    $(".attr-total").html(total);

                    $("#modal-view-evaluation").modal("show");
                }
            }
        });

    });
});

$("body").on("change", ".sel-filter-user", function() {
    var group = $(this).find('option:selected').closest("optgroup").attr("label");

    $("#filter-group").val(group);

    $(this).closest("form").submit();
});

$("body").on("change", ".sel-filter-status", function() {
    $(this).closest("form").submit();
});

$("body").on("click", ".btn-print-evaluation", function() {
    var divToPrint = document.getElementById("tbl-eval-result");

    var htmlToPrint = '' +
        '<h4 style="text-transform: capitalize;">Employee Evaluation - ' + $("#evaluation-detail").val() + '</h4>' +
        '<style type="text/css">' +
        'table th, table td {' +
        'border:1px groove #ddd;' +
        'padding;0.5em;' +
        '}' +
        'table {' +
        'border-style:groove' +
        '}' +
        '</style>';

    var newWin   = window.open("");

    htmlToPrint += divToPrint.outerHTML;
    newWin.document.write(htmlToPrint);
    newWin.print();
    newWin.close();
});