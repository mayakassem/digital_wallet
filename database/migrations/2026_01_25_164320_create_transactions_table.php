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
        Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('client_id');
        $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');

        $table->string('reference');
        $table->decimal('amount', 12, 2);
        $table->date('transaction_date');
        $table->string('bank_name');

        $table->timestamps();

        $table->unique(['reference', 'bank_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
