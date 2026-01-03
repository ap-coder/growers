<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('settings')->delete();
        
        \DB::table('settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'key' => 'company_name',
                'value' => 'Pacific Plant Growers',
                'type' => 'text',
                'group' => 'branding',
                'label' => 'Company Name',
                'description' => 'Company name displayed throughout the site',
                'created_at' => '2026-01-01 23:46:02',
                'updated_at' => '2026-01-01 23:46:02',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'key' => 'company_logo',
                'value' => NULL,
                'type' => 'image',
                'group' => 'branding',
                'label' => 'Company Logo',
                'description' => 'Main company logo for header and documents',
                'created_at' => '2026-01-01 23:46:02',
                'updated_at' => '2026-01-01 23:46:02',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'key' => 'company_logo_dark',
                'value' => NULL,
                'type' => 'image',
                'group' => 'branding',
            'label' => 'Company Logo (Dark)',
                'description' => 'Dark version of logo for light backgrounds',
                'created_at' => '2026-01-01 23:46:02',
                'updated_at' => '2026-01-01 23:46:02',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'key' => 'favicon',
                'value' => 'settings/1u0WvOEHrnlLindBFg4GzSXr8Wq17iRCxh8pT2Y7.png',
                'type' => 'image',
                'group' => 'branding',
                'label' => 'Favicon',
            'description' => 'Browser tab icon (recommended: 32x32 PNG)',
                'created_at' => '2026-01-01 23:46:02',
                'updated_at' => '2026-01-01 23:56:40',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'key' => 'company_address',
                'value' => '1697 W 2100 N. Lehi, UT 84043',
                'type' => 'textarea',
                'group' => 'contact',
                'label' => 'Company Address',
                'description' => 'Full company address for invoices and documents',
                'created_at' => '2026-01-01 23:46:02',
                'updated_at' => '2026-01-02 00:14:01',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'key' => 'company_phone',
                'value' => '801-768-2809',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Company Phone',
                'description' => 'Main contact phone number',
                'created_at' => '2026-01-01 23:46:02',
                'updated_at' => '2026-01-02 00:14:54',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'key' => 'company_email',
                'value' => 'orders@pacificplantgrowers.com',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Company Email',
                'description' => 'Main contact email address',
                'created_at' => '2026-01-01 23:46:02',
                'updated_at' => '2026-01-02 00:14:37',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'key' => 'company_website',
                'value' => 'pacificplantgrowers.com',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Company Website',
                'description' => 'Company website URL',
                'created_at' => '2026-01-01 23:46:02',
                'updated_at' => '2026-01-01 23:46:02',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'key' => 'login_background_image',
                'value' => NULL,
                'type' => 'image',
                'group' => 'login',
                'label' => 'Login Background Image',
                'description' => 'Background image for the login page',
                'created_at' => '2026-01-01 23:46:02',
                'updated_at' => '2026-01-01 23:46:02',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'key' => 'login_welcome_text',
                'value' => 'Welcome Back',
                'type' => 'text',
                'group' => 'login',
                'label' => 'Login Welcome Text',
                'description' => 'Welcome heading on login page',
                'created_at' => '2026-01-01 23:46:02',
                'updated_at' => '2026-01-01 23:46:02',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'key' => 'login_description',
                'value' => 'Sign back in to your account to access your orders and manage your wholesale plant purchases.',
                'type' => 'textarea',
                'group' => 'login',
                'label' => 'Login Description',
                'description' => 'Description text on login page',
                'created_at' => '2026-01-01 23:46:02',
                'updated_at' => '2026-01-01 23:46:02',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'key' => 'order_number_prefix',
                'value' => 'PPG-',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Order Number Prefix',
            'description' => 'Prefix for order numbers (e.g., PPG-1001)',
                'created_at' => '2026-01-01 23:46:02',
                'updated_at' => '2026-01-01 23:46:02',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'key' => 'order_number_start',
                'value' => '1001',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Order Number Start',
                'description' => 'Starting number for orders',
                'created_at' => '2026-01-01 23:46:02',
                'updated_at' => '2026-01-01 23:46:02',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'key' => 'default_delivery_days',
                'value' => '3',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Default Delivery Days',
                'description' => 'Default number of days for delivery from order date',
                'created_at' => '2026-01-01 23:46:02',
                'updated_at' => '2026-01-01 23:46:02',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'key' => 'enable_customer_registration',
                'value' => '0',
                'type' => 'boolean',
                'group' => 'general',
                'label' => 'Enable Customer Registration',
            'description' => 'Allow new customers to register (or admin-only)',
                'created_at' => '2026-01-01 23:46:02',
                'updated_at' => '2026-01-01 23:46:02',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'key' => 'require_approval_for_orders',
                'value' => '0',
                'type' => 'boolean',
                'group' => 'general',
                'label' => 'Require Order Approval',
                'description' => 'Orders require admin approval before processing',
                'created_at' => '2026-01-01 23:46:02',
                'updated_at' => '2026-01-01 23:46:02',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'key' => 'packing_slip_footer',
                'value' => 'Thank you for your order!',
                'type' => 'textarea',
                'group' => 'general',
                'label' => 'Packing Slip Footer',
                'description' => 'Footer text on packing slips',
                'created_at' => '2026-01-01 23:46:02',
                'updated_at' => '2026-01-01 23:46:02',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'key' => 'order_ticket_footer',
                'value' => NULL,
                'type' => 'textarea',
                'group' => 'general',
                'label' => 'Order Ticket Footer',
                'description' => 'Footer text on order tickets',
                'created_at' => '2026-01-01 23:46:02',
                'updated_at' => '2026-01-01 23:46:02',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'key' => 'shop_layout',
                'value' => 'list',
                'type' => 'select',
                'group' => 'shop',
                'label' => 'Shop Layout',
                'description' => 'Default layout for shop/product listing pages',
                'created_at' => '2026-01-01 23:46:02',
                'updated_at' => '2026-01-02 00:15:37',
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'key' => 'default_product_layout',
                'value' => 'default',
                'type' => 'select',
                'group' => 'shop',
                'label' => 'Default Product Layout',
                'description' => 'Default layout for product detail pages',
                'created_at' => '2026-01-01 23:46:02',
                'updated_at' => '2026-01-01 23:46:02',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}