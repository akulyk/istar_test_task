<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Class Contact
 * @package app\models
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $birth_date
 * @property Phone[] $phones
 */
class Contact extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'contact';
    }

    public function getPhones(): ActiveQuery
    {
        return $this->hasMany(Phone::class, ['contact_id' => 'id'])->orderBy(['value'=>SORT_ASC]);
    }

    public function getFirstPhoneNumber(): ?string
    {
        if (!$phones = $this->phones) {
            return null;
        }
        return $phones[0]->value;
    }

    public function getPhonesList($glue = PHP_EOL): ?string
    {
        if (!$phones = $this->phones) {
            return null;
        }

        $data = [];
        foreach ($phones as $phone) {
            $data[] = $phone->value;
        }

        return implode($glue, $data);
    }

    public function getFullName()
    {
        return $this->first_name . ' '. $this->last_name;
    }
}
