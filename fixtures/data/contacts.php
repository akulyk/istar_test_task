<?php

$faker = Faker\Factory::create('en_US');
$count = Yii::$app->params['fixturesContactAmount'] ?? 100;
$contacts  = [];

for ($i = 1;$i <= $count; $i++)
{
    $contact = [
        'id' => $i,
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'birth_date' =>  $faker->dateTimeBetween('1970-01-01', '2003-01-01')
            ->format('Y-m-d'),
    ];
    $contacts[] = $contact;
}

return $contacts;
