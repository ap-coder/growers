<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientAddress;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ClientAddressController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ClientAddress::with(['client'])->select(sprintf('%s.*', (new ClientAddress)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'client_show';
                $editGate      = 'client_edit';
                $deleteGate    = 'client_delete';
                $crudRoutePart = 'client-addresses';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->addColumn('client_name', function ($row) {
                return $row->client ? $row->client->name : '';
            });

            $table->editColumn('address_type', function ($row) {
                return $row->address_type ? ClientAddress::TYPE_SELECT[$row->address_type] ?? $row->address_type : '';
            });

            $table->editColumn('label', function ($row) {
                return $row->label ? $row->label : '';
            });

            $table->editColumn('nickname', function ($row) {
                return $row->nickname ? $row->nickname : '';
            });

            $table->editColumn('full_address', function ($row) {
                $address = $row->full_address ? $row->full_address : '';
                $url = route('admin.client-addresses.edit', $row->id);
                return $address ? '<a href="' . $url . '">' . $address . '</a>' : '';
            });

            $table->editColumn('is_primary', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_primary ? 'checked' : '') . '>';
            });

            $table->editColumn('is_fake', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_fake ? 'checked' : '') . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'client_name', 'full_address', 'is_primary', 'is_fake']);

            return $table->make(true);
        }

        return view('admin.client-addresses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('client_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id');
        $addressTypes = ClientAddress::TYPE_SELECT;

        return view('admin.client-addresses.create', compact('clients', 'addressTypes'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('client_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'address_type' => 'required|in:' . implode(',', array_keys(ClientAddress::TYPE_SELECT)),
            'label' => 'nullable|string|max:100',
            'nickname' => 'nullable|string|max:100',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:50',
            'postal_code' => 'required|string|max:20',
            'country' => 'nullable|string|max:50',
            'contact_name' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email|max:255',
            'delivery_notes' => 'nullable|string|max:500',
            'special_instructions' => 'nullable|string|max:500',
            'google_map_link' => 'nullable|url|max:500',
            'is_primary' => 'nullable|boolean',
            'is_fake' => 'nullable|boolean',
        ]);

        $data = $request->all();
        $data['is_primary'] = $request->boolean('is_primary');
        $data['is_fake'] = $request->boolean('is_fake');
        $data['country'] = $data['country'] ?? 'USA';

        // If setting as primary, unset other primaries of same type for this client
        if ($data['is_primary']) {
            ClientAddress::where('client_id', $data['client_id'])
                ->where('address_type', $data['address_type'])
                ->update(['is_primary' => false]);
        }

        ClientAddress::create($data);

        return redirect()->route('admin.client-addresses.index');
    }

    public function edit(ClientAddress $clientAddress)
    {
        abort_if(Gate::denies('client_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id');
        $addressTypes = ClientAddress::TYPE_SELECT;

        $clientAddress->load('client');

        return view('admin.client-addresses.edit', compact('clientAddress', 'clients', 'addressTypes'));
    }

    public function update(Request $request, ClientAddress $clientAddress)
    {
        abort_if(Gate::denies('client_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'address_type' => 'required|in:' . implode(',', array_keys(ClientAddress::TYPE_SELECT)),
            'label' => 'nullable|string|max:100',
            'nickname' => 'nullable|string|max:100',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:50',
            'postal_code' => 'required|string|max:20',
            'country' => 'nullable|string|max:50',
            'contact_name' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email|max:255',
            'delivery_notes' => 'nullable|string|max:500',
            'special_instructions' => 'nullable|string|max:500',
            'google_map_link' => 'nullable|url|max:500',
            'is_primary' => 'nullable|boolean',
            'is_fake' => 'nullable|boolean',
        ]);

        $data = $request->all();
        $data['is_primary'] = $request->boolean('is_primary');
        $data['is_fake'] = $request->boolean('is_fake');

        // If setting as primary, unset other primaries of same type for this client
        if ($data['is_primary'] && !$clientAddress->is_primary) {
            ClientAddress::where('client_id', $data['client_id'])
                ->where('address_type', $data['address_type'])
                ->where('id', '!=', $clientAddress->id)
                ->update(['is_primary' => false]);
        }

        $clientAddress->update($data);

        return redirect()->route('admin.client-addresses.index');
    }

    public function show(ClientAddress $clientAddress)
    {
        abort_if(Gate::denies('client_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientAddress->load('client');

        return view('admin.client-addresses.show', compact('clientAddress'));
    }

    public function destroy(ClientAddress $clientAddress)
    {
        abort_if(Gate::denies('client_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientAddress->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        abort_if(Gate::denies('client_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        ClientAddress::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
