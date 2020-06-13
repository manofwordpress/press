<?php
/**
 * Created by PhpStorm.
 * User: amrsharkas
 * Date: 12/06/2020
 * Time: 10:57 AM
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{

    public function up()
    {
        Schema::create('posts',function(Blueprint $table){
            $table->increments('id');
            $table->string('identifier')->index();
            $table->string('slug')->unique()->index();
            $table->string('title');
            $table->text('body');
            $table->text('extra');
            $table->timestamps();

            $table->index('created_at');
            $table->index('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}