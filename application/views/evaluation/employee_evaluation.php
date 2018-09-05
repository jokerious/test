<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <!--IE Compatibility modes-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile first-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Dashboard</title>

    <meta name="description" content="Free Admin Template Based On Twitter Bootstrap 3.x">
    <meta name="author" content="">

    <meta name="msapplication-TileColor" content="#5bc0de" />
    <meta name="msapplication-TileImage" content="<?php echo base_url();?>../assets/img/metis-tile.png" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url();?>../assets/lib/bootstrap/css/bootstrap.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <!-- Metis core stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url();?>../assets/css/main.css">
    <link rel="stylesheet" href="<?php echo base_url();?>../assets/css/tmhr.css">
    <link rel="stylesheet" href="<?php echo base_url();?>../assets/css/evaluation.css">

    <!-- metisMenu stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url();?>../assets/lib/metismenu/metisMenu.css">

    <!-- onoffcanvas stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url();?>../assets/lib/onoffcanvas/onoffcanvas.css">

    <!-- animate.css stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url();?>../assets/lib/animate.css/animate.css">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.5/fullcalendar.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/themes/semantic.min.css"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

    <link rel="stylesheet" href="<?php echo base_url();?>../assets/css/style-switcher.css">
    <link rel="stylesheet/less" type="text/css" href="<?php echo base_url();?>../assets/less/theme.less">
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/less.js/2.7.1/less.js"></script>-->

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css"/>

    <style type="text/css">
        .checkbox label:after, 
        .radio label:after {
            content: '';
            display: table;
            clear: both;
        }

        .checkbox .cr,
        .radio .cr {
            position: relative;
            display: inline-block;
            border: 1px solid #a9a9a9;
            border-radius: .25em;
            width: 1.3em;
            height: 1.3em;
            float: left;
            margin-right: .5em;
        }

        .radio .cr {
            border-radius: 50%;
        }

        .checkbox .cr .cr-icon,
        .radio .cr .cr-icon {
            position: absolute;
            font-size: .8em;
            line-height: 0;
            top: 50%;
            left: 20%;
        }

        .radio .cr .cr-icon {
            margin-left: 0.04em;
        }

        .checkbox label input[type="checkbox"],
        .radio label input[type="radio"] {
            display: none;
        }

        .checkbox label input[type="checkbox"] + .cr > .cr-icon,
        .radio label input[type="radio"] + .cr > .cr-icon {
            transform: scale(3) rotateZ(-20deg);
            opacity: 0;
            transition: all .3s ease-in;
        }

        .checkbox label input[type="checkbox"]:checked + .cr > .cr-icon,
        .radio label input[type="radio"]:checked + .cr > .cr-icon {
            transform: scale(1) rotateZ(0deg);
            opacity: 1;
        }

        .checkbox label input[type="checkbox"]:disabled + .cr,
        .radio label input[type="radio"]:disabled + .cr {
            opacity: .5;
        }

        .radio-container {
            margin-bottom: 10px;
            display : flex;
            align-items : center;
            border-bottom: 1px solid #efefef;
        }

        .radio-container:hover {
            background-color: #edfdfc;
        }

        .radio-height {
            font-size: 1.3em;
        }
    </style>
</head>

<body class="menu-affix evaluation-affix">
    <div class="col-md-1">
    </div>

    <div class="col-md-10 evaluation-wizard-container">
        <input type="hidden" class="base-url" value="<?php echo base_url();?>"/>
        <input type="hidden" class="evaluation-id" value="<?php echo $evaluation_id;?>"/>

        <div class="row">
            <div class="col-md-1">
            </div>

            <div class="col-md-10 text-center">
                <h3 class="eval-title;"><strong>Employee Evaluation</strong> - <span class="eval-emp"><i><?php echo ucwords($evaluation_detail["evaluated_name"]);?></i></span></h3>
                <h5 class="eval-sub-title">This information will let us know more about your co-employee.</h5>
            </div>

            <div class="col-md-1">
                <i class="fas fa-window-close btn-return-evaluation"></i>
            </div>

        </div>

        <div class="nav-active">
            <span></span>
        </div>
        <div class="row">
            <div class="wizard-navigation">
                <ul class="nav nav-pills eval-nav text-center">
                    <li data-nav-num="1" class="nav-eval width-14 active"><a class="eval-a" href="#quality" data-toggle="tab" aria-expanded="true">QUALITY</a></li>
                    <li data-nav-num="2" class="nav-eval width-14"><a class="eval-a" href="#quantity" data-toggle="tab">QUANTITY</a></li>
                    <li data-nav-num="3" class="nav-eval width-14"><a class="eval-a" href="#communication" data-toggle="tab">COMMUNICATION</a></li>
                    <li data-nav-num="4" class="nav-eval width-14"><a class="eval-a" href="#decision-making" data-toggle="tab" aria-expanded="true">DECISION MAKING</a></li>
                    <li data-nav-num="5" class="nav-eval width-14"><a class="eval-a" href="#project-planning" data-toggle="tab">PROJECT PLANNING</a></li>
                    <li data-nav-num="6" class="nav-eval width-14"><a class="eval-a" href="#dependability" data-toggle="tab">DEPENDABILITY</a></li>
                    <li data-nav-num="7" class="nav-eval width-13"><a class="eval-a" href="#relationship" data-toggle="tab">RELATIONSHIP</a></li>
                </ul>
            </div>
        </div>

        <?php echo form_open('', array('class' => 'form-horizontal', 'id' => 'frm-evaluation'));?>
            <div class="row eval-content">
                <div class="tab-content">
                    <div class="tab-pane active" id="quality">
                        <div class="row eval-page-container">
                            <div class="col-md-12">
                                <?php if(!empty($evaluation_attribute[1])) :?>
                                <h4><b class="text-brown"><?php echo $evaluation_attribute[1]['attr_title'];?></b> - <?php echo $evaluation_attribute[1]['attr_comment'];?></h4>

                                <hr/>
                                    <?php if(!empty($evaluation_data[1])):?>
                                        <?php foreach($evaluation_data[1] as $evaluation_id => $evaluate) :?>
                                <div class="col-md-12 radio-container">
                                    <div class="radio col-md-3">
                                        <label class="radio-height">
                                            <input type="radio" name="radio-<?php echo $evaluate['attribute_id'];?>" value="<?php echo $evaluate['evaluation_id'];?>">
                                            <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                                            <?php echo $evaluate["rating"];?>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <?php echo $evaluate["comment"];?>
                                    </div>
                                </div>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                <?php endif;?>

                                <div class="col-md-12 cr-container">
                                    <div class="row">
                                        <div class='col-md-6'>
                                            <label>Comments:</label>
                                            <textarea data-attr-id="<?php echo $evaluate['attribute_id'];?>" data-type="comment" name="evaluator-comments-<?php echo $evaluate['attribute_id'];?>" placeholder="Add Comments Here..." class="form-control"></textarea>
                                        </div>

                                        <div class='col-md-6'>
                                            <label>Recommendations:</label>
                                            <textarea data-attr-id="<?php echo $evaluate['attribute_id'];?>" data-type="recommendation" name="evaluator-recommendations-<?php echo $evaluate['attribute_id'];?>" placeholder="Add Recommendations Here..." class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="quantity">
                        <div class="row eval-page-container">
                            <div class="col-md-12">
                                <?php if(!empty($evaluation_attribute[2])) :?>
                                <h4><b class="text-brown"><?php echo $evaluation_attribute[2]['attr_title'];?></b> - <?php echo $evaluation_attribute[2]['attr_comment'];?></h4>

                                <hr/>
                                    <?php if(!empty($evaluation_data[2])):?>
                                        <?php foreach($evaluation_data[2] as $evaluation_id => $evaluate) :?>
                                <div class="col-md-12 radio-container">
                                    <div class="radio col-md-3">
                                        <label class="radio-height">
                                            <input type="radio" name="radio-<?php echo $evaluate['attribute_id'];?>" value="<?php echo $evaluate['evaluation_id'];?>">
                                            <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                                            <?php echo $evaluate["rating"];?>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <?php echo $evaluate["comment"];?>
                                    </div>
                                </div>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                <?php endif;?>

                                <div class="col-md-12 cr-container">
                                    <div class="row">
                                        <div class='col-md-6'>
                                            <label>Comments:</label>
                                            <textarea data-attr-id="<?php echo $evaluate['attribute_id'];?>" data-type="comment" name="evaluator-comments-<?php echo $evaluate['attribute_id'];?>" placeholder="Add Comments Here..." class="form-control"></textarea>
                                        </div>

                                        <div class='col-md-6'>
                                            <label>Recommendations:</label>
                                            <textarea data-attr-id="<?php echo $evaluate['attribute_id'];?>" data-type="recommendation" name="evaluator-recommendations-<?php echo $evaluate['attribute_id'];?>" placeholder="Add Recommendations Here..." class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="communication">
                        <div class="row eval-page-container">
                            <div class="col-md-12">
                                <?php if(!empty($evaluation_attribute[3])) :?>
                                <h4><b class="text-brown"><?php echo $evaluation_attribute[3]['attr_title'];?></b> - <?php echo $evaluation_attribute[3]['attr_comment'];?></h4>

                                <hr/>
                                    <?php if(!empty($evaluation_data[3])):?>
                                        <?php foreach($evaluation_data[3] as $evaluation_id => $evaluate) :?>
                                <div class="col-md-12 radio-container">
                                    <div class="radio col-md-3">
                                        <label class="radio-height">
                                            <input type="radio" name="radio-<?php echo $evaluate['attribute_id'];?>" value="<?php echo $evaluate['evaluation_id'];?>">
                                            <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                                            <?php echo $evaluate["rating"];?>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <?php echo $evaluate["comment"];?>
                                    </div>
                                </div>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                <?php endif;?>

                                <div class="col-md-12 cr-container">
                                    <div class="row">
                                        <div class='col-md-6'>
                                            <label>Comments:</label>
                                            <textarea data-attr-id="<?php echo $evaluate['attribute_id'];?>" data-type="comment" name="evaluator-comments-<?php echo $evaluate['attribute_id'];?>" placeholder="Add Comments Here..." class="form-control"></textarea>
                                        </div>

                                        <div class='col-md-6'>
                                            <label>Recommendations:</label>
                                            <textarea data-attr-id="<?php echo $evaluate['attribute_id'];?>" data-type="recommendation" name="evaluator-recommendations-<?php echo $evaluate['attribute_id'];?>" placeholder="Add Recommendations Here..." class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="decision-making">
                        <div class="row eval-page-container">
                            <div class="col-md-12">
                                <?php if(!empty($evaluation_attribute[4])) :?>
                                <h4><b class="text-brown"><?php echo $evaluation_attribute[4]['attr_title'];?></b> - <?php echo $evaluation_attribute[4]['attr_comment'];?></h4>

                                <hr/>
                                    <?php if(!empty($evaluation_data[4])):?>
                                        <?php foreach($evaluation_data[4] as $evaluation_id => $evaluate) :?>
                                <div class="col-md-12 radio-container">
                                    <div class="radio col-md-3">
                                        <label class="radio-height">
                                            <input type="radio" name="radio-<?php echo $evaluate['attribute_id'];?>" value="<?php echo $evaluate['evaluation_id'];?>">
                                            <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                                            <?php echo $evaluate["rating"];?>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <?php echo $evaluate["comment"];?>
                                    </div>
                                </div>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                <?php endif;?>

                                <div class="col-md-12 cr-container">
                                    <div class="row">
                                        <div class='col-md-6'>
                                            <label>Comments:</label>
                                            <textarea data-attr-id="<?php echo $evaluate['attribute_id'];?>" data-type="comment" name="evaluator-comments-<?php echo $evaluate['attribute_id'];?>" placeholder="Add Comments Here..." class="form-control"></textarea>
                                        </div>

                                        <div class='col-md-6'>
                                            <label>Recommendations:</label>
                                            <textarea data-attr-id="<?php echo $evaluate['attribute_id'];?>" data-type="recommendation" name="evaluator-recommendations-<?php echo $evaluate['attribute_id'];?>" placeholder="Add Recommendations Here..." class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="project-planning">
                        <div class="row eval-page-container">
                            <div class="col-md-12">
                                <?php if(!empty($evaluation_attribute[5])) :?>
                                <h4><b class="text-brown"><?php echo $evaluation_attribute[5]['attr_title'];?></b> - <?php echo $evaluation_attribute[5]['attr_comment'];?></h4>

                                <hr/>
                                    <?php if(!empty($evaluation_data[5])):?>
                                        <?php foreach($evaluation_data[5] as $evaluation_id => $evaluate) :?>
                                <div class="col-md-12 radio-container">
                                    <div class="radio col-md-3">
                                        <label class="radio-height">
                                            <input type="radio" name="radio-<?php echo $evaluate['attribute_id'];?>" value="<?php echo $evaluate['evaluation_id'];?>">
                                            <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                                            <?php echo $evaluate["rating"];?>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <?php echo $evaluate["comment"];?>
                                    </div>
                                </div>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                <?php endif;?>

                                <div class="col-md-12 cr-container">
                                    <div class="row">
                                        <div class='col-md-6'>
                                            <label>Comments:</label>
                                            <textarea data-attr-id="<?php echo $evaluate['attribute_id'];?>" data-type="comment" name="evaluator-comments-<?php echo $evaluate['attribute_id'];?>" placeholder="Add Comments Here..." class="form-control"></textarea>
                                        </div>

                                        <div class='col-md-6'>
                                            <label>Recommendations:</label>
                                            <textarea data-attr-id="<?php echo $evaluate['attribute_id'];?>" data-type="recommendation" name="evaluator-recommendations-<?php echo $evaluate['attribute_id'];?>" placeholder="Add Recommendations Here..." class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="dependability">
                        <div class="row eval-page-container">
                            <div class="col-md-12">
                                <?php if(!empty($evaluation_attribute[6])) :?>
                                <h4><b class="text-brown"><?php echo $evaluation_attribute[6]['attr_title'];?></b> - <?php echo $evaluation_attribute[6]['attr_comment'];?></h4>

                                <hr/>
                                    <?php if(!empty($evaluation_data[6])):?>
                                        <?php foreach($evaluation_data[6] as $evaluation_id => $evaluate) :?>
                                <div class="col-md-12 radio-container">
                                    <div class="radio col-md-3">
                                        <label class="radio-height">
                                            <input type="radio" name="radio-<?php echo $evaluate['attribute_id'];?>" value="<?php echo $evaluate['evaluation_id'];?>">
                                            <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                                            <?php echo $evaluate["rating"];?>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <?php echo $evaluate["comment"];?>
                                    </div>
                                </div>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                <?php endif;?>

                                <div class="col-md-12 cr-container">
                                    <div class="row">
                                        <div class='col-md-6'>
                                            <label>Comments:</label>
                                            <textarea data-attr-id="<?php echo $evaluate['attribute_id'];?>" data-type="comment" name="evaluator-comments-<?php echo $evaluate['attribute_id'];?>" placeholder="Add Comments Here..." class="form-control"></textarea>
                                        </div>

                                        <div class='col-md-6'>
                                            <label>Recommendations:</label>
                                            <textarea data-attr-id="<?php echo $evaluate['attribute_id'];?>" data-type="recommendation" name="evaluator-recommendations-<?php echo $evaluate['attribute_id'];?>" placeholder="Add Recommendations Here..." class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="relationship">
                        <div class="row eval-page-container">
                            <div class="col-md-12">
                                <?php if(!empty($evaluation_attribute[7])) :?>
                                <h4><b class="text-brown"><?php echo $evaluation_attribute[7]['attr_title'];?></b> - <?php echo $evaluation_attribute[7]['attr_comment'];?></h4>

                                <hr/>
                                    <?php if(!empty($evaluation_data[7])):?>
                                        <?php foreach($evaluation_data[7] as $evaluation_id => $evaluate) :?>
                                <div class="col-md-12 radio-container">
                                    <div class="radio col-md-3">
                                        <label class="radio-height">
                                            <input type="radio" name="radio-<?php echo $evaluate['attribute_id'];?>" value="<?php echo $evaluate['evaluation_id'];?>">
                                            <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                                            <?php echo $evaluate["rating"];?>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <?php echo $evaluate["comment"];?>
                                    </div>
                                </div>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                <?php endif;?>

                                <div class="col-md-12 cr-container">
                                    <div class="row">
                                        <div class='col-md-6'>
                                            <label>Comments:</label>
                                            <textarea data-attr-id="<?php echo $evaluate['attribute_id'];?>" data-type="comment" name="evaluator-comments-<?php echo $evaluate['attribute_id'];?>" placeholder="Add Comments Here..." class="form-control"></textarea>
                                        </div>

                                        <div class='col-md-6'>
                                            <label>Recommendations:</label>
                                            <textarea data-attr-id="<?php echo $evaluate['attribute_id'];?>" data-type="recommendation" name="evaluator-recommendations-<?php echo $evaluate['attribute_id'];?>" placeholder="Add Recommendations Here..." class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row eval-page-container">
                            <div class="col-md-12">
                                <?php if(!empty($evaluation_attribute[8])) :?>
                                <h4><b class="text-brown"><?php echo $evaluation_attribute[8]['attr_title'];?></b> - <?php echo $evaluation_attribute[8]['attr_comment'];?></h4>

                                <hr/>
                                    <?php if(!empty($evaluation_data[8])):?>
                                        <?php foreach($evaluation_data[8] as $evaluation_id => $evaluate) :?>
                                <div class="col-md-12 radio-container">
                                    <div class="radio col-md-3">
                                        <label class="radio-height">
                                            <input type="radio" name="radio-<?php echo $evaluate['attribute_id'];?>" value="<?php echo $evaluate['evaluation_id'];?>">
                                            <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                                            <?php echo $evaluate["rating"];?>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <?php echo $evaluate["comment"];?>
                                    </div>
                                </div>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                <?php endif;?>

                                <div class="col-md-12 cr-container">
                                    <div class="row">
                                        <div class='col-md-6'>
                                            <label>Comments:</label>
                                            <textarea data-attr-id="<?php echo $evaluate['attribute_id'];?>" data-type="comment" name="evaluator-comments-<?php echo $evaluate['attribute_id'];?>" placeholder="Add Comments Here..." class="form-control"></textarea>
                                        </div>

                                        <div class='col-md-6'>
                                            <label>Recommendations:</label>
                                            <textarea data-attr-id="<?php echo $evaluate['attribute_id'];?>" data-type="recommendation" name="evaluator-recommendations-<?php echo $evaluate['attribute_id'];?>" placeholder="Add Recommendations Here..." class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row eval-page-container">
                            <div class="col-md-12">
                                <?php if(!empty($evaluation_attribute[9])) :?>
                                <h4><b class="text-brown"><?php echo $evaluation_attribute[9]['attr_title'];?></b> - <?php echo $evaluation_attribute[9]['attr_comment'];?></h4>

                                <hr/>
                                    <?php if(!empty($evaluation_data[9])):?>
                                        <?php foreach($evaluation_data[9] as $evaluation_id => $evaluate) :?>
                                <div class="col-md-12 radio-container">
                                    <div class="radio col-md-3">
                                        <label class="radio-height">
                                            <input type="radio" name="radio-<?php echo $evaluate['attribute_id'];?>" value="<?php echo $evaluate['evaluation_id'];?>">
                                            <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                                            <?php echo $evaluate["rating"];?>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <?php echo $evaluate["comment"];?>
                                    </div>
                                </div>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                <?php endif;?>

                                <div class="col-md-12 cr-container">
                                    <div class="row">
                                        <div class='col-md-6'>
                                            <label>Comments:</label>
                                            <textarea data-attr-id="<?php echo $evaluate['attribute_id'];?>" data-type="comment" name="evaluator-comments-<?php echo $evaluate['attribute_id'];?>" placeholder="Add Comments Here..." class="form-control"></textarea>
                                        </div>

                                        <div class='col-md-6'>
                                            <label>Recommendations:</label>
                                            <textarea data-attr-id="<?php echo $evaluate['attribute_id'];?>" data-type="recommendation" name="evaluator-recommendations-<?php echo $evaluate['attribute_id'];?>" placeholder="Add Recommendations Here..." class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        <?php echo form_close();?>

        <div class="row eval-button-container">
            <a class="btn btn-primary btn-lg btn-eval btn-eval-prev">Previous</a>
            <a class="btn btn-success btn-lg btn-eval pull-right margin-right-30 btn-eval-next">Next</a>
            <a class="btn btn-info btn-lg btn-eval pull-right margin-right-30 btn-eval-finish" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Evaluating">Finish</a>
        </div>
    </div>

    <div class="col-md-1">
    </div>

    <script src="<?php echo base_url();?>../assets/lib/jquery/jquery.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.5/fullcalendar.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.18.4/js/jquery.tablesorter.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/alertify.min.js"></script>
    <!--<script src="//cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.min.js"></script>-->
    <!--<script src="//cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.selection.min.js"></script>-->
    <!--<script src="//cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.resize.min.js"></script>-->

    <!--Bootstrap -->
    <script src="<?php echo base_url();?>../assets/lib/bootstrap/js/bootstrap.js"></script>
    <!-- MetisMenu -->
    <script src="<?php echo base_url();?>../assets/lib/metismenu/metisMenu.js"></script>
    <!-- onoffcanvas -->
    <script src="<?php echo base_url();?>../assets/lib/onoffcanvas/onoffcanvas.js"></script>
    <!-- Screenfull -->
    <script src="<?php echo base_url();?>../assets/lib/screenfull/screenfull.js"></script>

    <!-- Metis core scripts -->
    <!--<script src="<?php echo base_url();?>../assets/js/core.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/less.js/2.7.1/less.js"></script>
    <!-- Metis demo scripts -->
    <!--<script src="<?php echo base_url();?>../assets/js/app.js"></script>-->

    <script src="<?php echo base_url();?>../assets/js/evaluation.js"></script>

    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
</body>

</html>