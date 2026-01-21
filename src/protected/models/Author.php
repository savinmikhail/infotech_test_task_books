<?php

class Author extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'author';
    }

    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'length', 'max' => 255],
            ['name', 'unique'],
            ['name', 'filter', 'filter' => 'strip_tags'],
        ];
    }

    public function relations()
    {
        return [
            'books' => [self::MANY_MANY, 'Book', 'book_author(author_id, book_id)'],
            'bookAuthors' => [self::HAS_MANY, 'BookAuthor', 'author_id'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Full name',
        ];
    }

    public static function getTopAuthorsByYear($year)
    {
        return Yii::app()->db->createCommand()
            ->select('a.id, a.name, COUNT(b.id) AS books_count')
            ->from('author a')
            ->join('book_author ba', 'ba.author_id = a.id')
            ->join('book b', 'b.id = ba.book_id')
            ->where('b.year = :year', [':year' => (int) $year])
            ->group('a.id, a.name')
            ->order('books_count DESC')
            ->limit(10)
            ->queryAll();
    }
}
