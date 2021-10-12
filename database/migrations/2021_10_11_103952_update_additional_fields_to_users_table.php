<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAdditionalFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('gender')->nullable();
            $table->string('telephone')->nullable();
            $table->string('customer_profile')->nullable();
            $table->string('short_description')->nullable();
            $table->string('prefered_language')->nullable();
            $table->string('fidelity_consent')->nullable();
            $table->string('fidelity_card')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();
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
            $table->dropColumn('gender');
            $table->dropColumn('telephone');
            $table->dropColumn('customer_profile');
            $table->dropColumn('short_description');
            $table->dropColumn('prefered_language');
            $table->dropColumn('fidelity_consent');
            $table->dropColumn('fidelity_card');
            $table->dropColumn('address');
            $table->dropColumn('city');
            $table->dropColumn('postal_code');
            $table->dropColumn('country');
        });
    }
}
