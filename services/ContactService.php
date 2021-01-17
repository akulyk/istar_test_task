<?php

namespace app\services;

use app\models\Contact;
use app\models\form\ContactFormModel;
use app\models\Phone;
use app\models\search\ContactSearch;
use yii\data\ActiveDataProvider;

class ContactService {

    public function findModel(int $id): ?Contact
    {
        return Contact::findOne($id);
    }

    public function findFormModel(int $id): ?Contact
    {
        return ContactFormModel::findOne($id);
    }

    public function getFormModel($config = []): Contact
    {
        return new ContactFormModel($config);
    }

    public function getSearchModel(array $config = []): ContactSearch
    {
        return new ContactSearch($config);
    }

    public function getDataProvider(ContactSearch $model, array $params = []): ActiveDataProvider
    {
        $query = Contact::find()->alias('contact');
        $dataProvider = new ActiveDataProvider([
           'query' => $query
        ]);

        $model->load($params);
        if(!$model->validate())
        {
            return $dataProvider;
        }
        if($model->phone) {
            $subQuery = Phone::find()->andFilterWhere(['like', 'value', $model->phone])
                ->select('contact_id')->groupBy('contact_id');
            $query->innerJoin(['existPhones' => $subQuery], 'contact.id = existPhones.contact_id');
        }

        $query->andFilterWhere(['like','contact.first_name', $model->first_name])
            ->andFilterWhere(['like','contact.last_name', $model->last_name]);


        return $dataProvider;
    }

    public function handleContactCreate(ContactFormModel $model,$post = []): bool
    {
        if(!$model->load($post))
        {
            return false;
        }

        if(!$model->validate())
        {
            return false;
        }
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $model->save(false);
            $rows = [];
            foreach ($model->userPhones as $phone) {
                $rows[] = [$model->id, $phone];
            }
            $command = \Yii::$app->db->createCommand()->batchInsert(Phone::tableName(), ['contact_id', 'value'], $rows);
            $command->execute();
            $transaction->commit();
            return true;
        } catch (\Exception $e)
        {
            \Yii::error($e->getMessage());
            $transaction->rollBack();
            return false;
        }

    }

    public function handleContactUpdate(ContactFormModel $model,$post = []): bool
    {
        if(!$model->load($post))
        {
            return false;
        }

        if(!$model->validate())
        {
            return false;
        }

        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $model->save(false);
            Phone::deleteAll(['contact_id' => $model->id]);
            $rows = [];
            foreach ($model->userPhones as $phone) {
                $rows[] = [$model->id, $phone];
            }
            $command = \Yii::$app->db->createCommand()->batchInsert(Phone::tableName(), ['contact_id', 'value'], $rows);
            $command->execute();
            $transaction->commit();
            return true;
        } catch (\Exception $e)
        {
            \Yii::error($e->getMessage());
            $transaction->rollBack();
            return false;
        }
    }

    public function handleContactDelete(Contact $model): bool
    {
        return !!$model->delete();
    }


}
