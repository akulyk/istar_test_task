<?php

namespace app\controllers;

use app\services\ContactService;
use yii\base\Module;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class ContactController extends Controller
{

    protected ContactService $contactService;

    public function __construct($id, Module $module,
                                ContactService $contactService,
                                $config = [])
    {
        $this->contactService = $contactService;
        parent::__construct($id, $module, $config);
    }

    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = $this->contactService->getSearchModel();
        $dataProvider = $this->contactService->getDataProvider($searchModel,\Yii::$app->request->getQueryParams());
        return $this->render('index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView(int $id)
    {
        $model = $this->getModel($id);
        return $this->render('view',[
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = $this->contactService->getFormModel();
        if($this->contactService->handleContactCreate($model,\Yii::$app->request->post())){
            \Yii::$app->session->setFlash('success','Contact was created!');
            return $this->redirect(['view','id'=>$model->id]);
        }
        return $this->render('create',[
            'model' => $model,
        ]);
    }

    public function actionUpdate(int $id)
    {
        if(!$model = $this->contactService->findFormModel($id))
        {
            throw new NotFoundHttpException('Page not found');
        }
        if($this->contactService->handleContactUpdate($model,\Yii::$app->request->post())){
            \Yii::$app->session->setFlash('success','Contact was updated!');
            return $this->redirect(['view','id'=>$model->id]);
        }

        return $this->render('update',[
            'model' => $model,
        ]);
    }

    public function actionDelete(int $id)
    {
        $model = $this->getModel($id);
        if($this->contactService->handleContactDelete($model)) {
            \Yii::$app->session->setFlash('warning', 'Contact was deleted!');
            return $this->redirect(['index']);
        }
        \Yii::$app->session->setFlash('error', 'Contact was not deleted!');
        return $this->redirect(['view','id'=>$model->id]);
    }

    protected function getModel(int $id)
    {
        if(!$model = $this->contactService->findModel($id))
        {
            throw new NotFoundHttpException('Page not found');
        }
        return $model;
    }

}
