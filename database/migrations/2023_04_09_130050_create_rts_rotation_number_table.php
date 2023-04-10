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
        Schema::create('rts_rotation_number', function (Blueprint $table) {
            $table->id();
            $table->integer('rts_id');
            $table->string('rotation_number_suggestion')->comment('by the coordinator');;
            $table->json('rotation_number_detail')->comment('created_at,updated_at, member_id, member_suggested_amount')->nullable();
            $table->json('computed_rotation_number')->comment('member_id,rotation_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rts_rotation_number');
    }
};
