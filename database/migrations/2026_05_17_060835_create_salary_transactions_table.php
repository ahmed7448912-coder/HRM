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
        Schema::create('salary_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('salary_id')->constrained()->onDelete('cascade');
            $table->string('transaction_id');
            $table->decimal('amount', 10, 2);
            $table->string('currency')->default('usd');
            $table->string('payment_method')->default('stripe');
            $table->string('status');
            $table->string('email_sent_to')->nullable();
            $table->timestamp('email_sent_at')->nullable();
            $table->json('stripe_response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_transactions');
    }
};
