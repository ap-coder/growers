# Pacific Plant Growers - Development Status

## Last Updated: December 31, 2024 (End of Day)

## Overview
Wholesale plant seller admin application. Clients are retail grocery stores and flower shops (Harmon's, Smith's, Associated, Flower Shops).

## Recent Changes (Dec 31, 2024)

### Accessory System (Complete)
- Created `accessory_types` table - categories like "Basket", "Card Holder"
- Created `accessories` table - individual items with base pricing
- Created `product_accessory` pivot table with `is_default` and `is_required` flags
- Created `accessory_client_prices` table for client-specific pricing
- Models: `AccessoryType`, `Accessory`, `AccessoryClientPrice`
- Admin CRUD for Accessory Types and Accessories
- Accessories tab in Product edit form
- Permissions seeded and assigned to Admin role

### ContentPage Updates
- Added `client_id` field - allows per-client custom pages (e.g., "How to Order with Us" for Smith's)
- Added `slug` field for URL-friendly paths
- Added `page_type` field: general, how_to_order, allocation_schedule, delivery_info
- Admin forms updated to support these fields

### User Model Updates
- Added `client_id` field - links users to clients for frontend access
- Added `phone` field
- Admin forms updated to assign users to clients

### Client Model Updates
- Added `store_number` field
- Added `contact_name`, `contact_phone`, `contact_email` fields
- Added `address` field
- Added `delivery_notes` field
- Added `requires_upc` boolean flag
- Admin forms updated with all new fields

### Order Model Updates
- Added `delivery_date` field - requested delivery date
- Added `special_request` field - customer notes
- Added `delivery_details` field
- Added `ordered_by_name` and `ordered_by_phone` fields
- Admin forms updated with all new fields

### Settings System (Enhanced)
- Added `type`, `group`, `label`, `description` fields to settings table
- Types: text, textarea, image, boolean, select
- Groups: general, login, branding, contact
- Helper methods: `Setting::get($key)`, `Setting::set($key, $value, ...)`
- Admin forms updated with dynamic value inputs based on type
- Image upload support for settings

### Client Settings
- Added `logo` field to clients table
- Logo upload support in Client admin forms
- Logos stored in `storage/app/public/clients/`

### Role/Auth Updates
- Renamed "User" role to "Customer" in seeder
- `RedirectIfAuthenticated` middleware routes admins to `/admin`, customers to `/home`
- `LoginController` already had correct redirect logic

### Bug Fixes
- Added `product_id` to `ClientPrice` model fillable
- Added `orderItems()` relationship to `Order` model
- Simplified frontend routes (removed references to non-existent controllers)

## Pending Tasks

### High Priority
1. **Product purchase sets option** - Add field for set quantities (2, 4, 6 sets)
2. **Packing slip generation** - PDF for customer (no prices)
3. **Order ticket generation** - PDF for fulfillment (includes UPC codes where applicable)

### Medium Priority
4. **Frontend site integration** - In progress
   - Base layout created at `resources/views/site/layouts/app.blade.php`
   - Account views scaffolded (dashboard, profile, orders, order-details)
   - Assets copied from `xhtml/` to `public/site/` (css, js, images, vendor)
   - Login page integrated with template styling ✓
   - Registration page needs template integration
   - Full frontend product browsing/ordering flow still pending

### Low Priority
5. **Seasonal categories/tags** - Valentines, Spring, Mother's Day, etc.

## Database Migrations Run
- `2024_12_31_000001_create_accessory_types_table`
- `2024_12_31_000002_create_accessories_table`
- `2024_12_31_000003_create_product_accessory_table`
- `2024_12_31_000004_create_accessory_client_prices_table`
- `2024_12_31_000005_add_client_id_to_content_pages_table`
- `2024_12_31_000006_add_client_id_to_users_table`
- `2024_12_31_000007_add_fields_to_clients_table`
- `2024_12_31_000008_add_fields_to_orders_table`

## Key Business Rules (from guidelines/)
- No pricing visible to public - must be logged in
- No credit card/merchant gateway - invoices produced upon order placement
- Packing slip for customer: items/quantities, delivery details, special notes (NO prices)
- Order ticket for fulfillment: store info, contact, delivery date, items by category, UPC codes (where applicable)
- Different clients have different requirements (UPC codes, special request buttons, etc.)

## File Structure Notes
- Admin views: `resources/views/admin/`
- Frontend views (not integrated): `resources/views/site/`
- xhtml template source: `xhtml/`
- Guidelines/requirements: `guidelines/`
