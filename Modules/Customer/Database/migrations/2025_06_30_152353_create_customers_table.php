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
        Schema::create('module_customer_customers', function (Blueprint $table) {
            $table->id();
            $table->enum('customerType', ['Bireysel', 'Kurumsal'])->nullable();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->date('createdAt')->nullable();
            $table->string('tckn', 11)->nullable();
            $table->string('vkn', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_customer_customers');
    }
};
