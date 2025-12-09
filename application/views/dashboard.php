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
                                    <p>Using the most basic table markup, here's how <code class="code-class">.table</code> based tables look by default.</p>
                                </div> -->
                            </div>
                            <div class="nk-block-head-content" style="margin-top: 20px;">
                                <div class="row g-3 justify-content-center align-items-end">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="capabilityFilter" class="form-label">Filter by Capability:</label>
                                            <div class="form-control-wrap">
                                                <select id="capabilityFilter" class="form-select js-select2" multiple data-placeholder="Select capabilities to filter...">
                                                    <?php
                                                    // Get all unique capabilities from companies
                                                    $allCapabilities = [];
                                                    foreach ($companies as $comp) {
                                                        if (!empty($comp->capability_list)) {
                                                            $capabilities = array_map('trim', explode(',', $comp->capability_list));
                                                            foreach ($capabilities as $capability) {
                                                                if (!empty($capability) && !in_array($capability, $allCapabilities)) {
                                                                    $allCapabilities[] = $capability;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    sort($allCapabilities);
                                                    foreach ($allCapabilities as $capability) {
                                                    ?>
                                                        <option value="<?php echo htmlspecialchars($capability); ?>"><?php echo htmlspecialchars($capability); ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <button type="button" class="btn btn-primary" id="sendRfpBtn" onclick="sendRfpToSelected()">
                                                    <em class="icon ni ni-send"></em> Send RFP
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $status = ['success', 'info', 'danger', 'primary', 'dark', 'purple', 'warning'];
                        ?>
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <table class="datatable-init nowrap nk-tb-list nk-tb-ulist" data-auto-responsive="false" id="companiesTable">
                                    <thead>
                                        <tr class="nk-tb-item nk-tb-head">
                                            <th class="nk-tb-col" style="width: 50px;">
                                                <input type="checkbox" id="selectAllRows" onchange="toggleAllRows(this)">
                                            </th>
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
                                            <tr class="nk-tb-item" data-capabilities="<?php echo htmlspecialchars($comp->capability_list); ?>">
                                                <td class="nk-tb-col" style="width: 50px;">
                                                    <input type="checkbox" class="row-checkbox" value="<?php echo $comp->id; ?>">
                                                </td>
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
                                                                    <img src="<?php echo base_url(); ?>assets/uploads/companies/<?php echo $comp->company_logo; ?>" />
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
                                                <td class="nk-tb-col tb-col-lg" style="width: 80px;">
                                                    <a href="<?php echo base_url(); ?>company/<?php echo $comp->id; ?>" class="btn btn-sm btn-primary">View</a>
                                                    <!-- <a href="#" class="btn btn-sm btn-danger">Send RFP</a>
                                                    <a href="#" class="btn btn-sm btn-warning">Send RFQ</a> -->
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

<!-- RFP Confirmation Modal -->
<div class="modal fade" id="rfpModal" tabindex="-1" role="dialog" aria-labelledby="rfpModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rfpModalLabel">Send RFP to Selected Companies</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to send RFP to the selected companies?</p>
                <div id="selectedCompaniesList"></div>
                <div class="alert alert-info mt-3">
                    <strong>Note:</strong> This will send your email template with attachment to the selected companies' email addresses.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelRfpBtn">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmRfpSend">Send RFP</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/js/bundle.js?ver=1.6.0"></script>
<script src="<?php echo base_url(); ?>assets/js/scripts.js?ver=1.6.0"></script>
<script src="<?php echo base_url(); ?>/assets/js/libs/datatable-btns.js?ver=3.3.0"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.blockUI.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.ajax.js"></script>

<style>
    /* Style for table checkboxes */
    .row-checkbox {
        transform: scale(1.2);
        margin: 0;
    }

    #selectAllRows {
        transform: scale(1.2);
        margin: 0;
    }

    /* Style for table rows */
    .nk-tb-item {
        transition: background-color 0.2s ease;
    }

    .nk-tb-item:hover {
        background-color: #f8f9fa;
    }

    /* Style for filtered out rows */
    .nk-tb-item[style*="display: none"] {
        display: none !important;
    }

    /* Form group styling */
    .form-group {
        margin-bottom: 0;
    }

    .form-label {
        font-weight: 600;
        margin-bottom: 8px;
        color: #333;
    }

    /* Capability filter styling */
    #capabilityFilter {
        min-width: 300px;
    }

    /* RFP Button styling */
    #sendRfpBtn {
        min-width: 120px;
        white-space: nowrap;
    }

    #sendRfpBtn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    /* Responsive adjustments for filter row */
    @media (max-width: 768px) {

        .nk-block-head-content .row .col-md-8,
        .nk-block-head-content .row .col-md-4 {
            margin-bottom: 15px;
        }
    }
</style>

<script>
    // Store the current filter state
    let currentCapabilityFilter = [];

    // Filter table based on selected capabilities
    function filterTable() {
        const selectedCapabilities = $('#capabilityFilter').val() || [];

        // Update current filter state
        currentCapabilityFilter = selectedCapabilities;

        // Clear existing custom search functions
        $.fn.dataTable.ext.search = $.fn.dataTable.ext.search.filter(function(fn) {
            return fn !== capabilitySearchFunction;
        });

        // Add our custom search function
        $.fn.dataTable.ext.search.push(capabilitySearchFunction);

        // Redraw the table
        if ($.fn.DataTable && $.fn.DataTable.isDataTable('#companiesTable')) {
            $('#companiesTable').DataTable().draw();
        }

        // Update select all checkbox state
        updateSelectAllState();
    }

    // Custom search function for capability filtering
    function capabilitySearchFunction(settings, data, dataIndex) {
        // Only apply to our table
        if (settings.nTable.id !== 'companiesTable') {
            return true;
        }

        // If no capabilities selected, show all rows
        if (currentCapabilityFilter.length === 0) {
            return true;
        }

        // Get the row element to access data-capabilities
        const table = $('#companiesTable').DataTable();
        const row = table.row(dataIndex).node();
        const rowCapabilities = $(row).attr('data-capabilities');

        if (!rowCapabilities) {
            return false;
        }

        // Check if any selected capability matches the row's capabilities
        const rowCapabilityList = rowCapabilities.split(',').map(cap => cap.trim());
        return currentCapabilityFilter.some(selectedCap =>
            rowCapabilityList.some(rowCap =>
                rowCap.toLowerCase().includes(selectedCap.toLowerCase())
            )
        );
    }

    // Initialize Select2 for capability filter (using same pattern as edit_company.php)
    function initSelect2() {
        if (window.jQuery && typeof window.jQuery.fn.select2 === 'function') {
            window.jQuery('#capabilityFilter').each(function() {
                const $input = window.jQuery(this);

                // Destroy existing Select2 if any
                if ($input.hasClass('select2-hidden-accessible')) {
                    $input.select2('destroy');
                }

                // Initialize Select2 with tags functionality
                $input.select2({
                    tags: false, // Don't allow new tags for filtering
                    placeholder: $input.data('placeholder') || 'Select capabilities to filter...',
                    allowClear: true,
                    width: '100%',
                    closeOnSelect: false,
                    multiple: true
                });

                // Bind change event
                $input.on('change', function() {
                    filterTable();
                });
            });
        }
    }

    // Toggle all rows
    function toggleAllRows(selectAllCheckbox) {
        const rowCheckboxes = document.querySelectorAll('.row-checkbox');
        rowCheckboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
        });
    }

    // Update select all checkbox state based on visible rows
    function updateSelectAllState() {
        const visibleRows = document.querySelectorAll('#companiesTable tbody tr:not([style*="display: none"])');
        const checkedVisibleRows = document.querySelectorAll('#companiesTable tbody tr:not([style*="display: none"]) .row-checkbox:checked');

        const selectAllCheckbox = document.getElementById('selectAllRows');
        if (visibleRows.length === 0) {
            selectAllCheckbox.checked = false;
            selectAllCheckbox.indeterminate = false;
        } else if (checkedVisibleRows.length === visibleRows.length) {
            selectAllCheckbox.checked = true;
            selectAllCheckbox.indeterminate = false;
        } else if (checkedVisibleRows.length > 0) {
            selectAllCheckbox.checked = false;
            selectAllCheckbox.indeterminate = true;
        } else {
            selectAllCheckbox.checked = false;
            selectAllCheckbox.indeterminate = false;
        }
    }

     // Add event listeners for row checkboxes
     document.addEventListener('DOMContentLoaded', function() {
         const rowCheckboxes = document.querySelectorAll('.row-checkbox');
         rowCheckboxes.forEach(checkbox => {
             checkbox.addEventListener('change', updateSelectAllState);
         });

         // Add event listener for RFP confirmation button
         const confirmRfpBtn = document.getElementById('confirmRfpSend');
         if (confirmRfpBtn) {
             confirmRfpBtn.addEventListener('click', actuallySendRfp);
         }

         // Add event listener for RFP cancel button
         const cancelRfpBtn = document.getElementById('cancelRfpBtn');
         if (cancelRfpBtn) {
             cancelRfpBtn.addEventListener('click', function(e) {
                 e.preventDefault();
                 // Hide modal using Bootstrap 4 jQuery API
                 $('#rfpModal').modal('hide');
                 // Reset button state
                 resetRfpButton();
             });
         }

         // Add event listener for modal close button (X)
         const modalCloseBtn = document.querySelector('#rfpModal .close');
         if (modalCloseBtn) {
             modalCloseBtn.addEventListener('click', function(e) {
                 e.preventDefault();
                 // Hide modal using Bootstrap 4 jQuery API
                 $('#rfpModal').modal('hide');
                 // Reset button state
                 resetRfpButton();
             });
         }

         // Add event listener for modal backdrop click (Bootstrap 4)
         $('#rfpModal').on('hidden.bs.modal', function() {
             // Reset button state when modal is hidden
             resetRfpButton();
         });
     });

     // Function to reset RFP button state
     function resetRfpButton() {
         const sendBtn = document.getElementById('sendRfpBtn');
         if (sendBtn) {
             sendBtn.innerHTML = '<em class="icon ni ni-send"></em> Send RFP';
             sendBtn.disabled = false;
         }
     }

     // Initialize when page loads (same pattern as edit_company.php)
     if (document.readyState === 'loading') {
         document.addEventListener('DOMContentLoaded', function() {
             initSelect2();
             initializeDataTable();
         });
     } else {
         initSelect2();
         initializeDataTable();
     }

     // Backup initialization (same as edit_company.php)
     setTimeout(function() {
         initSelect2();
         initializeDataTable();
     }, 1000);

     // Function to safely initialize DataTable settings
     function initializeDataTable() {
         // Wait a bit for the existing DataTable initialization to complete
         setTimeout(function() {
             if ($.fn.DataTable && $.fn.DataTable.isDataTable('#companiesTable')) {
                 try {
                     const table = $('#companiesTable').DataTable();
                     
                     // Check if orderable method exists before using it
                     if (table.column && typeof table.column(0).orderable === 'function') {
                         table.column(0).orderable(false);
                     }
                 } catch (error) {
                     console.log('DataTable column configuration not available:', error);
                 }
             }
         }, 100);
     }

    // Send RFP to selected companies
    function sendRfpToSelected() {
        const selectedCompanies = [];
        const checkboxes = document.querySelectorAll('.row-checkbox:checked');

        checkboxes.forEach(checkbox => {
            selectedCompanies.push(checkbox.value);
        });

        if (selectedCompanies.length === 0) {
            if (window.NioApp && typeof NioApp.Toast === 'function') {
                NioApp.Toast('Please select at least one company to send RFP', 'warning', {
                    position: 'top-right'
                });
            } else {
                alert('Please select at least one company to send RFP');
            }
            return;
        }

        // Get company names for display
        const selectedCompanyNames = [];
        checkboxes.forEach(checkbox => {
            const row = checkbox.closest('tr');
            const companyName = row.querySelector('.user-info .tb-lead').textContent.trim();
            selectedCompanyNames.push(companyName);
        });

        // Show company names in modal
        const companiesList = document.getElementById('selectedCompaniesList');
        companiesList.innerHTML = '<strong>Selected Companies:</strong><ul class="mt-2">' +
            selectedCompanyNames.map(name => '<li>' + name + '</li>').join('') +
            '</ul>';

         // Show modal using Bootstrap 4 jQuery API
         $('#rfpModal').modal('show');

        // Store selected company IDs for later use
        window.selectedCompanyIds = selectedCompanies;
    }

     // Actually send RFP (called from modal confirmation)
     function actuallySendRfp() {
         const selectedCompanies = window.selectedCompanyIds || [];

         if (selectedCompanies.length === 0) {
             if (window.NioApp && typeof NioApp.Toast === 'function') {
                 NioApp.Toast('No companies selected', 'error', {
                     position: 'top-right'
                 });
             } else {
                 alert('No companies selected');
             }
             return;
         }

         // Disable button and show loading
         const sendBtn = document.getElementById('confirmRfpSend');
         const originalText = sendBtn.innerHTML;
         sendBtn.innerHTML = '<em class="icon ni ni-loader"></em> Sending...';
         sendBtn.disabled = true;

         // Send AJAX request
         fetch('<?php echo base_url(); ?>sendRfpToCompanies', {
                 method: 'POST',
                 headers: {
                     'Content-Type': 'application/json',
                 },
                 body: JSON.stringify({
                     company_ids: selectedCompanies
                 })
             })
             .then(response => response.json())
             .then(data => {
                 if (data.success) {
                     // Hide modal on success using Bootstrap 4 jQuery API
                     $('#rfpModal').modal('hide');
                     
                     if (window.NioApp && typeof NioApp.Toast === 'function') {
                         NioApp.Toast(data.message || 'RFP sent successfully to ' + data.sent_count + ' companies', 'success', {
                             position: 'top-right'
                         });
                     } else {
                         alert(data.message || 'RFP sent successfully to ' + data.sent_count + ' companies');
                     }
                 } else {
                     if (window.NioApp && typeof NioApp.Toast === 'function') {
                         NioApp.Toast(data.message || 'Error sending RFP', 'error', {
                             position: 'top-right'
                         });
                     } else {
                         alert(data.message || 'Error sending RFP');
                     }
                 }
             })
             .catch(error => {
                 console.error('Error:', error);
                 if (window.NioApp && typeof NioApp.Toast === 'function') {
                     NioApp.Toast('Network error occurred while sending RFP', 'error', {
                         position: 'top-right'
                     });
                 } else {
                     alert('Network error occurred while sending RFP');
                 }
             })
             .finally(() => {
                 // Reset button state
                 sendBtn.innerHTML = originalText;
                 sendBtn.disabled = false;
             });
     }
</script>