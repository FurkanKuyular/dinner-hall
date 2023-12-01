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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->float('price', 15);
            $table->float('point', 2);
            $table->string('order_id', 10);
            $table->string('user_id', 36);
            $table->string('ref_code', 10);
            $table->string('callback_success_url');
            $table->string('callback_fail_url');
            $table->string('hash', 40);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
