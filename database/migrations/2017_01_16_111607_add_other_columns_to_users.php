<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOtherColumnsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
         Schema::table('users', function (Blueprint $table) {
            $table->string('about')->after('email');
            $table->string('profile_photo')->default('default.png')->after('about');
            $table->integer('num_of_articles')->unsigned()->default(0)->after('profile_photo');
            $table->float('avg_readability',6,2)->default(0.0)->after('num_of_articles');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['about', 'profile_photo', 'num_of_articles', 'avg_readability']);
        });
    }
}
