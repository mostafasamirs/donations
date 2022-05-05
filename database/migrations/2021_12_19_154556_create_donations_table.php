<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('kiosk_id');
            $table->foreign('kiosk_id')->references('id')->on('kiosks')->onDelete('cascade');

            $table->unsignedBigInteger('donator_id')->nullable();
            $table->foreign('donator_id')->references('id')->on('donators')->onDelete('cascade');

            // $table->string('phone')->unique();
            $table->double('amount', 8, 2)->default(0);
            // $table->timestamp('date')->useCurrent();
            $table->softDeletes();
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
        Schema::dropIfExists('donations');
    }
}
