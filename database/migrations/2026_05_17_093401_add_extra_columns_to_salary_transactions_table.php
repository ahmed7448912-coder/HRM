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
            if (!Schema::hasColumn('salary_transactions', 'currency')) {
                $table->string('currency')->default('usd')->after('amount');
            }
            if (!Schema::hasColumn('salary_transactions', 'email_sent_to')) {
                $table->string('email_sent_to')->nullable()->after('status');
            }
            if (!Schema::hasColumn('salary_transactions', 'email_sent_at')) {
                $table->timestamp('email_sent_at')->nullable()->after('email_sent_to');
            }
            if (!Schema::hasColumn('salary_transactions', 'stripe_response')) {
                $table->json('stripe_response')->nullable()->after('email_sent_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('salary_transactions', function (Blueprint $table) {
            $cols = [];
            foreach (['currency', 'email_sent_to', 'email_sent_at', 'stripe_response'] as $col) {
                if (Schema::hasColumn('salary_transactions', $col)) {
                    $cols[] = $col;
                }
            }
            if (!empty($cols)) {
                $table->dropColumn($cols);
            }
        });
    }
};
