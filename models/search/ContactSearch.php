<?php

namespace app\models\search;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;


class ContactSearch extends \app\models\Contact
{
    public $phone;

    public function rules()
    {
        return [
            [['first_name', 'phone', 'last_name'], 'trim'],
            [['first_name', 'phone', 'last_name'], 'string']
        ];
    }
}
