<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $driver = Schema::connection($this->getConnection())->getConnection()->getDriverName();

        Schema::table('nominees', function (Blueprint $table) use ($driver) {
            $table->string('biography')->nullable()->change();
            $table->string('link_to_page')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nominees', function (Blueprint $table) {
            $table->string('biography')->nullable(false)->change();
            $table->string('link_to_page')->nullable(false)->change();
        });
    }
};
