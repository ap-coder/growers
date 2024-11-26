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
        <tbody>
            @foreach($product->clients as $client)
                <tr>
                    <td>{{ $client->name }}</td>
                    <td>
                        <input type="number" name="prices[{{ $client->id }}]" class="form-control"
                            value="{{ $client->pivot->price ?? '' }}" placeholder="Enter price">
                    </td>
                    <td>
                        <input type="text" name="skus[{{ $client->id }}]" class="form-control"
                            value="{{ $client->pivot->sku ?? '' }}" placeholder="Enter SKU">
                    </td>
                    <td>
                        <input type="text" name="mpns[{{ $client->id }}]" class="form-control"
                            value="{{ $client->pivot->mpn ?? '' }}" placeholder="Enter MPN">
                    </td>
                    <td>
                        <input type="text" name="gtins[{{ $client->id }}]" class="form-control"
                            value="{{ $client->pivot->gtin ?? '' }}" placeholder="Enter GTIN">
                    </td>
                    <td>
                        <input type="text" name="upcs[{{ $client->id }}]" class="form-control"
                            value="{{ $client->pivot->upc ?? '' }}" placeholder="Enter UPC">
                    </td>
                    <td>
                        <input type="text" name="qb_1[{{ $client->id }}]" class="form-control"
                            value="{{ $client->pivot->qb_1 ?? '' }}" placeholder="Enter QB 1">
                    </td>
                    <td>
                        <input type="text" name="qb_2[{{ $client->id }}]" class="form-control"
                            value="{{ $client->pivot->qb_2 ?? '' }}" placeholder="Enter QB 2">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
