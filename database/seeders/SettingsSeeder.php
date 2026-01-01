<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Branding
            [
                'key' => 'company_name',
                'value' => 'Pacific Plant Growers',
                'type' => 'text',
                'group' => 'branding',
                'label' => 'Company Name',
                'description' => 'Company name displayed throughout the site',
            ],
            [
                'key' => 'company_logo',
                'value' => null,
                'type' => 'image',
                'group' => 'branding',
                'label' => 'Company Logo',
                'description' => 'Main company logo for header and documents',
            ],
            [
                'key' => 'company_logo_dark',
                'value' => null,
                'type' => 'image',
                'group' => 'branding',
                'label' => 'Company Logo (Dark)',
                'description' => 'Dark version of logo for light backgrounds',
            ],
            [
                'key' => 'favicon',
                'value' => null,
                'type' => 'image',
                'group' => 'branding',
                'label' => 'Favicon',
                'description' => 'Browser tab icon (recommended: 32x32 PNG)',
            ],

            // Contact Info
            [
                'key' => 'company_address',
                'value' => null,
                'type' => 'textarea',
                'group' => 'contact',
                'label' => 'Company Address',
                'description' => 'Full company address for invoices and documents',
            ],
            [
                'key' => 'company_phone',
                'value' => null,
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Company Phone',
                'description' => 'Main contact phone number',
            ],
            [
                'key' => 'company_email',
                'value' => null,
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Company Email',
                'description' => 'Main contact email address',
            ],
            [
                'key' => 'company_website',
                'value' => 'pacificplantgrowers.com',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Company Website',
                'description' => 'Company website URL',
            ],

            // Login Page
            [
                'key' => 'login_background_image',
                'value' => null,
                'type' => 'image',
                'group' => 'login',
                'label' => 'Login Background Image',
                'description' => 'Background image for the login page',
            ],
            [
                'key' => 'login_welcome_text',
                'value' => 'Welcome Back',
                'type' => 'text',
                'group' => 'login',
                'label' => 'Login Welcome Text',
                'description' => 'Welcome heading on login page',
            ],
            [
                'key' => 'login_description',
                'value' => 'Sign back in to your account to access your orders and manage your wholesale plant purchases.',
                'type' => 'textarea',
                'group' => 'login',
                'label' => 'Login Description',
                'description' => 'Description text on login page',
            ],

            // General
            [
                'key' => 'order_number_prefix',
                'value' => 'PPG-',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Order Number Prefix',
                'description' => 'Prefix for order numbers (e.g., PPG-1001)',
            ],
            [
                'key' => 'order_number_start',
                'value' => '1001',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Order Number Start',
                'description' => 'Starting number for orders',
            ],
            [
                'key' => 'default_delivery_days',
                'value' => '3',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Default Delivery Days',
                'description' => 'Default number of days for delivery from order date',
            ],
            [
                'key' => 'enable_customer_registration',
                'value' => '0',
                'type' => 'boolean',
                'group' => 'general',
                'label' => 'Enable Customer Registration',
                'description' => 'Allow new customers to register (or admin-only)',
            ],
            [
                'key' => 'require_approval_for_orders',
                'value' => '0',
                'type' => 'boolean',
                'group' => 'general',
                'label' => 'Require Order Approval',
                'description' => 'Orders require admin approval before processing',
            ],

            // Order Documents
            [
                'key' => 'packing_slip_footer',
                'value' => 'Thank you for your order!',
                'type' => 'textarea',
                'group' => 'general',
                'label' => 'Packing Slip Footer',
                'description' => 'Footer text on packing slips',
            ],
            [
                'key' => 'order_ticket_footer',
                'value' => null,
                'type' => 'textarea',
                'group' => 'general',
                'label' => 'Order Ticket Footer',
                'description' => 'Footer text on order tickets',
            ],

            // Shop Settings
            [
                'key' => 'shop_layout',
                'value' => 'standard',
                'type' => 'select',
                'group' => 'shop',
                'label' => 'Shop Layout',
                'description' => 'Default layout for shop/product listing pages',
            ],
            [
                'key' => 'default_product_layout',
                'value' => 'default',
                'type' => 'select',
                'group' => 'shop',
                'label' => 'Default Product Layout',
                'description' => 'Default layout for product detail pages',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
