<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu_item_package', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_item_id')->constrained('menu')->onDelete('cascade');
            $table->foreignId('package_id')->constrained()->onDelete('cascade');
            // Tambahkan kolom deskripsi pilihan jika perlu
            // $table->string('category_in_package'); // e.g., 'Pilihan Lauk Utama'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_item_package');
    }
};
