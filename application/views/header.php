<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Todook admin pages">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.png">
    <!-- Page Title  -->
    <title>Aerospace & Defence Supplier Identification Dashboard</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dashlite-old.css?ver=1.6.0">
    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dashlite.css?ver=1.6.0"> -->
    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dashlite.min.css"> -->
    <link id="skin-default" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/skins/theme-egyptian.css?ver=1.6.0">
    <link id="skin-default" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">

    <?php
    foreach ($css_files as $file): ?>
        <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
    <?php endforeach; ?>


</head>
<style>
    .logo-img {
        max-height: 50px;
    }
</style>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="preloader" style="display: none;"></div>
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">

            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger mr-sm-2 d-lg-none">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-brand">
                                <a href="<?php echo base_url(); ?>" class="logo-link">
                                    <img class="logo-light logo-img" src="<?php echo base_url(); ?>assets/images/logo.png" alt="logo">
                                    <img class="logo-dark logo-img" src="<?php echo base_url(); ?>assets/images/logo.png" alt="logo-dark">

                                </a>
                            </div><!-- .nk-header-brand -->
                            <div class="nk-header-menu" data-content="headerNav">
                                <div class="nk-header-mobile">
                                    <div class="nk-header-brand">
                                        <a href="<?php echo base_url(); ?>" class="logo-link">
                                            <img class="logo-light logo-img" src="<?php echo base_url(); ?>assets/images/logo.png" alt="logo">
                                            <img class="logo-dark logo-img" src="<?php echo base_url(); ?>assets/images/logo.png" alt="logo-dark">
                                        </a>
                                    </div>
                                    <div class="nk-menu-trigger mr-n2">
                                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-arrow-left"></em></a>
                                    </div>
                                </div>
                                <!-- Menu -->
                                <ul class="nk-menu nk-menu-main">
                                    <?php if ($this->session->userdata('user_type') == 'buyer') { ?>
                                        <li class="nk-menu-item">
                                            <a href="<?php echo base_url(); ?>dashboard" class="nk-menu-link dashboard">
                                                <span class="nk-menu-text">COMPANY LIST</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <li class="nk-menu-item">
                                        <a href="<?php echo base_url(); ?>editCompany" class="nk-menu-link dashboard">
                                            <span class="nk-menu-text">EDIT COMPANY</span>
                                        </a>
                                    </li>
                                    <?php if ($this->session->userdata('user_type') == 'buyer') { ?>
                                        <li class="nk-menu-item">
                                            <a href="<?php echo base_url(); ?>emailTemplate" class="nk-menu-link reports">
                                                <span class="nk-menu-text">Email Templates</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div><!-- .nk-header-menu -->

                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                        <span><?php echo strtoupper(substr($this->session->userdata('name'), 0, 2)); ?></span>
                                                    </div>
                                                    <div class="user-info d-flex align-items-center" style="gap: 8px;">
                                                        <span>Welcome</span>
                                                        <span class="lead-text"><?php echo ucwords($this->session->userdata('name')); ?></span>
                                                        <div class="user-name dropdown-indicator"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                                            <!-- <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="<?php echo base_url(); ?>account"><em class="icon ni ni-user-alt"></em><span>My Account</span></a></li>
                                                </ul>
                                            </div> -->
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="<?php echo base_url(); ?>logout"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li><!-- .dropdown -->

                                </ul><!-- .nk-quick-nav -->
                            </div><!-- .nk-header-tools -->
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
                </div>
                <!-- main header @e -->