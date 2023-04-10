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
        Schema::create('rts_contribution', function (Blueprint $table) {
            $table->id();
            $table->integer('rts_id');
            $table->string('contribution_amount_suggestion')->comment('by the coordinator');
            $table->json('contribution_detail')->comment('id,created_at,updated_at, member_id, member_suggested_amount')->nullable();
            $table->string('computed_contribution_amount')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rts_contribution');
    }
};
