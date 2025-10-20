<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBadgesTable extends Migration
{
    public function up()
    {
        Schema::create('badges', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('icon')->nullable();
            $table->string('type')->default('reputation');
            $table->integer('threshold')->nullable();
            $table->json('filters')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_auto')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        DB::table('badges')->insert([
        [
            'title' => 'Ulysse',
            'slug' => 'ulysse-badge',
            'icon' => 'ulysse-plus.svg',
            'type' => 'reputation',
            'threshold' => 0,
            'is_auto' => true,
        ],
        [
            'title' => 'Ulysse+',
            'slug' => 'ulysse-plus',
            'icon' => 'ulysse-plus.svg',
            'type' => 'reputation',
            'threshold' => 100,
            'is_auto' => true,
        ],
        [
            'title' => 'Top Ulysse',
            'slug' => 'top-ulysse',
            'icon' => 'top-ulysse.svg',
            'type' => 'reputation',
            'threshold' => 200,
            'is_auto' => true,
        ],
        [
            'title' => 'Ulysse Diamond',
            'slug' => 'ulysse-diamond',
            'icon' => 'ulysse-diamond.svg',
            'type' => 'reputation',
            'threshold' => 300,
            'is_auto' => true,
        ],
    ]);

    }

    public function down()
    {
        Schema::dropIfExists('badges');
    }
}

