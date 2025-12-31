# Pacific Plant Growers - Feature Documentation

This document provides comprehensive documentation for all features and functionality in the Pacific Plant Growers wholesale ordering system.

---

## Table of Contents

1. [Product Management](#product-management)
2. [Product Types](#product-types)
3. [Pricing System](#pricing-system)
4. [Client Management](#client-management)
5. [Order Management](#order-management)
6. [User & Authentication](#user--authentication)
7. [Settings System](#settings-system)
8. [Content Pages](#content-pages)

---

## Product Management

### Overview
Products are the core items sold through the system. Each product can be a standard item, an accessory, or a set/bundle.

### Product Fields

| Field | Description |
|-------|-------------|
| `name` | Product name displayed to customers |
| `description` | Detailed product description |
| `product_type` | Type of product: `standard`, `accessory`, or `set` |
| `base_price` | Default price for all clients |
| `sku` | Internal stock keeping unit code |
| `upc_code` | Universal Product Code for order tickets |
| `qb_1` | QuickBooks accounting identifier 1 |
| `qb_2` | QuickBooks accounting identifier 2 |
| `quantity` | Inventory count |
| `published` | Whether product is visible |
| `featured` | Whether product is featured |
| `accessory_type_id` | Category for accessory products |

### Managing Products

1. **Create Product**: Admin > Products > Add New
2. **Edit Product**: Click on product name or edit button
3. **Product Tabs**:
   - **General**: Basic info, photos, product type
   - **Categories**: Assign to product categories
   - **Pricing**: Base price, identifiers, client price overrides
   - **Bundle Items**: (Sets only) Define included products
   - **Accessories**: Link available accessories
   - **Settings**: Additional configuration

---

## Product Types

### Standard Products
Regular items for sale (plants, baskets, ceramics, etc.)

- Have base pricing and optional client-specific pricing
- Can have accessories attached
- Can be included in sets/bundles

### Accessories
Add-on items that can be selected with other products.

- Grouped by **Accessory Type** (e.g., "Card Holders", "Ribbons", "Baskets")
- Can be marked as `is_default` (pre-selected) or `is_required` (must include)
- Have their own pricing (base + client-specific)

**Creating an Accessory:**
1. Create new product
2. Set Product Type to "Accessory"
3. Select an Accessory Type to group it
4. Set pricing as normal

### Sets/Bundles
Pre-configured combinations of products with optional customer choices.

**Bundle Structure:**
- A set contains one or more **groups**
- Each group has a name (e.g., "Choose your basket")
- Each group contains **items** (products)
- Items can be:
  - **Required**: Must be included in the bundle
  - **Selectable**: Customer can choose from options

**Example Bundle: "Valentine's Basket Set"**
```
Group: "Choose your basket" (required, selectable)
  - Red Heart Basket
  - Pink Round Basket
  - White Square Basket

Group: "Choose your plant" (required, selectable)
  - Peace Lily
  - Orchid
  - Succulent Trio

Group: "Add-ons" (optional, selectable)
  - Card Holder
  - Ribbon Bow
  - Gift Tag
```

**Creating a Set:**
1. Create new product
2. Set Product Type to "Set/Bundle"
3. Go to "Bundle Items" tab
4. Add groups and items
5. Configure required/selectable options

---

## Pricing System

### Base Price
Every product has a `base_price` - the default price shown to all clients.

### Client Price Overrides
Specific clients can have different prices:

1. Go to Product > Edit > Pricing tab
2. Select clients in the dropdown
3. Enter override price for each client (leave blank to use base price)

### Getting Effective Price (Code)
```php
// Get price for a specific client
$price = $product->getPriceForClient($clientId);

// Check if client has custom price
if ($product->hasClientPrice($clientId)) {
    // Has override
}
```

### Product Identifiers

| Field | Purpose |
|-------|---------|
| `sku` | Internal tracking code |
| `upc_code` | Barcode for order tickets (stores requiring UPC) |
| `qb_1` | QuickBooks identifier for accounting |
| `qb_2` | Secondary QuickBooks identifier |

---

## Client Management

### Client Types
- **Grocery Stores**: Harmon's, Smith's, Associated
- **Flower Shops**: Independent florists

### Client Fields

| Field | Description |
|-------|-------------|
| `name` | Company/store name |
| `logo` | Client logo for documents |
| `store_number` | Store identifier (e.g., #87) |
| `contact_name` | Primary contact person |
| `contact_phone` | Contact phone number |
| `contact_email` | Contact email address |
| `address` | Delivery address |
| `delivery_notes` | Special delivery instructions |
| `requires_upc` | Whether this client needs UPC codes on orders |

### Client-Specific Features
Different clients may have different requirements:
- **Harmon's**: UPC codes, exclusive products, special request buttons
- **Smith's**: Store location requests, delivery date info
- **Associated**: UPC codes (some stores only)
- **Flower Shops**: Special requests, delivery date info

---

## Order Management

### Order Fields

| Field | Description |
|-------|-------------|
| `number` | Order number |
| `client_id` | Associated client |
| `status` | Order status (new, processing, fulfilled, etc.) |
| `delivery_date` | Requested delivery date |
| `special_request` | Customer notes/instructions |
| `delivery_details` | Delivery information |
| `ordered_by_name` | Person who placed the order |
| `ordered_by_phone` | Contact phone for order |
| `order_total` | Total order amount |

### Order View Layout
The order view follows the guidelines layout:

**Left Side:**
- Client name and store number
- Order date, delivery date
- Ordered by information
- Items grouped by category
- Special instructions

**Right Side:**
- UPC codes table (Qty, UPC, Product)
- Sorted by UPC code

### Order Documents

**Packing Slip** (for customer):
- Product listing with quantities
- Delivery details
- Special notes
- NO prices shown

**Order Ticket** (for fulfillment):
- Store name/number
- Contact information
- Delivery date
- Products by category
- UPC codes (where applicable)
- QuickBooks identifiers for accounting

### Printing Orders
1. Go to Orders > View Order
2. Click "Print Order Ticket" button
3. Printable page opens and auto-prints

---

## User & Authentication

### User Roles
- **Admin**: Full access to admin panel
- **Customer**: Frontend access, can place orders

### User Fields

| Field | Description |
|-------|-------------|
| `name` | User's full name |
| `email` | Login email |
| `phone` | Contact phone |
| `client_id` | Associated client (for customers) |

### Login Behavior
- Admins redirect to `/admin`
- Customers redirect to `/home`

### Customer Profile
Customers can view their profile which shows:
- Personal information (editable)
- Company information (read-only, managed by admin)
  - Company name, store number
  - Contact details
  - Delivery address
  - Delivery notes

---

## Settings System

### Overview
Global application settings stored in the database.

### Setting Types
- **Text**: Single line text
- **Textarea**: Multi-line text
- **Image**: File upload (stored in `storage/app/public/settings/`)
- **Boolean**: On/off toggle
- **Select**: Dropdown options

### Setting Groups
- **General**: Site-wide settings
- **Login**: Login page customization
- **Branding**: Logo, colors, etc.
- **Contact**: Contact information

### Using Settings (Code)
```php
// Get a setting value
$value = Setting::get('login_background_image', 'default-value');

// Set a setting value
Setting::set('site_name', 'Pacific Plant Growers', 'text', 'general', 'Site Name');
```

### Managing Settings
1. Admin > Settings
2. Add new setting with key, label, type, group
3. Set value based on type

---

## Content Pages

### Overview
Custom content pages that can be client-specific.

### Page Types
- **General**: Available to all
- **How to Order**: Ordering instructions
- **FAQ**: Frequently asked questions
- **Terms**: Terms and conditions

### Client-Specific Pages
Pages can be assigned to specific clients:
1. Create/edit content page
2. Select client from dropdown
3. Page will only show for that client's users

### Fields

| Field | Description |
|-------|-------------|
| `title` | Page title |
| `slug` | URL-friendly identifier |
| `content` | Page content (HTML) |
| `page_type` | Type of page |
| `client_id` | Optional client assignment |
| `published` | Whether page is visible |

---

## Quick Reference

### Product Scopes (Code)
```php
Product::standard()->get();    // Only standard products
Product::accessories()->get(); // Only accessories
Product::sets()->get();        // Only sets/bundles
```

### Product Type Checks
```php
$product->isAccessory(); // true if accessory
$product->isSet();       // true if set/bundle
```

### Bundle Items
```php
// Get bundle items grouped by group name
$groups = $product->getBundleItemsByGroup();

foreach ($groups as $groupName => $items) {
    echo $groupName; // "Choose your basket"
    foreach ($items as $item) {
        echo $item->itemProduct->name;
        echo $item->quantity;
        echo $item->is_required ? 'Required' : 'Optional';
    }
}
```

---

## Database Tables Reference

### Core Tables
- `products` - All products (standard, accessories, sets)
- `product_categories` - Product categories
- `product_tags` - Product tags
- `clients` - Client companies
- `orders` - Customer orders
- `order_items` - Items in orders
- `users` - System users

### Relationship Tables
- `client_prices` - Client-specific price overrides
- `product_bundle_items` - Items included in sets/bundles
- `product_accessory` - Accessories linked to products
- `accessory_types` - Categories for accessories
- `client_product` - Products available to clients

### System Tables
- `settings` - Application settings
- `content_pages` - Custom content pages

---

*Last Updated: December 31, 2024*
