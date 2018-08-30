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

    <?php if(!empty($page_data)) :?>
        <?php if(!empty($page_data["css"])) :?>
            <?php foreach($page_data["css"] as $css_key => $css_file) :?>
                    <link rel="stylesheet" href="<?php echo base_url();?>../assets/css/<?php echo $css_file;?>">
            <?php endforeach;?>
        <?php endif;?>
    <?php endif;?>

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
</head>

<body class="  menu-affix">
    <div class="bg-dark dk" id="wrap">
        <div id="top">
            <!-- .navbar -->
            <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="container-fluid">

                    <!-- Brand and toggle get grouped for better mobile display -->
                    <header class="navbar-header">

                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="<?php echo base_url("dashboard");?>" class="navbar-brand"><h4><b>TM</b>|HR</h4></a>

                    </header>

                    <div class="topnav">
                        <div class="btn-group">
                            <a data-placement="bottom" data-original-title="Fullscreen" data-toggle="tooltip" class="btn btn-default btn-sm" id="toggleFullScreen">
                                <i class="glyphicon glyphicon-fullscreen"></i>
                            </a>
                        </div>
                        <!--
                        <div class="btn-group">
                            <a data-placement="bottom" data-original-title="E-mail" data-toggle="tooltip" class="btn btn-default btn-sm">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-warning">5</span>
                            </a>
                            <a data-placement="bottom" data-original-title="Messages" href="#" data-toggle="tooltip" class="btn btn-default btn-sm">
                                <i class="fa fa-comments"></i>
                                <span class="label label-danger">4</span>
                            </a>
                            <a data-toggle="modal" data-original-title="Help" data-placement="bottom" class="btn btn-default btn-sm" href="#helpModal">
                                <i class="fa fa-question"></i>
                            </a>
                        </div>
                        -->

                        <div class="btn-group">
                            <a href="<?php echo base_url("login/logout");?>" data-toggle="tooltip" data-original-title="Logout" data-placement="bottom" class="btn btn-metis-1 btn-sm">
                                <i class="fa fa-power-off"></i>
                            </a>
                        </div>
                        <div class="btn-group">
                            <a data-placement="bottom" data-original-title="Show / Hide Left" data-toggle="tooltip" class="btn btn-primary btn-sm toggle-left" id="menu-toggle">
                                <i class="fa fa-bars"></i>
                            </a>

                            <!--
                            <a href="#right" data-toggle="onoffcanvas" class="btn btn-default btn-sm" aria-expanded="false">
                                <span class="fa fa-fw fa-comment"></span>
                            </a>
                            -->
                        </div>

                    </div>

                    <div class="collapse navbar-collapse navbar-ex1-collapse">

                        <!-- 
                        <ul class="nav navbar-nav">
                            <li><a href="<?php echo base_url('dashboard');?>">Dashboard</a></li>
                            <li><a href="table.html">Tables</a></li>
                            <li class='dropdown '>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            Form Elements <b class="caret"></b>
                                        </a>
                                <ul class="dropdown-menu">
                                    <li><a href="form-general.html">General</a></li>
                                    <li><a href="form-validation.html">Validation</a></li>
                                    <li><a href="form-wysiwyg.html">WYSIWYG</a></li>
                                    <li><a href="form-wizard.html">Wizard &amp; File Upload</a></li>
                                </ul>
                            </li>
                        </ul>
                        /.nav -->

                    </div>
                </div>
                <!-- /.container-fluid -->
            </nav>
            <!-- /.navbar -->
            <header class="head">
                <div class="search-bar">
                    <form class="main-search" action="">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Live Search ...">
                            <span class="input-group-btn">
                                <button class="btn btn-primary btn-sm text-muted" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.main-search -->
                </div>
                <!-- /.search-bar -->
                <div class="main-bar">
                    <h3>
                        <i class="fas <?php echo getNavIcon($this->router->fetch_class());?>"></i>
                        <?php echo ucfirst($this->router->fetch_class());?>
                        <?php echo ucfirst(getNavTitle($this->uri->segment(2)));?>
                    </h3>
                </div>
                <!-- /.main-bar -->
            </header>
            <!-- /.head -->
        </div>
        <!-- /#top -->
        <div id="left">
            <div class="media user-media bg-dark dker">
                <div class="user-media-toggleHover">
                    <span class="fa fa-user"></span>
                </div>
                <div class="user-wrapper bg-dark profile-container">
                    <a class="user-link" href="">
                        <img class="media-object img-thumbnail user-img" alt="User Picture" src="<?php echo base_url();?>../assets/img/user.gif">
                        <span class="label label-danger user-label"></span>
                    </a>

                    <div class="media-body">
                        <h5 class="media-heading"><?php echo ucfirst($_SESSION["first_name"]);?></h5>
                        <ul class="list-unstyled user-info">
                            <!--<li><a href=""><?php echo ucfirst($_SESSION["type"]);?></a></li>-->
                            <li>Last Access :
                                <br>
                                <small><i class="fa fa-calendar"></i>&nbsp;16 Mar 16:32</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #menu -->

            <ul id="menu" class="bg-blue dker">
                <li class="nav-header">Menu</li>
                <li class="nav-divider"></li>

                <?php if(checkPermission('dashboard')) :?>
                <li class="<?php echo tabNavigation('dashboard', $page);?>">
                    <a href="<?php echo base_url('dashboard');?>">
                        <i class="fas fa-tachometer-alt"></i>
                        <span class="link-title">
                            &nbsp;Dashboard
                        </span>
                    </a>
                </li>
                <?php endif;?>

                <?php if(checkPermission('employee')) :?>
                <li class="<?php echo tabNavigation('employee', $page);?>">
                    <a href="<?php echo base_url('employee');?>">
                        <i class="fas fa-users"></i>
                        <span class="link-title">
                            &nbsp;Employee
                        </span>
                    </a>
                </li>
                <?php endif;?>

                <?php if(checkPermission('evaluation')) :?>
                <li class="<?php echo tabNavigation('evaluation', $page);?>">
                    <a href="javascript:;">
                        <i class="fas fa-balance-scale"></i>
                        <span class="link-title">
                            &nbsp;Evaluation
                        </span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="collapse">
                        <?php if(checkPermission('evaluation_home')) :?>
                        <li>
                            <a href="<?php echo base_url('evaluation');?>">
                                <i class="fas fa-list-ul"></i>
                                &nbsp;List
                            </a>
                        </li>
                        <?php endif;?>

                        <?php if(checkPermission('my_evaluation')) :?>
                        <li>
                            <a href="<?php echo base_url('evaluation/myEvaluation');?>">
                                <i class="fas fa-list-ul"></i>
                                &nbsp;My Evaluations
                            </a>
                        </li>
                        <?php endif;?>


                    </ul>
                </li>
                <?php endif;?>
            </ul>
            <!-- /#menu -->
        </div>