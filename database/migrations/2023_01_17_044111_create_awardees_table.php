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
        Schema::create('awardees', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('address');
            $table->string('phone');
            $table->string('level');
            $table->string('gen');
            $table->string('picture')->nullable();
            $table->enum('status', ['aktif', 'nonaktif', 'pending'])->default('pending');
            $table->string('account_number');
            $table->string('bank');
            $table->string('status_detail')->nullable();
            $table->string('front_home')->nullable();
            $table->string('side_home')->nullable();
            $table->string('back_home')->nullable();
            $table->string('register_proof')->nullable();
            $table->string('cv')->nullable();
            $table->string('surat_ket_tidak_mampu')->nullable();
            $table->string('certificates')->nullable();
            $table->string('identity')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('parent_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('operator_id')->constrained()->references('id')->on('users')->onDelete('CASCADE');
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
        Schema::dropIfExists('awardees');
    }
};
