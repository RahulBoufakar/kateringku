<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropForeign(['menu_item_id']);
            $table->foreign('menu_item_id')
                ->references('id')
                ->on('menu')
                ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropForeign(['menu_item_id']);
            $table->foreign('menu_item_id')
                ->references('id')
                ->on('menu');
                // Default: no onDelete (equivalent to 'restrict')
        });
    }
};
