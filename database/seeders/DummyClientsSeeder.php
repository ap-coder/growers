<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\ClientAddress;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DummyClientsSeeder extends Seeder
{
    public function run(): void
    {
        $clients = [
            [
                'name' => 'Harmon\'s Grocery',
                'store_number' => 'HRM-001',
                'contact_name' => 'Sarah Johnson',
                'contact_phone' => '(801) 555-1234',
                'contact_email' => 'sarah.johnson@harmonsgrocery.com',
                'requires_upc' => true,
                'published' => true,
                'addresses' => [
                    [
                        'address_type' => 'corporate',
                        'label' => 'Corporate Office',
                        'is_primary' => true,
                        'address_line_1' => '3270 South 1300 East',
                        'address_line_2' => 'Suite 200',
                        'city' => 'Salt Lake City',
                        'state' => 'UT',
                        'postal_code' => '84106',
                        'contact_name' => 'Corporate Receiving',
                        'contact_phone' => '(801) 555-1234',
                    ],
                    [
                        'address_type' => 'shipping',
                        'label' => 'Store #1 - Downtown',
                        'is_primary' => true,
                        'address_line_1' => '135 East 100 South',
                        'city' => 'Salt Lake City',
                        'state' => 'UT',
                        'postal_code' => '84111',
                        'contact_name' => 'Floral Dept',
                        'contact_phone' => '(801) 555-1235',
                        'delivery_notes' => 'Deliver to back entrance. Ring bell for floral department.',
                    ],
                    [
                        'address_type' => 'shipping',
                        'label' => 'Store #2 - Sugarhouse',
                        'is_primary' => false,
                        'address_line_1' => '2100 South 900 East',
                        'city' => 'Salt Lake City',
                        'state' => 'UT',
                        'postal_code' => '84106',
                        'contact_name' => 'Floral Dept',
                        'contact_phone' => '(801) 555-1236',
                        'delivery_notes' => 'Use loading dock on south side.',
                    ],
                    [
                        'address_type' => 'billing',
                        'label' => 'Accounts Payable',
                        'is_primary' => true,
                        'address_line_1' => '3270 South 1300 East',
                        'address_line_2' => 'Suite 200, AP Dept',
                        'city' => 'Salt Lake City',
                        'state' => 'UT',
                        'postal_code' => '84106',
                        'contact_email' => 'ap@harmonsgrocery.com',
                    ],
                ],
            ],
            [
                'name' => 'Smith\'s Food & Drug',
                'store_number' => 'SMT-001',
                'contact_name' => 'Mike Williams',
                'contact_phone' => '(801) 555-2345',
                'contact_email' => 'mike.williams@smiths.com',
                'requires_upc' => true,
                'published' => true,
                'addresses' => [
                    [
                        'address_type' => 'corporate',
                        'label' => 'Regional Office',
                        'is_primary' => true,
                        'address_line_1' => '1550 South Redwood Road',
                        'city' => 'Salt Lake City',
                        'state' => 'UT',
                        'postal_code' => '84104',
                        'contact_name' => 'Regional Manager',
                        'contact_phone' => '(801) 555-2345',
                    ],
                    [
                        'address_type' => 'shipping',
                        'label' => 'Distribution Center',
                        'is_primary' => true,
                        'address_line_1' => '4500 West 5400 South',
                        'city' => 'West Valley City',
                        'state' => 'UT',
                        'postal_code' => '84118',
                        'contact_name' => 'Receiving Dock',
                        'contact_phone' => '(801) 555-2346',
                        'delivery_notes' => 'Check in at guard station. Dock appointments required.',
                        'special_instructions' => 'All deliveries must have PO number visible.',
                    ],
                ],
            ],
            [
                'name' => 'Mountain View Florist',
                'store_number' => 'MVF-001',
                'contact_name' => 'Emily Chen',
                'contact_phone' => '(801) 555-3456',
                'contact_email' => 'emily@mountainviewflorist.com',
                'requires_upc' => false,
                'published' => true,
                'addresses' => [
                    [
                        'address_type' => 'shipping',
                        'label' => 'Main Shop',
                        'is_primary' => true,
                        'address_line_1' => '456 Main Street',
                        'city' => 'Park City',
                        'state' => 'UT',
                        'postal_code' => '84060',
                        'contact_name' => 'Emily Chen',
                        'contact_phone' => '(801) 555-3456',
                        'delivery_notes' => 'Small shop - call 30 min before delivery.',
                    ],
                    [
                        'address_type' => 'billing',
                        'label' => 'Same as Shop',
                        'is_primary' => true,
                        'address_line_1' => '456 Main Street',
                        'city' => 'Park City',
                        'state' => 'UT',
                        'postal_code' => '84060',
                    ],
                ],
            ],
            [
                'name' => 'Valley Garden Center',
                'store_number' => 'VGC-001',
                'contact_name' => 'Robert Martinez',
                'contact_phone' => '(801) 555-4567',
                'contact_email' => 'robert@valleygarden.com',
                'requires_upc' => false,
                'published' => true,
                'addresses' => [
                    [
                        'address_type' => 'corporate',
                        'label' => 'Main Location',
                        'is_primary' => true,
                        'address_line_1' => '7890 South State Street',
                        'city' => 'Midvale',
                        'state' => 'UT',
                        'postal_code' => '84047',
                        'contact_name' => 'Robert Martinez',
                        'contact_phone' => '(801) 555-4567',
                    ],
                    [
                        'address_type' => 'shipping',
                        'label' => 'Greenhouse',
                        'is_primary' => true,
                        'address_line_1' => '7890 South State Street',
                        'address_line_2' => 'Greenhouse Entrance',
                        'city' => 'Midvale',
                        'state' => 'UT',
                        'postal_code' => '84047',
                        'delivery_notes' => 'Drive around back to greenhouse. Open 6am-6pm.',
                    ],
                ],
            ],
            [
                'name' => 'Associated Food Stores',
                'store_number' => 'AFS-001',
                'contact_name' => 'Jennifer Brown',
                'contact_phone' => '(801) 555-5678',
                'contact_email' => 'jennifer.brown@afstores.com',
                'requires_upc' => true,
                'published' => true,
                'addresses' => [
                    [
                        'address_type' => 'corporate',
                        'label' => 'Headquarters',
                        'is_primary' => true,
                        'address_line_1' => '1850 West 2100 South',
                        'city' => 'Salt Lake City',
                        'state' => 'UT',
                        'postal_code' => '84119',
                        'contact_name' => 'Purchasing Dept',
                        'contact_phone' => '(801) 555-5678',
                    ],
                    [
                        'address_type' => 'shipping',
                        'label' => 'Distribution Warehouse',
                        'is_primary' => true,
                        'address_line_1' => '1900 West 2100 South',
                        'city' => 'Salt Lake City',
                        'state' => 'UT',
                        'postal_code' => '84119',
                        'contact_name' => 'Warehouse Receiving',
                        'contact_phone' => '(801) 555-5679',
                        'delivery_notes' => 'Dock #3 for floral deliveries. Hours: 5am-2pm.',
                        'special_instructions' => 'Must have appointment. Call day before.',
                    ],
                    [
                        'address_type' => 'billing',
                        'label' => 'Accounts Payable',
                        'is_primary' => true,
                        'address_line_1' => '1850 West 2100 South',
                        'city' => 'Salt Lake City',
                        'state' => 'UT',
                        'postal_code' => '84119',
                        'contact_email' => 'payables@afstores.com',
                    ],
                ],
            ],
        ];

        foreach ($clients as $clientData) {
            $addresses = $clientData['addresses'] ?? [];
            unset($clientData['addresses']);

            $client = Client::create($clientData);

            foreach ($addresses as $addressData) {
                $addressData['client_id'] = $client->id;
                ClientAddress::create($addressData);
            }
        }

        $this->command->info('Dummy clients created successfully!');
        $this->command->info('Created: ' . count($clients) . ' clients with addresses');
    }

    /**
     * Remove all dummy clients (those with store_number starting with test prefixes)
     */
    public static function removeDummyClients(): int
    {
        $storeNumberPrefixes = ['HRM-', 'SMT-', 'MVF-', 'VGC-', 'AFS-'];
        
        $count = 0;
        foreach ($storeNumberPrefixes as $prefix) {
            $clients = Client::where('store_number', 'like', $prefix . '%')->get();
            foreach ($clients as $client) {
                // Delete related addresses
                $client->addresses()->delete();
                // Delete client prices
                $client->clientPrices()->delete();
                // Detach products
                $client->products()->detach();
                // Delete client
                $client->forceDelete();
                $count++;
            }
        }
        
        return $count;
    }
}
