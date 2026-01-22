<?php

use PHPUnit\Framework\TestCase;

class BookTest extends TestCase
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

    public function testCreateBookWithAuthor()
    {
        $author = new Author();
        $author->name = 'Author ' . uniqid('book_', true);
        $this->assertTrue($author->save());
        $this->authorId = $author->id;

        $book = new Book();
        $book->isbn = 'ISBN-' . substr(md5($author->name), 0, 8);
        $book->title = 'Book ' . uniqid('title_', true);
        $book->year = 2024;
        $book->image_url = 'https://example.com/cover-' . $author->id . '.jpg';
        $book->description = 'Test description';

        $this->assertTrue($book->saveWithAuthors([$author->id]));
        $this->bookId = $book->id;

        $reloaded = Book::model()->with('authors')->findByPk($this->bookId);
        $this->assertNotNull($reloaded);
        $this->assertCount(1, $reloaded->authors);
        $this->assertSame((int) $author->id, (int) $reloaded->authors[0]->id);
    }
}
