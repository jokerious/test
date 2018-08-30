<div id="content">
    <input type="hidden" class="base-url" value="<?php echo base_url();?>"/>

    <div class="outer">
        <div class="bg-light lter">

            <div id="user-profile-2" class="user-profile page-container">
                <div class="tabbable">
                    <ul class="nav nav-tabs padding-18 dashboard-navtab">
                        <li class="active">
                            <a data-toggle="tab" href="#ongoing" style="border-left: 1px;">
                                <i class="blue ace-icon fas fa-thumbtack bigger-120"></i>
                                On going
                            </a>
                        </li>

                        <li>
                            <a data-toggle="tab" href="#finished">
                                <i class="fas fa-check-circle bigger-120 blue"></i>
                                Finished
                            </a>
                        </li>

                        <li>
                            <a data-toggle="tab" href="#expired">
                                <i class="fas fa-bell-slash bigger-120 blue"></i>
                                Expired
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content no-border padding-24">
                        <div id="ongoing" class="tab-pane in active">
                            <div>
                                <table id="table-evalute-ongoing" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Employee to Evaluate</th>
                                            <th>Department</th>
                                            <th>Position</th>
                                            <th>Expiry Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($evaluations["on_going"])) :?>
                                            <?php foreach($evaluations["on_going"] as $on_going) :?>
                                        <tr class="tr-evaluate">
                                            <td><?php echo ucwords($on_going["evaluated_name"]);?></td>
                                            <td><?php echo (isset($department_id[$on_going["department"]])) ? $department_id[$on_going["department"]] : "";?></td>
                                            <td><?php echo (isset($positions[$on_going["evaluated_position"]])) ? ucfirst($positions[$on_going["evaluated_position"]]["position_title"]) : "";?></td>
                                            <td class="text-right"><?php echo (!empty($on_going["expiry_date"])) ? date("F m, Y", strtotime($on_going["expiry_date"])) : "";?></td>
                                            <td class="evaluate-action"><button type="button" class="btn btn-link btn-evaluate" data-evaluation-id="<?php echo $on_going['evaluation_list_id'];?>">Evaluate</button></td>
                                        </tr>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div id="finished" class="tab-pane">
                            <div>
                                <table id="table-evalute-finished" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Employee to Evaluate</th>
                                            <th>Department</th>
                                            <th>Position</th>
                                            <th>Score</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($evaluations["finished"])) :?>
                                            <?php foreach($evaluations["finished"] as $finished) :?>
                                        <tr class="tr-evaluate">
                                            <td><?php echo ucwords($finished["evaluated_name"]);?></td>
                                            <td><?php echo (isset($department_id[$finished["department"]])) ? $department_id[$finished["department"]] : "";?></td>
                                            <td><?php echo (isset($positions[$finished["evaluated_position"]])) ? ucfirst($positions[$finished["evaluated_position"]]["position_title"]) : "";?></td>
                                            <td class="evaluate-action"><?php echo $finished["score"] . "%";?></td>
                                        </tr>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div id="expired" class="tab-pane">
                            <div>
                                <table id="table-evalute-expired" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Employee to Evaluate</th>
                                            <th>Department</th>
                                            <th>Position</th>
                                            <th>Expiry Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($evaluations["expired"])) :?>
                                            <?php foreach($evaluations["expired"] as $expired) :?>
                                        <tr class="tr-evaluate">
                                            <td><?php echo ucwords($expired["evaluated_name"]);?></td>
                                            <td><?php echo (isset($department_id[$expired["department"]])) ? $department_id[$expired["department"]] : "";?></td>
                                            <td><?php echo (isset($positions[$expired["evaluated_position"]])) ? ucfirst($positions[$expired["evaluated_position"]]["position_title"]) : "";?></td>
                                            <td class="text-right text-red"><?php echo (!empty($expired["expiry_date"])) ? date("F m, Y", strtotime($expired["expiry_date"])) : "";?></td>
                                        </tr>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

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

<?php echo form_open(base_url() . 'evaluation/employeeEvaluation', array('class' => 'form-horizontal', 'id' => 'frm-evaluation'));?>
    <input type="hidden" id="evaluation-id" name="evaluation-id" value="" />
<?php echo form_close();?>