<?php

class Commentary
{

    private $product_id;
    private $id;
    private $author;
    private $commentary;
    private $commentary_date;
    private $commentary_id;
    private $avaliation;

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
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
        return $this->author;
    }
    public function setCommentary($commentary)
    {
        $this->commentary = $commentary;
    }
    public function getCommentary()
    {
        return $this->commentary;
    }
    public function setCommentaryId($commentary_id)
    {
        $this->commentary_id = $commentary_id;
    }
    public function getCommentaryId()
    {
        return $this->commentary_id;
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
