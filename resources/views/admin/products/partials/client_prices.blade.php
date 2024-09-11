<div class="form-group">
    <label for="clients">Select Clients</label>
    <select class="form-control select2" name="clients[]" id="clients" multiple>
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
    @foreach($product->clients as $client)
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="price-{{ $client->id }}">Price</label>
                <input type="number" name="prices[{{ $client->id }}]" id="price-{{ $client->id }}" class="form-control" value="{{ $client->pivot->price }}" placeholder="Enter price">
            </div>
            <div class="form-group col-md-2">
                <label for="sku-{{ $client->id }}">SKU</label>
                <input type="text" name="skus[{{ $client->id }}]" id="sku-{{ $client->id }}" class="form-control" value="{{ $client->pivot->sku }}" placeholder="Enter SKU">
            </div>
            <div class="form-group col-md-2">
                <label for="mpn-{{ $client->id }}">MPN</label>
                <input type="text" name="mpns[{{ $client->id }}]" id="mpn-{{ $client->id }}" class="form-control" value="{{ $client->pivot->mpn }}" placeholder="Enter MPN">
            </div>
            <div class="form-group col-md-2">
                <label for="gtin-{{ $client->id }}">GTIN</label>
                <input type="text" name="gtins[{{ $client->id }}]" id="gtin-{{ $client->id }}" class="form-control" value="{{ $client->pivot->gtin }}" placeholder="Enter GTIN">
            </div>
            <div class="form-group col-md-2">
                <label for="upc-{{ $client->id }}">UPC</label>
                <input type="text" name="upcs[{{ $client->id }}]" id="upc-{{ $client->id }}" class="form-control" value="{{ $client->pivot->upc }}" placeholder="Enter UPC">
            </div>
            <div class="form-group col-md-2">
                <label for="qb1-{{ $client->id }}">QB 1</label>
                <input type="text" name="qb_1[{{ $client->id }}]" id="qb1-{{ $client->id }}" class="form-control" value="{{ $client->pivot->qb_1 }}" placeholder="Enter QB 1">
            </div>
            <div class="form-group col-md-2">
                <label for="qb2-{{ $client->id }}">QB 2</label>
                <input type="text" name="qb_2[{{ $client->id }}]" id="qb2-{{ $client->id }}" class="form-control" value="{{ $client->pivot->qb_2 }}" placeholder="Enter QB 2">
            </div>
        </div>
    @endforeach
</div>

