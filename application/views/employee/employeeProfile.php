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

                                <div class='pull-right'>
                                    <i class="fas fa-user-edit light-orange update-employee-profile"></i>
                                </div>

                                <h4 class="blue">
                                    <span class="middle"><?php echo ucwords($employee_details["last_name"] . ", " . $employee_details["first_name"]);?></span>
                                </h4>

                                <div class="col-xs-12 col-sm-9">
                                    <div class="profile-user-info">
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Middle Name </div>

                                            <div class="profile-info-value">
                                                <span><?php echo $employee_details["middle_name"];?></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Birth Date </div>

                                            <div class="profile-info-value">
                                                <i class="fas fa-birthday-cake light-orange bigger-110"></i>
                                                <span><?php echo (!empty($employee_details["birth_date"]) && $employee_details["birth_date"] <> "0000-00-00 00:00:00") ? date("F d, Y", strtotime($employee_details["birth_date"])) : "";?></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Age </div>

                                            <div class="profile-info-value">
                                                <span><?php echo (!empty($employee_details["birth_date"]) && $employee_details["birth_date"] <> "0000-00-00 00:00:00") ? floor((time() - strtotime($employee_details["birth_date"])) / (60*60*24*365)) : "";?></span>
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


<div class="modal fade in" id="modal-update-employee-profile">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update Employee</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <?php echo form_open('', array('class' => 'form-horizontal', 'id' => 'frm-update-employee-profile'));?>
                    <div id="container-update-employee" class="col-lg-6">

                        <input type="hidden" id="employee-id" value="<?php echo $employee_id;?>"/>
                        <div class="form-group">
                            <label class="control-label col-lg-4">First Name</label>
                            <div class="col-lg-8">
                                <input id="employee-first-name" type="text" name="first-name" placeholder="First Name" class="form-control" v-model="first_name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">Middle Name</label>
                            <div class="col-lg-8">
                                <input type="text" name="middle-name" placeholder="Middle Name" class="form-control" v-model="middle_name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">Last Name</label>
                            <div class="col-lg-8">
                                <input id="employee-last-name" type="text" name="last-name" placeholder="Last Name" class="form-control" v-model="last_name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">Birth Date</label>
                            <div class="col-lg-8">
                                <input type="text" name="birth-date" placeholder="" class="form-control date-picker text-right" v-model="birth_date">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">Gender</label>
                            <div class="col-lg-8">
                                <select name="gender" class="form-control" v-model="gender">
                                    <option value="0" selected>Select Gender</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">Address</label>
                            <div class="col-lg-8">
                                <input type="text" name="address" placeholder="Address" class="form-control" v-model="address">
                            </div>
                        </div>
                        <!-- /.form-group -->
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label col-lg-4">Phone Number</label>
                            <div class="col-lg-8">
                                <input type="text" name="phone-number" placeholder="Phone Number" class="form-control" v-model="phone_number">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">Email Address</label>
                            <div class="col-lg-8">
                                <input type="text" name="email-address" placeholder="Email Address" class="form-control" v-model="email_address">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">Bank Account Number</label>
                            <div class="col-lg-8">
                                <input type="text" name="bank-account-number" placeholder="Bank Account Number" class="form-control" v-model="bank_account_number">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">SSS Number</label>
                            <div class="col-lg-8">
                                <input type="text" name="sss-number" placeholder="SSS Number" class="form-control" v-model="sss_number">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">HDMF Number</label>
                            <div class="col-lg-8">
                                <input type="text" name="hdmf-number" placeholder="HDMF" class="form-control" v-model="hdmf_number">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">PhilHealth Number</label>
                            <div class="col-lg-8">
                                <input type="text" name="philhealth-number" placeholder="PhilHealth Number" class="form-control" v-model="philhealth_number">
                            </div>
                        </div>
                    </div>
                    <?php echo form_close();?>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-th-width" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-employee-update btn-th-width">Update Employee</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>