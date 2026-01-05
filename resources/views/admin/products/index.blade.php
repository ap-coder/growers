@extends('layouts.admin')
@section('content')

@can('product_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.products.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.product.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Product', 'route' => 'admin.products.parseCsvImport'])
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.product.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-Product w-100">
            <thead>
                <tr>
                    <th width="10"></th>
                    @foreach($columns as $column)
                        <th>{{ ucfirst(str_replace('_', ' ', $column)) }}</th>
                    @endforeach
                    <th>&nbsp;</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection

@section('scripts')
@parent

<style>
    div.dt-button-collection, .dataTables_wrapper div.dt-button-collection, .dataTables_wrapper[class*="dt-"] div.dt-button-collection, .dt-buttons div.dt-button-collection, .datatable-Product div.dt-button-collection {width: auto !important;min-width: 400px !important;max-width: 600px !important;display: flex !important;flex-wrap: wrap !important;gap: 6px !important;padding: 10px !important;background: #fff !important;border: 1px solid #dee2e6 !important;box-shadow: 0 2px 8px rgba(0,0,0,.15) !important;z-index: 9999 !important;}
    div.dt-button-collection a.dt-button, .dataTables_wrapper[class*="dt-"] div.dt-button-collection a.dt-button, .dt-buttons div.dt-button-collection a.dt-button, .datatable-Product div.dt-button-collection a.dt-button {flex: 0 0 calc(33% - 6px);background: #f8f9fa !important;border: 1px solid #ccc !important;color: #212529 !important;text-align: left !important;border-radius: 4px !important;padding: 6px 8px !important;white-space: nowrap !important;transition: background 0.15s ease-in-out;}
    div.dt-button-collection a.dt-button:hover, .dataTables_wrapper[class*="dt-"] div.dt-button-collection a.dt-button:hover {background: #e9ecef !important;}
    div.dt-button-background, .dataTables_wrapper[class*="dt-"] div.dt-button-background {background: transparent !important;opacity: 1 !important;}
</style>

<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);
        
        // Add colvis button that excludes actions column
        dtButtons.push({
            extend: 'colvis',
            text: '<i class="fas fa-columns"></i> Columns',
            columns: ':not(.no-colvis):not(:first-child)' // Exclude placeholder and actions
        });

        @can('product_delete')
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.products.massDestroy') }}",
            className: 'btn-danger',
            action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
                    return entry.id
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
                        data: { ids: ids, _method: 'DELETE' }
                    }).done(function () { location.reload() })
                }
            }
        }
        dtButtons.push(deleteButton)
        @endcan

        let dtOverrideGlobals = {
            buttons: dtButtons,
            processing: true,
            serverSide: true,
            retrieve: true,
            stateSave: true,
            ajax: "{{ route('admin.products.index') }}",
            columns: [
                { data: 'placeholder', name: 'placeholder', visible: false },
                @foreach($columns as $column)
                {
                    data: "{{ $column }}",
                    name: "{{ $column === 'category' ? 'categories.name' : ($column === 'clients' ? 'clients.name' : $column) }}",
                    visible: {{ in_array($column, $defaultVisible) ? 'true' : 'false' }},
                    @if($column === 'photo')
                    sortable: false,
                    searchable: false,
                    @endif
                    render: function (data, type, row) {
                        if ("{{ $column }}" === "name" && data) {
                            let url = "{{ url('admin/products') }}/" + row.id + "/edit";
                            return '<a href="' + url + '" class="fw-semibold text-primary">' + data + '</a>';
                        }
                        if ("{{ $column }}" === "published") {
                            return '<input type="checkbox" disabled ' + (data ? 'checked' : '') + '>';
                        }
                        if ("{{ $column }}" === "product_type" && data) {
                            let types = {
                                'standard': 'Standard',
                                'accessory': 'Accessory',
                                'set': 'Set/Bundle'
                            };
                            return types[data] || data;
                        }
                        return data ?? '';
                    }
                },
                @endforeach
                { data: 'actions', name: 'actions', orderable: false, searchable: false, className: 'no-colvis', title: 'Actions' }
            ],
            orderCellsTop: true,
            order: [[2, 'asc']], // Order by name
            pageLength: 100,
            dom: 'Bfrtip'
        };

        let table = $('.datatable-Product').DataTable(dtOverrideGlobals);

        // Sort Columns dropdown alphabetically when it opens
        table.on('buttons-open', function (e, buttonApi, node, config) {
            if (config.extend === 'colvis') {
                setTimeout(function () {
                    let $collection = $('div.dt-button-collection');
                    let $buttons = $collection.find('a.dt-button');

                    let sorted = $buttons.sort(function (a, b) {
                        return $(a).text().toLowerCase().localeCompare($(b).text().toLowerCase());
                    });

                    $collection.append(sorted);
                }, 5);
            }
        });

        // Re-adjust on tab change
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function() {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    });
</script>
@endsection