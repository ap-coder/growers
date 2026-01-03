<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemsWpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( config('menu.table_prefix') . config('menu.table_name_items') , function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('label');
            $table->unsignedBigInteger('parent')->default(0);
            $table->integer('sort')->default(0);
            $table->string('class')->nullable();
            $table->unsignedBigInteger('menu');
            $table->integer('depth')->default(0);

            $table->boolean('local')->default(1)->nullable();
            $table->boolean('development')->default(1)->nullable();
            $table->boolean('stage')->default(0)->nullable();
            $table->boolean('production')->default(0)->nullable();
            $table->boolean('marketing')->default(0)->nullable();
            $table->boolean('logged_in_only')->default(0)->nullable();
            $table->boolean('icon_only_menu')->default(0)->nullable();
            $table->string('link')->nullable()->change();
            $table->string('menu_icon_class')->nullable();
            
            $table->timestamps();

            $table->foreign('menu')->references('id')->on(config('menu.table_prefix') . config('menu.table_name_menus'))
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( config('menu.table_prefix') . config('menu.table_name_items'));
    }
}
