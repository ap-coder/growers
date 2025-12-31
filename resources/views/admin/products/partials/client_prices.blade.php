<!-- Base Pricing & Identifiers (on Product) -->
<div class="card card-secondary mb-4">
    <div class="card-header">
        <h5 class="mb-0">Base Pricing & Identifiers</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="base_price">Base Price</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input class="form-control" type="number" step="0.01" name="base_price" id="base_price" value="{{ old('base_price', $product->base_price) }}">
                    </div>
                    <span class="help-block">Default price for all clients</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="sku">SKU</label>
                    <input class="form-control" type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}">
                    <span class="help-block">Internal product code</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="upc_code">UPC Code</label>
                    <input class="form-control" type="text" name="upc_code" id="upc_code" value="{{ old('upc_code', $product->upc_code) }}">
                    <span class="help-block">For order tickets</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="qb_1">QuickBooks ID 1</label>
                    <input class="form-control" type="text" name="qb_1" id="qb_1" value="{{ old('qb_1', $product->qb_1) }}">
                    <span class="help-block">Accounting identifier</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="qb_2">QuickBooks ID 2</label>
                    <input class="form-control" type="text" name="qb_2" id="qb_2" value="{{ old('qb_2', $product->qb_2) }}">
                    <span class="help-block">Accounting identifier</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Select Clients Dropdown with Select2 (allows multiple selections) -->
<div class="form-group">
    <label for="clientSelect">Select Clients</label>
    <div class="input-group">
        <select id="clientSelect" class="form-control select2" name="clients[]" multiple style="width: 80%;">
            @foreach($clients as $client)
                <option style="width: 100%;" value="{{ $client->id }}" {{ (in_array($client->id, old('clients', $product->clients->pluck('id')->toArray()))) ? 'selected' : '' }}>
                    {{ $client->name }}
                </option>
            @endforeach
        </select>

        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="addClient">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <span class="help-block">Select clients to show product on.</span>
</div>

<!-- Client Price Overrides -->
<div id="clientPricingTableContainer" class="mt-3">
    <h5>Client Price Overrides</h5>
    <p class="text-muted">Only set a price if it differs from the base price above. Leave blank to use base price.</p>
    <table id="clientPricingTable" class="table table-bordered">
        <thead>
            <tr>
                <th>Client Name</th>
                <th>Price Override</th>
            </tr>
        </thead>
        <tbody id="clientPricingTableBody">
            @foreach ($prices as $clientPrice)
                <tr id="pricing-row-{{ $clientPrice->client_id }}">
                    <td>{{ $clientPrice->client->name }}</td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" step="0.01" name="client_prices[{{ $clientPrice->client_id }}][price]" class="form-control" value="{{ old('client_prices.' . $clientPrice->client_id . '.price', $clientPrice->price) }}" placeholder="Use base price">
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

