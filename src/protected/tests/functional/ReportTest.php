<?php

use PHPUnit\Framework\TestCase;

class ReportTest extends TestCase
{
    private $authorId;
    private $bookId;

    protected function tearDown(): void
    {
        if ($this->bookId) {
            Book::model()->deleteByPk($this->bookId);
        }
        if ($this->authorId) {
            Author::model()->deleteByPk($this->authorId);
        }
        parent::tearDown();
    }

    public function testTopAuthorsByYearContainsAuthor()
    {
        $author = new Author();
        $author->name = 'Author ' . uniqid('report_', true);
        $this->assertTrue($author->save());
        $this->authorId = $author->id;

        $book = new Book();
        $book->isbn = 'ISBN-' . substr(md5($author->name), 0, 8);
        $book->title = 'Book ' . uniqid('report_', true);
        $book->year = 2023;
        $book->image_url = 'https://example.com/report-' . $author->id . '.jpg';
        $book->description = 'Report test book';

        $this->assertTrue($book->saveWithAuthors([$author->id]));
        $this->bookId = $book->id;

        $rows = Author::getTopAuthorsByYear(2023);
        $names = [];
        foreach ($rows as $row) {
            $names[] = $row['name'];
        }
        $this->assertContains($author->name, $names);
    }
}
