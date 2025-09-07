<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview mx-auto">
                    <div class="nk-block nk-block-lg">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title">Companies</h4>
                                <!-- <div class="nk-block-des">
                                    <p>Using the most basic table markup, here’s how <code class="code-class">.table</code> based tables look by default.</p>
                                </div> -->
                            </div>
                        </div>
                        <?php
                        $status = ['success', 'info', 'danger', 'primary', 'dark', 'purple', 'warning'];
                        ?>
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <table class="datatable-init nowrap nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                    <thead>
                                        <tr class="nk-tb-item nk-tb-head">
                                            <th class="nk-tb-col" style="width: 130px;"><span class="sub-text">Supplier No</span></th>
                                            <th class="nk-tb-col"><span class="sub-text">Company</span></th>
                                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">city</span></th>
                                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">Capability List</span></th>
                                            <th class="nk-tb-col tb-col-lg" style="width: 280px;">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        foreach ($companies as $comp) {
                                        ?>
                                            <tr class="nk-tb-item">
                                                <td class="nk-tb-col tb-col-md" style="width: 130px;">
                                                    <span><?php echo (int)$comp->supplier_number; ?></span>
                                                </td>
                                                <td class="nk-tb-col">
                                                    <a href="<?php echo base_url(); ?>company/<?php echo $comp->id; ?>">
                                                        <div class="user-card">
                                                            <div class="user-avatar bg-dim-primary d-none d-sm-flex <?php if ($comp->company_logo) {
                                                                                                                        echo 'bg-white';
                                                                                                                    } ?>">
                                                                <?php if ($comp->company_logo) { ?>
                                                                    <img src="<?php echo base_url(); ?>uploads/logo/<?php echo $comp->company_logo; ?>" />
                                                                <?php } else { ?>
                                                                    <span><?php echo strtoupper(substr($comp->company_name, 0, 2)); ?></span>
                                                                <?php } ?>
                                                            </div>
                                                            <div class="user-info">
                                                                <span class="tb-lead"><?php echo $comp->company_name; ?> <span class="dot dot-success d-md-none ms-1"></span></span>
                                                                <span><?php echo $comp->company_email; ?></span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span><?php echo $comp->city; ?></span>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg">
                                                    <span><?php echo $comp->capability_list; ?></span>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg" style="width: 280px;">
                                                    <a href="<?php echo base_url(); ?>company/<?php echo $comp->id; ?>" class="btn btn-sm btn-primary">View</a>
                                                    <a href="#" class="btn btn-sm btn-danger">Send RFP</a>
                                                    <a href="#" class="btn btn-sm btn-warning">Send RFQ</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/js/bundle.js?ver=1.6.0"></script>
<script src="<?php echo base_url(); ?>assets/js/scripts.js?ver=1.6.0"></script>
<script src="<?php echo base_url(); ?>/assets/js/libs/datatable-btns.js?ver=3.3.0"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.blockUI.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.ajax.js"></script>