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
        Schema::create('pastas', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->longText('content');
            $table->string('hash');

            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->unsignedBigInteger('access_type');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pastas');
    }
};
