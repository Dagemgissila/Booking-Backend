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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete("cascade")->onUpdate("cascade");
            $table->foreignId('room_id')->constrained('rooms')->onDelete("cascade")->onUpdate("cascade");
            $table->double("total_price");
            $table->dateTime("start_time");
            $table->dateTime("end_time");
            $table->string("reservation_code");
            $table->text("note");
            $table->enum("status", ["active", "completed"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
