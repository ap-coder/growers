@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-file-invoice mr-2"></i> Invoices
        </h3>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-Invoice">
            <thead>
                <tr>
                    <th width="10"></th>
                    <th>Invoice #</th>
                    <th>Client</th>
                    <th>Invoice Date</th>
                    <th>Status</th>
                    <th>Subtotal</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection

@section('scripts')
@parent
<script>
$(function () {
    let dtOverrideGlobals = {
        buttons: [],
        processing: true,
        serverSide: true,
        retrieve: true,
        aaSorting: [],
        ajax: "{{ route('admin.invoices.index') }}",
        columns: [
            { data: 'placeholder', name: 'placeholder' },
            { data: 'number', name: 'number' },
            { data: 'client_name', name: 'client.name' },
            { data: 'invoice_date', name: 'created_at' },
            { data: 'status', name: 'status' },
            { data: 'order_total', name: 'order_total' },
            { data: 'total_price', name: 'total_price' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ],
        orderCellsTop: true,
        order: [[ 3, 'desc' ]],
        pageLength: 100,
    };
    
    let table = $('.datatable-Invoice').DataTable(dtOverrideGlobals);
    
    $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});
</script>
@endsection
