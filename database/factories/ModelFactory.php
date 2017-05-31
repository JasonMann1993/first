<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->userName,
        'openid' => str_random(28),
        'sex' => random_int(0, 1),
        'avatar' => $faker->imageUrl()
    ];
});


/**
 * 送水
 */
$factory->define(App\Models\DeliverWater::class, function (Faker\Generator $faker) {
    $userIds = \App\Models\User::pluck('id')->toArray();
    return [
        'user_id' => $faker->randomElement($userIds),
        'address' => $faker->address,
        'name' => $faker->title,
        'longitude' => $faker->longitude,
        'latitude' => $faker->latitude,
        'phone' => $faker->phoneNumber,
        'remark' => $faker->sentence,
        'status' => random_int(0, 3),
        'type' => true,
        'verify' => $faker->dateTimeBetween('-30 day')
    ];
});

/**
 * 搬家
 */
$factory->define(App\Models\HouseMoving::class, function (Faker\Generator $faker) {
    $userIds = \App\Models\User::pluck('id')->toArray();
    return [
        'user_id' => $faker->randomElement($userIds),
        'address' => $faker->address,
        'name' => $faker->title,
        'longitude' => $faker->longitude,
        'latitude' => $faker->latitude,
        'phone' => $faker->phoneNumber,
        'remark' => $faker->sentence,
        'status' => random_int(0, 3),
        'type' => true,
        'verify' => $faker->dateTimeBetween('-30 day')
    ];
});


/**
 * 图片
 */
$factory->define(App\Models\Img::class, function (Faker\Generator $faker) {
    return [
        'img' => $faker->imageUrl(),
    ];
});

/**
 * 租房
 */
$factory->define(App\Models\Rental::class, function (Faker\Generator $faker) {
    $userIds = \App\Models\User::pluck('id')->toArray();
    return [
        'user_id' => $faker->randomElement($userIds),
        'address' => $faker->address,
        'name' => $faker->title,
        'longitude' => $faker->longitude,
        'latitude' => $faker->latitude,
        'phone' => $faker->phoneNumber,
        'remark' => $faker->sentence,
        'status' => random_int(0, 3),
        'type' => true,
        'verify' => $faker->dateTimeBetween('-30 day'),
        'size' => random_int(10, 999),
        'cell_name' => $faker->streetName,
        'price' => random_int(10, 10000),
        'form' => random_int(1, 3),
        'require' => random_int(1, 2)
    ];
});

/**
 * 开锁
 */
$factory->define(App\Models\Unlock::class, function (Faker\Generator $faker) {
    $userIds = \App\Models\User::pluck('id')->toArray();
    return [
        'user_id' => $faker->randomElement($userIds),
        'address' => $faker->address,
        'name' => $faker->title,
        'longitude' => $faker->longitude,
        'latitude' => $faker->latitude,
        'phone' => $faker->phoneNumber,
        'remark' => $faker->sentence,
        'status' => random_int(0, 3),
        'type' => true,
        'verify' => $faker->dateTimeBetween('-30 day')
    ];
});
/**
 * 煤气
 */
$factory->define(App\Models\CoalGass::class, function (Faker\Generator $faker) {
    $userIds = \App\Models\User::pluck('id')->toArray();
    return [
        'user_id' => $faker->randomElement($userIds),
        'address' => $faker->address,
        'name' => $faker->title,
        'longitude' => $faker->longitude,
        'latitude' => $faker->latitude,
        'phone' => $faker->phoneNumber,
        'remark' => $faker->sentence,
        'status' => random_int(0, 3),
        'type' => true,
        'verify' => $faker->dateTimeBetween('-30 day')
    ];
});
/**
 * 回收
 */
$factory->define(App\Models\Recovery::class, function (Faker\Generator $faker) {
    $userIds = \App\Models\User::pluck('id')->toArray();
    return [
        'user_id' => $faker->randomElement($userIds),
        'address' => $faker->address,
        'name' => $faker->title,
        'longitude' => $faker->longitude,
        'latitude' => $faker->latitude,
        'phone' => $faker->phoneNumber,
        'remark' => $faker->sentence,
        'status' => random_int(0, 3),
        'type' => true,
        'verify' => $faker->dateTimeBetween('-30 day')
    ];
});
/**
 * 公厕
 */
$factory->define(App\Models\PublicToilet::class, function (Faker\Generator $faker) {
    $userIds = \App\Models\User::pluck('id')->toArray();
    return [
        'user_id' => $faker->randomElement($userIds),
        'address' => $faker->address,
        'name' => $faker->title,
        'longitude' => $faker->longitude,
        'latitude' => $faker->latitude,
        'remark' => $faker->sentence,
        'status' => random_int(0, 3),
        'type' => true,
        'verify' => $faker->dateTimeBetween('-30 day')
    ];
});
/**
 * 投诉
 */
$factory->define(App\Models\Complaint::class, function (Faker\Generator $faker) {
    $userIds = \App\Models\User::pluck('id')->toArray();
    return [
        'user_id' => $faker->randomElement($userIds),
        'reasons' => '假的#收费的',
        'remark' => $faker->sentence,
        'status' => rand(1,2),
        'detail' => $faker->sentence,
        'audited_at'=> $faker->dateTimeBetween('-30 day'),
        'common_id' => rand(1,50),
        'common_type' => App\Models\PublicToilet::class,
    ];
});