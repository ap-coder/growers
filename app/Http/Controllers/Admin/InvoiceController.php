<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Order::with(['client', 'team'])->select(sprintf('%s.*', (new Order)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'order_show';
                $editGate      = 'order_edit';
                $deleteGate    = 'order_delete';
                $crudRoutePart = 'orders';
                $showInvoice   = true;

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row',
                    'showInvoice'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('client_name', function ($row) {
                return $row->client ? $row->client->name : '';
            });

            $table->editColumn('number', function ($row) {
                return $row->number ? $row->number : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Order::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('order_total', function ($row) {
                return $row->order_total ? '$' . number_format($row->order_total, 2) : '';
            });
            $table->editColumn('total_price', function ($row) {
                return $row->total_price ? '$' . number_format($row->total_price, 2) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'client']);

            return $table->make(true);
        }

        return view('admin.invoices.index');
    }

    public function show(Order $invoice)
    {
        abort_if(Gate::denies('order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoice->load('client', 'team', 'orderItems.product');

        return view('admin.invoices.show', compact('invoice'));
    }
}
