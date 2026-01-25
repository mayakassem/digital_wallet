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
        Schema::create('bank_webhooks', function (Blueprint $table) {
            $table->id();
            $table->string('bank');
            $table->text('payload');
            $table->enum('status', ['pending', 'processed'])->default('pending');
            $table->dateTime('received_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_webhooks');
    }
};
