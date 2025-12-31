@extends('layouts.admin')
@section('content')
@can('accessory_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.accessories.create') }}">
                {{ trans('global.add') }} Accessory
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Accessory {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-Accessory">
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Base Price</th>
                        <th>Published</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accessories as $key => $accessory)
                        <tr data-entry-id="{{ $accessory->id }}">
                            <td></td>
                            <td>{{ $accessory->id ?? '' }}</td>
                            <td>{{ $accessory->accessoryType->name ?? '' }}</td>
                            <td>{{ $accessory->name ?? '' }}</td>
                            <td>{{ $accessory->sku ?? '' }}</td>
                            <td>{{ $accessory->base_price ? '$' . number_format($accessory->base_price, 2) : '-' }}</td>
                            <td>
                                <input type="checkbox" disabled {{ $accessory->published ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('accessory_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.accessories.show', $accessory->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('accessory_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.accessories.edit', $accessory->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('accessory_delete')
                                    <form action="{{ route('admin.accessories.destroy', $accessory->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@endsection
@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        @can('accessory_delete')
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.accessories.massDestroy') }}",
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
            order: [[ 1, 'asc' ]],
            pageLength: 100,
        });
        let table = $('.datatable-Accessory:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    })
</script>
@endsection
