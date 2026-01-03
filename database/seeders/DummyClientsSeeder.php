<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\ClientAddress;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DummyClientsSeeder extends Seeder
{
    // Demo versions of real clients - same names, full data, is_fake=true
    private array $demoClients = [
        [
            'name' => 'Harmons',
            'store_number' => 'HRM-001',
            'requires_upc' => true,
        ],
        [
            'name' => 'Albertsons',
            'store_number' => 'ALB-001',
            'requires_upc' => true,
        ],
        [
            'name' => 'Walgreens',
            'store_number' => 'WAL-001',
            'requires_upc' => true,
        ],
    ];

    public function run(): void
    {
        $this->command->info('Creating dummy clients...');
        $faker = Faker::create();
        
        foreach ($this->demoClients as $clientData) {
            // Create demo client with full data
            $client = Client::create([
                'name' => $clientData['name'],
                'store_number' => $clientData['store_number'],
                'contact_name' => $faker->name(),
                'contact_phone' => $faker->phoneNumber(),
                'contact_email' => $faker->companyEmail(),
                'requires_upc' => $clientData['requires_upc'],
                'published' => true,
                'is_fake' => true,
            ]);
            
            // Create corporate address (primary)
            ClientAddress::factory()
                ->corporate()
                ->primary()
                ->create(['client_id' => $client->id]);
            
            // Create 1-2 shipping addresses
            $shippingCount = rand(1, 2);
            $shippingAddresses = ClientAddress::factory()
                ->shipping()
                ->count($shippingCount)
                ->create(['client_id' => $client->id]);
            
            // Set first shipping as primary
            if ($shippingAddresses->count() > 0) {
                $shippingAddresses->first()->update(['is_primary' => true]);
            }
            
            // Create billing address (primary)
            ClientAddress::factory()
                ->billing()
                ->primary()
                ->create(['client_id' => $client->id]);
        }
        
        $this->command->info('  Created ' . count($this->demoClients) . ' demo clients with addresses');
        $this->command->info('Dummy clients created successfully!');
    }

    /**
     * Remove all dummy clients based on is_fake flag
     */
    public static function removeDummyClients(): array
    {
        $counts = [
            'clients' => 0,
            'addresses' => 0,
        ];
        
        $fakeClients = Client::where('is_fake', true)->get();
        
        foreach ($fakeClients as $client) {
            // Count addresses before deleting
            $counts['addresses'] += $client->addresses()->count();
            
            // Delete related addresses
            $client->addresses()->delete();
            // Delete client prices
            $client->clientPrices()->delete();
            // Detach products
            $client->products()->detach();
            // Delete client
            $client->forceDelete();
            $counts['clients']++;
        }
        
        return $counts;
    }
}
