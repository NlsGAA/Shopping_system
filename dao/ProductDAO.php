<?php
require_once __DIR__ . '/../models/Products.php';

class ProductDAO implements ProductDAOModel
{
    private $pdo;

    public function __construct(PDO $driver)
    {
        $this->pdo = $driver;
    }

    public function add(Product $product)
    {
        $sql = $this->pdo->prepare("INSERT INTO itens (title, description, value) VALUES (:title, :description, :value)");
        $sql->bindValue(':title', $product->getTitle());
        $sql->bindValue(':description', $product->getDescription());
        $sql->bindValue(':value', number_format($product->getValue(), 2));
        $sql->execute();

        $product->setId($this->pdo->lastInsertId());
        return $product;
    }
    public function findAll()
    {
        $productSelected = [];

        $sql = $this->pdo->query("SELECT * FROM itens");
        if ($sql->rowCount() > 0) {
            $productData = $sql->fetchAll(PDO::FETCH_ASSOC);

            foreach ($productData as $key_productData => $value_productData) {

                $product = new Product;
                $product->setId($value_productData['id']);
                $product->setTitle($value_productData['title']);
                $product->setDescription($value_productData['description']);
                $product->setValue($value_productData['value']);

                $productSelected[] = $product;
            }
        } else {
            return false;
        }

        return $productSelected;
    }
    public function findById($id)
    {
        $sql = $this->pdo->prepare("SELECT * FROM itens WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $productData = $sql->fetch();

            $product = new Product;
            $product->setId($productData['id']);
            $product->setTitle($productData['title']);
            $product->setDescription($productData['description']);
            $product->setValue($productData['value']);

            return $product;
        } else {
            return false;
        }
    }
    public function findByTitle($title)
    {
        $sql = $this->pdo->prepare("SELECT * FROM itens WHERE title = :title");
        $sql->bindValue(':title', $title);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $productData = $sql->fetch();

            $product = new Product;
            $product->setId($productData['id']);
            $product->setTitle($productData['title']);
            $product->setDescription($productData['description']);
            $product->setValue($productData['value']);

            return $product;
        } else {
            return false;
        }
    }
    public function updateProduct(Product $product)
    {
        $sql = $this->pdo->prepare("UPDATE itens SET title = :title,
                                                     value = :value,
                                                     description = :description
                                    WHERE id = :id");

        $sql->bindValue(':title', $product->getTitle());
        $sql->bindValue(':value', number_format($product->getValue(), 2));
        $sql->bindValue(':description', $product->getDescription());
        $sql->bindValue(':id', $product->getId());
        $sql->execute();

        return true;
    }
    public function deleteProduct($id)
    {
        $sql = $this->pdo->prepare("DELETE FROM itens WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }
}
