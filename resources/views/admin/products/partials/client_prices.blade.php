<!-- Select Clients -->
<div class="form-group">
    <label for="clients">Select Clients</label>
    <select class="form-control select2" name="clients[]" id="clients" multiple style="width: 100%;">
        @foreach($clients as $id => $client)
            <option value="{{ $id }}"
                {{ (in_array($id, old('clients', $product->clients->pluck('id')->toArray()))) ? 'selected' : '' }}>
                {{ $client }}
            </option>
        @endforeach
    </select>
</div>

<!-- Client Pricing Fields -->
<div id="client-pricing-fields" class="mt-4">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Client</th>
                <th>Price</th>
                <th>SKU</th>
                <th>MPN</th>
                <th>GTIN</th>
                <th>UPC</th>
                <th>QB 1</th>
                <th>QB 2</th>
            </tr>
        </thead>
        <tbody id="client-pricing-tbody">
            @foreach($product->clientPrices as $clientPrice)
                <tr>
                    <td>{{ $clientPrice->client->name }}</td>
                    <td>
                        <input type="number" name="prices[{{ $clientPrice->client_id }}]" class="form-control" value="{{ $clientPrice->price ?? '' }}" placeholder="Enter price">
                    </td>
                    <td>
                        <input type="text" name="skus[{{ $clientPrice->client_id }}]" class="form-control" value="{{ $clientPrice->sku ?? '' }}" placeholder="Enter SKU">
                    </td>
                    <td>
                        <input type="text" name="mpns[{{ $clientPrice->client_id }}]" class="form-control" value="{{ $clientPrice->mpn ?? '' }}" placeholder="Enter MPN">
                    </td>
                    <td>
                        <input type="text" name="gtins[{{ $clientPrice->client_id }}]" class="form-control" value="{{ $clientPrice->gtin ?? '' }}" placeholder="Enter GTIN">
                    </td>
                    <td>
                        <input type="text" name="upcs[{{ $clientPrice->client_id }}]" class="form-control" value="{{ $clientPrice->upc ?? '' }}" placeholder="Enter UPC">
                    </td>
                    <td>
                        <input type="text" name="qb_1[{{ $clientPrice->client_id }}]" class="form-control" value="{{ $clientPrice->qb_1 ?? '' }}" placeholder="Enter QB 1">
                    </td>
                    <td>
                        <input type="text" name="qb_2[{{ $clientPrice->client_id }}]" class="form-control" value="{{ $clientPrice->qb_2 ?? '' }}" placeholder="Enter QB 2">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

