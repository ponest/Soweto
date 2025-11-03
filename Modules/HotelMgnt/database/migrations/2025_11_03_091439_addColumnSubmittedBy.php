<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table("client_wallets", function (Blueprint $table) {
            $table->boolean("is_active")->default(false);
            $table->string("status")->default("draft");
            $table->foreignId("submitted_by")->nullable()->constrained("users");
            $table->dateTime("submitted_at")->nullable();
            $table->foreignId("reviewed_by")->nullable()->constrained("users");
            $table->dateTime("reviewed_at")->nullable();
            $table->boolean("is_approved")->nullable();
            $table->text("reject_comments")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table("client_wallets", function (Blueprint $table) {
            $table->dropForeign("client_wallets_submitted_by_foreign");
            $table->dropForeign("client_wallets_reviewed_by_foreign");
            $table->dropColumn("is_active");
            $table->dropColumn("submitted_by");
            $table->dropColumn("submitted_at");
            $table->dropColumn("reviewed_at");
            $table->dropColumn("reviewed_by");
            $table->dropColumn("is_approved");
            $table->dropColumn("reject_comments");
            $table->dropColumn("status");
        });
    }
};
