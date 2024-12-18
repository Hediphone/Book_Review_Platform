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
    // Hashing existing passwords in the 'users' table
    DB::table('users')->get()->each(function ($user) {
        // Hash the password without checking its current algorithm (assuming it's not hashed)
        $hashedPassword = Hash::make($user->password);  // Hash the plain-text password
        DB::table('users')->where('userID', $user->userID)->update(['password' => $hashedPassword]);  // Save the hashed password
    });
}

public function down()
{
    // This rollback method won't undo the password hash since bcrypt hashes are irreversible
}
};
