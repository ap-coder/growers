@extends('layouts.admin')
@section('content')

<div class="mb-3">
    <a class="btn btn-default" href="{{ route('admin.orders.index') }}">
        {{ trans('global.back_to_list') }}
    </a>
    <a class="btn btn-primary" href="{{ route('admin.orders.edit', $order->id) }}">
        Edit Order
    </a>
    <a class="btn btn-info" href="{{ route('admin.orders.print', $order->id) }}" target="_blank">
        <i class="fa fa-print"></i> Print Order Ticket
    </a>
    <a class="btn btn-success" href="{{ route('admin.orders.packingSlip', $order->id) }}" target="_blank">
        <i class="fa fa-file-text"></i> Download Packing Slip
    </a>
    <a class="btn btn-warning" href="{{ route('admin.orders.invoice', $order->id) }}" target="_blank">
        <i class="fa fa-file-invoice"></i> Download Invoice
    </a>
</div>

<div class="row">
    {{-- LEFT SIDE: Order Details by Category --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">{{ $order->client->name ?? 'No Client' }} {{ $order->client->store_number ? '#' . $order->client->store_number : '' }}</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-6">
                        <strong>Date of Order:</strong> {{ $order->created_at->format('m/d/Y') }}
                    </div>
                    <div class="col-6">
                        <strong>Order #:</strong> {{ $order->number }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <strong>Order Placed By:</strong> {{ $order->ordered_by_name ?? 'N/A' }}
                        @if($order->ordered_by_phone)
                            <br><small>{{ $order->ordered_by_phone }}</small>
                        @endif
                    </div>
                    <div class="col-6">
                        <strong>Delivery Date:</strong> {{ $order->delivery_date ? \Carbon\Carbon::parse($order->delivery_date)->format('l m/d/Y') : 'N/A' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <strong>Status:</strong> 
                        <span class="badge badge-{{ $order->status == 'new' ? 'warning' : ($order->status == 'Fullfilled' ? 'success' : 'info') }}">
                            {{ App\Models\Order::STATUS_SELECT[$order->status] ?? $order->status }}
                        </span>
                    </div>
                    <div class="col-6">
                        <strong>Total:</strong> ${{ number_format($order->order_total, 2) }}
                    </div>
                </div>

                <hr>

                {{-- Items grouped by category --}}
                <h5>Items by Category</h5>
                @php
                    $itemsByCategory = $order->orderItems->groupBy(function($item) {
                        return $item->product->categories->first()->name ?? 'Uncategorized';
                    });
                @endphp

                <div class="row">
                    @foreach($itemsByCategory as $category => $items)
                        <div class="col-md-6 mb-3">
                            <div class="card h-100">
                                <div class="card-header py-2 bg-light">
                                    <strong>{{ strtoupper($category) }}</strong>
                                </div>
                                <div class="card-body py-2">
                                    <ul class="list-unstyled mb-0" style="font-size: 0.9em;">
                                        @foreach($items as $item)
                                            <li>{{ $item->quantity }} {{ $item->product->name ?? 'Unknown Product' }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($order->special_request)
                    <hr>
                    <div class="card bg-warning-light">
                        <div class="card-header py-2 bg-warning">
                            <strong>SPECIAL INSTRUCTIONS</strong>
                        </div>
                        <div class="card-body py-2">
                            {{ $order->special_request }}
                        </div>
                    </div>
                @endif

                @if($order->delivery_details)
                    <div class="card mt-2">
                        <div class="card-header py-2 bg-info text-white">
                            <strong>DELIVERY DETAILS</strong>
                        </div>
                        <div class="card-body py-2">
                            {{ $order->delivery_details }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- RIGHT SIDE: UPC Codes List --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">UPC CODES</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm table-striped mb-0">
                    <thead>
                        <tr>
                            <th width="50">Qty</th>
                            <th width="80">UPC</th>
                            <th>Product</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($order->orderItems->sortBy(function($item) {
                            return $item->product->upc_code ?? 'zzz';
                        }) as $item)
                            <tr>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->product->upc_code ?? '-' }}</td>
                                <td>{{ $item->product->name ?? 'Unknown' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">No items in this order</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <strong>Total Items:</strong> {{ $order->orderItems->sum('quantity') }}
            </div>
        </div>
    </div>
</div>

<div class="mt-3">
    <a class="btn btn-default" href="{{ route('admin.orders.index') }}">
        {{ trans('global.back_to_list') }}
    </a>
</div>

@endsection