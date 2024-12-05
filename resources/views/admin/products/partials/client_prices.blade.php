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



<!-- Predefined Table for Client Pricing -->
<div id="clientPricingTableContainer" class="mt-3">
    <table id="clientPricingTable" class="table table-bordered">
        <thead>
            <tr>
                <th>Client Name</th>
                <th>Price</th>
                <th>SKU</th>
                <th>MPN</th>
                <th>GTIN</th>
                <th>UPC</th>
                <th>QB 1</th>
                <th>QB 2</th>
            </tr>
        </thead>
        <tbody id="clientPricingTableBody">
            <!-- Loop to pre-populate existing client pricing -->
            @foreach ($prices as $clientPrice)
                <tr id="pricing-row-{{ $clientPrice->client_id }}">
                    <td>{{ $clientPrice->client->name }}</td>
                    <td><input type="number" name="client_prices[{{ $clientPrice->client_id }}][price]" class="form-control" value="{{ old('client_prices.' . $clientPrice->client_id . '.price', $clientPrice->price) }}" required></td>
                    <td><input type="text" name="client_prices[{{ $clientPrice->client_id }}][sku]" class="form-control" value="{{ old('client_prices.' . $clientPrice->client_id . '.sku', $clientPrice->sku) }}"></td>
                    <td><input type="text" name="client_prices[{{ $clientPrice->client_id }}][mpn]" class="form-control" value="{{ old('client_prices.' . $clientPrice->client_id . '.mpn', $clientPrice->mpn) }}"></td>
                    <td><input type="text" name="client_prices[{{ $clientPrice->client_id }}][gtin]" class="form-control" value="{{ old('client_prices.' . $clientPrice->client_id . '.gtin', $clientPrice->gtin) }}"></td>
                    <td><input type="text" name="client_prices[{{ $clientPrice->client_id }}][upc]" class="form-control" value="{{ old('client_prices.' . $clientPrice->client_id . '.upc', $clientPrice->upc) }}"></td>
                    <td><input type="text" name="client_prices[{{ $clientPrice->client_id }}][qb_1]" class="form-control" value="{{ old('client_prices.' . $clientPrice->client_id . '.qb_1', $clientPrice->qb_1) }}"></td>
                    <td><input type="text" name="client_prices[{{ $clientPrice->client_id }}][qb_2]" class="form-control" value="{{ old('client_prices.' . $clientPrice->client_id . '.qb_2', $clientPrice->qb_2) }}"></td>

                </tr>
            @endforeach

        </tbody>
    </table>
</div>

