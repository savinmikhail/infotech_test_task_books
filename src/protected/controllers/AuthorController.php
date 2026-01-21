<?php

class AuthorController extends Controller
{
    public function filters()
    {
        return [
            'accessControl',
            'postOnly + delete',
        ];
    }

    public function accessRules()
    {
        return [
            ['allow',
                'actions' => ['index', 'view'],
                'users' => ['*'],
            ],
            ['allow',
                'actions' => ['create', 'update', 'delete'],
                'users' => ['@'],
            ],
            ['deny',
                'users' => ['*'],
            ],
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Author', [
            'pagination' => ['pageSize' => 10],
            'criteria' => ['order' => 'name ASC'],
        ]);

        $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->loadModel($id);
        $subscription = new Subscription();
        $subscription->author_id = $model->id;

        if (isset($_POST['Subscription'])) {
            if (!Yii::app()->user->isGuest) {
                throw new CHttpException(403, 'Subscription is available for guests only.');
            }
            $subscription->attributes = $_POST['Subscription'];
            $subscription->author_id = $model->id;
            if ($subscription->save()) {
                Yii::app()->user->setFlash('success', 'Subscription created.');
                $this->refresh();
            }
        }

        $this->render('view', [
            'model' => $model,
            'subscription' => $subscription,
        ]);
    }

    public function actionCreate()
    {
        $model = new Author();

        if (isset($_POST['Author'])) {
            $model->attributes = $_POST['Author'];
            if ($model->save()) {
                $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['Author'])) {
            $model->attributes = $_POST['Author'];
            if ($model->save()) {
                $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
        $this->redirect(['index']);
    }

    protected function loadModel($id)
    {
        $model = Author::model()->with('books')->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'Author not found.');
        }
        return $model;
    }
}
