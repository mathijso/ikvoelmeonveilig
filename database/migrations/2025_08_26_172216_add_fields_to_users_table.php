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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->text('emergency_contact_relationship')->nullable();
            $table->boolean('is_available_for_help')->default(true);
            $table->boolean('receive_notifications')->default(true);
            $table->string('google_id')->nullable();
            $table->string('avatar')->nullable();
            $table->timestamp('last_active_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone_number',
                'emergency_contact_name',
                'emergency_contact_phone',
                'emergency_contact_relationship',
                'is_available_for_help',
                'receive_notifications',
                'google_id',
                'avatar',
                'last_active_at'
            ]);
        });
    }
};
