<!-- Client Addresses Section -->
<div class="card card-info mb-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-map-marker-alt mr-2"></i> Addresses</h5>
    </div>
    <div class="card-body">
        <div id="addressesContainer">
            @php
                $addresses = $client->addresses ?? collect();
                $addressTypes = \App\Models\ClientAddress::TYPE_SELECT;
            @endphp

            @forelse($addresses as $index => $address)
                <div class="address-card card mb-3">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <div>
                            <select name="addresses[{{ $index }}][address_type]" class="form-control form-control-sm d-inline-block w-auto">
                                @foreach($addressTypes as $key => $label)
                                    <option value="{{ $key }}" {{ $address->address_type == $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="addresses[{{ $index }}][label]" class="form-control form-control-sm d-inline-block ml-2" style="width: 150px;" placeholder="Label" value="{{ $address->label }}">
                            <input type="text" name="addresses[{{ $index }}][nickname]" class="form-control form-control-sm d-inline-block ml-2" style="width: 150px;" placeholder="Nickname" value="{{ $address->nickname }}">
                        </div>
                        <div>
                            <label class="mb-0 mr-3">
                                <input type="checkbox" name="addresses[{{ $index }}][is_primary]" value="1" {{ $address->is_primary ? 'checked' : '' }}> Primary
                            </label>
                            <label class="mb-0 mr-3">
                                <input type="checkbox" name="addresses[{{ $index }}][is_fake]" value="1" {{ $address->is_fake ? 'checked' : '' }}> Fake/Demo
                            </label>
                            <button type="button" class="btn btn-sm btn-danger remove-address-btn">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address Line 1 <span class="text-danger">*</span></label>
                                    <input type="text" name="addresses[{{ $index }}][address_line_1]" class="form-control" value="{{ $address->address_line_1 }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address Line 2</label>
                                    <input type="text" name="addresses[{{ $index }}][address_line_2]" class="form-control" value="{{ $address->address_line_2 }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>City <span class="text-danger">*</span></label>
                                    <input type="text" name="addresses[{{ $index }}][city]" class="form-control" value="{{ $address->city }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>State <span class="text-danger">*</span></label>
                                    <input type="text" name="addresses[{{ $index }}][state]" class="form-control" value="{{ $address->state }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Postal Code <span class="text-danger">*</span></label>
                                    <input type="text" name="addresses[{{ $index }}][postal_code]" class="form-control" value="{{ $address->postal_code }}" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Country</label>
                                    <input type="text" name="addresses[{{ $index }}][country]" class="form-control" value="{{ $address->country ?? 'USA' }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Contact Name</label>
                                    <input type="text" name="addresses[{{ $index }}][contact_name]" class="form-control" value="{{ $address->contact_name }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Contact Phone</label>
                                    <input type="text" name="addresses[{{ $index }}][contact_phone]" class="form-control" value="{{ $address->contact_phone }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Contact Email</label>
                                    <input type="email" name="addresses[{{ $index }}][contact_email]" class="form-control" value="{{ $address->contact_email }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Delivery Notes</label>
                                    <textarea name="addresses[{{ $index }}][delivery_notes]" class="form-control" rows="2">{{ $address->delivery_notes }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Special Instructions</label>
                                    <textarea name="addresses[{{ $index }}][special_instructions]" class="form-control" rows="2">{{ $address->special_instructions }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Google Map Link</label>
                                    <input type="url" name="addresses[{{ $index }}][google_map_link]" class="form-control" value="{{ $address->google_map_link }}" placeholder="https://maps.google.com/...">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="addresses[{{ $index }}][id]" value="{{ $address->id }}">
                    </div>
                </div>
            @empty
                <p class="text-muted" id="noAddressesMsg">No addresses added yet. Click "Add Address" to add one.</p>
            @endforelse
        </div>

        <button type="button" class="btn btn-outline-success" id="addAddressBtn">
            <i class="fas fa-plus"></i> Add Address
        </button>
    </div>
</div>

<script>
$(function() {
    var addressIndex = {{ $addresses->count() }};
    var addressTypes = @json($addressTypes);

    $('#addAddressBtn').on('click', function() {
        $('#noAddressesMsg').hide();
        
        var typeOptions = '';
        $.each(addressTypes, function(key, label) {
            typeOptions += '<option value="' + key + '">' + label + '</option>';
        });

        var newAddress = `
            <div class="address-card card mb-3">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <div>
                        <select name="addresses[${addressIndex}][address_type]" class="form-control form-control-sm d-inline-block w-auto">
                            ${typeOptions}
                        </select>
                        <input type="text" name="addresses[${addressIndex}][label]" class="form-control form-control-sm d-inline-block ml-2" style="width: 150px;" placeholder="Label">
                        <input type="text" name="addresses[${addressIndex}][nickname]" class="form-control form-control-sm d-inline-block ml-2" style="width: 150px;" placeholder="Nickname">
                    </div>
                    <div>
                        <label class="mb-0 mr-3">
                            <input type="checkbox" name="addresses[${addressIndex}][is_primary]" value="1"> Primary
                        </label>
                        <label class="mb-0 mr-3">
                            <input type="checkbox" name="addresses[${addressIndex}][is_fake]" value="1"> Fake/Demo
                        </label>
                        <button type="button" class="btn btn-sm btn-danger remove-address-btn">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Address Line 1 <span class="text-danger">*</span></label>
                                <input type="text" name="addresses[${addressIndex}][address_line_1]" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Address Line 2</label>
                                <input type="text" name="addresses[${addressIndex}][address_line_2]" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>City <span class="text-danger">*</span></label>
                                <input type="text" name="addresses[${addressIndex}][city]" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>State <span class="text-danger">*</span></label>
                                <input type="text" name="addresses[${addressIndex}][state]" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Postal Code <span class="text-danger">*</span></label>
                                <input type="text" name="addresses[${addressIndex}][postal_code]" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Country</label>
                                <input type="text" name="addresses[${addressIndex}][country]" class="form-control" value="USA">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Contact Name</label>
                                <input type="text" name="addresses[${addressIndex}][contact_name]" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Contact Phone</label>
                                <input type="text" name="addresses[${addressIndex}][contact_phone]" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Contact Email</label>
                                <input type="email" name="addresses[${addressIndex}][contact_email]" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Delivery Notes</label>
                                <textarea name="addresses[${addressIndex}][delivery_notes]" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Special Instructions</label>
                                <textarea name="addresses[${addressIndex}][special_instructions]" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Google Map Link</label>
                                <input type="url" name="addresses[${addressIndex}][google_map_link]" class="form-control" placeholder="https://maps.google.com/...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $('#addressesContainer').append(newAddress);
        addressIndex++;
    });

    $(document).on('click', '.remove-address-btn', function() {
        $(this).closest('.address-card').remove();
        if ($('.address-card').length === 0) {
            $('#noAddressesMsg').show();
        }
    });
});
</script>
