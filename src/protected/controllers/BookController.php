<?php

class BookController extends Controller
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
        $dataProvider = new CActiveDataProvider('Book', [
            'pagination' => ['pageSize' => 10],
            'criteria' => ['order' => 'year DESC, title ASC'],
        ]);

        $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $this->render('view', [
            'model' => $this->loadModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Book();

        if (isset($_POST['Book'])) {
            $model->attributes = $_POST['Book'];
            $authorIds = isset($_POST['Book']['authorIds']) ? $_POST['Book']['authorIds'] : [];
            $model->authorIds = $authorIds;
            if ($model->saveWithAuthors($authorIds)) {
                $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $this->render('create', [
            'model' => $model,
            'authors' => $this->getAuthorsList(),
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $model->authorIds = CHtml::listData($model->authors, 'id', 'id');

        if (isset($_POST['Book'])) {
            $model->attributes = $_POST['Book'];
            $authorIds = isset($_POST['Book']['authorIds']) ? $_POST['Book']['authorIds'] : [];
            $model->authorIds = $authorIds;
            if ($model->saveWithAuthors($authorIds)) {
                $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $this->render('update', [
            'model' => $model,
            'authors' => $this->getAuthorsList(),
        ]);
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
        $this->redirect(['index']);
    }

    protected function loadModel($id)
    {
        $model = Book::model()->with('authors')->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'Book not found.');
        }
        return $model;
    }

    protected function getAuthorsList()
    {
        $authors = Author::model()->findAll(['order' => 'name']);
        return CHtml::listData($authors, 'id', 'name');
    }
}
