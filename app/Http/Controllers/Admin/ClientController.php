<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyClientRequest;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Models\ClientAddress;
use App\Models\ClientPrice;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Client::with(['prices', 'team'])->select(sprintf('%s.*', (new Client)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'client_show';
                $editGate      = 'client_edit';
                $deleteGate    = 'client_delete';
                $crudRoutePart = 'clients';

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
            $table->editColumn('published', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->published ? 'checked' : null) . '>';
            });
            $table->editColumn('name', function ($row) {
                $name = $row->name ? $row->name : '';
                $url = route('admin.clients.edit', $row->id);
                return $name ? '<a href="' . $url . '">' . $name . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'name', 'published']);

            return $table->make(true);
        }

        return view('admin.clients.index');
    }

    public function create()
    {
        abort_if(Gate::denies('client_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prices = ClientPrice::pluck('price', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.clients.create', compact('prices'));
    }

    public function store(StoreClientRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('clients', 'public');
            $data['logo'] = $path;
        }

        $client = Client::create($data);

        // Handle addresses
        if ($request->has('addresses')) {
            $this->syncAddresses($client, $request->input('addresses'));
        }

        return redirect()->route('admin.clients.index');
    }

    public function storeAjax(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:clients,name',
        ]);

        $client = Client::create($validatedData);

        return response()->json(['id' => $client->id, 'name' => $client->name]);
    }

    public function edit(Client $client)
    {
        abort_if(Gate::denies('client_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prices = ClientPrice::pluck('price', 'id')->prepend(trans('global.pleaseSelect'), '');

        $client->load('prices', 'team', 'addresses', 'users');

        // Get users not associated with any client (available to assign)
        $availableUsers = User::whereNull('client_id')
            ->orWhere('client_id', '')
            ->orderBy('name')
            ->get();

        return view('admin.clients.edit', compact('client', 'prices', 'availableUsers'));
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        $data = $request->all();

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('clients', 'public');
            $data['logo'] = $path;
        }

        $client->update($data);

        // Handle addresses
        if ($request->has('addresses')) {
            $this->syncAddresses($client, $request->input('addresses'));
        }

        return redirect()->route('admin.clients.index');
    }

    private function syncAddresses(Client $client, array $addresses)
    {
        $existingIds = [];
        
        foreach ($addresses as $addressData) {
            if (empty($addressData['address_line_1'])) {
                continue;
            }
            
            $addressData['client_id'] = $client->id;
            $addressData['is_primary'] = isset($addressData['is_primary']) ? 1 : 0;
            $addressData['is_fake'] = isset($addressData['is_fake']) ? 1 : 0;
            
            if (!empty($addressData['id'])) {
                // Update existing
                $address = ClientAddress::find($addressData['id']);
                if ($address && $address->client_id == $client->id) {
                    $address->update($addressData);
                    $existingIds[] = $address->id;
                }
            } else {
                // Create new
                $address = ClientAddress::create($addressData);
                $existingIds[] = $address->id;
            }
        }
        
        // Delete addresses not in the submitted list
        $client->addresses()->whereNotIn('id', $existingIds)->delete();
    }

    public function show(Client $client)
    {
        abort_if(Gate::denies('client_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client->load('prices', 'team', 'clientClientPrices', 'clientsProducts');

        return view('admin.clients.show', compact('client'));
    }

    public function destroy(Client $client)
    {
        abort_if(Gate::denies('client_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client->delete();

        return back();
    }

    public function massDestroy(MassDestroyClientRequest $request)
    {
        $clients = Client::find(request('ids'));

        foreach ($clients as $client) {
            $client->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function associateUser(Request $request, Client $client)
    {
        abort_if(Gate::denies('client_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::find($request->user_id);
        $user->update(['client_id' => $client->id]);

        return response()->json(['success' => true, 'message' => 'User associated successfully']);
    }

    public function createUser(Request $request, Client $client)
    {
        abort_if(Gate::denies('client_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'client_id' => $client->id,
            'verified' => true,
            'approved' => true,
        ]);

        // Assign Customer role
        $customerRole = \App\Models\Role::where('title', 'Customer')->first();
        if ($customerRole) {
            $user->roles()->sync([$customerRole->id]);
        }

        return response()->json(['success' => true, 'message' => 'User created and associated successfully']);
    }

    public function removeUser(Request $request, Client $client)
    {
        abort_if(Gate::denies('client_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::find($request->user_id);
        
        // Only remove if user belongs to this client
        if ($user->client_id == $client->id) {
            $user->update(['client_id' => null]);
        }

        return response()->json(['success' => true, 'message' => 'User removed from client']);
    }
}
