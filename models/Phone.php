<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Class Phone
 * @package app\models
 * @property int $id
 * @property int $contact_id
 * @property string $value
 * @property Contact $contact
 */
class Phone extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'phone';
    }

    public function getContact(): ActiveQuery
    {
        return $this->hasOne(Contact::class,['id'=>'contact_id']);
    }
}
