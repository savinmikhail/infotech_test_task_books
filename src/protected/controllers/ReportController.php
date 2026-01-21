<?php

class ReportController extends Controller
{
    public function filters()
    {
        return ['accessControl'];
    }

    public function accessRules()
    {
        return [
            ['allow',
                'users' => ['*'],
            ],
        ];
    }

    public function actionTopAuthors()
    {
        $years = Book::getAvailableYears();
        $this->render('topAuthors', [
            'years' => $years,
        ]);
    }

    public function actionTopAuthorsByYear($year)
    {
        $authors = Author::getTopAuthorsByYear($year);
        $this->render('topAuthorsByYear', [
            'year' => (int) $year,
            'authors' => $authors,
        ]);
    }
}
