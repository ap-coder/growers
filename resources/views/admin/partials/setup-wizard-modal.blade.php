<div class="modal fade" id="setupWizardModal" tabindex="-1" role="dialog" aria-labelledby="setupWizardModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="setupWizardModalLabel">
                    <i class="fas fa-magic mr-2"></i> Site Setup Wizard
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="wizardTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="settings-tab" data-toggle="tab" href="#settings-panel" role="tab">
                            <i class="fas fa-cog mr-1"></i> Site Settings
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pages-tab" data-toggle="tab" href="#pages-panel" role="tab">
                            <i class="fas fa-file-alt mr-1"></i> Default Pages
                        </a>
                    </li>
                </ul>

                <div class="tab-content pt-3" id="wizardTabContent">
                    <!-- Site Settings Tab -->
                    <div class="tab-pane fade show active" id="settings-panel" role="tabpanel">
                        <form id="wizardSettingsForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><i class="fas fa-image mr-1"></i> Header Logo</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="header_logo" name="header_logo" accept="image/*">
                                            <label class="custom-file-label" for="header_logo">Choose file...</label>
                                        </div>
                                        <small class="text-muted">Recommended: PNG with transparent background</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><i class="fas fa-image mr-1"></i> Login Page Background</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="login_image" name="login_image" accept="image/*">
                                            <label class="custom-file-label" for="login_image">Choose file...</label>
                                        </div>
                                        <small class="text-muted">Recommended size: 1920x1080px</small>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h6 class="text-muted mb-3"><i class="fas fa-map-marker-alt mr-1"></i> Footer Information</h6>

                            @php
                                $user = auth()->user();
                                $companyName = \App\Models\Setting::get('company_name', 'Pacific Plant Growers');
                                $defaultEmail = \App\Models\Setting::get('footer_email') ?: \App\Models\Setting::get('company_email') ?: 'orders@pacificplantgrowers.com';
                                $defaultPhone = \App\Models\Setting::get('footer_phone') ?: \App\Models\Setting::get('company_phone') ?: '801-768-2809';
                                $defaultAddress = \App\Models\Setting::get('footer_address') ?: \App\Models\Setting::get('company_address') ?: "Pacific Plant Growers\n1697 W 2100 N.\nLehi, UT 84043";
                                $defaultDisclaimer = \App\Models\Setting::get('footer_disclaimer') ?: "© " . date('Y') . " {$companyName}. All rights reserved. | pacificplantgrowers.com";
                            @endphp

                            <div class="form-group">
                                <label>Company Address</label>
                                <textarea class="form-control" id="footer_address" name="footer_address" rows="2" placeholder="123 Main Street&#10;City, State 12345">{{ $defaultAddress }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><i class="fas fa-envelope mr-1"></i> Contact Email</label>
                                        <input type="email" class="form-control" id="footer_email" name="footer_email" placeholder="contact@company.com" value="{{ $defaultEmail }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><i class="fas fa-phone mr-1"></i> Phone Number</label>
                                        <input type="text" class="form-control" id="footer_phone" name="footer_phone" placeholder="(555) 123-4567" value="{{ $defaultPhone }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label><i class="fas fa-gavel mr-1"></i> Footer Disclaimer Text</label>
                                <textarea class="form-control" id="footer_disclaimer" name="footer_disclaimer" rows="3" placeholder="Optional disclaimer text for the footer...">{{ $defaultDisclaimer }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save mr-1"></i> Save Settings
                            </button>
                            <button type="button" class="btn btn-primary ml-2" id="nextToPagesBtn">
                                Next: Default Pages <i class="fas fa-arrow-right ml-1"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Default Pages Tab -->
                    <div class="tab-pane fade" id="pages-panel" role="tabpanel">
                        <p class="text-muted mb-3">Create default pages for your site. Click <strong>Go</strong> to create each page, or <strong>X</strong> to skip it.</p>
                        
                        <div id="defaultPagesContainer">
                            <div class="default-page-row d-flex align-items-center mb-2" data-slug="about">
                                <input type="text" class="form-control form-control-sm mr-2" style="width: 200px;" value="About" placeholder="Page Name">
                                <button type="button" class="btn btn-sm btn-success mr-2 create-page-btn">
                                    <i class="fas fa-check"></i> Go
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger remove-page-row-btn">
                                    <i class="fas fa-times"></i>
                                </button>
                                <span class="ml-2 page-status"></span>
                            </div>

                            <div class="default-page-row d-flex align-items-center mb-2" data-slug="return-policy">
                                <input type="text" class="form-control form-control-sm mr-2" style="width: 200px;" value="Return Policy" placeholder="Page Name">
                                <button type="button" class="btn btn-sm btn-success mr-2 create-page-btn">
                                    <i class="fas fa-check"></i> Go
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger remove-page-row-btn">
                                    <i class="fas fa-times"></i>
                                </button>
                                <span class="ml-2 page-status"></span>
                            </div>

                            <div class="default-page-row d-flex align-items-center mb-2" data-slug="privacy-policy">
                                <input type="text" class="form-control form-control-sm mr-2" style="width: 200px;" value="Privacy Policy" placeholder="Page Name">
                                <button type="button" class="btn btn-sm btn-success mr-2 create-page-btn">
                                    <i class="fas fa-check"></i> Go
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger remove-page-row-btn">
                                    <i class="fas fa-times"></i>
                                </button>
                                <span class="ml-2 page-status"></span>
                            </div>

                            <div class="default-page-row d-flex align-items-center mb-2" data-slug="terms-conditions">
                                <input type="text" class="form-control form-control-sm mr-2" style="width: 200px;" value="Terms & Conditions" placeholder="Page Name">
                                <button type="button" class="btn btn-sm btn-success mr-2 create-page-btn">
                                    <i class="fas fa-check"></i> Go
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger remove-page-row-btn">
                                    <i class="fas fa-times"></i>
                                </button>
                                <span class="ml-2 page-status"></span>
                            </div>

                            <div class="default-page-row d-flex align-items-center mb-2 new-page-template" data-slug="">
                                <input type="text" class="form-control form-control-sm mr-2" style="width: 200px;" value="" placeholder="New Page Name">
                                <button type="button" class="btn btn-sm btn-success mr-2 create-page-btn">
                                    <i class="fas fa-check"></i> Go
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger remove-page-row-btn">
                                    <i class="fas fa-times"></i>
                                </button>
                                <span class="ml-2 page-status"></span>
                            </div>
                        </div>

                        <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="addPageRowBtn">
                            <i class="fas fa-plus"></i> Add Another Page
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                @if(auth()->user()->needs_setup)
                    <button type="button" class="btn btn-success" id="completeSetupBtn" style="display: none;">
                        <i class="fas fa-check-circle mr-1"></i> Complete Setup & Don't Show Again
                    </button>
                @endif
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(function() {
    // Auto-show wizard if user needs setup
    @if(auth()->user()->needs_setup)
        $('#setupWizardModal').modal('show');
    @endif

    // Complete Setup button
    $('#completeSetupBtn').on('click', function() {
        var $btn = $(this);
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Completing...');
        
        $.ajax({
            url: '{{ route("admin.setup-wizard.complete") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    toastr.success('Setup completed! This wizard will no longer auto-open.');
                    $('#setupWizardModal').modal('hide');
                    $btn.remove();
                } else {
                    toastr.error(response.message || 'Error completing setup');
                    $btn.prop('disabled', false).html('<i class="fas fa-check-circle mr-1"></i> Complete Setup & Don\'t Show Again');
                }
            },
            error: function(xhr) {
                toastr.error(xhr.responseJSON?.message || 'Error completing setup');
                $btn.prop('disabled', false).html('<i class="fas fa-check-circle mr-1"></i> Complete Setup & Don\'t Show Again');
            }
        });
    });

    // Next button to Pages tab
    $('#nextToPagesBtn').on('click', function() {
        $('#pages-tab').tab('show');
    });

    // Show/hide Complete Setup button based on active tab
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        if ($(e.target).attr('href') === '#pages-panel') {
            $('#completeSetupBtn').fadeIn();
        } else {
            $('#completeSetupBtn').fadeOut();
        }
    });

    // Custom file input label update
    $('.custom-file-input').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').html(fileName || 'Choose file...');
    });

    // Save settings form
    $('#wizardSettingsForm').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        
        $.ajax({
            url: '{{ route("admin.setup-wizard.save-settings") }}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    toastr.success('Settings saved successfully!');
                } else {
                    toastr.error(response.message || 'Error saving settings');
                }
            },
            error: function(xhr) {
                toastr.error(xhr.responseJSON?.message || 'Error saving settings');
            }
        });
    });

    // Create page button
    $(document).on('click', '.create-page-btn', function() {
        var $row = $(this).closest('.default-page-row');
        var pageName = $row.find('input').val().trim();
        var $btn = $(this);
        var $status = $row.find('.page-status');
        
        if (!pageName) {
            toastr.warning('Please enter a page name');
            return;
        }
        
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
        
        $.ajax({
            url: '{{ route("admin.setup-wizard.create-page") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                title: pageName
            },
            success: function(response) {
                if (response.success) {
                    $btn.removeClass('btn-success').addClass('btn-secondary').html('<i class="fas fa-check"></i> Created').prop('disabled', true);
                    $status.html('<span class="badge badge-success">Created</span> <a href="' + response.edit_url + '" class="btn btn-xs btn-info ml-1" target="_blank"><i class="fas fa-edit"></i> Edit</a>');
                    $row.find('.remove-page-row-btn').hide();
                } else {
                    $btn.prop('disabled', false).html('<i class="fas fa-check"></i> Go');
                    toastr.error(response.message || 'Error creating page');
                }
            },
            error: function(xhr) {
                $btn.prop('disabled', false).html('<i class="fas fa-check"></i> Go');
                toastr.error(xhr.responseJSON?.message || 'Error creating page');
            }
        });
    });

    // Remove page row
    $(document).on('click', '.remove-page-row-btn', function() {
        $(this).closest('.default-page-row').fadeOut(200, function() {
            $(this).remove();
        });
    });

    // Add new page row
    $('#addPageRowBtn').on('click', function() {
        var newRow = `
            <div class="default-page-row d-flex align-items-center mb-2" data-slug="">
                <input type="text" class="form-control form-control-sm mr-2" style="width: 200px;" value="" placeholder="New Page Name">
                <button type="button" class="btn btn-sm btn-success mr-2 create-page-btn">
                    <i class="fas fa-check"></i> Go
                </button>
                <button type="button" class="btn btn-sm btn-outline-danger remove-page-row-btn">
                    <i class="fas fa-times"></i>
                </button>
                <span class="ml-2 page-status"></span>
            </div>
        `;
        $('#defaultPagesContainer').append(newRow);
    });
});
</script>
@endpush
