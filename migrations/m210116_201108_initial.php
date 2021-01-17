<?php

use yii\db\Migration;
use app\models\Contact;
use app\models\Phone;
/**
 * Class m210116_201108_initial
 */
class m210116_201108_initial extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable(Contact::tableName(),[
            'id' => $this->primaryKey(),
            'first_name' => $this->string(),
            'last_name' => $this->string(),
            'email' => $this->string(),
            'birth_date' => $this->date(),
        ],
            'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->createTable(Phone::tableName(),[
            'id' => $this->primaryKey(),
            'contact_id' => $this->integer(),
            'value' => $this->string(),
        ],
            'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->addForeignKey('fk-'.Phone::tableName().'-contact_id',
            Phone::tableName(),'contact_id',
            Contact::tableName(),
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('fk-'.Phone::tableName().'-contact_id',Phone::tableName());
        $this->dropTable(Phone::tableName());
        $this->dropTable(Contact::tableName());
    }

}
