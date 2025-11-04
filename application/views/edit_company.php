<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Edit Company</h3>
                            <div class="nk-block-des text-soft">
                                <p>Update company information and details</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="nk-block">
                    <div class="row g-gs">
                        <div class="col-md-12">
                            <div class="card card-bordered card-full">
                                <div class="card-inner">
                                    <?php if (!empty($error)) { ?>
                                        <div class="alert alert-danger"><?php echo $error; ?></div>
                                    <?php } ?>

                                    <form action="<?php echo base_url(); ?>saveEditCompany" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="company_id" value="<?php echo $company['id']; ?>">
                                        
                                        <div class="row g-3">
                                            <!-- Basic Information -->
                                            <div class="col-12">
                                                <h5 class="title">Basic Information</h5>
                                                <hr>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="company_name">Company Name</label>
                                                    <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo htmlspecialchars($company['company_name']); ?>" required>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="company_email">Company Email</label>
                                                    <input type="email" class="form-control" id="company_email" name="company_email" value="<?php echo htmlspecialchars($company['company_email']); ?>">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="company_logo">Company Logo</label>
                                                    <div class="form-control-wrap">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="company_logo" name="company_logo" accept="image/*">
                                                            <label class="custom-file-label" for="company_logo">Choose logo</label>
                                                        </div>
                                                    </div>
                                                    <?php if (!empty($company['company_logo'])) { ?>
                                                        <div class="form-note mt-1">Current logo: <a target="_blank" href="<?php echo base_url('assets/uploads/companies/' . $company['company_logo']); ?>"><?php echo htmlspecialchars($company['company_logo']); ?></a></div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="company_description">Company Description</label>
                                                    <textarea class="form-control" id="company_description" name="company_description" rows="8"><?php echo htmlspecialchars($company['company_description']); ?></textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="company_address">Company Address</label>
                                                    <textarea class="form-control" id="company_address" name="company_address" rows="3"><?php echo htmlspecialchars($company['company_address']); ?></textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="office_number">Office Number</label>
                                                    <input type="text" class="form-control" id="office_number" name="office_number" value="<?php echo htmlspecialchars($company['office_number']); ?>">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="city">City</label>
                                                    <input type="text" class="form-control" id="city" name="city" value="<?php echo htmlspecialchars($company['city']); ?>">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="segment">Segment</label>
                                                    <input type="text" class="form-control" id="segment" name="segment" value="<?php echo htmlspecialchars($company['segment']); ?>">
                                                </div>
                                            </div>
                                            
                                            <!-- Contact Information -->
                                            <div class="col-12">
                                                <h5 class="title">Contact Information</h5>
                                                <hr>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="contact_person">Contact Person</label>
                                                    <input type="text" class="form-control" id="contact_person" name="contact_person" value="<?php echo htmlspecialchars($company['contact_person']); ?>">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="designation">Designation</label>
                                                    <input type="text" class="form-control" id="designation" name="designation" value="<?php echo htmlspecialchars($company['designation']); ?>">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="mobile_number">Mobile Number</label>
                                                    <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="<?php echo htmlspecialchars($company['mobile_number']); ?>">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="email_id">Email ID</label>
                                                    <input type="email" class="form-control" id="email_id" name="email_id" value="<?php echo htmlspecialchars($company['email_id']); ?>">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="whatsapp_number">WhatsApp Number</label>
                                                    <input type="text" class="form-control" id="whatsapp_number" name="whatsapp_number" value="<?php echo htmlspecialchars($company['whatsapp_number']); ?>">
                                                </div>
                                            </div>
                                            
                                            <!-- Tag Input Fields -->
                                            <div class="col-12">
                                                <h5 class="title">Capabilities & Projects</h5>
                                                <hr>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="capability_list">Capability List</label>
                                                    <div class="form-control-wrap">
                                                        <select class="form-select js-select2" id="capability_list" name="capability_list" multiple data-placeholder="Enter capabilities separated by commas">
                                                            <?php 
                                                            $capabilities = explode(',', $company['capability_list']);
                                                            foreach($capabilities as $capability) {
                                                                if(trim($capability)) {
                                                                    echo '<option value="' . htmlspecialchars(trim($capability)) . '" selected>' . htmlspecialchars(trim($capability)) . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="components">Components</label>
                                                    <div class="form-control-wrap">
                                                        <select class="form-select js-select2" id="components" name="components" multiple data-placeholder="Enter components separated by commas">
                                                            <?php 
                                                            $components = explode(',', $company['components']);
                                                            foreach($components as $component) {
                                                                if(trim($component)) {
                                                                    echo '<option value="' . htmlspecialchars(trim($component)) . '" selected>' . htmlspecialchars(trim($component)) . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="products">Products</label>
                                                    <div class="form-control-wrap">
                                                        <select class="form-select js-select2" id="products" name="products" multiple data-placeholder="Enter products separated by commas">
                                                            <?php 
                                                            $products = explode(',', $company['products']);
                                                            foreach($products as $product) {
                                                                if(trim($product)) {
                                                                    echo '<option value="' . htmlspecialchars(trim($product)) . '" selected>' . htmlspecialchars(trim($product)) . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="production_capability">Production Capability</label>
                                                    <div class="form-control-wrap">
                                                        <select class="form-select js-select2" id="production_capability" name="production_capability" multiple data-placeholder="Enter production capabilities separated by commas">
                                                            <?php 
                                                            $capabilities = explode(',', $company['production_capability']);
                                                            foreach($capabilities as $capability) {
                                                                if(trim($capability)) {
                                                                    echo '<option value="' . htmlspecialchars(trim($capability)) . '" selected>' . htmlspecialchars(trim($capability)) . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="recent_project">Recent Project</label>
                                                    <div class="form-control-wrap">
                                                        <select class="form-select js-select2" id="recent_project" name="recent_project" multiple data-placeholder="Enter recent projects separated by commas">
                                                            <?php 
                                                            $projects = explode(',', $company['recent_project']);
                                                            foreach($projects as $project) {
                                                                if(trim($project)) {
                                                                    echo '<option value="' . htmlspecialchars(trim($project)) . '" selected>' . htmlspecialchars(trim($project)) . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="key_projects">Key Projects</label>
                                                    <div class="form-control-wrap">
                                                        <select class="form-select js-select2" id="key_projects" name="key_projects" multiple data-placeholder="Enter key projects separated by commas">
                                                            <?php 
                                                            $keyProjects = explode(',', $company['key_projects']);
                                                            foreach($keyProjects as $project) {
                                                                if(trim($project)) {
                                                                    echo '<option value="' . htmlspecialchars(trim($project)) . '" selected>' . htmlspecialchars(trim($project)) . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="clients">Clients</label>
                                                    <div class="form-control-wrap">
                                                        <select class="form-select js-select2" id="clients" name="clients" multiple data-placeholder="Enter clients separated by commas">
                                                            <?php 
                                                            $clients = explode(',', $company['clients']);
                                                            foreach($clients as $client) {
                                                                if(trim($client)) {
                                                                    echo '<option value="' . htmlspecialchars(trim($client)) . '" selected>' . htmlspecialchars(trim($client)) . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="export_to_countries">Export to Countries</label>
                                                    <div class="form-control-wrap">
                                                        <select class="form-select js-select2" id="export_to_countries" name="export_to_countries" multiple data-placeholder="Enter countries separated by commas">
                                                            <?php 
                                                            $countries = explode(',', $company['export_to_countries']);
                                                            foreach($countries as $country) {
                                                                if(trim($country)) {
                                                                    echo '<option value="' . htmlspecialchars(trim($country)) . '" selected>' . htmlspecialchars(trim($country)) . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Additional Information -->
                                            <div class="col-12">
                                                <h5 class="title">Additional Information</h5>
                                                <hr>
                                            </div>
                                            
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="latest_press_release">Latest Press Release</label>
                                                    <textarea class="form-control" id="latest_press_release" name="latest_press_release" rows="4"><?php echo htmlspecialchars($company['latest_press_release']); ?></textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="video_url">Video URL (YouTube)</label>
                                                    <input type="text" class="form-control" id="video_url" name="video_url" value="<?php echo htmlspecialchars($company['video_url']); ?>" placeholder="Enter YouTube URL or ID">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="near_term_capability_expansion">Near Term Capability Expansion</label>
                                                    <textarea class="form-control" id="near_term_capability_expansion" name="near_term_capability_expansion" rows="3"><?php echo htmlspecialchars($company['near_term_capability_expansion']); ?></textarea>
                                                </div>
                                            </div>
                                            
                                            <!-- Registration Status -->
                                            <div class="col-12">
                                                <h5 class="title">Registration Status</h5>
                                                <hr>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="register_under_msme">Register under MSME</label>
                                                    <select class="form-control" id="register_under_msme" name="register_under_msme">
                                                        <option value="Yes" <?php echo ($company['register_under_msme'] == 'Yes') ? 'selected' : ''; ?>>Yes</option>
                                                        <option value="No" <?php echo ($company['register_under_msme'] == 'No') ? 'selected' : ''; ?>>No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="working_with_indian_dpsu">Working with Indian DPSU</label>
                                                    <select class="form-control" id="working_with_indian_dpsu" name="working_with_indian_dpsu">
                                                        <option value="Yes" <?php echo ($company['working_with_indian_dpsu'] == 'Yes') ? 'selected' : ''; ?>>Yes</option>
                                                        <option value="No" <?php echo ($company['working_with_indian_dpsu'] == 'No') ? 'selected' : ''; ?>>No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="aerospace_defense_industry">Aerospace Defense Industry</label>
                                                    <select class="form-control" id="aerospace_defense_industry" name="aerospace_defense_industry">
                                                        <option value="Yes" <?php echo ($company['aerospace_defense_industry'] == 'Yes') ? 'selected' : ''; ?>>Yes</option>
                                                        <option value="No" <?php echo ($company['aerospace_defense_industry'] == 'No') ? 'selected' : ''; ?>>No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Save Company</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script src="<?php echo base_url(); ?>assets/js/bundle.js?ver=1.6.0"></script>
<script src="<?php echo base_url(); ?>assets/js/scripts.js?ver=1.6.0"></script>
<!-- Using Dashlite theme's built-in Select2 -->
<!-- Using Dashlite theme's built-in Select2 styling -->
<script src="<?php echo base_url(); ?>assets/grocery_crud/texteditor/ckeditor/ckeditor.js"></script>
<script>
    // Toast notification using theme's toaster helper (NioApp.Toast)
    (function(){
        var successMsg = <?php echo json_encode($this->session->flashdata('success_msg')); ?>;
        if (successMsg && window.NioApp && typeof NioApp.Toast === 'function') {
            if (window.toastr && typeof toastr.clear === 'function') { toastr.clear(); }
            NioApp.Toast(successMsg, 'success', { position: 'top-right' });
        }
    })();

    // Initialize CKEditor for company description
    if (typeof CKEDITOR !== 'undefined') {
        CKEDITOR.replace('company_description', {
            height: 200,
            removePlugins: 'elementspath',
            resize_enabled: true,
            toolbar: [
                { name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
                { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                { name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
                { name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
                '/',
                { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
                { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl' ] },
                { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar', 'PageBreak', 'Iframe' ] },
                '/',
                { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
                { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] }
            ]
        });
    }

    // Initialize Select2 for tag input fields
    function initSelect2() {
        if (window.jQuery && typeof window.jQuery.fn.select2 === 'function') {
            window.jQuery('.js-select2').each(function() {
                const $input = window.jQuery(this);
                
                // Destroy existing Select2 if any
                if ($input.hasClass('select2-hidden-accessible')) {
                    $input.select2('destroy');
                }
                
                // Initialize Select2 with tags functionality
                $input.select2({
                    tags: true,
                    tokenSeparators: [',', ' '],
                    placeholder: $input.data('placeholder') || 'Enter values separated by commas',
                    allowClear: false,
                    width: '100%',
                    maximumSelectionLength: 20,
                    closeOnSelect: false,
                    createTag: function (params) {
                        var term = window.jQuery.trim(params.term);
                        if (term === '') {
                            return null;
                        }
                        return {
                            id: term,
                            text: term,
                            newTag: true
                        };
                    },
                    insertTag: function (data, tag) {
                        data.push(tag);
                    },
                    templateResult: function (data) {
                        if (data.newTag) {
                            return window.jQuery('<span>Add "' + data.text + '" as new tag</span>');
                        }
                        return data.text;
                    },
                    templateSelection: function (data) {
                        return data.text;
                    }
                });
            });
        }
    }

    // Initialize when page loads
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSelect2);
    } else {
        initSelect2();
    }
    
    // Backup initialization
    setTimeout(initSelect2, 1000);

    // AJAX form submission for edit company
    const formEl = document.querySelector('form[action$="saveEditCompany"]');
    if (formEl) {
        formEl.addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent default form submission
            
            // Update CKEditor content
            if (window.CKEDITOR) {
                for (var instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
            }
            
            // Manual validation for required fields
            const companyName = document.getElementById('company_name').value.trim();
            const companyDescription = document.getElementById('company_description').value.trim();
            const companyAddress = document.getElementById('company_address').value.trim();
            
            if (!companyName) {
                if (window.NioApp && typeof NioApp.Toast === 'function') {
                    NioApp.Toast('Company name is required', 'error', { position: 'top-right' });
                } else {
                    alert('Company name is required');
                }
                return;
            }
            
            if (!companyDescription) {
                if (window.NioApp && typeof NioApp.Toast === 'function') {
                    NioApp.Toast('Company description is required', 'error', { position: 'top-right' });
                } else {
                    alert('Company description is required');
                }
                return;
            }
            
            if (!companyAddress) {
                if (window.NioApp && typeof NioApp.Toast === 'function') {
                    NioApp.Toast('Company address is required', 'error', { position: 'top-right' });
                } else {
                    alert('Company address is required');
                }
                return;
            }
            
            // Prepare form data
            const formData = new FormData(formEl);
            
            // Process Select2 inputs - convert selected values to comma-separated strings
            const select2Inputs = document.querySelectorAll('.js-select2');
            
            select2Inputs.forEach(function(input) {
                if (window.jQuery && window.jQuery(input).hasClass('select2-hidden-accessible')) {
                    const selectedValues = window.jQuery(input).val();
                    
                    if (selectedValues && Array.isArray(selectedValues) && selectedValues.length > 0) {
                        const filteredValues = selectedValues.filter(val => val && val.trim() !== '');
                        const finalValue = filteredValues.join(',');
                        formData.set(input.name, finalValue);
                    } else if (selectedValues && !Array.isArray(selectedValues) && selectedValues.trim() !== '') {
                        formData.set(input.name, selectedValues);
                    } else {
                        formData.set(input.name, '');
                    }
                }
            });
            
            // Show loading state
            const submitBtn = formEl.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Saving...';
            submitBtn.disabled = true;
            
            // Send AJAX request
            fetch(formEl.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    if (window.NioApp && typeof NioApp.Toast === 'function') {
                        NioApp.Toast(data.message || 'Company updated successfully!', 'success', { position: 'top-right' });
                    } else {
                        alert(data.message || 'Company updated successfully!');
                    }
                } else {
                    // Show error message
                    if (window.NioApp && typeof NioApp.Toast === 'function') {
                        NioApp.Toast(data.message || 'Error updating company', 'error', { position: 'top-right' });
                    } else {
                        alert(data.message || 'Error updating company');
                    }
                }
            })
            .catch(error => {
                if (window.NioApp && typeof NioApp.Toast === 'function') {
                    NioApp.Toast('Network error occurred', 'error', { position: 'top-right' });
                } else {
                    alert('Network error occurred');
                }
            })
            .finally(() => {
                // Reset button state
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            });
        });
    }
</script>

