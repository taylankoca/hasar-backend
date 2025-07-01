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
        Schema::create('module_invoice_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoiceNo')->unique()->nullable();
            $table->string('customerKey')->nullable(); // email
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->date('dueDate')->nullable();
            $table->enum('paymentType', ['Credit Card', 'PayPal', 'Bank Transfer'])->nullable();
            $table->enum('status', ['Pending', 'Paid', 'Overdue'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_invoice_invoices');
    }
};
