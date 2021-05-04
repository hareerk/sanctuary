<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('userid')->unsigned();
            $table->string('name', 30)->unique();
            $table->enum('gender',['male', 'female']);
            $table->string('species', 30);
            $table->date('date_of_birth');
            $table->string('description', 256)->nullable();
            $table->string('image', 256)->nullable();
            $table->boolean('available');
            $table->timestamps();
            $table->foreign('userid')->references('id')->on('users'); 
        });

        Schema::table('animals', function (Blueprint $table) {
            $table->dropColumn('available');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animals');
    }
}
