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
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('book_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('quantity')->default(1);
            $table->timestamp('requested_at');
            $table->timestamp('approved_at')->nullable();
            $table->date('borrow_date')->nullable();
            $table->timestamp('due_date')->nullable();
            $table->timestamp('returned_at')->nullable();
            $table->enum('status', ['menunggu', 'diterima', 'ditolak', 'dipinjam', 'dikembalikan'])->default('menunggu');
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
