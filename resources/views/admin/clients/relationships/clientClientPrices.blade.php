<div class="m-3">
    @can('client_price_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.client-prices.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.clientPrice.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.clientPrice.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-clientClientPrices">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.clientPrice.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.clientPrice.fields.published') }}
                            </th>
                            <th>
                                {{ trans('cruds.clientPrice.fields.price') }}
                            </th>
                            <th>
                                {{ trans('cruds.clientPrice.fields.sku') }}
                            </th>
                            <th>
                                {{ trans('cruds.clientPrice.fields.qb_1') }}
                            </th>
                            <th>
                                {{ trans('cruds.clientPrice.fields.qb_2') }}
                            </th>
                            <th>
                                {{ trans('cruds.clientPrice.fields.client') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientPrices as $key => $clientPrice)
                            <tr data-entry-id="{{ $clientPrice->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $clientPrice->id ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $clientPrice->published ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $clientPrice->published ? 'checked' : '' }}>
                                </td>
                                <td>
                                    {{ $clientPrice->price ?? '' }}
                                </td>
                                <td>
                                    {{ $clientPrice->sku ?? '' }}
                                </td>
                                <td>
                                    {{ $clientPrice->qb_1 ?? '' }}
                                </td>
                                <td>
                                    {{ $clientPrice->qb_2 ?? '' }}
                                </td>
                                <td>
                                    {{ $clientPrice->client->name ?? '' }}
                                </td>
                                <td>
                                    @can('client_price_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.client-prices.show', $clientPrice->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('client_price_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.client-prices.edit', $clientPrice->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('client_price_delete')
                                        <form action="{{ route('admin.client-prices.destroy', $clientPrice->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('client_price_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.client-prices.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-clientClientPrices:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection