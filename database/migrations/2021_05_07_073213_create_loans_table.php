<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->string('loan_id');
            $table->string('client_id');
            $table->string('amount');
            $table->string('security');
            $table->string('interest');
            $table->string('period');
            $table->string('guarantor_one_name')->nullable();
            $table->string('guarantor_one_phone')->nullable();
            $table->string('guarantor_two_name')->nullable();
            $table->string('guarantor_two_phone')->nullable();
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
        Schema::dropIfExists('loans');
    }
}
