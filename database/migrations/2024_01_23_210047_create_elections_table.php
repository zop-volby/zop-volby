<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Election;
use App\Models\ElectionPhases;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('elections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTime('start_at');
            $table->string('phase');
            $table->timestamps();
        });

        Election::create([
            'name' => 'Zkušební volby',
            'start_at' => now()->addWeeks(5),
            'phase' => ElectionPhases::PREPARATION,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elections');
    }
};
