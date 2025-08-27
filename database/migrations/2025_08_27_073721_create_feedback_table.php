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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Anonymous but still linked to user
            $table->string('title');
            $table->text('description');
            $table->enum('category', ['feature', 'improvement', 'bug', 'other'])->default('feature');
            $table->enum('status', ['open', 'in_progress', 'completed', 'declined'])->default('open');
            $table->integer('upvotes')->default(0);
            $table->integer('downvotes')->default(0);
            $table->boolean('is_anonymous')->default(true);
            $table->timestamps();
            
            $table->index(['status', 'created_at']);
            $table->index(['upvotes', 'downvotes']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
