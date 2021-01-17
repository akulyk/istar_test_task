<?php

$faker = $faker = Faker\Factory::create('en_US');
$contacts = Yii::$app->params['fixturesContactAmount'] ?? 100;
$maxAmountOfPhones = \Yii::$app->params['maxAmountOfPhones'] ?? 7;

$phones  = [];
$j = 1;

for ($i = 1;$i <= $contacts; $i++)
{
    $n = mt_rand(1,$maxAmountOfPhones);
    for($p = 1; $p <= $n; $p++)
    {
        $value = '380';
        $value .= $faker->randomNumber(9);
        //otherwise can be less then 12 digits
        $length = mb_strlen($value);
        if($length < 12)
        {
            $value .= $faker->randomNumber(12-$length);
        }
        $phones[] = [
          'id'=> $j,
          'contact_id' => $i,
          'value' => $value,
        ];
        $j++;
    }
}

return $phones;
