<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funds', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('dana')->nullable();
            $table->string('spp')->nullable();
            $table->string('received_funds')->nullable();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('operator_id')->constrained()->references('id')->on('users')->onDelete('CASCADE');
            $table->string('catatan')->nullable();
            $table->string('invoice')->nullable();
            $table->enum('status', ['sudah transfer', 'belum transfer'])->default('belum transfer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funds');
    }
};
