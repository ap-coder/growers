@can('order_show')
    <a class="btn btn-xs btn-primary" href="{{ route('admin.orders.show', $row->id) }}" title="View Order">
        <i class="fa fa-eye"></i>
    </a>
@endcan
<a class="btn btn-xs btn-info" href="{{ route('admin.orders.invoice', $row->id) }}" target="_blank" title="View Invoice">
    <i class="fa fa-file-invoice"></i>
</a>
<a class="btn btn-xs btn-success" href="{{ route('admin.orders.packingSlip', $row->id) }}" target="_blank" title="Packing Slip">
    <i class="fa fa-file-text"></i>
</a>
<a class="btn btn-xs btn-secondary" href="{{ route('admin.orders.print', $row->id) }}" target="_blank" title="Print Order">
    <i class="fa fa-print"></i>
</a>
