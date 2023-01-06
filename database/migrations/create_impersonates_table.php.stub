<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('impersonates', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('impersonated_id')->comment('Original user id');
            $table->foreignId('user_id');
            $table->dateTime('logged_in')->nullable();
            $table->dateTime('logouted_at')->nullable();
            $table->text('ip_address')->nullable();
            $table->text('user_agent')->nullable();
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
        Schema::dropIfExists('impersonates');
    }
};
