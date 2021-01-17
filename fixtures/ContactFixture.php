<?php
namespace app\fixtures;

use yii\test\ActiveFixture;

class ContactFixture extends ActiveFixture
{
    public $modelClass = 'app\models\Contact';
    public $dataFile = __DIR__.'/data/contacts.php';

}
