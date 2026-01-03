# Pacific Plant Growers - Development Status

## Last Updated: January 2, 2026 (Evening Session)

## Overview
Wholesale plant seller admin application. Clients are retail grocery stores and flower shops (Harmon's, Smith's, Associated, Flower Shops).

---

## CRITICAL BUSINESS REQUIREMENTS (from guidelines/)

### Company Overview
- Indoor plant wholesaler selling to retail grocery store chains and flower shops
- In business 20+ years, never had a functioning website
- Orders currently placed by phone or email
- Printed catalog sent out regularly to current clients
- Produces seasonal product categories and regular "Everyday" catalog
- Website must be very user-friendly with mobile devices

### Customer Profile
- Grocery store floral managers and flower shop owners
- High turnover - many don't have computer access at work
- Use personal cell phones or email to receive catalogs and call in orders

### CRITICAL: No Public Pricing
- **Pricing NOT visible to public** - must be logged in to see prices
- **No credit card/merchant gateway** - invoices produced upon order placement
- Customer signature takes place upon delivery
- **No invoice or pricing total needed for any store**

### Client Types & Requirements
Each client type has different requirements:

**HARMON'S:**
- UPC Code Numbering
- Exclusive product offering
- Special Request buttons
- Delivery request date info
- Log-in credentials: ~85 users

**SMITH'S:**
- UPC Code Numbering
- Store location request
- Special Request buttons
- Delivery request date info
- Log-in credentials: ~30 users

**ASSOCIATED:**
- UPC Code Numbering (only for some stores)
- Store location request
- Delivery request date info
- Log-in credentials: ~60 users

**FLOWER SHOPS:**
- Special Request buttons
- Delivery request date info
- Log-in credentials: ~30 users

### Product Categories
Standard categories (may adjust per store):
- baskets, table top tins, floor tins, ceramics, wood, novelty, money trees, bamboo, supplies

Seasonal landing pages:
- Valentines, Spring, Mother's Day, Summer, Fall, Halloween, Christmas, Product specials

### Packing Slip (FOR CUSTOMER)
Should include:
- Product order listing items ordered/quantities
- Delivery details
- Special notes/requests
- **NO invoice product totals needed**

### Order Ticket (FOR FULFILLMENT)
Should include:
- Store Name/Number
- Name of person ordering
- Contact phone # - good time to reach
- Requested date of delivery
- Product order by category listing
- Delivery details
- **No product dollar amount totals needed for customer, but on order ticket**
- UPC codes/quantities (on applicable stores)
- Sorting capabilities by UPC coding or product category
- Custom page size/font size/categories or fulfillment protocols

### Product Field Needs
- UPC code (does not show to customer, but used for order ticket needs)
- Options to purchase in sets (e.g., 2 sets, 4 sets, 6 sets)
- Inventory count
- Special request field

### Product Check-Out
- Packing slip for customer with product order list
- Order ticket for fulfillment
- Special request/note field
- Desired delivery date
- **No invoice or pricing total is needed for any store**

### Promotional Blasts
- Ability to send out discounts and promotional specials
- Email blast with link that takes customer directly to landing page of special
- Ability to navigate back to all products

### Customer Check-Out Requirements
- Need ability to list any special requests
- Need to describe delivery/pick up needs
- **Does not need to have prices/check out totals**

---

## Recent Changes (January 2, 2026 - Late Night Session #4)

### Collection Showcase Layouts (11 Layout Types)
All layouts match xhtml template pages exactly and use existing products:
- **grid** - Simple responsive grid layout
- **masonry** - Masonry grid with category filtering
- **carousel** - Swiper carousel showcase with prev/next navigation
- **tiles** - Portfolio tiles with category filtering
- **cobble-1** - Cobble pattern (small, small, large repeating)
- **cobble-2** - Cobble pattern (large, small, small repeating)
- **collage-1** - Collage with alternating large/small
- **collage-2** - Collage with different alternating pattern
- **film-strip** - Horizontal film strip slider
- **split-slider** - Split view with image and content side by side
- **thumbs-slider** - Main slider with thumbnail navigation

### Collection Catalog/Advertisement Export
- **Print-friendly view** - `/collections/{slug}/catalog` route
- **PDF export** - Browser print dialog allows Save as PDF
- **Catalog layout** - Clean, professional layout for catalogs and advertisements
- **Download button** - Added to collection show pages

### Menu Builder Fixes
- **Save fix** - Removed role_id update causing "Column 'role_id' cannot be null" error
- **Accordion persistence** - Sections stay open after adding items (localStorage)

### Frontend Styling
- **Accordion headers** - margin-bottom: 0.5rem, aligned with accordion header (1.25rem padding)
- **Variation items** - Indented more (1.5rem padding-left)
- **Price tiers units** - Darker text color (#555) for readability
- **Shop hover icons** - Removed cart icon, kept eye and heart only

### Routes Added
- `GET /collections` - Collections index
- `GET /collections/{slug}` - Collection show (layout-specific)
- `GET /collections/{slug}/catalog` - Print-friendly catalog view

### Files Created
- `app/Http/Controllers/Site/CollectionController.php` - Updated with catalog method
- `resources/views/site/collections/index.blade.php` - Collections listing
- `resources/views/site/collections/catalog.blade.php` - Print-friendly catalog
- `resources/views/site/collections/layouts/*.blade.php` - 11 layout files

---

## Previous Changes (January 2, 2026 - Late Night Session #3)

### Product Collections System
- **DummyProductCollectionsSeeder** - Creates one collection per layout type (11 total) with 4-8 random products
- **Admin Settings button** - Add/Remove dummy collections in Developer Tools section
- **Menu Builder** - Product Collections section added to menu builder for navigation links
- **is_fake field** - Added to ProductCollection model for dummy data tracking
- **Frontend route** - `/collections/{slug}` route with CollectionController@show
- **Collection view** - `site/collections/show.blade.php` displays collection products in grid

### Price Tiers Styling Update
- **Label first** - Shows tier label (e.g., "Regular") before units
- **Units in parentheses** - Shows "(1-24 units)" after label in gray
- **No badge backgrounds** - Removed colored badge backgrounds from labels
- **Discount as text** - Shows "X% off" in green text instead of badge

### Accordion Spacing
- **Category headers** - Added 0.5rem margin-top above headers (except first one)
- **Applies to** - Variations, price tiers groups

### Menu Ordering Fix
- **Header navigation** - Fixed to properly order menu items by `sort` field
- **Direct query** - Now fetches MenuItems directly with `orderBy('sort', 'asc')` instead of using relationship

### Database Changes
- `add_is_fake_to_product_collections_table` - Boolean for dummy data tracking

---

## Previous Changes (January 2, 2026 - Late Night Session #2)

### Frontend Product Page Accordion System
- **Accordion layout** - Variations, accessories, and price tiers now in collapsible accordion sections
- **Template accordion** - Uses `dz-accordion accordion-sm` classes from xhtml template
- **Accessory types as accordion items** - Each accessory type (Card Holders, Ribbons, etc.) gets its own accordion
- **Fixed getAccessoriesByType()** - Now groups by type NAME instead of type ID

### Frontend Styling Refinements
- **Category headers** - Gray background (`bg-secondary`), white text, full width, no border radius
- **Item rows** - Compact padding (`0.1rem 0.5rem 0.1rem 0.75rem`), indented names
- **Prices** - Green color (`var(--primary)`), bold weight
- **Item names** - Bold black text
- **Quantity inputs** - Square (border-radius: 0), 40px width, 1.5rem height
- **Font sizes** - All using rem for responsiveness (0.8rem rows, 0.75rem inputs)
- **Current Total** - Renamed from "Selection Total", with hr lines above and below

### Admin Pricing Tab Restructure
- **Base Product Pricing** - Always visible section with SKU, UPC, Price, Full Price, Cost, Quantity, QB IDs
- **Variation Pricing** - Table now includes Cost column for profit calculation
- **Price Tiers grouped by tier_group** - Frontend displays tiers grouped by their tier_group name

### Database Changes
- `add_show_quantity_to_product_variations_table` - Boolean to control quantity display on frontend
- `add_is_fake_to_price_tiers_and_accessories_tables` - Added `is_fake` to ProductPriceTier, Accessory, AccessoryType
- `add_tier_group_to_product_price_tiers_table` - String field for grouping price tiers

### New Frontend Partials
- `product-variations-content.blade.php` - Variations grouped by category for accordion
- `product-accessory-type-content.blade.php` - Single accessory type content for accordion
- `product-price-tiers-content.blade.php` - Price tiers grouped by tier_group for accordion

### Model Updates
- **ProductVariation** - Added `show_quantity` to fillable/casts
- **ProductPriceTier** - Added `tier_group`, `is_fake` to fillable/casts
- **Accessory** - Added `is_fake` to fillable/casts
- **AccessoryType** - Added `is_fake` to fillable/casts
- **Product.getAccessoriesByType()** - Fixed to group by type name instead of ID
- **ProductCollection** - Added `is_fake` to fillable/casts

### DummyProductsSeeder Updates
- All dummy data now sets `is_fake = true` on price tiers, accessories, accessory types
- `removeDummyProducts()` now cleans up all fake data across all related models

---

## Previous Changes (January 2, 2026 - Late Night Session #1)

### Product Detail Page Enhancements
- **Excerpt/Description layout** - Excerpt shows in right column, full description moved below images
- **Variations display** - Grouped by VariationCategory with stock badges (green >10, yellow 1-10, red Out)
- **Quantity inputs** - Plain number inputs without +/- buttons, no spinner arrows, centered text
- **Accessories section** - New partial `product-accessories.blade.php` displays product accessories
- **Included in Price** - New `included_in_price` field on product_accessory pivot table with green "Included" badge

### Admin Product Edit Enhancements
- **Quick Add Variations** - Select from existing variations used on other products to maintain consistency
- **Quick Add Price Tiers** - Select from existing tier ranges (e.g., 1-49, 50-99, 100+) used on other products
- **Discount % on Price Tiers** - New `discount_percent` column on `product_price_tiers` table
- **Included in Price checkbox** - New column on Accessories tab for accessories included in product price

### WCL Developer Tools (Admin Settings)
- **Session-based alerts** - SweetAlert messages persist across page changes using session flash
- **Cache clearing** - Added before/after all WCL commands to prevent caching issues
- **Timeout handling** - Extended timeout (5 min) for long-running commands

### Database Migrations
- `add_included_in_price_to_product_accessory_table` - Boolean for accessories included in price
- `add_discount_to_product_price_tiers_table` - Decimal for discount percentage

---

## Previous Changes (January 2, 2026 - Evening Session)

### Menu Builder Enhancements
- **Role-based menu items** - Enabled `use_roles` in config, added `role_id` column to `menu_items` table
- **Role select on ALL menu types** - Categories, Products, Pages, FAQs, Custom Links, Separators/Dividers
- **Divider options** - Added separator types: Separator (labeled), Divider | (horizontal), Divider ─ (vertical)
- **Fixed config** - Changed `roles_title_field` from 'name' to 'title' to match roles table

### Settings Admin - Developer Tools (WCL Developer only)
- **Squash Migrations** - Button to run `migrate:generate --squash`
- **Media Regenerate All** - Regenerate all media with responsive images
- **Media Regenerate Missing** - Only regenerate missing conversions
- **Per-model media regen** - Separate buttons for Pages, Products, Clients, Settings
- **Telescope** - Link to open + Clear Logs button
- **Daily telescope:clear** - Scheduled job in Kernel.php

### Settings Admin - Seeding Improvements
- **Export Menus** - New button to generate seeders for menus/menu_items tables
- **Separated dummy seeders** - Each button only creates its own data type (products don't create FAQs/Pages)
- **Duplicate checking** - FAQs and Pages check for existing fake data before creating
- **Fixed product images** - All dummy products (including accessories and bundles) now get placeholder images

### Telescope Configuration
- Moved to production dependencies in composer.json
- Access restricted to admins and WCL developers via gate

### Composer Updates
- Removed `wecodelaravel/laravel-menu` (hardcoded now)
- Added platform PHP 8.2
- Moved `kitloong/laravel-migrations-generator` and `laravel/telescope` to require (from require-dev)

### Product Admin Refactor (Earlier in day)
- **Tab structure** - General, Variations, Pricing, Client Access, Categories & Tags, Accessories, Bundle, Media
- **Visibility controls** - show_original_price, show_variations, show_sets, show_accessories
- **Active flags** - Added to variations, bundle items, accessories for granular control

---

## Previous Changes (January 2, 2026 - Morning)

### Shop Page Layout Fixes (Rewritten to Match Template Exactly)
**NEW RULE: Never modify original template styles/classes - only ADD new classes for Laravel functionality**

- **List view as default** - Template has list view active by default, grid controls updated
- **Tab structure** - Added `row > col-12 tab-content shop-` wrapper to match template exactly
- **Product card list** - Matches template structure: `dz-shop-card style-2`, `bookmark-btn style-1` with `flaticon flaticon-heart-3`
- **Grid controls** - Matches template: `panel-btn`, `default-select` dropdowns, SVG icons with `#949494` fill
- **Sidebar** - Matches template: `widget_search` with `form-group`, `widget_categories` with `custom-control custom-checkbox d-flex`
- **Category checkboxes** - Uses `form-check-input square` class (template default)
- **Added classes for Laravel** - `category-filter` on checkboxes, `add-to-cart-btn` on buttons (additions only, no modifications)

### Files Modified
- `resources/views/site/shop/standard.blade.php` - Banner, scripts, styles
- `resources/views/site/shop/partials/grid-controls.blade.php` - Added dropdowns, fixed SVGs
- `resources/views/site/shop/partials/sidebar.blade.php` - Fixed checkbox structure, price display
- `resources/views/site/shop/partials/category-menu-item.blade.php` - Fixed checkbox structure, indentation
- `resources/views/site/shop/partials/product-card-list.blade.php` - Fixed structure to match template
- `resources/views/site/shop/partials/pagination.blade.php` - Fixed to use template pagination style

## Previous Changes (January 1, 2026)

### Settings & Dummy Data System
- **Settings value column** - Changed from VARCHAR to TEXT to support HTML content
- **Settings types** - Added `html` type for WYSIWYG editor fields
- **Dummy data AJAX** - Added SweetAlert confirmations and AJAX responses for dummy data buttons
- **DummyProductsSeeder** - Fixed `Factory::set()` conflict by renaming to `asSet()`
- **FaqQuestionFactory** - Fixed unique overflow error

### How to Order Page
- **Client.how_to_order_content** - New field for client-specific ordering instructions
- **Priority system**: Client field → Client ContentPage → General ContentPage → Default setting → Hardcoded fallback
- **Default setting** - `how_to_order_default` with HTML type for default content
- Admin forms updated to edit client-specific content

### Menu Builder (Fixed January 1, 2026)
- **Database fix**: Added missing `link` column to `menu_items` table
- **Controller fix**: Changed from `Menu::getByName()` (returns arrays) to `MenuItems::getall()` (returns objects)
- **Null checks**: Added to `updateitem()` method to prevent errors
- **Section order**: Product Categories, Products, Pages, FAQ Categories, Custom Link, Separator (Custom Link and Separator moved to bottom)
- **All sections closed by default**: Removed `open` class from accordion sections
- **Select dropdowns**: Each section uses select dropdown with Label and Icon inputs (not checkboxes)
- **AdminLTE styling**: All selects use `form-control select2` with bootstrap4 theme, inputs use `form-control`
- **Select2 events**: Uses `select2:select` event to auto-fill label when selection changes
- **Icon support**: Menu items can have FontAwesome icons, with "Icon Only" checkbox to hide label
- **Icon only field**: `icon_only_menu` column saves/displays correctly

### Header Navigation (Fixed January 1, 2026)
- **No duplicates**: Only shows menu items if "Main Navigation" menu has items, otherwise falls back to defaults
- **Icon display**: Shows icon before label when `menu_icon_class` is set
- **Icon only**: Hides label when `icon_only_menu` is true
- **Dropdown support**: Nested menu items create dropdown menus with `sub-menu-down` class
- **FontAwesome CDN**: Added to frontend layout for icon display

### Shop Sidebar
- Updated to match xhtml template structure
- Checkbox-based category filtering
- Featured products widget
- Product tags widget
- Search input

### Shop AJAX Filtering
- **ShopController** - Returns JSON for AJAX requests with rendered HTML partials
- **products-grid.blade.php** - New partial for product grid content
- **pagination.blade.php** - New partial for pagination
- **standard.blade.php** - Added JavaScript for AJAX filtering:
  - Category checkboxes filter without page reload
  - Search input with debounce (500ms)
  - Sort dropdown triggers AJAX
  - Pagination links load via AJAX
  - Reset filters button clears all and reloads
  - URL updates via pushState for bookmarkability
  - Loading state with opacity change

## Previous Changes (Dec 31, 2024)

### Accessory System (Complete)

#### Concepts Explained

**Accessory Types** = Categories/groupings for accessories
- Examples: "Ribbon", "Pot Cover", "Pick", "Bow", "Card Holder"
- Used to organize and group related accessories together

**Accessories** = Specific items that belong to an Accessory Type
- Example: Accessory Type "Ribbon" contains:
  - "Red Satin Ribbon"
  - "Gold Ribbon"  
  - "White Organza Ribbon"
- Each accessory has its own SKU, price, and can have client-specific pricing

**Product → Accessories relationship** = Which accessories can be added to a product
- When editing a product, you select which specific accessories are available for that product
- Example: A "6" Poinsettia" product might have these accessories available:
  - Red Satin Ribbon (type: Ribbon)
  - Gold Ribbon (type: Ribbon)
  - Foil Wrap (type: Pot Cover)
  - Holiday Pick (type: Pick)
- Accessories can be marked as `is_default` (pre-selected) or `is_required` (must include)

**Product.accessory_type_id** = When a PRODUCT is itself an accessory
- Only applies when `product_type = 'accessory'`
- Tells you what category this accessory-product belongs to
- Example: Product "Red Satin Ribbon" with `product_type = 'accessory'` and `accessory_type_id = 1` (Ribbon)

#### Database Structure
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

### Pricing Structure (Refactored)
- **Product model** now has: `base_price`, `sku`, `upc_code`, `qb_1`, `qb_2`
  - `base_price` - default price for all clients
  - `sku` - internal product code
  - `upc_code` - for order tickets (stores requiring UPC)
  - `qb_1`, `qb_2` - QuickBooks accounting identifiers
- **ClientPrice model** simplified to only store price overrides
  - Only `price` field needed per client (if different from base)
- Helper method: `$product->getPriceForClient($clientId)` returns client price or base price
- Product admin forms updated with Pricing & Identifiers section

### Product Types (Unified Model)
- **Product model** now has `product_type` field: `standard`, `accessory`, `set`
- Accessories are now products with `product_type = 'accessory'`
- Sets/Bundles are products with `product_type = 'set'`
- `accessory_type_id` field links to AccessoryType for grouping
- **ProductBundleItem model** for set contents:
  - `bundle_product_id` - the set product
  - `item_product_id` - product included in set
  - `quantity`, `is_required`, `is_selectable`, `group_name`
- Helper scopes: `Product::standard()`, `Product::accessories()`, `Product::sets()`
- See `docs/features.md` for comprehensive documentation

### Settings System (Enhanced)
- Added `type`, `group`, `label`, `description` fields to settings table
- Types: text, textarea, image, boolean, select
- Groups: general, login, branding, contact
- Helper methods: `Setting::get($key)`, `Setting::set($key, $value, ...)`
- Admin forms updated with dynamic value inputs based on type
- Image upload support for settings
- **SettingsSeeder** with essential settings:
  - **Branding**: company_name, company_logo, company_logo_dark, favicon
  - **Contact**: company_address, company_phone, company_email, company_website
  - **Login**: login_background_image, login_welcome_text, login_description
  - **General**: order_number_prefix, order_number_start, default_delivery_days, enable_customer_registration, require_approval_for_orders, packing_slip_footer, order_ticket_footer
- Settings index view now shows grouped cards instead of DataTable

### Client Settings
- Added `logo` field to clients table

### Client Addresses (Multi-Location Support)
- **ClientAddress model** for managing multiple addresses per client
- Address types: `corporate`, `shipping`, `billing`
- Each address can have:
  - Label (e.g., "Store #123", "Main Warehouse")
  - Full address fields (line 1, line 2, city, state, postal, country)
  - Contact info (name, phone, email)
  - Delivery notes and special instructions
  - Primary flag for default selection
- Client admin views updated with addresses section
- Relationships: `$client->addresses()`, `$client->shippingAddresses()`, `$client->primaryShippingAddress()`

### Order Fields (per guidelines)
- **Order model** fields:
  - `special_request` - Customer notes/instructions (visible on packing slip)
  - `internal_notes` - Admin-only notes (not visible to customer)
  - `delivery_details` - Delivery information
  - `store_location_request` - Store location/department request
  - `ordered_by_name`, `ordered_by_phone` - Contact info
  - `delivery_date` - Requested delivery date
- Order print view includes all fields per guidelines layout

### Product Collections (Showcase System)
- **ProductCollection model** for grouping products with different display layouts
- **ProductCollectionItem** pivot with sort_order and is_featured flag
- Layout types with visual icons:
  - Grid, Masonry Grid, Carousel Showcase, Tiles
  - Cobble Style 1 & 2, Collage Style 1 & 2
  - Film Strip, Split Slider, Thumbs Slider
- Features:
  - Visual layout selector with preview icons
  - Drag-and-drop product ordering
  - Mark products as featured within collection
  - Show on homepage option
  - Custom background/text colors
  - Column count for grid layouts
- Admin CRUD at `/admin/product-collections`
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

### Dummy Data System (Demo Data)

The application includes a demo data system for showcasing functionality to new clients.

#### How It Works
- **Real Seeders** (`ClientsTableSeeder`, etc.) create skeleton records with `published = false`, `is_fake = false`
- **Dummy Seeders** (`DummyClientsSeeder`, `DummyProductsSeeder`) create demo versions with full data, `published = true`, `is_fake = true`
- Demo data shows owners how complete records look
- Clearing dummy data only removes records where `is_fake = true`
- Real records remain (unpublished) for owners to fill in and publish

#### Admin Settings Page
Separate buttons for each data type:
- **Add/Remove Products** - Products, categories, tags
- **Add/Remove Clients** - Clients with addresses
- **Remove FAQs** - FAQ categories and questions
- **Remove Pages** - Content pages

#### Visual Indicators
- Demo data shows info badge/alert: "Demo Data - This is sample data for demonstration"
- Displayed on edit forms for products, clients, FAQ categories, content pages

#### Factories Used
- `ClientFactory` - Generates demo clients (Harmons, Albertsons, Walgreens)
- `ClientAddressFactory` - Generates addresses with Utah cities
- `ProductFactory` - Generates plant products with placeholder images
- `ProductCategoryFactory`, `ProductTagFactory` - Categories and tags
- `FaqCategoryFactory`, `FaqQuestionFactory` - FAQ content
- `ContentPageFactory` - Content pages

### Frontend Account Area (Client Self-Service)

Added client-facing account management:
- **Company Info** (`/account/company`) - Edit client name, contact info, store number
- **Locations** (`/account/locations`) - Manage multiple addresses (corporate, shipping, billing)
  - Add/edit/delete addresses
  - Set primary address per type
  - Full address fields with contact info and delivery notes

Routes in `routes/frontend.php`, controller methods in `AccountController`.

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
6. **Product identifiers** - Need clarification on identifiers table for checkout vs accounting

## Database Migrations Run
- `2024_12_31_000001_create_accessory_types_table`
- `2024_12_31_000002_create_accessories_table`
- `2024_12_31_000003_create_product_accessory_table`
- `2024_12_31_000004_create_accessory_client_prices_table`
- `2024_12_31_000005_add_client_id_to_content_pages_table`
- `2024_12_31_000006_add_client_id_to_users_table`
- `2024_12_31_000007_add_fields_to_clients_table`
- `2024_12_31_000008_add_fields_to_orders_table`
- `2024_12_31_000009_add_fields_to_settings_table`
- `2024_12_31_000010_add_logo_to_clients_table`
- `2024_12_31_000011_add_pricing_fields_to_products_table`
- `2024_12_31_000012_add_product_type_to_products_table`
- `2024_12_31_000013_create_product_bundle_items_table`
- `2024_12_31_000014_create_client_addresses_table`
- `2024_12_31_000015_add_internal_notes_to_orders_table`
- `2024_12_31_000016_create_product_collections_table`

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

## Reference Links
- **Original Template**: [xhtml/index.html](../xhtml/index.html) - Open to view all template pages and components
