<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateCouriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('couriers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('title');
            $table->timestamps();
        });
        DB::table('couriers')->insert([
            ['code' => 'jne', 'title' => 'JNE', 'status' => 'active'],
            ['code' => 'pos', 'title' => 'POS', 'status' => 'active'],
            ['code' => 'tiki', 'title' => 'TIKI', 'status' => 'active']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('couriers');
    }
}
