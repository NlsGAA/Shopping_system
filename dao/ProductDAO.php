<?php
require_once __DIR__ . '/../models/Products.php';

class ProductDAO implements ProductDAOModel
{
    private $pdo;

    public function __construct(PDO $driver)
    {
        $this->pdo = $driver;
    }

    public function imageUpload()
    {
        if (!empty($_FILES['image']['name'])) {

            $fileName = $_FILES['image']['name'];
            $fileType = $_FILES['image']['type'];
            $tmpName = $_FILES['image']['tmp_name'];
            $fileSize = $_FILES['image']['size'];
            $errors = [];

            $maxSize = 1024 * 1024 * 5; //aprox 5mb

            if ($fileSize > $maxSize) {
                $errors[] = "Tamanho do arquivo não suportado";
            }

            $acceptFile = ["png", "jpg", "jpeg"];
            $extension = pathinfo($fileName, PATHINFO_EXTENSION);
            if (!in_array($extension, $acceptFile)) {
                $errors[] = "Tipo de arquivo não permitido";
            }

            $acceptType = ["image/png", "image/jpg", "image/jpeg"];
            if (!in_array($fileType, $acceptType)) {
                $errors[] = "Tipo de arquivo não permitido";
            }

            if (!empty($errors)) {
                foreach ($errors as $key => $error) {
                    echo $error;
                }
            } else {
                $path = __DIR__ . "/../image/";
                $newName = hash('md5', $fileName) . "." . $extension;
                if (move_uploaded_file($tmpName, $path . $newName)) {
                    return $newName;
                } else {
                    return false;
                }
            }
        }
    }

    public function add(Product $product)
    {
        $sql = $this->pdo->prepare("INSERT INTO itens (company_id, title, description, value, image) VALUES (:company_id, :title, :description, :value, :image)");
        $sql->bindValue(':company_id', $product->getCompany_Id());
        $sql->bindValue(':title', $product->getTitle());
        $sql->bindValue(':description', $product->getDescription());
        $sql->bindValue(':value', $product->getValue());
        $sql->bindValue(':image', $product->getImage());
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
                $product->setCompany_Id($value_productData['company_id']);
                $product->setTitle($value_productData['title']);
                $product->setDescription($value_productData['description']);
                $product->setValue($value_productData['value']);
                $product->setImage($value_productData['image']);

                $productSelected[] = $product;
            }
        } else {
            return false;
        }

        return $productSelected;
    }
    public function findPurchaseHistory($user_id)
    {
        $productBought = [];

        $sql = $this->pdo->prepare("SELECT * FROM customer_purchase WHERE user_id=:user_id");
        $sql->bindValue(':user_id', $user_id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $commentaryData = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach ($commentaryData as $key_commentaryData => $value_commentaryData) {
                // $dateTime = $value_commentaryData['purchase_date'];
                // $dateObject = DateTime::createFromFormat('d/m/Y H:i:s', $dateTime);
                // $date = $dateObject->format('d/m/Y H:i:s');

                $commentary = new Product;
                $commentary->setId($value_commentaryData['id']);
                $commentary->setTitle($value_commentaryData['title']);
                $commentary->setDescription($value_commentaryData['description']);
                $commentary->setValue($value_commentaryData['value']);
                $commentary->setPurchase_date($value_commentaryData['purchase_date']);

                $productBought[] = $commentary;
            }
        } else {
            return 0;
        }
        return $productBought;
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
            $product->setImage($productData['image']);

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
                                                     description = :description,
                                                     image = :image
                                    WHERE id = :id");

        $sql->bindValue(':title', $product->getTitle());
        $sql->bindValue(':value', number_format($product->getValue(), 2));
        $sql->bindValue(':description', $product->getDescription());
        $sql->bindValue(':image', $product->getImage());
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
