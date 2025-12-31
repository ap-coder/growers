# Pacific Plant Growers - Change Log

## December 31, 2024

### Session 1 - Admin Fixes, Accessory System, and Frontend Setup

#### Bug Fixes
- **ClientPrice model** - Added `product_id` to `$fillable` array (was causing mass assignment errors)
- **Order model** - Added missing `orderItems()` relationship
- **Frontend routes** - Simplified to remove references to non-existent controllers

#### Role/Auth Updates
- Renamed "User" role to "Customer" in `RolesTableSeeder`
- Updated `RedirectIfAuthenticated` middleware to route admins to `/admin` and customers to `/home`

#### New Feature: Accessory System
Created complete product add-on/accessory system:

**Migrations:**
- `2024_12_31_000001_create_accessory_types_table`
- `2024_12_31_000002_create_accessories_table`
- `2024_12_31_000003_create_product_accessory_table`
- `2024_12_31_000004_create_accessory_client_prices_table`

**Models:**
- `App\Models\AccessoryType`
- `App\Models\Accessory`
- `App\Models\AccessoryClientPrice`

**Controllers:**
- `App\Http\Controllers\Admin\AccessoryTypeController`
- `App\Http\Controllers\Admin\AccessoryController`

**Views:**
- `resources/views/admin/accessoryTypes/` (index, create, edit, show)
- `resources/views/admin/accessories/` (index, create, edit, show)
- `resources/views/admin/products/partials/accessories.blade.php`

**Routes:**
- Added resource routes for `accessory-types` and `accessories` under `/admin`

**Menu:**
- Added Accessory Types and Accessories links to products-section menu

**Permissions:**
- Added 10 new permissions (accessory_type_*, accessory_*) and assigned to Admin role

#### ContentPage Updates
**Migration:** `2024_12_31_000005_add_client_id_to_content_pages_table`

**Model changes:**
- Added `client_id`, `slug`, `page_type` to fillable
- Added `client()` relationship
- Added `PAGE_TYPE_SELECT` constant

**Controller changes:**
- Added `$clients` and `$pageTypes` to create/edit methods

**View changes:**
- Added client_id, slug, page_type fields to create/edit forms

#### User Model Updates
**Migration:** `2024_12_31_000006_add_client_id_to_users_table`

**Model changes:**
- Added `client_id`, `phone` to fillable
- Added `client()` relationship

**Controller changes:**
- Added `$clients` to create/edit methods

**View changes:**
- Added client_id, phone fields to create/edit forms

#### Client Model Updates
**Migration:** `2024_12_31_000007_add_fields_to_clients_table`

**Model changes:**
- Added to fillable: `store_number`, `contact_name`, `contact_phone`, `contact_email`, `address`, `delivery_notes`, `requires_upc`

**View changes:**
- Added all new fields to create/edit forms

#### Order Model Updates
**Migration:** `2024_12_31_000008_add_fields_to_orders_table`

**Model changes:**
- Added to fillable: `delivery_date`, `special_request`, `delivery_details`, `ordered_by_name`, `ordered_by_phone`

**View changes:**
- Added all new fields to create/edit forms

#### Frontend Scaffolding (Not Integrated)
Created placeholder structure for future frontend integration:
- `resources/views/site/layouts/app.blade.php`
- `resources/views/site/layouts/partials/header.blade.php`
- `resources/views/site/layouts/partials/footer.blade.php`
- `resources/views/site/layouts/partials/account-sidebar.blade.php`
- `resources/views/site/account/dashboard.blade.php`
- `resources/views/site/account/profile.blade.php`
- `resources/views/site/account/orders.blade.php`
- `resources/views/site/account/order-details.blade.php`
- `resources/views/site/pages/how-to-order.blade.php`
- `app/Http/Controllers/Site/AccountController.php`

**Note:** These are scaffolding only - full xhtml template integration is pending.

#### Login Page Integration
- Replaced default Laravel login with xhtml template design
- Removed social sign-in buttons (Google, Facebook)
- Added "Create an Account" button at top
- Changed "Sign up" button to "Login"
- Removed "Don't have an account?" text
- Old login backed up at `resources/views/auth/login.blade.php.bak`

#### Frontend Assets
- Copied `xhtml/css/` → `public/site/css/`
- Copied `xhtml/js/` → `public/site/js/`
- Copied `xhtml/vendor/` → `public/site/vendor/`
- Copied `xhtml/images/` → `public/site/images/`
- All site views reference `public/site/` paths
- `xhtml/` folder can be removed once all pages are integrated

---

## File Reference

### Key Files Modified
| File | Change Type |
|------|-------------|
| `app/Models/ClientPrice.php` | Bug fix |
| `app/Models/Order.php` | Bug fix + new fields |
| `app/Models/ContentPage.php` | New fields + relationship |
| `app/Models/User.php` | New fields + relationship |
| `app/Models/Client.php` | New fields |
| `app/Models/Product.php` | New relationship |
| `resources/views/auth/login.blade.php` | Template integration |
| `database/seeders/RolesTableSeeder.php` | Role rename |
| `database/seeders/PermissionsTableSeeder.php` | New permissions |
| `app/Http/Middleware/RedirectIfAuthenticated.php` | Role-based redirect |
| `routes/web.php` | New routes |
| `routes/frontend.php` | Simplified + new routes |

### New Files Created
- All accessory system files (models, controllers, views, migrations)
- ContentPage migration
- User migration
- Client migration
- Order migration
- Site scaffolding files
- `docs/current.md`
- `docs/changes.md`
