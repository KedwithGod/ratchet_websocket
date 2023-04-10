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
        Schema::create('rts_saving_cycle', function (Blueprint $table) {
            $table->id();
            $table->integer('rts_id');
            $table->string('saving_cycle_suggestion')->comment('by the coordinator');
            $table->json('saving_cycle_detail')->comment('created_at,updated_at, member_id, member_suggested_cycle');
            $table->string('computed_saving_cycle');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rts_saving_cycle');
    }
};
