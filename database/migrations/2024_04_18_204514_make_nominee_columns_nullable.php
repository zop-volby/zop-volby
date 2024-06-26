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
            $table->text('biography')->nullable()->change();
            $table->text('link_to_page')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nominees', function (Blueprint $table) {
            $table->text('biography')->nullable(false)->change();
            $table->text('link_to_page')->nullable(false)->change();
        });
    }
};
