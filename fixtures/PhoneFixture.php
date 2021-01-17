<?php
namespace app\fixtures;

use yii\test\ActiveFixture;

class PhoneFixture extends ActiveFixture
{
    public $modelClass = 'app\models\Phone';
    public $dataFile = __DIR__.'/data/phones.php';

}
