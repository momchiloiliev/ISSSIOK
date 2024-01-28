<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('title');
            // $table->foreignId('author'')->constrained('users'); // Assuming 'author'' is a foreign key referencing 'id' in 'users' table
            $table->unsignedBigInteger('author')->default(0);
            // $table->foreign('author')->references('id')->on('users')->onDelete('cascade');
            $table->text('body');
            $table->string('slug')->unique();
            $table->timestamp('published_on')->nullable();
            $table->timestamp('last_modified')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Reverse the changes made in the 'up' method
            $table->dropColumn(['title', 'author', 'body', 'slug', 'published_on', 'last_modified']);
        });
        
    }


};
