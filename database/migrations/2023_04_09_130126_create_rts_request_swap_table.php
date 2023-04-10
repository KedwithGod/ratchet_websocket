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
        Schema::create('rts_request_swap', function (Blueprint $table) {
            $table->id();
            $table->integer('rts_id');
            $table->json('swap_request_detail')->comment('requester_id,request_rotation_no, recipient_id, recipient_rotation_no');
            $table->json('swap_request_answers')->comment('created_at,updated_at, member_id, member_answer');
            $table->string('swap_computed_decision')->comment('yes,no->computed based on majority answer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rts_request_swap');
    }
};
