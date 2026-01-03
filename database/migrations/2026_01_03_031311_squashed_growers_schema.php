<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accessories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('accessory_type_id')->index('accessories_accessory_type_id_foreign');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('sku')->nullable();
            $table->decimal('base_price', 10)->nullable();
            $table->boolean('published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('accessory_client_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('accessory_id');
            $table->unsignedBigInteger('client_id')->index('accessory_client_prices_client_id_foreign');
            $table->decimal('price', 10);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['accessory_id', 'client_id']);
        });

        Schema::create('accessory_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('accessory_variants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('accessory_id');
            $table->string('name');
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->string('material')->nullable();
            $table->string('sku')->nullable();
            $table->decimal('price_adjustment', 10)->default(0)->comment('Add/subtract from base price');
            $table->decimal('price_override', 10)->nullable()->comment('Fixed price (overrides base + adjustment)');
            $table->boolean('is_default')->default(false);
            $table->boolean('published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->integer('stock_quantity')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['accessory_id', 'published']);
        });

        Schema::create('audit_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('description');
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->string('subject_type')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('properties')->nullable();
            $table->string('host', 46)->nullable();
            $table->timestamps();
        });

        Schema::create('client_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id');
            $table->string('address_type');
            $table->string('label')->nullable();
            $table->boolean('is_primary')->default(false);
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('postal_code');
            $table->string('country')->default('USA');
            $table->string('contact_name')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->text('delivery_notes')->nullable();
            $table->text('special_instructions')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['client_id', 'address_type']);
        });

        Schema::create('client_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('published')->nullable()->default(false);
            $table->decimal('price', 15)->nullable();
            $table->string('sku')->nullable();
            $table->string('mpn')->nullable();
            $table->string('gtin')->nullable();
            $table->string('upc')->nullable();
            $table->string('qb_1')->nullable();
            $table->string('qb_2')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('client_id')->index('client_fk_10288983');
            $table->unsignedBigInteger('product_id')->index('client_prices_product_id_foreign');
            $table->unsignedBigInteger('team_id')->nullable()->index('team_fk_9986806');
        });

        Schema::create('client_product', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->index('product_id_fk_10112000');
            $table->unsignedBigInteger('client_id')->index('client_id_fk_10112000');
        });

        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('published')->nullable()->default(false);
            $table->string('name')->nullable();
            $table->boolean('is_fake')->default(false);
            $table->string('logo')->nullable();
            $table->string('store_number')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->text('address')->nullable();
            $table->text('delivery_notes')->nullable();
            $table->text('how_to_order_content')->nullable();
            $table->boolean('requires_upc')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('prices_id')->nullable()->index('prices_fk_10288950');
            $table->unsignedBigInteger('team_id')->nullable()->index('team_fk_9986797');
        });

        Schema::create('content_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('content_category_content_page', function (Blueprint $table) {
            $table->unsignedBigInteger('content_page_id')->index('content_page_id_fk_9558413');
            $table->unsignedBigInteger('content_category_id')->index('content_category_id_fk_9558413');
        });

        Schema::create('content_page_content_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('content_page_id')->index('content_page_id_fk_9558414');
            $table->unsignedBigInteger('content_tag_id')->index('content_tag_id_fk_9558414');
        });

        Schema::create('content_pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->boolean('published')->nullable()->default(false);
            $table->boolean('is_fake')->default(false);
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('page_type')->default('general');
            $table->string('layout')->default('default');
            $table->longText('page_text')->nullable();
            $table->longText('excerpt')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['client_id', 'page_type']);
        });

        Schema::create('content_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('faq_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category')->nullable();
            $table->boolean('is_fake')->default(false);
            $table->boolean('published')->nullable()->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('faq_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('published')->nullable()->default(false);
            $table->longText('question')->nullable();
            $table->longText('answer')->nullable();
            $table->boolean('is_fake')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('category_id')->nullable()->index('category_fk_9558427');
        });

        Schema::create('media', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
            $table->char('uuid', 36)->nullable()->unique();
            $table->string('collection_name');
            $table->string('name');
            $table->string('file_name');
            $table->string('mime_type')->nullable();
            $table->string('disk');
            $table->string('conversions_disk')->nullable();
            $table->unsignedBigInteger('size');
            $table->json('manipulations');
            $table->json('custom_properties');
            $table->json('generated_conversions');
            $table->json('responsive_images');
            $table->unsignedInteger('order_column')->nullable()->index();
            $table->timestamps();

            $table->index(['model_type', 'model_id']);
        });

        Schema::create('menu_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('label');
            $table->string('link')->nullable();
            $table->unsignedBigInteger('parent')->default(0);
            $table->integer('sort')->default(0);
            $table->string('class')->nullable();
            $table->unsignedBigInteger('menu')->index('menu_items_menu_foreign');
            $table->integer('depth')->default(0);
            $table->boolean('local')->nullable()->default(true);
            $table->boolean('development')->nullable()->default(true);
            $table->boolean('stage')->nullable()->default(false);
            $table->boolean('production')->nullable()->default(false);
            $table->boolean('marketing')->nullable()->default(false);
            $table->boolean('logged_in_only')->nullable()->default(false);
            $table->integer('role_id')->default(0);
            $table->boolean('icon_only_menu')->nullable()->default(false);
            $table->string('menu_icon_class')->nullable();
            $table->timestamps();
        });

        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('gtin')->nullable();
            $table->string('sku')->nullable();
            $table->string('mpn')->nullable();
            $table->double('price', 15, 2)->nullable();
            $table->integer('quantity')->nullable();
            $table->double('total_price', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('product_id')->nullable()->index('product_fk_9986962');
            $table->unsignedBigInteger('items_id')->nullable()->index('items_fk_9986974');
            $table->unsignedBigInteger('team_id')->nullable()->index('team_fk_9986972');
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('number')->nullable();
            $table->string('status')->nullable();
            $table->date('delivery_date')->nullable();
            $table->text('special_request')->nullable();
            $table->text('internal_notes')->nullable();
            $table->text('delivery_details')->nullable();
            $table->string('store_location_request')->nullable();
            $table->string('ordered_by_name')->nullable();
            $table->string('ordered_by_phone')->nullable();
            $table->double('shipping_cost', 15, 2)->nullable();
            $table->double('order_total', 15, 2)->nullable();
            $table->double('total_price', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('client_id')->nullable()->index('client_fk_9986973');
            $table->unsignedBigInteger('team_id')->nullable()->index('team_fk_9935719');
        });

        Schema::create('page_sections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('content_page_id')->index('page_sections_content_page_id_foreign');
            $table->string('section_type');
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->text('content')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();
            $table->string('button_style')->default('primary');
            $table->string('background_color')->nullable();
            $table->string('background_image')->nullable();
            $table->string('text_color')->nullable();
            $table->string('alignment')->default('left');
            $table->string('container_width')->default('container');
            $table->string('padding')->default('normal');
            $table->json('settings')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('published')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('permission_role', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->index('role_id_fk_9558359');
            $table->unsignedBigInteger('permission_id')->index('permission_id_fk_9558359');
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tokenable_type');
            $table->unsignedBigInteger('tokenable_id');
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();

            $table->index(['tokenable_type', 'tokenable_id']);
        });

        Schema::create('product_accessory', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('accessory_id')->index('product_accessory_accessory_id_foreign');
            $table->boolean('is_default')->default(false);
            $table->boolean('is_required')->default(false);
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->unique(['product_id', 'accessory_id']);
        });

        Schema::create('product_bundle_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bundle_product_id')->comment('The set/bundle product');
            $table->unsignedBigInteger('item_product_id')->index('product_bundle_items_item_product_id_foreign')->comment('Product included in the bundle');
            $table->integer('quantity')->default(1);
            $table->decimal('price_override', 10)->nullable()->comment('Custom price for this item when part of bundle (null = use product base price)');
            $table->decimal('price_adjustment', 10)->nullable()->comment('Price adjustment (+/-) from base price');
            $table->string('price_type')->default('default')->comment('default, override, adjustment, free');
            $table->boolean('is_required')->default(true)->comment('Must be included in bundle');
            $table->boolean('is_selectable')->default(false)->comment('Customer can choose from options');
            $table->string('group_name')->nullable()->comment('Group for selectable options (e.g., Choose your basket)');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_fake')->default(false);
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->index(['bundle_product_id', 'group_name']);
        });

        Schema::create('product_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('published')->nullable()->default(false);
            $table->string('name')->nullable();
            $table->boolean('is_fake')->default(false);
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('product_collection_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_collection_id');
            $table->unsignedBigInteger('product_id')->index('product_collection_items_product_id_foreign');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();

            $table->unique(['product_collection_id', 'product_id']);
        });

        Schema::create('product_collections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('layout_type')->default('grid');
            $table->boolean('published')->default(false);
            $table->boolean('show_on_homepage')->default(false);
            $table->integer('sort_order')->default(0);
            $table->string('background_color')->nullable();
            $table->string('text_color')->nullable();
            $table->integer('columns')->default(4);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('product_favorites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id')->index('product_favorites_product_id_foreign');
            $table->timestamps();

            $table->unique(['user_id', 'product_id']);
        });

        Schema::create('product_price_tiers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->integer('min_quantity');
            $table->integer('max_quantity')->nullable();
            $table->decimal('price', 10);
            $table->string('label')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index(['product_id', 'min_quantity']);
        });

        Schema::create('product_product_category', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->index('product_id_fk_9558452');
            $table->unsignedBigInteger('product_category_id')->index('product_category_id_fk_9558452');
        });

        Schema::create('product_product_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->index('product_id_fk_9558453');
            $table->unsignedBigInteger('product_tag_id')->index('product_tag_id_fk_9558453');
        });

        Schema::create('product_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->boolean('is_fake')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('product_variations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id')->index('product_variations_product_id_foreign');
            $table->string('category')->nullable();
            $table->unsignedBigInteger('variation_category_id')->nullable()->index('product_variations_variation_category_id_foreign');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('sku')->nullable();
            $table->string('upc_code')->nullable();
            $table->decimal('base_price', 10)->nullable();
            $table->decimal('full_price', 10)->nullable();
            $table->decimal('base_cost', 10)->nullable();
            $table->integer('quantity')->default(0);
            $table->string('qb_1')->nullable();
            $table->string('qb_2')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('published')->default(true);
            $table->boolean('active')->default(true);
            $table->boolean('is_fake')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('published')->nullable()->default(false);
            $table->boolean('is_fake')->default(false);
            $table->boolean('featured')->nullable()->default(false);
            $table->string('layout')->default('default');
            $table->string('name')->nullable();
            $table->string('product_type')->default('standard')->index();
            $table->unsignedBigInteger('accessory_type_id')->nullable()->index('products_accessory_type_id_foreign');
            $table->integer('sort_order')->default(0);
            $table->longText('description')->nullable();
            $table->text('excerpt')->nullable();
            $table->decimal('base_price', 10)->nullable();
            $table->decimal('full_price', 10)->nullable();
            $table->boolean('show_original_price')->default(true);
            $table->boolean('show_variations')->default(true);
            $table->boolean('show_sets')->default(true);
            $table->boolean('show_accessories')->default(true);
            $table->decimal('base_cost', 10)->nullable();
            $table->string('bundle_price_type')->default('calculated')->comment('calculated, fixed, discount_percent, discount_amount');
            $table->decimal('bundle_price_override', 10)->nullable()->comment('Fixed bundle price when bundle_price_type is fixed');
            $table->decimal('bundle_discount', 10)->nullable()->comment('Discount percent or amount based on bundle_price_type');
            $table->string('sku')->nullable();
            $table->string('upc_code')->nullable();
            $table->string('qb_1')->nullable()->comment('QuickBooks identifier 1');
            $table->string('qb_2')->nullable()->comment('QuickBooks identifier 2');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('team_id')->nullable()->index('team_fk_9986809');
            $table->integer('quantity')->nullable();
        });

        Schema::create('qa_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('topic_id')->index('qa_messages_topic_id_foreign');
            $table->unsignedBigInteger('sender_id')->index('qa_messages_sender_id_foreign');
            $table->timestamp('read_at')->nullable();
            $table->text('content');
            $table->timestamps();
        });

        Schema::create('qa_topics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subject');
            $table->unsignedBigInteger('creator_id')->index('qa_topics_creator_id_foreign');
            $table->unsignedBigInteger('receiver_id')->index('qa_topics_receiver_id_foreign');
            $table->timestamps();
        });

        Schema::create('reminders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('message')->nullable();
            $table->string('type')->default('info');
            $table->string('link')->nullable();
            $table->string('link_text')->nullable();
            $table->string('model_type')->nullable();
            $table->unsignedBigInteger('model_id')->nullable();
            $table->boolean('dismissed')->default(false)->index();
            $table->unsignedBigInteger('dismissed_by')->nullable();
            $table->timestamp('dismissed_at')->nullable();
            $table->timestamps();

            $table->index(['model_type', 'model_id']);
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->index('user_id_fk_9558368');
            $table->unsignedBigInteger('role_id')->index('role_id_fk_9558368');
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text');
            $table->string('group')->default('general');
            $table->string('label')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('task_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('task_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('task_task_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('task_id')->index('task_id_fk_9935620');
            $table->unsignedBigInteger('task_tag_id')->index('task_tag_id_fk_9935620');
        });

        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->date('due_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('status_id')->nullable()->index('status_fk_9935619');
            $table->unsignedBigInteger('assigned_to_id')->nullable()->index('assigned_to_fk_9935623');
        });

        Schema::create('teams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('owner_id')->nullable()->index('owner_fk_9558391');
        });

        Schema::create('telescope_entries', function (Blueprint $table) {
            $table->bigIncrements('sequence');
            $table->char('uuid', 36)->unique();
            $table->char('batch_id', 36)->index();
            $table->string('family_hash')->nullable()->index();
            $table->boolean('should_display_on_index')->default(true);
            $table->string('type', 20);
            $table->longText('content');
            $table->dateTime('created_at')->nullable()->index();

            $table->index(['type', 'should_display_on_index']);
        });

        Schema::create('telescope_entries_tags', function (Blueprint $table) {
            $table->char('entry_uuid', 36);
            $table->string('tag')->index();

            $table->primary(['entry_uuid', 'tag']);
        });

        Schema::create('telescope_monitoring', function (Blueprint $table) {
            $table->string('tag')->primary();
        });

        Schema::create('user_alerts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('alert_text');
            $table->string('alert_link')->nullable();
            $table->timestamps();
        });

        Schema::create('user_user_alert', function (Blueprint $table) {
            $table->unsignedBigInteger('user_alert_id')->index('user_alert_id_fk_9558396');
            $table->unsignedBigInteger('user_id')->index('user_id_fk_9558396');
            $table->boolean('read')->default(false);
        });

        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id')->nullable()->index('users_client_id_foreign');
            $table->string('name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable();
            $table->dateTime('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->boolean('approved')->nullable()->default(false);
            $table->boolean('needs_setup')->default(false);
            $table->boolean('verified')->nullable()->default(false);
            $table->dateTime('verified_at')->nullable();
            $table->string('verification_token')->nullable();
            $table->boolean('two_factor')->nullable()->default(false);
            $table->string('two_factor_code')->nullable();
            $table->string('remember_token')->nullable();
            $table->dateTime('two_factor_expires_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('team_id')->nullable()->index('team_fk_9558392');
        });

        Schema::create('variation_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('published')->default(true);
            $table->boolean('is_fake')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('variation_client_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('variation_id');
            $table->unsignedBigInteger('client_id')->index('variation_client_prices_client_id_foreign');
            $table->decimal('price', 10)->nullable();
            $table->timestamps();

            $table->unique(['variation_id', 'client_id']);
        });

        Schema::table('accessories', function (Blueprint $table) {
            $table->foreign(['accessory_type_id'])->references(['id'])->on('accessory_types')->onUpdate('no action')->onDelete('cascade');
        });

        Schema::table('accessory_client_prices', function (Blueprint $table) {
            $table->foreign(['accessory_id'])->references(['id'])->on('accessories')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['client_id'])->references(['id'])->on('clients')->onUpdate('no action')->onDelete('cascade');
        });

        Schema::table('accessory_variants', function (Blueprint $table) {
            $table->foreign(['accessory_id'])->references(['id'])->on('accessories')->onUpdate('no action')->onDelete('cascade');
        });

        Schema::table('client_addresses', function (Blueprint $table) {
            $table->foreign(['client_id'])->references(['id'])->on('clients')->onUpdate('no action')->onDelete('cascade');
        });

        Schema::table('client_prices', function (Blueprint $table) {
            $table->foreign(['client_id'], 'client_fk_10288983')->references(['id'])->on('clients')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['product_id'])->references(['id'])->on('products')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['team_id'], 'team_fk_9986806')->references(['id'])->on('teams')->onUpdate('no action')->onDelete('no action');
        });

        Schema::table('client_product', function (Blueprint $table) {
            $table->foreign(['client_id'], 'client_id_fk_10112000')->references(['id'])->on('clients')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['product_id'], 'product_id_fk_10112000')->references(['id'])->on('products')->onUpdate('no action')->onDelete('cascade');
        });

        Schema::table('clients', function (Blueprint $table) {
            $table->foreign(['prices_id'], 'prices_fk_10288950')->references(['id'])->on('client_prices')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['team_id'], 'team_fk_9986797')->references(['id'])->on('teams')->onUpdate('no action')->onDelete('no action');
        });

        Schema::table('content_category_content_page', function (Blueprint $table) {
            $table->foreign(['content_category_id'], 'content_category_id_fk_9558413')->references(['id'])->on('content_categories')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['content_page_id'], 'content_page_id_fk_9558413')->references(['id'])->on('content_pages')->onUpdate('no action')->onDelete('cascade');
        });

        Schema::table('content_page_content_tag', function (Blueprint $table) {
            $table->foreign(['content_page_id'], 'content_page_id_fk_9558414')->references(['id'])->on('content_pages')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['content_tag_id'], 'content_tag_id_fk_9558414')->references(['id'])->on('content_tags')->onUpdate('no action')->onDelete('cascade');
        });

        Schema::table('content_pages', function (Blueprint $table) {
            $table->foreign(['client_id'])->references(['id'])->on('clients')->onUpdate('no action')->onDelete('set null');
        });

        Schema::table('faq_questions', function (Blueprint $table) {
            $table->foreign(['category_id'], 'category_fk_9558427')->references(['id'])->on('faq_categories')->onUpdate('no action')->onDelete('no action');
        });

        Schema::table('menu_items', function (Blueprint $table) {
            $table->foreign(['menu'])->references(['id'])->on('menus')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->foreign(['items_id'], 'items_fk_9986974')->references(['id'])->on('orders')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['product_id'], 'product_fk_9986962')->references(['id'])->on('products')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['team_id'], 'team_fk_9986972')->references(['id'])->on('teams')->onUpdate('no action')->onDelete('no action');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign(['client_id'], 'client_fk_9986973')->references(['id'])->on('clients')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['team_id'], 'team_fk_9935719')->references(['id'])->on('teams')->onUpdate('no action')->onDelete('no action');
        });

        Schema::table('page_sections', function (Blueprint $table) {
            $table->foreign(['content_page_id'])->references(['id'])->on('content_pages')->onUpdate('no action')->onDelete('cascade');
        });

        Schema::table('permission_role', function (Blueprint $table) {
            $table->foreign(['permission_id'], 'permission_id_fk_9558359')->references(['id'])->on('permissions')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['role_id'], 'role_id_fk_9558359')->references(['id'])->on('roles')->onUpdate('no action')->onDelete('cascade');
        });

        Schema::table('product_accessory', function (Blueprint $table) {
            $table->foreign(['accessory_id'])->references(['id'])->on('accessories')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['product_id'])->references(['id'])->on('products')->onUpdate('no action')->onDelete('cascade');
        });

        Schema::table('product_bundle_items', function (Blueprint $table) {
            $table->foreign(['bundle_product_id'])->references(['id'])->on('products')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['item_product_id'])->references(['id'])->on('products')->onUpdate('no action')->onDelete('cascade');
        });

        Schema::table('product_collection_items', function (Blueprint $table) {
            $table->foreign(['product_collection_id'])->references(['id'])->on('product_collections')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['product_id'])->references(['id'])->on('products')->onUpdate('no action')->onDelete('cascade');
        });

        Schema::table('product_favorites', function (Blueprint $table) {
            $table->foreign(['product_id'])->references(['id'])->on('products')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onUpdate('no action')->onDelete('cascade');
        });

        Schema::table('product_price_tiers', function (Blueprint $table) {
            $table->foreign(['product_id'])->references(['id'])->on('products')->onUpdate('no action')->onDelete('cascade');
        });

        Schema::table('product_product_category', function (Blueprint $table) {
            $table->foreign(['product_category_id'], 'product_category_id_fk_9558452')->references(['id'])->on('product_categories')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['product_id'], 'product_id_fk_9558452')->references(['id'])->on('products')->onUpdate('no action')->onDelete('cascade');
        });

        Schema::table('product_product_tag', function (Blueprint $table) {
            $table->foreign(['product_id'], 'product_id_fk_9558453')->references(['id'])->on('products')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['product_tag_id'], 'product_tag_id_fk_9558453')->references(['id'])->on('product_tags')->onUpdate('no action')->onDelete('cascade');
        });

        Schema::table('product_variations', function (Blueprint $table) {
            $table->foreign(['product_id'])->references(['id'])->on('products')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['variation_category_id'])->references(['id'])->on('variation_categories')->onUpdate('no action')->onDelete('set null');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreign(['accessory_type_id'])->references(['id'])->on('accessory_types')->onUpdate('no action')->onDelete('set null');
            $table->foreign(['team_id'], 'team_fk_9986809')->references(['id'])->on('teams')->onUpdate('no action')->onDelete('no action');
        });

        Schema::table('qa_messages', function (Blueprint $table) {
            $table->foreign(['sender_id'])->references(['id'])->on('users')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['topic_id'])->references(['id'])->on('qa_topics')->onUpdate('no action')->onDelete('cascade');
        });

        Schema::table('qa_topics', function (Blueprint $table) {
            $table->foreign(['creator_id'])->references(['id'])->on('users')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['receiver_id'])->references(['id'])->on('users')->onUpdate('no action')->onDelete('cascade');
        });

        Schema::table('role_user', function (Blueprint $table) {
            $table->foreign(['role_id'], 'role_id_fk_9558368')->references(['id'])->on('roles')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['user_id'], 'user_id_fk_9558368')->references(['id'])->on('users')->onUpdate('no action')->onDelete('cascade');
        });

        Schema::table('task_task_tag', function (Blueprint $table) {
            $table->foreign(['task_id'], 'task_id_fk_9935620')->references(['id'])->on('tasks')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['task_tag_id'], 'task_tag_id_fk_9935620')->references(['id'])->on('task_tags')->onUpdate('no action')->onDelete('cascade');
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->foreign(['assigned_to_id'], 'assigned_to_fk_9935623')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['status_id'], 'status_fk_9935619')->references(['id'])->on('task_statuses')->onUpdate('no action')->onDelete('no action');
        });

        Schema::table('teams', function (Blueprint $table) {
            $table->foreign(['owner_id'], 'owner_fk_9558391')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });

        Schema::table('telescope_entries_tags', function (Blueprint $table) {
            $table->foreign(['entry_uuid'])->references(['uuid'])->on('telescope_entries')->onUpdate('no action')->onDelete('cascade');
        });

        Schema::table('user_user_alert', function (Blueprint $table) {
            $table->foreign(['user_alert_id'], 'user_alert_id_fk_9558396')->references(['id'])->on('user_alerts')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['user_id'], 'user_id_fk_9558396')->references(['id'])->on('users')->onUpdate('no action')->onDelete('cascade');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign(['team_id'], 'team_fk_9558392')->references(['id'])->on('teams')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['client_id'])->references(['id'])->on('clients')->onUpdate('no action')->onDelete('set null');
        });

        Schema::table('variation_client_prices', function (Blueprint $table) {
            $table->foreign(['client_id'])->references(['id'])->on('clients')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['variation_id'])->references(['id'])->on('product_variations')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('variation_client_prices', function (Blueprint $table) {
            $table->dropForeign('variation_client_prices_client_id_foreign');
            $table->dropForeign('variation_client_prices_variation_id_foreign');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('team_fk_9558392');
            $table->dropForeign('users_client_id_foreign');
        });

        Schema::table('user_user_alert', function (Blueprint $table) {
            $table->dropForeign('user_alert_id_fk_9558396');
            $table->dropForeign('user_id_fk_9558396');
        });

        Schema::table('telescope_entries_tags', function (Blueprint $table) {
            $table->dropForeign('telescope_entries_tags_entry_uuid_foreign');
        });

        Schema::table('teams', function (Blueprint $table) {
            $table->dropForeign('owner_fk_9558391');
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign('assigned_to_fk_9935623');
            $table->dropForeign('status_fk_9935619');
        });

        Schema::table('task_task_tag', function (Blueprint $table) {
            $table->dropForeign('task_id_fk_9935620');
            $table->dropForeign('task_tag_id_fk_9935620');
        });

        Schema::table('role_user', function (Blueprint $table) {
            $table->dropForeign('role_id_fk_9558368');
            $table->dropForeign('user_id_fk_9558368');
        });

        Schema::table('qa_topics', function (Blueprint $table) {
            $table->dropForeign('qa_topics_creator_id_foreign');
            $table->dropForeign('qa_topics_receiver_id_foreign');
        });

        Schema::table('qa_messages', function (Blueprint $table) {
            $table->dropForeign('qa_messages_sender_id_foreign');
            $table->dropForeign('qa_messages_topic_id_foreign');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_accessory_type_id_foreign');
            $table->dropForeign('team_fk_9986809');
        });

        Schema::table('product_variations', function (Blueprint $table) {
            $table->dropForeign('product_variations_product_id_foreign');
            $table->dropForeign('product_variations_variation_category_id_foreign');
        });

        Schema::table('product_product_tag', function (Blueprint $table) {
            $table->dropForeign('product_id_fk_9558453');
            $table->dropForeign('product_tag_id_fk_9558453');
        });

        Schema::table('product_product_category', function (Blueprint $table) {
            $table->dropForeign('product_category_id_fk_9558452');
            $table->dropForeign('product_id_fk_9558452');
        });

        Schema::table('product_price_tiers', function (Blueprint $table) {
            $table->dropForeign('product_price_tiers_product_id_foreign');
        });

        Schema::table('product_favorites', function (Blueprint $table) {
            $table->dropForeign('product_favorites_product_id_foreign');
            $table->dropForeign('product_favorites_user_id_foreign');
        });

        Schema::table('product_collection_items', function (Blueprint $table) {
            $table->dropForeign('product_collection_items_product_collection_id_foreign');
            $table->dropForeign('product_collection_items_product_id_foreign');
        });

        Schema::table('product_bundle_items', function (Blueprint $table) {
            $table->dropForeign('product_bundle_items_bundle_product_id_foreign');
            $table->dropForeign('product_bundle_items_item_product_id_foreign');
        });

        Schema::table('product_accessory', function (Blueprint $table) {
            $table->dropForeign('product_accessory_accessory_id_foreign');
            $table->dropForeign('product_accessory_product_id_foreign');
        });

        Schema::table('permission_role', function (Blueprint $table) {
            $table->dropForeign('permission_id_fk_9558359');
            $table->dropForeign('role_id_fk_9558359');
        });

        Schema::table('page_sections', function (Blueprint $table) {
            $table->dropForeign('page_sections_content_page_id_foreign');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('client_fk_9986973');
            $table->dropForeign('team_fk_9935719');
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign('items_fk_9986974');
            $table->dropForeign('product_fk_9986962');
            $table->dropForeign('team_fk_9986972');
        });

        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropForeign('menu_items_menu_foreign');
        });

        Schema::table('faq_questions', function (Blueprint $table) {
            $table->dropForeign('category_fk_9558427');
        });

        Schema::table('content_pages', function (Blueprint $table) {
            $table->dropForeign('content_pages_client_id_foreign');
        });

        Schema::table('content_page_content_tag', function (Blueprint $table) {
            $table->dropForeign('content_page_id_fk_9558414');
            $table->dropForeign('content_tag_id_fk_9558414');
        });

        Schema::table('content_category_content_page', function (Blueprint $table) {
            $table->dropForeign('content_category_id_fk_9558413');
            $table->dropForeign('content_page_id_fk_9558413');
        });

        Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign('prices_fk_10288950');
            $table->dropForeign('team_fk_9986797');
        });

        Schema::table('client_product', function (Blueprint $table) {
            $table->dropForeign('client_id_fk_10112000');
            $table->dropForeign('product_id_fk_10112000');
        });

        Schema::table('client_prices', function (Blueprint $table) {
            $table->dropForeign('client_fk_10288983');
            $table->dropForeign('client_prices_product_id_foreign');
            $table->dropForeign('team_fk_9986806');
        });

        Schema::table('client_addresses', function (Blueprint $table) {
            $table->dropForeign('client_addresses_client_id_foreign');
        });

        Schema::table('accessory_variants', function (Blueprint $table) {
            $table->dropForeign('accessory_variants_accessory_id_foreign');
        });

        Schema::table('accessory_client_prices', function (Blueprint $table) {
            $table->dropForeign('accessory_client_prices_accessory_id_foreign');
            $table->dropForeign('accessory_client_prices_client_id_foreign');
        });

        Schema::table('accessories', function (Blueprint $table) {
            $table->dropForeign('accessories_accessory_type_id_foreign');
        });

        Schema::dropIfExists('variation_client_prices');

        Schema::dropIfExists('variation_categories');

        Schema::dropIfExists('users');

        Schema::dropIfExists('user_user_alert');

        Schema::dropIfExists('user_alerts');

        Schema::dropIfExists('telescope_monitoring');

        Schema::dropIfExists('telescope_entries_tags');

        Schema::dropIfExists('telescope_entries');

        Schema::dropIfExists('teams');

        Schema::dropIfExists('tasks');

        Schema::dropIfExists('task_task_tag');

        Schema::dropIfExists('task_tags');

        Schema::dropIfExists('task_statuses');

        Schema::dropIfExists('settings');

        Schema::dropIfExists('roles');

        Schema::dropIfExists('role_user');

        Schema::dropIfExists('reminders');

        Schema::dropIfExists('qa_topics');

        Schema::dropIfExists('qa_messages');

        Schema::dropIfExists('products');

        Schema::dropIfExists('product_variations');

        Schema::dropIfExists('product_tags');

        Schema::dropIfExists('product_product_tag');

        Schema::dropIfExists('product_product_category');

        Schema::dropIfExists('product_price_tiers');

        Schema::dropIfExists('product_favorites');

        Schema::dropIfExists('product_collections');

        Schema::dropIfExists('product_collection_items');

        Schema::dropIfExists('product_categories');

        Schema::dropIfExists('product_bundle_items');

        Schema::dropIfExists('product_accessory');

        Schema::dropIfExists('personal_access_tokens');

        Schema::dropIfExists('permissions');

        Schema::dropIfExists('permission_role');

        Schema::dropIfExists('password_resets');

        Schema::dropIfExists('page_sections');

        Schema::dropIfExists('orders');

        Schema::dropIfExists('order_items');

        Schema::dropIfExists('menus');

        Schema::dropIfExists('menu_items');

        Schema::dropIfExists('media');

        Schema::dropIfExists('faq_questions');

        Schema::dropIfExists('faq_categories');

        Schema::dropIfExists('content_tags');

        Schema::dropIfExists('content_pages');

        Schema::dropIfExists('content_page_content_tag');

        Schema::dropIfExists('content_category_content_page');

        Schema::dropIfExists('content_categories');

        Schema::dropIfExists('clients');

        Schema::dropIfExists('client_product');

        Schema::dropIfExists('client_prices');

        Schema::dropIfExists('client_addresses');

        Schema::dropIfExists('audit_logs');

        Schema::dropIfExists('accessory_variants');

        Schema::dropIfExists('accessory_types');

        Schema::dropIfExists('accessory_client_prices');

        Schema::dropIfExists('accessories');
    }
};
