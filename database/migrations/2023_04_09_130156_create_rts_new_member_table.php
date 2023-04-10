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
        Schema::create('rts_new_member', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rts_id')->constrained('rts_group')->onDelete('cascade');
            $table->json('new_member_details')->comment('requester_id,reason, new_member-user_id-this can be used to fetch the new_member\'s details');
            $table->json('new_member_answers')->comment('created_at,updated_at, member_id, member_answer');
            $table->string('new_member_decision')->comment('yes,no->computed based on tha Yes mean all is yes, no mean one of the answer is no');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rts_new_member');
    }
};
