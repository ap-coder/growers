<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Client;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'client_id' => ['nullable', 'exists:clients,id'],
            'new_client_name' => ['nullable', 'string', 'max:255'],
        ];

        // If creating new client, require the name
        if (!empty($data['create_new_client']) && $data['create_new_client'] == '1') {
            $rules['new_client_name'] = ['required', 'string', 'max:255', 'unique:clients,name'];
        }

        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $clientId = null;

        // Handle client - either select existing or create new
        if (!empty($data['create_new_client']) && $data['create_new_client'] == '1' && !empty($data['new_client_name'])) {
            // Create new client
            $client = Client::create([
                'name' => $data['new_client_name'],
                'published' => false, // Needs admin approval
            ]);
            $clientId = $client->id;
        } elseif (!empty($data['client_id'])) {
            $clientId = $data['client_id'];
        }

        $user = User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
            'client_id' => $clientId,
            'team_id'   => request()->input('team', null),
        ]);

        if (!request()->has('team')) {
            $team = \App\Models\Team::create([
                'owner_id' => $user->id,
                'name'     => $data['email'],
            ]);

            $user->update(['team_id' => $team->id]);
        }

        return $user;
    }

    public function showRegistrationForm()
    {
        if (request()->has('signature') && ! request()->hasValidSignature()) {
            return redirect()->route('register');
        }

        $clients = Client::where('published', true)->orderBy('name')->pluck('name', 'id');

        return view('auth.register', compact('clients'));
    }
}
