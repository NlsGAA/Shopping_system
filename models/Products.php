<?php

class Product
{
    private $id;
    private $title;
    private $description;
    private float $value;

    public function setId($id)
    {
        $this->id = trim($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTitle($title)
    {
        $this->title = ucfirst(trim($title));
    }

    public function getTitle()
    {
        return $this->title;
    }
    public function setDescription($description)
    {
        $this->description = ucfirst($description);
    }

    public function getDescription()
    {
        return $this->description;
    }
    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return number_format($this->value, 2);
    }
}

interface ProductDAOModel
{
    public function add(Product $product);
    public function findAll();
    public function findById($id);
    public function findByTitle($title);
    public function updateProduct(Product $product);
    public function deleteProduct($id);
}
