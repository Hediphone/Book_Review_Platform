<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add the remember_token column if missing
            $table->rememberToken();

            // // Add created_at and updated_at with current timestamps as default
            // $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            // $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'))->useCurrentOnUpdate();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the remember_token column
            // $table->dropColumn('remember_token');

            // Drop created_at and updated_at
            // $table->dropColumn('created_at');
            // $table->dropColumn('updated_at');
        });
    }


};
