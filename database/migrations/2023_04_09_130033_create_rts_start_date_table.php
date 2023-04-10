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
        Schema::create('rts_start_date', function (Blueprint $table) {
            $table->id();
            $table->integer('rts_id');
            $table->string('start_date_suggestion')->comment('by the coordinator');;
            $table->json('start_date_detail')->comment('created_at,updated_at, member_id, member_suggested_date')->nullable();
            $table->string('computed_start_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rts_start_date');
    }
};
