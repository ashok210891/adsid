<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Report</h3>
                            <div class="nk-block-des text-soft">
                                <p>Welcome to ToDook Report.</p>
                            </div>
                        </div><!-- .nk-block-head-content -->

                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->

                <div class="nk-block">
                    <div class="row g-gs">
                    <?php foreach($reports as $report) {
                      $reportName = ucwords(str_replace('_', ' ', $report));
                      ?>
                        <div class="col-md-3">
                            <div class="card card-bordered">
                                <div class="card-header border-bottom"><?php echo $reportName; ?></div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $reportName; ?></h5>
                                    <p class="card-text">Shows detailed report for <?php echo $reportName; ?>.</p>
                                    <a href="<?php echo base_url().'report/'.$report; ?>" class="btn btn-primary">View</a>
                                </div>
                            </div>
                          </div>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
