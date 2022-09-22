<?php

class Article
{
    protected $id;
    protected $title;
    protected $text;
    protected $author;

    public function __construct($id, $title, $text) {
        $this->id = $id;
        $this->title = $title;
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    public function view()
    {
        echo "$this->title $this->text";
    }
}

class Article2 extends Article {
    public function view2() {
        echo "$this->id $this->title $this->text";
    }
}

$article2 = new Article2('1', 'Заголовок', 'Наш текст');

$article2->view();
echo PHP_EOL;
$article2->view2();