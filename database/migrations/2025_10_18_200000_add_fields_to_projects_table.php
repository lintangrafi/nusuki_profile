<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title');
            $table->string('client')->nullable()->after('category');
            $table->string('location')->nullable()->after('client');
            
            // Make sure the slug is unique
            $table->unique('slug');
        });
        
        // Populate the slug field for existing records
        \DB::table('projects')->orderBy('id')->chunk(100, function ($projects) {
            foreach ($projects as $project) {
                \DB::table('projects')
                    ->where('id', $project->id)
                    ->update(['slug' => Str::slug($project->title)]);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn(['slug', 'client', 'location']);
        });
    }
};