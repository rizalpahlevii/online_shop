<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddStatusToCouriers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('couriers', function (Blueprint $table) {
            $table->enum('status', ['active', 'inactive'])->default('active');
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
        Schema::table('couriers', function (Blueprint $table) {
            //
        });
    }
}
