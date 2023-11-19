<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campaign>
 */
class CampaignFactory extends Factory
{

    public function definition(): array
    {
        $status = array('created','active','paused','disabled');
        $currentTimestamp = time();
        $range1InSeconds = 10 * 24 * 60 * 60;
        $randomSeconds1 = rand(0, $range1InSeconds);
        $randomTimestamp1 = $currentTimestamp + $randomSeconds1;
        $range2InSeconds = 30 * 24 * 60 * 60;
        $randomSeconds2 = rand(0, $range2InSeconds);
        $randomTimestamp2 = $randomTimestamp1 + $randomSeconds2;
        $randomDate1 = date("Y-m-d H:i:s", $randomTimestamp1);
        $randomDate2 = date("Y-m-d H:i:s", $randomTimestamp2);

        

        return [
            'user_id' => '9a95c9f0-c9a2-47d4-80b4-fb79d0ddb877',
            'name' => fake()->name(),
            'description' => fake()->words(200, true),
            'status' => $status[array_rand($status, 1)],
            'from' => $randomDate1,
            'to' => $randomDate2
        ];
    }
}


// $table->uuid('user_id');
// $table->string('name');
// $table->text('description')->nullable();
// $table->string('status')->default('created');
// $table->timestamp('from')->nullable();
// $table->timestamp('to')->nullable();