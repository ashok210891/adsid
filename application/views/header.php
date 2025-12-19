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


            <!-- Help Modal -->
            <div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="helpModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center">Help & Support</h5>
                        </div>
                        <div class="modal-body">
                            <form id="helpForm">
                                <div class="form-group mb-3">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" value="Market Sizing / Market Opportunity" id="market-sizing" name="help-question" required>
                                        <label class="custom-control-label" for="market-sizing">Market Sizing / Market Opportunity</label>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" value="Looking for Partners/ Joint Ventures" id="partners-joint-ventures" name="help-question" required>
                                        <label class="custom-control-label" for="partners-joint-ventures">Looking for Partners/ Joint Ventures</label>
                                    </div>
                                </div>
                                <?php if ($this->session->userdata('user_type') == 'buyer') { ?>
                                    <div class="form-group mb-3">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" value="Identify / Audit suppliers" id="equity" name="help-question" required>
                                            <label class="custom-control-label" for="equity">Identify / Audit suppliers</label>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="form-group mb-3">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" value="Need help in Equity" id="equity" name="help-question" required>
                                            <label class="custom-control-label" for="equity">Need help in Equity</label>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="form-group mb-3">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" value="Interested in Defense Decision Dashboard" id="defense-decision-dashboard" name="help-question" required>
                                        <label class="custom-control-label" for="defense-decision-dashboard">Interested in Defense Decision Dashboard</label>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="foreign-oems" value="Connect to Foreign OEM's" name="help-question" required>
                                        <label class="custom-control-label" for="foreign-oems">Connect to Foreign OEM's</label>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="other-question" name="help-question" required value="other-question">
                                        <label class="custom-control-label" for="other-question">Others</label>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="form-group" id="other-question-group" style="display: none;">
                                        <textarea class="form-control" id="other-question-text" name="other-question-text" placeholder="Enter your question"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="help-form-btn">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="newsModal" tabindex="-1" aria-labelledby="newsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 90vw;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center">Recent News</h5>
                            <i class="icon ni ni-cross-circle" style="font-size: 20px; cursor: pointer; color: red;" data-dismiss="modal"></i>
                        </div>
                        <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
                            <div class="accordion" id="accordion">
                                <?php
                                $recent_news = $this->webmodel->getLatestNews();
                                foreach ($recent_news as $news) {
                                ?>
                                    <div class="accordion-item">
                                        <a href="#" class="accordion-head collapsed" data-toggle="collapse" data-target="#accordion-item-<?php echo $news->id; ?>">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6 class="title"><?php echo $news->news_title; ?></h6>
                                                <div class="" style="width: 140px;">
                                                    <span class="date"><?php echo $news->news_date; ?></span>
                                                    <span class="accordion-icon"></span>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="accordion-body collapse" id="accordion-item-<?php echo $news->id; ?>" data-parent="#accordion">
                                            <div class="accordion-inner">
                                                <p style="white-space: pre-wrap;"><?php echo html_entity_decode($news->news_description); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
                                    <?php if ($this->session->userdata('company_id') > 0) { ?>
                                        <li class="nk-menu-item">
                                            <a href="<?php echo base_url(); ?>editCompany" class="nk-menu-link dashboard">
                                                <span class="nk-menu-text">EDIT COMPANY</span>
                                            </a>
                                        </li>
                                    <?php } ?>
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
                                    <button class="btn btn-primary btn-sm mr-2" data-toggle="modal" data-target="#newsModal">Recent News</button>
                                    <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#helpModal"><i class="icon ni ni-help mr-1"></i>Help</button>
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