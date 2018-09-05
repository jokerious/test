<div id="content">
    <input type="hidden" class="base-url" value="<?php echo base_url();?>"/>
    
    <div class="outer">
        <div class="bg-light lter">

            <div id="user-profile-2" class="user-profile">
                <div class="tabbable">
                    <ul class="nav nav-tabs padding-18 dashboard-navtab">
                        <li class="active">
                            <a data-toggle="tab" href="#home" style="border-left: 1px;">
                                <i class="blue ace-icon fa fa-user bigger-120"></i>
                                Profile
                            </a>
                        </li>

                        <li>
                            <a data-toggle="tab" href="#employment-information">
                                <i class="fas fa-user-lock bigger-120 blue"></i>
                                Employment Information
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content no-border padding-24">
                        <div id="home" class="tab-pane in active">
                            <div class="row">
                                <div class="col-xs-12 col-sm-3 center">
                                    <span class="profile-picture">
                                        <i class="fas fa-user" style="font-size: 220px;"></i>
                                    </span>
                                </div><!-- /.col -->

                                <h4 class="blue">
                                    <span class="middle"><?php echo ucwords($employee_details["last_name"] . ", " . $employee_details["first_name"]);?></span>
                                </h4>

                                <div class="col-xs-12 col-sm-9">
                                    <div class="profile-user-info">
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Middle Name </div>

                                            <div class="profile-info-value">
                                                <span><?php echo ucfirst($employee_details["middle_name"]);?></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Birth Date </div>

                                            <div class="profile-info-value">
                                                <i class="fas fa-birthday-cake light-orange bigger-110"></i>
                                                <span><?php echo (!empty($employee_details["birth_date"])) ? date("F d, Y", strtotime($employee_details["birth_date"])) : "";?></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Age </div>

                                            <div class="profile-info-value">
                                                <span><?php echo (!empty($employee_details["birth_date"])) ? floor((time() - strtotime($employee_details["birth_date"])) / (60*60*24*365)) : "";?></span>
                                            </div>
                                        </div>

                                        <!--
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Date Hired </div>

                                            <div class="profile-info-value">
                                                <span><?php echo (!empty($employment_info["date_hired"])) ? date("F d, Y", strtotime($employment_info["date_hired"])) : "";?></span>
                                            </div>
                                        </div>
                                        -->

                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Address </div>

                                            <div class="profile-info-value">
                                                <i class="fa fa-map-marker light-orange bigger-110"></i>
                                                <span><?php echo $employee_details["address"];?></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Phone Number </div>

                                            <div class="profile-info-value">
                                                <i class="fas fa-phone light-orange bigger-110"></i>
                                                <span><?php echo $employee_details["phone_number"];?></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Email Address </div>

                                            <div class="profile-info-value">
                                                <i class="fas fa-envelope light-orange bigger-110"></i>
                                                <span><?php echo $employee_details["email_address"];?></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> SSS Number </div>

                                            <div class="profile-info-value">
                                                <i class="light-orange bigger-110">#</i>
                                                <span><?php echo $employee_details["sss_number"];?></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> HDMF Number </div>

                                            <div class="profile-info-value">
                                                <i class="light-orange bigger-110">#</i>
                                                <span><?php echo $employee_details["hdmf_number"];?></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> PhilHealth Number </div>

                                            <div class="profile-info-value">
                                                <i class="light-orange bigger-110">#</i>
                                                <span><?php echo $employee_details["philhealth_number"];?></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> TIN </div>

                                            <div class="profile-info-value">
                                                <i class="light-orange bigger-110">#</i>
                                                <span></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Bank Account </div>

                                            <div class="profile-info-value">
                                                <i class="fa fa-id-card light-orange bigger-110"></i>
                                                <span><?php echo $employee_details["bank_account_number"];?></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Username </div>

                                            <div class="profile-info-value">
                                                <i class="fa fa-user light-orange bigger-110"></i>
                                                <span><?php echo $employee_details["username"];?></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Password </div>

                                            <div class="profile-info-value margin-top-20">
                                                <button class="btn btn-default btn-xs btn-update-password">Update Password</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="hr hr-8 dotted"></div>
                                </div>
                            </div>
                        </div><!-- /#home -->

                        <div id="employment-information" class="tab-pane">
                            <div class="profile-feed row">
                                <div class="col-xs-12 col-sm-3 center">
                                    <span class="profile-picture">
                                        <i class="fas fa-user" style="font-size: 220px;"></i>
                                    </span>
                                </div><!-- /.col -->

                                <h4 class="blue">
                                    <span class="middle"><?php echo ucwords($employee_details["last_name"] . ", " . $employee_details["first_name"]);?></span>
                                </h4>

                                <div class="col-xs-12 col-sm-9">
                                    <div class="profile-user-info">
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Date Hired </div>

                                            <div class="profile-info-value">
                                                <span><?php echo (!empty($employment_info["date_hired"])) ? date("F d, Y", strtotime($employment_info["date_hired"])) : "";?></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Department </div>

                                            <div class="profile-info-value">
                                                <span><?php echo ((!empty($employment_info["department"])) && !empty($departments[$employment_info["department"]])) ? $departments[$employment_info["department"]] : "";?></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Position </div>

                                            <div class="profile-info-value">
                                                <span><?php echo (!empty($employment_info["position"]) && !empty($positions[$employment_info["position"]])) ? ucfirst($positions[$employment_info["position"]]) : "";?></span>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div><!-- /.row -->

                            <div class="space-20 margin-20"></div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Level </div>

                                        <div class="profile-info-value">
                                            <span><?php echo (!empty($employment_info["level"])) ? $employment_info["level"] : '';?></span>
                                        </div>
                                    </div>

                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Employment Status </div>

                                        <div class="profile-info-value">
                                            <span><?php echo (!empty($employment_info["employment_status"])) ? $employment_info["employment_status"] : '';?></span>
                                        </div>
                                    </div>

                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Marital Status </div>

                                        <div class="profile-info-value">
                                            <span><?php echo (!empty($employment_info["marital_status"])) ? $employment_info["marital_status"] : '';?></span>
                                        </div>
                                    </div>

                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Salary </div>

                                        <div class="profile-info-value">
                                            <span><?php echo (!empty($employment_info["salary"])) ? number_format($employment_info["salary"], 2) : "";?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /#feed -->

                        <div style="margin-bottom: 30px;"></div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.inner -->
    </div>
    <!-- /.outer -->
</div>
<!-- /#content -->

<div class="modal fade in" id="modal-update-password">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update Password</h4>
            </div>
            <div class="modal-body">
                <form id="frm-update-password" class="form-horizontal">
                    <input type="hidden" name="tm_hr_token" value="<?php echo $this->security->get_csrf_hash();?>">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-lg-4">Current Password</label>
                                <div class="col-lg-8">
                                    <input id="current-password" type="password" name="current-password" placeholder="Please Enter Your Current Password" class="form-control">
                                    <span class="glyphicon glyphicon-eye-open pull-right view-password"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-4">New Password</label>
                                <div class="col-lg-8">
                                    <input id="new-password" type="password" name="new-password" placeholder="New Password" class="form-control">
                                    <span class="glyphicon glyphicon-eye-open pull-right view-password"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-4">Confirm New Password</label>
                                <div class="col-lg-8">
                                    <input id="confirm-new-password" type="password" name="confirm-new-password" placeholder="Confirm New Password" class="form-control">
                                    <span class="glyphicon glyphicon-eye-open pull-right view-password"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-tm-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-tm-default btn-save-password">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
