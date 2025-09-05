<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between g-3">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title"><?php echo $title; ?></h3>
                            <div class="nk-block-des text-soft">
                                <p><?php echo $company->supplier_number; ?></p>
                            </div>
                        </div>
                        <div class="nk-block-head-content">
                            <a href="<?php echo base_url(); ?>" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                            <a href="<?php echo base_url(); ?>" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="row g-gs">
                        <div class="col-lg-4 col-xl-4 col-xxl-3">
                            <div class="card card-bordered">
                                <div class="card-inner-group">
                                    <div class="card-inner">
                                        <div class="user-card user-card-s2">
                                            <!-- <div class="user-avatar lg bg-primary">
                                                <img src="./images/avatar/b-sm.jpg" alt="">
                                            </div> -->
                                            <div class="user-info">
                                                <div class="badge bg-light rounded-pill ucap"><?php echo $company->designation; ?></div>
                                                <h5><?php echo $company->contact_person; ?></h5>
                                                <span class="sub-text"><?php echo $company->email_id; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="card-inner card-inner-sm">
                                        <ul class="btn-toolbar justify-center gx-1">
                                            <li><a href="#" class="btn btn-trigger btn-icon"><em class="icon ni ni-shield-off"></em></a></li>
                                            <li><a href="#" class="btn btn-trigger btn-icon"><em class="icon ni ni-mail"></em></a></li>
                                            <li><a href="#" class="btn btn-trigger btn-icon"><em class="icon ni ni-bookmark"></em></a></li>
                                            <li><a href="#" class="btn btn-trigger btn-icon text-danger"><em class="icon ni ni-na"></em></a></li>
                                        </ul>
                                    </div> -->
                                    <!-- <div class="card-inner">
                                        <div class="row text-center">
                                            <div class="col-4">
                                                <div class="profile-stats">
                                                    <span class="amount">23</span>
                                                    <span class="sub-text">Total Order</span>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="profile-stats">
                                                    <span class="amount">20</span>
                                                    <span class="sub-text">Complete</span>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="profile-stats">
                                                    <span class="amount">3</span>
                                                    <span class="sub-text">Progress</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="card-inner">
                                        <h6 class="overline-title mb-2">Short Details</h6>
                                        <div class="row g-3">
                                            <div class="col-sm-6 col-md-4 col-lg-12">
                                                <span class="sub-text">Email:</span>
                                                <span><?php echo $company->company_email; ?></span>
                                            </div>
                                            <div class="col-sm-6 col-md-4 col-lg-12">
                                                <span class="sub-text">Whatsapp Number:</span>
                                                <span><?php echo $company->whatsapp_number; ?></span>
                                            </div>
                                        </div>
                                    </div><!-- .card-inner -->
                                </div>
                            </div>
                            <div class="card card-bordered">
                                <div class="card-inner-group">
                                    <div class="card-inner">
                                        <iframe width="100%" height="315"
                                            src="https://www.youtube.com/embed/<?php echo $company->video_url; ?>?autoplay=1&loop=1&playlist=<?php echo $company->video_url; ?>"
                                            title="YouTube video player"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen>
                                        </iframe>
                                    </div><!-- .card-inner -->
                                </div>
                            </div>
                        </div><!-- .col -->
                        <div class="col-lg-8 col-xl-8 col-xxl-9">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div class="nk-block">
                                        <div class="overline-title-alt mb-2 mt-2">Segment</div>
                                        <div class="profile-balance">
                                            <div class="profile-balance-group gx-4">
                                                <div class="profile-balance-sub">
                                                    <div class="profile-balance-amount">
                                                        <div class="number"><?php echo $company->segment; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-block">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="nk-block">
                                                    <div class="overline-title-alt mb-2 mt-2">Components</div>
                                                    <?php $cabArr = explode(",", $company->components); ?>
                                                    <div class="nk-tb-list nk-tb-ulist is-compact border round-sm">
                                                        <?php foreach ($cabArr as $cap) { ?>
                                                            <div class="nk-tb-item nk-tb-head">
                                                                <div class="nk-tb-col tb-col-sm">
                                                                    <span class="sub-text"><?php echo $cap; ?></span>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="nk-block">
                                                    <div class="overline-title-alt mb-2 mt-2">Capability List</div>
                                                    <?php $cabArr = explode(",", $company->capability_list); ?>
                                                    <div class="nk-tb-list nk-tb-ulist is-compact border round-sm">
                                                        <?php foreach ($cabArr as $cap) { ?>
                                                            <div class="nk-tb-item nk-tb-head">
                                                                <div class="nk-tb-col tb-col-sm">
                                                                    <span class="sub-text"><?php echo $cap; ?></span>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-block">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="nk-block">
                                                    <div class="overline-title-alt mb-2 mt-2">Products</div>
                                                    <?php $cabArr = explode(",", $company->products); ?>
                                                    <div class="nk-tb-list nk-tb-ulist is-compact border round-sm">
                                                        <?php foreach ($cabArr as $cap) { ?>
                                                            <div class="nk-tb-item nk-tb-head">
                                                                <div class="nk-tb-col tb-col-sm">
                                                                    <span class="sub-text"><?php echo $cap; ?></span>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="nk-block">
                                                    <div class="overline-title-alt mb-2 mt-2">Production Capability</div>
                                                    <?php $cabArr = explode(",", $company->production_capability); ?>
                                                    <div class="nk-tb-list nk-tb-ulist is-compact border round-sm">
                                                        <?php foreach ($cabArr as $cap) { ?>
                                                            <div class="nk-tb-item nk-tb-head">
                                                                <div class="nk-tb-col tb-col-sm">
                                                                    <span class="sub-text"><?php echo $cap; ?></span>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-block">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="nk-block">
                                                    <div class="overline-title-alt mb-2 mt-2">Recent Project</div>
                                                    <?php $cabArr = explode(",", $company->recent_project); ?>
                                                    <div class="nk-tb-list nk-tb-ulist is-compact border round-sm">
                                                        <?php foreach ($cabArr as $cap) { ?>
                                                            <div class="nk-tb-item nk-tb-head">
                                                                <div class="nk-tb-col tb-col-sm">
                                                                    <span class="sub-text"><?php echo $cap; ?></span>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="nk-block">
                                                    <div class="overline-title-alt mb-2 mt-2">Key Projects</div>
                                                    <?php $cabArr = explode(",", $company->key_projects); ?>
                                                    <div class="nk-tb-list nk-tb-ulist is-compact border round-sm">
                                                        <?php foreach ($cabArr as $cap) { ?>
                                                            <div class="nk-tb-item nk-tb-head">
                                                                <div class="nk-tb-col tb-col-sm">
                                                                    <span class="sub-text"><?php echo $cap; ?></span>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-block">
                                        <div class="overline-title-alt mb-2 mt-2">Clients</div>
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <div class="between-center flex-wrap flex-md-nowrap g-3">
                                                    <?php echo $company->clients; ?>
                                                </div>
                                            </div><!-- .nk-card-inner -->
                                        </div><!-- .nk-card -->
                                    </div>
                                    <div class="nk-block">
                                        <div class="overline-title-alt mb-2 mt-2">Export to countries</div>
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <div class="between-center flex-wrap flex-md-nowrap g-3">
                                                    <?php echo $company->export_to_countries; ?>
                                                </div>
                                            </div><!-- .nk-card-inner -->
                                        </div><!-- .nk-card -->
                                        <div class="nk-block-head nk-block-head-sm">
                                            <div class="nk-block-head-content">
                                                <h6 class="nk-block-title">Latest Press Release</h6>
                                                <div class="nk-block-des">
                                                    <p><?php echo $company->latest_press_release; ?></p>
                                                </div>
                                            </div>
                                        </div><!-- .nk-block-head -->
                                    </div>
                                </div><!-- .card-inner -->
                            </div><!-- .card -->
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>