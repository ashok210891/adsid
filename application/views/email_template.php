<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">My Email Template</h3>
                            <div class="nk-block-des text-soft">
                                <p>Update your email template details</p>
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

                                    <form action="<?php echo base_url(); ?>saveEmailTemplate" method="post" enctype="multipart/form-data">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="template_name">Template Name</label>
                                                    <input type="text" class="form-control" id="template_name" name="template_name" value="<?php echo htmlspecialchars($template['template_name']); ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="email_subject">Email Subject</label>
                                                    <input type="text" class="form-control" id="email_subject" name="email_subject" value="<?php echo htmlspecialchars($template['email_subject']); ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="template_content">Template Content</label>
                                                    <textarea class="form-control" id="template_content" name="template_content" rows="10"><?php echo htmlspecialchars($template['template_content']); ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="file">Attachment (optional)</label>
                                                    <div class="form-control-wrap">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="file" name="file">
                                                            <label class="custom-file-label" for="file">Choose file</label>
                                                        </div>
                                                    </div>
                                                    <?php if (!empty($template['file'])) { ?>
                                                        <div class="form-note mt-1">Current file: <a target="_blank" href="<?php echo base_url('assets/uploads/files/' . $template['file']); ?>"><?php echo htmlspecialchars($template['file']); ?></a></div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-12">
                            					<button type="submit" class="btn btn-primary">Save Template</button>
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

    // Initialize CKEditor
    if (typeof CKEDITOR !== 'undefined') {
        CKEDITOR.replace('template_content', {
            height: 300,
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
    
    // AJAX form submission for email template
    const formEl = document.querySelector('form[action$="saveEmailTemplate"]');
    if (formEl) {
        formEl.addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent default form submission
            
            // Update CKEditor content before validation
            if (window.CKEDITOR) {
                for (var instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
            }
            
            // Manual validation for CKEditor content
            const ckEditorInstance = CKEDITOR.instances.template_content;
            if (ckEditorInstance) {
                const content = ckEditorInstance.getData();
                if (!content || content.trim() === '') {
                    if (window.NioApp && typeof NioApp.Toast === 'function') {
                        NioApp.Toast('Template content is required', 'error', { position: 'top-right' });
                    } else {
                        alert('Template content is required');
                    }
                    return;
                }
            }
            
            // Validate other required fields
            const templateName = document.getElementById('template_name').value.trim();
            const emailSubject = document.getElementById('email_subject').value.trim();
            
            if (!templateName) {
                if (window.NioApp && typeof NioApp.Toast === 'function') {
                    NioApp.Toast('Template name is required', 'error', { position: 'top-right' });
                } else {
                    alert('Template name is required');
                }
                return;
            }
            
            if (!emailSubject) {
                if (window.NioApp && typeof NioApp.Toast === 'function') {
                    NioApp.Toast('Email subject is required', 'error', { position: 'top-right' });
                } else {
                    alert('Email subject is required');
                }
                return;
            }
            
            // Prepare form data
            const formData = new FormData(formEl);
            
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
                        NioApp.Toast(data.message || 'Email template updated successfully!', 'success', { position: 'top-right' });
                    } else {
                        alert(data.message || 'Email template updated successfully!');
                    }
                } else {
                    // Show error message
                    if (window.NioApp && typeof NioApp.Toast === 'function') {
                        NioApp.Toast(data.message || 'Error updating email template', 'error', { position: 'top-right' });
                    } else {
                        alert(data.message || 'Error updating email template');
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

