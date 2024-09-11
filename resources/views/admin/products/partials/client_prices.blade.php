<div class="form-group">
    <label for="clients">Select Clients</label>
    <select class="form-control select2" name="clients[]" id="clients" multiple>
        @foreach($clients as $id => $client)
            <option value="{{ $id }}" {{ (in_array($id, old('clients', [])) || $product->clients->contains($id)) ? 'selected' : '' }}>
                {{ $client->name }}
            </option>
        @endforeach
    </select>
</div>

<!-- Pricing fields for each client -->
<div id="client-pricing-fields">
    <!-- Pricing fields are dynamically added here through JavaScript -->
</div>
