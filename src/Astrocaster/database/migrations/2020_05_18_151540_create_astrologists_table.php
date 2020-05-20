<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAstrologistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('astrologists', function (Blueprint $table) {
            $table->id();
            $table->string('first_name',20);
            $table->string('last_name',30);
            $table->string('patronymic_name',30)->nullable();
            $table->string('email',50);
            $table->string('photo_name',256);
            $table->longText('bio');
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
        Schema::dropIfExists('astrologists');
    }
}
