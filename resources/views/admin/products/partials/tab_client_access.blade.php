{{-- Client Access Tab - Which clients can see this product + price overrides --}}

{{-- Product Availability --}}
<div class="card card-primary mb-3">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-eye mr-2"></i>Product Availability</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Availability Mode</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="availability_mode" id="availability_all" value="all" {{ old('availability_mode', $product->clients->isEmpty() ? 'all' : 'selected') === 'all' ? 'checked' : '' }}>
                        <label class="form-check-label" for="availability_all">
                            <strong>All Clients</strong> - Product visible to everyone
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="availability_mode" id="availability_selected" value="selected" {{ old('availability_mode', $product->clients->isEmpty() ? 'all' : 'selected') === 'selected' ? 'checked' : '' }}>
                        <label class="form-check-label" for="availability_selected">
                            <strong>Selected Clients Only</strong> - Restrict visibility
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-8" id="clientSelectContainer">
                <label for="clientSelect">Available To Clients</label><br>
                <select id="clientSelect" class="form-control select2" name="clients[]" multiple style="width: 100%;">
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ (in_array($client->id, old('clients', $product->clients->pluck('id')->toArray()))) ? 'selected' : '' }}>
                            {{ $client->name }}
                        </option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Select clients who can view and order this product.</small>
            </div>


        </div>
    </div>
</div>

{{-- Client Price Overrides --}}
<div class="card card-secondary mb-3">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-tag mr-2"></i>Client Price Overrides</h5>
    </div>
    <div class="card-body">
        <p class="text-muted">Set custom prices for specific clients. Leave blank to use the base/variation price.</p>

        @php
            // Build lookup for existing client prices
            $clientPricesLookup = $prices->keyBy('client_id');
            // Build lookup for variation client prices
            $variationPricesLookup = [];
            foreach($product->variations as $variation) {
                foreach($variation->clientPrices as $vcp) {
                    $variationPricesLookup[$vcp->client_id][$variation->id] = $vcp->price;
                }
            }
            // Group variations by category (using variation_category_id)
            $variationsByCategory = $product->variations->groupBy('variation_category_id');
        @endphp

        @foreach($clients as $client)
        <div id="pricing-row-{{ $client->id }}" data-client-id="{{ $client->id }}" class="client-price-row card card-outline card-light mb-3" style="{{ !in_array($client->id, $product->clients->pluck('id')->toArray()) && $product->clients->isNotEmpty() ? 'display:none;' : '' }}">
            <div class="card-header py-2 bg-secondary text-white">
                <strong>{{ $client->name }}</strong>
                <span class="float-right">
                    <small>Base Product (${{ number_format($product->base_price ?? 0, 2) }}):</small>
                    <div class="input-group input-group-sm d-inline-flex" style="width: 100px;">
                        <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                        <input type="number" step="0.01" name="client_prices[{{ $client->id }}][price]" class="form-control" 
                            value="{{ old('client_prices.' . $client->id . '.price', $clientPricesLookup[$client->id]->price ?? '') }}" 
                            placeholder="{{ number_format($product->base_price ?? 0, 2) }}">
                    </div>
                </span>
            </div>
            @if($product->variations->count() > 0)
            <div class="card-body py-2">
                @foreach($variationsByCategory as $category => $variations)
                @php
                    $categoryModel = \App\Models\VariationCategory::find($category);
                    $categoryName = $categoryModel->name ?? 'Uncategorized';
                @endphp
                <div class="table-responsive mb-2">
                    <table class="table table-sm table-bordered mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 100px;" class="bg-secondary text-white">{{ $categoryName }}</th>
                                @foreach($variations as $variation)
                                <th class="text-center">
                                    {{ $variation->name }}<br>
                                    <small class="text-muted">${{ number_format($variation->base_price ?? 0, 2) }}</small>
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="align-middle text-center"><small class="text-muted">Base Price →</small></td>
                                @foreach($variations as $variation)
                                <td>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                        <input type="number" step="0.01" name="variation_client_prices[{{ $client->id }}][{{ $variation->id }}]" class="form-control" 
                                            value="{{ old('variation_client_prices.' . $client->id . '.' . $variation->id, $variationPricesLookup[$client->id][$variation->id] ?? '') }}" 
                                            placeholder="{{ number_format($variation->base_price ?? 0, 2) }}">
                                    </div>
                                </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        @endforeach

        <div class="text-muted text-center py-3" id="noClientPricesMsg" style="{{ $clients->isEmpty() ? '' : 'display:none;' }}">
            <i class="fas fa-info-circle mr-1"></i>
            <span id="noPricesText">No clients available for price overrides.</span>
        </div>
    </div>
</div>
