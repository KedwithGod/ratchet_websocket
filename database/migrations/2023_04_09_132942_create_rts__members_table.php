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
        Schema::create('rts__members', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('members_name');
            $table->integer('member_user_id');
            $table->integer('rts_id');
            // when the rts is renewed members that accept renewal will be kept, members that reject it, will be achieved
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rts__members');
    }
};
