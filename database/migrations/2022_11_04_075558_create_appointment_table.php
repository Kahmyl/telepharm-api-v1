<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('symptoms');
            $table->string('duration');
            $table->string('is_on_medication');
            $table->string('medication')->nullable();
            $table->string('has_drug_allergy');
            $table->string('drug_allergy')->nullable();
            $table->string('has_previous_condition');
            $table->string('previous_condition')->nullable();
            $table->string('status')->default('pending');
            $table->bigInteger('doctor_id')->unsigned();
            $table->bigInteger('patient_id')->unsigned();
            // $table->foreignIdFor(User::class);
            $table->timestamps();
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number')->default('xxxxx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointment');
    }
};
