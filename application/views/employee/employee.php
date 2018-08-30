<div id="content">
    <input type="hidden" class="base-url" value="<?php echo base_url();?>"/>

    <div class="outer content-outer">
        <div class="inner bg-light lter">

            <div class="row">
                <div class="col-md-12 ui-sortable">
                    <div class="box ui-sortable-handle">
                        <header>
                            <h5>Employee List</h5>
                            <div class="toolbar">
                                <a href="#" class="btn btn-primary btn-sm btn-flat btn-add-employee">Add Employee</a>
                            </div>
                        </header>
                        <div id="defaultTable" class="body collapse in">
                            <?php echo form_open(base_url() . "employee/employeeProfile", array("id" => "frm-emp-profile"));?>
                            <input id="employee-id" name="employee-id" type="hidden" value =""/>
                            <?php echo form_close();?>

                            <table class="table table-striped responsive-table employee-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <!--<th>Employee ID</th>-->
                                        <th>Last Name</th>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($employees)) :?>
                                        <?php foreach($employees as $key => $employee) :?>
                                    <tr class="emp-row" data-emp-detail="<?php echo $employee["employee_id"];?>">
                                        <td><?php echo ($key +1);?></td>
                                        <!--<td><?php echo $employee["employee_id"];?></td>-->
                                        <td><?php echo ucfirst($employee["last_name"]);?></td>
                                        <td><?php echo ucfirst($employee["first_name"]);?></td>
                                        <td><?php echo ucfirst($employee["middle_name"]);?></td>
                                    </tr>
                                        <?php endforeach;?>
                                    <?php else :?>
                                    <tr>
                                        <td colspan="5">Data Not Found.</td>
                                    </tr>
                                    <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.inner -->
    </div>
    <!-- /.outer -->
</div>

<div class="modal fade in" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Default Modal</h4>
            </div>
            <div class="modal-body">
                <p>One fine body…</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade in" id="modal-add-employee">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add Employee</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open('', array('class' => 'form-horizontal', 'id' => 'form-add-employee'));?>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="box dark">
                                <header>
                                    <div class="icons">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <h5>Personal Information</h5>
                                </header>
                                <div id="div-1" class="body collapse in" aria-expanded="true" style="">
                                    <div class="form-group">
                                        <label class="control-label col-lg-4">First Name</label>
                                        <div class="col-lg-8">
                                            <input id="employee-first-name" type="text" name="first-name" placeholder="First Name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-lg-4">Middle Name</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="middle-name" placeholder="Middle Name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-lg-4">Last Name</label>
                                        <div class="col-lg-8">
                                            <input id="employee-last-name" type="text" name="last-name" placeholder="Last Name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-lg-4">Birth Date</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="birth-date" placeholder="" class="form-control date-picker text-right">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-lg-4">Gender</label>
                                        <div class="col-lg-8">
                                            <select name="gender" class="form-control">
                                                <option value="0" selected>Select Gender</option>
                                                <option>Male</option>
                                                <option>Female</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-lg-4">Address</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="address" placeholder="Address" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-lg-4">Phone Number</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="phone-number" placeholder="Phone Number" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-lg-4">Email Address</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="email-address" placeholder="Email Address" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-lg-4">Bank Account Number</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="bank-account-number" placeholder="Bank Account Number" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-lg-4">SSS Number</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="sss-number" placeholder="SSS Number" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-lg-4">HDMF Number</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="hdmf-number" placeholder="HDMF" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-lg-4">PhilHealth Number</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="philhealth-number" placeholder="PhilHealth Number" class="form-control">
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>
                        </div>
                        <!--END TEXT INPUT FIELD-->

                        <!--BEGIN SELECT        -->
                        <div class="col-lg-6">
                            <div class="box dark">
                                <header>
                                    <div class="icons">
                                        <i class="fa fa-briefcase"></i>
                                    </div>
                                    <h5>Employment Information</h5>
                                </header>
                                <div id="div-1" class="body collapse in" aria-expanded="true" style="">
                                    <!--
                                    <div class="form-group">
                                        <label class="control-label col-lg-4">User ID</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="user-id" placeholder="User ID" class="form-control">
                                        </div>
                                    </div>
                                    -->

                                    <div class="form-group">
                                        <label class="control-label col-lg-4">Date Hired</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="date-hired" placeholder="" class="form-control date-picker text-right">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-lg-4">Position</label>
                                        <div class="col-lg-4">
                                            <select name="position" class="form-control">
                                                <option value="0" selected>Position</option>

                                                <?php if(!empty($positions)) :?>
                                                    <?php foreach($positions as $position):?>
                                                <option value="<?php echo $position['position_id'];?>"><?php echo ucwords($position['position_title']);?></option>
                                                    <?php endforeach;?>
                                                <?php endif;?>
                                            </select>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="input-group input-append date" data-date="<?php echo date('m-d-Y')?>" data-date-format="mm-dd-yyyy">
                                                <input class="form-control date-picker" name="position-effectivity-date" type="text" value="<?php echo date('m/d/Y');?>">
                                                <span class="input-group-addon add-on date-picker-icon"><i class="fa fa-calendar" data-toggle="tm-tooltip" title="Effectivity Date"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-lg-4">Employee Level</label>
                                        <div class="col-lg-4">
                                            <select name="level" class="form-control">
                                                <option value="employee" selected>Employee</option>
                                                <option value="Department Head">Department Head</option>
                                                <option value="administrator">Administrator</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="input-group input-append date" data-date="<?php echo date('m-d-Y')?>" data-date-format="mm-dd-yyyy">
                                                <input class="form-control date-picker" name="level-effectivity-date" type="text" value="<?php echo date('m/d/Y');?>">
                                                <span class="input-group-addon add-on date-picker-icon"><i class="fa fa-calendar" data-toggle="tm-tooltip" title="Effectivity Date"></i></span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label col-lg-4">Department</label>
                                        <div class="col-lg-4">
                                            <select name="department" class="form-control">
                                                <option value="0" selected>Department</option>

                                                <?php if(!empty($departments)) :?>
                                                    <?php foreach($departments as $department):?>
                                                <option value="<?php echo $department['department_id'];?>"><?php echo ucwords($department['department_title']);?></option>
                                                    <?php endforeach;?>
                                                <?php endif;?>
                                            </select>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="input-group input-append date" data-date="<?php echo date('m-d-Y')?>" data-date-format="mm-dd-yyyy">
                                                <input class="form-control date-picker" name="department-effectivity-date" type="text" value="<?php echo date('m/d/Y');?>">
                                                <span class="input-group-addon add-on date-picker-icon"><i class="fa fa-calendar" data-toggle="tm-tooltip" title="Effectivity Date"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-lg-4">Employment Status</label>
                                        <div class="col-lg-4">
                                            <select name="employment-status" class="form-control">
                                                <option value="0" selected>Employment Status</option>
                                                <option>Probationary</option>
                                                <option>Regular</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="input-group input-append date" data-date="<?php echo date('m-d-Y')?>" data-date-format="mm-dd-yyyy">
                                                <input class="form-control date-picker" name="employment-status-effectivity-date" type="text" value="<?php echo date('m/d/Y');?>">
                                                <span class="input-group-addon add-on date-picker-icon"><i class="fa fa-calendar" data-toggle="tm-tooltip" title="Effectivity Date"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-lg-4">Marital Status</label>
                                        <div class="col-lg-4">
                                            <select name="marital-status" class="form-control">
                                                <option value="0" selected>Marital Status</option>
                                                <option>Single</option>
                                                <option>Maried</option>
                                                <option>Separated</option>
                                                <option>Widow/Widower</option>
                                                <option>It's Complicated</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="input-group input-append date" data-date="<?php echo date('m-d-Y')?>" data-date-format="mm-dd-yyyy">
                                                <input class="form-control date-picker" name="marital-status-effectivity-date" type="text" value="<?php echo date('m/d/Y');?>">
                                                <span class="input-group-addon add-on date-picker-icon"><i class="fa fa-calendar" data-toggle="tm-tooltip" title="Effectivity Date"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-lg-4"> Monthly Salary</label>
                                        <div class="col-lg-4">
                                            <input type="text" name="salary" placeholder="" class="form-control text-right">
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="input-group input-append date" data-date="<?php echo date('m-d-Y')?>" data-date-format="mm-dd-yyyy">
                                                <input class="form-control date-picker" name="salary-effectivity-date" type="text" value="<?php echo date('m/d/Y');?>">
                                                <span class="input-group-addon add-on date-picker-icon"><i class="fa fa-calendar" data-toggle="tm-tooltip" title="Effectivity Date"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <h5>&nbsp;<b>Login Information</b></h5>
                                    <div class="form-group">
                                        <label class="control-label col-lg-4">Username</label>
                                        <div class="col-lg-8">
                                            <input id="employee-username" type="text" name="username" placeholder="Username" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-lg-4">Password</label>
                                        <div class="col-lg-8">
                                            <input id="employee-password" type="password" name="password" placeholder="Password" class="form-control">
                                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--END SELECT-->
                    </div>
                <?php echo form_close();?>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-employee-save">Save</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>