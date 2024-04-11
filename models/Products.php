<?php

class Product
{
    private $id;
    private $company_id;
    private $title;
    private $description;
    private $value;
    private string $purchase_date;
    private $image;

    public function setId($id)
    {
        $this->id = trim($id);
    }

    public function getId()
    {
        return $this->id;
    }
    public function setCompany_Id($company_id)
    {
        $this->company_id = trim($company_id);
    }

    public function getCompany_Id()
    {
        return $this->company_id;
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
        $this->value = intval($value);
    }

    public function getValue()
    {
        return number_format($this->value, 2, ',', '.');
    }
    public function setPurchase_date($purchase_date)
    {
        $this->purchase_date = $purchase_date;
    }

    public function getPurchase_date()
    {
        return $this->purchase_date;
    }
    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }
}

interface ProductDAOModel
{
    public function validateImage($fileName, $fileType, $fileSize);
    public function uploadImage($fileName, $tmpName);
    public function add(Product $product);
    public function findAll();
    public function findPurchaseHistory($user_id);
    public function findById($id);
    public function findByCompanyId($company_id);
    public function findByTitle($title);
    public function updateProduct(Product $product);
    public function deleteProduct($id);
}
