<?php

class Commentary
{

    private $id;
    private $author_id;
    private $author;
    private $product_id;
    private $commentary;
    private $commentary_date;
    private $avaliation;

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setAuthorId($author_id)
    {
        $this->author_id = $author_id;
    }
    public function getAuthorId()
    {
        return $this->author_id;
    }
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }
    public function getProductId()
    {
        return $this->product_id;
    }
    public function setAuthor($author)
    {
        $author = explode("@", $author);
        $this->author = $author[0];
    }
    public function getAuthor()
    {
        return ucfirst($this->author);
    }
    public function setCommentary($commentary)
    {
        $this->commentary = $commentary;
    }
    public function getCommentary()
    {
        return $this->commentary;
    }
    public function setAvaliation($avaliation)
    {
    }
    public function getAvaliation()
    {
    }

    public function setCommentaryDate($date)
    {
        $this->commentary_date = $date;
    }
    public function getCommentaryDate()
    {
        return $this->commentary_date;
    }
}

interface CommentaryDAOModel
{
    public function addCommentary(Commentary $commentary);
    public function commentaryInProduct($id);
    public function deleteCommentary($id);
}
