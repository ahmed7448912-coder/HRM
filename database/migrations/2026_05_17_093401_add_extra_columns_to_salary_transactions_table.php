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
        Schema::table('salary_transactions', function (Blueprint $table) {
            $table->string('currency')->default('usd')->after('amount');
            $table->string('email_sent_to')->nullable()->after('status');
            $table->timestamp('email_sent_at')->nullable()->after('email_sent_to');
            $table->json('stripe_response')->nullable()->after('email_sent_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('salary_transactions', function (Blueprint $table) {
            $table->dropColumn(['currency', 'email_sent_to', 'email_sent_at', 'stripe_response']);
        });
    }
};
