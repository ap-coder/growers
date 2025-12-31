@extends('layouts.admin')
@section('content')
@can('accessory_type_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.accessory-types.create') }}">
                {{ trans('global.add') }} Accessory Type
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Accessory Type {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-AccessoryType">
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Published</th>
                        <th>Sort Order</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accessoryTypes as $key => $accessoryType)
                        <tr data-entry-id="{{ $accessoryType->id }}">
                            <td></td>
                            <td>{{ $accessoryType->id ?? '' }}</td>
                            <td>{{ $accessoryType->name ?? '' }}</td>
                            <td>{{ Str::limit($accessoryType->description, 50) ?? '' }}</td>
                            <td>
                                <input type="checkbox" disabled {{ $accessoryType->published ? 'checked' : '' }}>
                            </td>
                            <td>{{ $accessoryType->sort_order ?? '' }}</td>
                            <td>
                                @can('accessory_type_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.accessory-types.show', $accessoryType->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('accessory_type_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.accessory-types.edit', $accessoryType->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('accessory_type_delete')
                                    <form action="{{ route('admin.accessory-types.destroy', $accessoryType->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
        @can('accessory_type_delete')
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.accessory-types.massDestroy') }}",
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
        let table = $('.datatable-AccessoryType:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    })
</script>
@endsection
