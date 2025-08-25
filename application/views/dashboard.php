<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Overview</h3>
                            <div class="nk-block-des text-soft">
                                <p>Welcome to ToDook Dashboard.</p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt"><a href="<?php echo base_url("reports") ?>" class="btn btn-primary"><em class="icon ni ni-reports"></em><span>Reports</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->

                <div class="nk-block">
                    <div class="row g-gs">
                        <div class="col-md-6">
                            <div class="card card-bordered card-full">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-0">
                                        <div class="card-title">
                                            <h6 class="subtitle">Total Enquiry</h6>
                                        </div>
                                        <div class="card-tools">
                                            <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="Total Enquiry"></em>
                                        </div>
                                    </div>
                                    <div class="card-amount">
                                        <span class="amount" id="total_enquiry">
                                        </span>
                                        <span id="spanClass"><em id="emClass" class="enquiry_day"></em></span>
                                    </div>
                                    <div class="invest-data">
                                        <div class="invest-data-amount g-2">
                                            <div class="invest-data-history">
                                                <div class="title">This Month</div>
                                                <div class="amount enquiry_month"> </div>
                                            </div>
                                            <div class="invest-data-history">
                                                <div class="title">This Week</div>
                                                <div class="amount enquiry_week"> </div>
                                            </div>
                                            <div class="invest-data-history">
                                                <div class="title">Today</div>
                                                <div class="amount enquiry_day"> </div>
                                            </div>
                                        </div>
                                        <div class="invest-data-ck">
                                            <canvas class="iv-data-chart" id="totalEnquiryDeposit"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-md-6">
                            <div class="card card-bordered card-full">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-0">
                                        <div class="card-title">
                                            <h6 class="subtitle">Total Users</h6>
                                        </div>
                                        <div class="card-tools">
                                            <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="Total User"></em>
                                        </div>
                                    </div>
                                    <div class="card-amount">
                                        <span class="amount" id="total_user">
                                        </span>
                                        <span id="userSpanClass"><em id="userEmClass" class="userDay"></em></span>
                                    </div>
                                    <div class="invest-data">
                                        <div class="invest-data-amount g-2">
                                            <div class="invest-data-history">
                                                <div class="title">This Month</div>
                                                <div class="amount" id="month"> </div>
                                            </div>
                                            <div class="invest-data-history">
                                                <div class="title">This Week</div>
                                                <div class="amount" id="week"> </div>
                                            </div>
                                            <div class="invest-data-history">
                                                <div class="title">Today</div>
                                                <div class="amount userDay"> </div>
                                            </div>
                                        </div>
                                        <div class="invest-data-ck">
                                            <canvas class="iv-data-chart" id="totalDeposit"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->


                        <div class="col-xxl-6">
                            <div class="card card-bordered h-100">
                                <div class="card-inner">
                                    <div class="card-title-group align-start gx-3 mb-3">
                                        <div class="card-title">
                                            <h6 class="title">Enquiry Overview</h6>
                                            <p><span id="dayscount"></span> days details. </p>
                                        </div>
                                        <!-- <div class="card-tools">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-primary btn-dim d-none d-sm-inline-flex"
                                                    data-toggle="dropdown"><em
                                                        class="icon ni ni-download-cloud"></em><span><span
                                                            class="d-none d-md-inline">Download</span> Report</span></a>
                                                <a href="#" class="btn btn-icon btn-primary btn-dim d-sm-none"
                                                    data-toggle="dropdown"><em
                                                        class="icon ni ni-download-cloud"></em></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="#"><span>Download Mini Version</span></a></li>
                                                        <li><a href="#"><span>Download Full Version</span></a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><em class="icon ni ni-opt-alt"></em><span>More
                                                                    Options</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="nk-sale-data-group align-center justify-between gy-3 gx-5">
                                        <div class="nk-sale-data">
                                            <span class="amount"></span>
                                        </div>
                                        <div class="nk-sale-data">
                                            <span class="amount sm"><span id="currentmonthuserscount"></span> <small>Users</small></span>
                                        </div>
                                    </div>
                                    <div class="nk-sales-ck large pt-4">
                                        <canvas class="sales-overview-chart" id="salesOverview"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xxl-4">
                            <div class="card card-bordered card-full">
                                <div class="card-inner border-bottom">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Recent Enquires</h6>
                                        </div>
                                    </div>
                                </div>
                                <ul class="nk-activity" id="recentEnquiry">

                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-xxl-4">
                            <div class="card card-bordered card-full">
                                <div class="card-inner border-bottom">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Recent Users</h6>
                                        </div>
                                    </div>
                                </div>
                                <ul class="nk-activity" id="recentUsers">

                                </ul>
                            </div>
                        </div>
                        <!-- <div class="col-md-6 col-xxl-4">
                            <div class="card card-bordered card-full">
                                <div class="card-inner border-bottom">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Enquiry For Industry</h6>
                                        </div>
                                        <div class="card-tools">
                                            <div class="dropdown">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <select class="form-select form-control form-control-lg" id="industryDoughnutDays">
                                                            <option value="30">30 Days</option>
                                                            <option value="7">7 Days</option>
                                                            <option value="1">1 Day</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="traffic-channel">
                                    <div class="traffic-channel-doughnut-ck">
                                        <canvas class="analytics-doughnut" id="TrafficChannelDoughnutData"></canvas>
                                    </div>
                                    <div class="traffic-channel-group g-2" id="industryData">
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <div class="col-md-12">
                            <div class="card card-bordered h-100">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title card-title-sm">
                                            <h6 class="title">Enquiry Heatmap</h6>
                                        </div>
                                    </div>
                                    <div class="analytics-map">
                                        <div class="vector-map" id="worldMap"></div>
                                        <table class="analytics-map-data-list" id="worlddata">

                                        </table>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <!--<div class="col-md-6 col-xxl-3">
                            <div class="card card-bordered h-100">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title card-title-sm">
                                            <h6 class="title">Users Heatmap</h6>
                                        </div>
                                    </div>
                                    <div class="analytics-map">
                                        <div class="vector-map" id="indiaMap"></div>
                                        <table class="analytics-map-data-list" id="indiadata">

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                    </div><!-- .row -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
<!-- content @e -->
<script src="<?php echo base_url(); ?>assets/js/bundle.js?ver=1.6.0"></script>
<script src="<?php echo base_url(); ?>assets/js/scripts.js?ver=1.6.0"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.blockUI.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.ajax.js"></script>
<script src="<?php echo base_url(); ?>assets/js/charts/gd-general.js?ver=1.6.0"></script>
<!-- <script src="<?php echo base_url(); ?>assets/js/charts/gd-invest.js?ver=1.6.0"></script> -->
<script src="<?php echo base_url(); ?>assets/js/charts/gd-analytics.js?ver=1.6.0"></script>
<script src="<?php echo base_url(); ?>assets/js/vendors/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/vendors/jqvmap/maps/jquery.vmap.world.js"></script>
<script src="<?php echo base_url(); ?>assets/js/vendors/jqvmap/maps/jquery.vmap.india.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dashboard.js"></script>