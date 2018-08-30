<div id="content">
    <input type="hidden" class="base-url" value="<?php echo base_url();?>"/>

    <div class="outer content-outer">
        <div class="inner bg-light lter">

            <div class="row">
                <div class="col-lg-12">
                    <div class="box">
                        <?php echo form_open(base_url() . 'evaluation', array('id' => 'evaluation-filter'));?>
                        <input id="filter-group" name="filter-group" type="hidden"  value="<?php echo (!empty($sel_group)) ? $sel_group : '';?>"/>

                        <header>
                            <div class="col-md-7">
                                <div class="icons icon-evaluation">
                                    <i class="fa fa-th"></i>
                                </div>
                                <h5>Evaluation List</h5>
                            </div>

                            <div class="col-md-2 filter-container">
                                <select name="sel-filter-status" class="form-control evaluation-filter sel-filter-status">
                                    <option>All</option>
                                    <option <?php echo ($filter_status == "Done") ? "selected" : "";?>>Done</option>
                                    <option <?php echo ($filter_status == "Ongoing") ? "selected" : "";?>>Ongoing</option>
                                    <option <?php echo ($filter_status == "Expired") ? "selected" : "";?>>Expired</option>
                                </select>
                            </div>

                            <div class="col-md-2 filter-container">
                                <select name="sel-filter-user" class="form-control evaluation-filter sel-filter-user">
                                    <option value="0">Select Filter</option>
                                    <optgroup label="By Department">
                                        <?php if(!empty($departments)) :?>
                                            <?php foreach($departments as $dep_key => $department) :?>
                                                <?php $selected = ($sel_group == "By Department" && $filter_id == $department['department_id']) ? "selected" : "";?>

                                        <option value="<?php echo $department['department_id'];?>" <?php echo $selected;?>><?php echo ucwords($department['department_title']);?></option>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </optgroup>
                                    <optgroup label="By Employee">
                                        <?php if(!empty($employee_names)) :?>
                                            <?php foreach($employee_names as $emp_id => $employee) :?>
                                                <?php $selected = ($sel_group == "By Employee" && $filter_id == $emp_id) ? "selected" : "";?>

                                        <option value="<?php echo $emp_id;?>" <?php echo $selected;?>><?php echo ucwords($employee);?></option>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </optgroup>
                                </select>
                            </div>

                            <!-- .toolbar -->
                            <div class="toolbar col-md-1">
                                <nav class="pull-right" style="padding: 8px;">
                                    <a href="javascript:;" class="btn btn-default btn-xs collapse-box">
                                        <i class="fa fa-minus"></i>
                                    </a>
                                    <a href="javascript:;" class="btn btn-default btn-xs full-box">
                                        <i class="fa fa-expand"></i>
                                    </a>
                                </nav>
                            </div>
                            <!-- /.toolbar -->
                        </header>
                        <?php echo form_close();?>
                        <div id="div-5" class="body collapse in" aria-expanded="true" style="">
                            <input id="create-eval-token" type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />

                            <form class="">
                                <div class="form-group row">
                                    <div class="col-lg-10">
                                    </div>
                                    <div class="col-lg-2">
                                        <a class="btn btn-primary" id="btn-create-evaluation">
                                            Create Evaluation
                                        </a>
                                    </div>

                                    <?php if(!empty($evaluation_list)) :?>
                                        <?php foreach($evaluation_list as $department_id => $evaluation) :?>
                                            <?php foreach($evaluation as $employee_id => $evaluate) :?>
                                                <?php $evaluation_counter = 1;?>
                                    <div class="col-lg-12 ui-sortable">
                                        <div class="box ui-sortable-handle">
                                            <header>
                                                <h5 class="ucfirst text-info"><?php echo $employee_names[$employee_id];?></h5>
                                                <div class="toolbar">
                                                    <div class="btn-group">
                                                        <a href="#defaultTable-<?php echo $department_id . '-' . $employee_id;?>" data-toggle="collapse" class="btn btn-sm btn-default minimize-box" aria-expanded="true">
                                                            <i class="fa fa-angle-up"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </header>
                                            <div id="defaultTable-<?php echo $department_id . '-' . $employee_id;?>" class="body collapse in" aria-expanded="true" style="">
                                                <table class="table table-bordered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Evaluator's Name</th>
                                                            <th>Status</th>
                                                            <th>Score</th>
                                                            <th>Evaluation Detail</th>
                                                            <th>Expiry Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($evaluate as $eval_key => $eval) :?>
                                                        <tr class="tbl-eval-row" data-eval-list="<?php echo $eval['id'];?>">
                                                            <td><?php echo $evaluation_counter++;?></td>
                                                            <td class="ucfirst"><?php echo $employee_names[$eval['evaluator']];?></td>
                                                            <td><?php echo ($eval["status"] == 0) ? "Ongoing" : "Done";?></td>
                                                            <td class="text-center"><?php echo (!empty($eval["score"])) ? ($eval["score"] . "%") : '';?></td>
                                                            <td class="text-center">
                                                                <a class="btn btn-default <?php echo (!empty($eval["score"])) ? 'btn-finish-eval' : '';?>" <?php echo (!empty($eval["score"])) ? '' : 'disabled';?> data-csrf-token="<?php echo $this->security->get_csrf_hash();?>">View Result</a>
                                                            </td>
                                                            <td class="text-red text-right"><?php echo $eval["expiry_date"];?></td>
                                                        </tr>
                                                        <?php endforeach;?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                            <?php endforeach;?>
                                        <?php endforeach;?>
                                    <?php else :?>

                                    <div class="col-lg-12 ui-sortable">
                                        <div class="box ui-sortable-handle">
                                            <header>
                                                <h5 class="ucfirst text-info"></h5>
                                                <div class="toolbar">
                                                    <div class="btn-group">
                                                        <a href="#defaultTable" data-toggle="collapse" class="btn btn-sm btn-default minimize-box" aria-expanded="true">
                                                            <i class="fa fa-angle-up"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </header>
                                            <div id="defaultTable" class="body collapse in" aria-expanded="true" style="">
                                                <table class="table table-bordered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Evaluator's Name</th>
                                                            <th>Status</th>
                                                            <th>Score</th>
                                                            <th>Evaluation Detail</th>
                                                            <th>Expiry Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="tbl-eval-row">
                                                            <td colspan="6">No Existing Evaluation.</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <?php endif;?>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.inner -->
    </div>
    <!-- /.outer -->
</div>

<div class="modal fade in" id="modal-create-evaluation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Create Evaluation</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open('', array('class' => 'form-horizontal', 'id' => 'form-evaluate-employee'));?>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <div class="col-lg-4">
                                </div>

                                <label class="control-label col-lg-4">Evaluation Type</label>
                                <div class="col-lg-4">
                                    <select id="evalution-type" class="form-control">
                                        <option>Department Head To Employee</option>
                                        <option>Employee To Department Head</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="box dark">
                                        <header>
                                            <div class="icons">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <h5>Department Head</h5>

                                            <!-- .toolbar -->
                                            <div class="toolbar">
                                                <nav style="padding: 8px;">
                                                    <a href="javascript:;" class="btn btn-default btn-xs collapse-box">
                                                        <i class="fa fa-minus"></i>
                                                    </a>
                                                    <a href="javascript:;" class="btn btn-default btn-xs full-box">
                                                        <i class="fa fa-expand"></i>
                                                    </a>
                                                </nav>
                                            </div>
                                            <!-- /.toolbar -->
                                        </header>
                                        <div id="div-1" class="body collapse in" aria-expanded="true" style="">
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Department</label>
                                                <div class="col-lg-8">
                                                    <select id="sel-eval-department" name="department" class="form-control">
                                                        <?php if(!empty($departments)) :?>
                                                            <?php foreach($departments as $department):?>
                                                        <option value="<?php echo $department['department_id'];?>"><?php echo ucwords($department['department_title']);?></option>
                                                            <?php endforeach;?>
                                                        <?php endif;?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Department Head</label>
                                                <div class="col-lg-8">
                                                    <select id="sel-dep-head" name="dep-head" multiple="multiple" size="5" class="form-control" disabled>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                               <div class="col-lg-6">
                                    <div class="box dark">
                                        <header>
                                            <div class="icons">
                                                <i class="fas fa-users"></i>
                                            </div>
                                            <h5>Employee</h5>

                                            <!-- .toolbar -->
                                            <div class="toolbar">
                                                <nav style="padding: 8px;">
                                                    <a href="javascript:;" class="btn btn-default btn-xs collapse-box">
                                                        <i class="fa fa-minus"></i>
                                                    </a>
                                                    <a href="javascript:;" class="btn btn-default btn-xs full-box">
                                                        <i class="fa fa-expand"></i>
                                                    </a>
                                                </nav>
                                            </div>
                                            <!-- /.toolbar -->
                                        </header>
                                        <div id="div-1" class="body collapse in" aria-expanded="true" style="">
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Expiry Date</label>
                                                <div class="col-lg-8">
                                                    <input id="evaluation-expiry-date" type="text" name="evaluation-expiry-date" placeholder="" class="form-control date-picker text-right">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Employee List</label>
                                                <div class="col-lg-8">
                                                    <select id="sel-dep-emp" name="dep-emp" multiple="multiple" size="5" class="form-control" disabled>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--END SELECT-->
                            </div>

                        </div>
                    </div>
                <?php echo form_close();?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-110" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-110 btn-create-evaluation">Create</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade in" id="modal-view-evaluation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Evaluation Result</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open('', array('class' => 'form-horizontal', 'id' => 'form-view-evaluation'));?>

                <table class="table table-bordered responsive-table">
                    <thead>
                        <tr>
                            <th class="text-center" width="300px">Attribute</th>
                            <th class="text-center">Selected Rating</th>
                            <th class="text-center">Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($evaluation_attribute)) :?>
                            <?php foreach($evaluation_attribute as $key => $attr_value) :?>
                        <tr>
                            <td><?php echo $attr_value["attr_title"];?></td>
                            <td class="vertical-middle rating-<?php echo $attr_value['attr_id'];?>"></td>
                            <td class="vertical-middle text-right rating-num-<?php echo $attr_value['attr_id'];?>"></td>
                        </tr>
                            <?php endforeach;?>

                        <tr>
                            <td class="text-center" colspan="2"><b>Total</b></td>
                            <td class="text-right attr-total"></td>
                        </tr>

                        <?php else :?>
                        <tr>
                            <td colspan="3">No Data Found.</td>
                        </tr>
                        <?php endif;?>
                    </tbody>
                </table>

                <?php echo form_close();?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-110" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>