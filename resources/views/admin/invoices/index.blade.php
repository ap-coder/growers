@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Invoices List
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Invoice">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.order.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.client') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.number') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.order_total') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.total_price') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
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
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.invoices.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'client_name', name: 'client.name' },
{ data: 'number', name: 'number' },
{ data: 'status', name: 'status' },
{ data: 'order_total', name: 'order_total' },
{ data: 'total_price', name: 'total_price' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
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
