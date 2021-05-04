<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdoptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adoptions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('userid')->unsigned();
            $table->bigInteger('animalid')->unsigned();
            
            
            $table->boolean('approved')->default(FALSE);
            $table->timestamps();
            $table->foreign('userid')->references('id')->on('users');
            $table->foreign('animalid')->references('id')->on('animals');
            
            
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adoptions');
    }
}
