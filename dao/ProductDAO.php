<?php
require_once __DIR__ . '/../models/Products.php';

class ProductDAO implements ProductDAOModel
{
    private $pdo;

    public function __construct(PDO $driver)
    {
        $this->pdo = $driver;
    }

    public function validateImage($fileName, $fileType, $fileSize)
    {
        $errors = [];
        $maxSize = 1024 * 1024 * 5; //aprox 5mb
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $acceptFile = ["png", "jpg", "jpeg"];
        $acceptType = ["image/png", "image/jpg", "image/jpeg"];

        if ($fileSize > $maxSize) {
            $errors[] = "Tamanho do arquivo não suportado";
        }
        if (!in_array($extension, $acceptFile)) {
            $errors[] = "Tipo de arquivo não permitido";
        }
        if (!in_array($fileType, $acceptType)) {
            $errors[] = "Tipo de arquivo não permitido";
        }
        
        return $errors;
    }

    public function uploadImage($fileName, $tmpName)
    {
        $path = __DIR__ . "/../image/";
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $newName = hash('md5', $fileName) . "." . $extension;
        
        if (move_uploaded_file($tmpName, $path . $newName)) {
            return $newName;
        }
        
        return false;
    }

    public function add(Product $product): Product
    {
        $sql = $this->pdo->prepare(
    "INSERT INTO itens (company_id, title, description, value, image) 
            VALUES (:company_id, :title, :description, :value, :image)"
        );

        $sql->bindValue(':company_id', $product->getCompany_Id());
        $sql->bindValue(':title', $product->getTitle());
        $sql->bindValue(':description', $product->getDescription());
        $sql->bindValue(':value', $product->getValue());
        $sql->bindValue(':image', $product->getImage());
        $sql->execute();

        $product->setId($this->pdo->lastInsertId());
        
        return $product;
    }
    public function findAll(): array|bool
    {
        $productSelected = [];
        

        $sql = $this->pdo->query(
            "SELECT *
            FROM itens"
        );

        
        if ($sql->rowCount() <= 0) {
            return false;
        }
        
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

        return $productSelected;
    }
    public function findPurchaseHistory($user_id): array|int
    {
        $productBought = [];

        $sql = $this->pdo->prepare(
    "SELECT * 
            FROM customer_purchase 
            WHERE user_id=:user_id"
        );
        $sql->bindValue(':user_id', $user_id);
        $sql->execute();

        if ($sql->rowCount() <= 0) {
            return 0;  
        } 

        $commentaryData = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($commentaryData as $key_commentaryData => $value_commentaryData) {
            $commentary = new Product;

            $commentary->setId($value_commentaryData['id']);
            $commentary->setTitle($value_commentaryData['title']);
            $commentary->setDescription($value_commentaryData['description']);
            $commentary->setValue($value_commentaryData['value']);
            $commentary->setPurchase_date($value_commentaryData['purchase_date']);

            $productBought[] = $commentary;
        }

        return $productBought;
    }
    public function findById($id): bool|Product
    {
        $product = new Product;

        $sql = $this->pdo->prepare(
    "SELECT *
            FROM itens
            WHERE id = :id"
        );
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() <= 0) {
            return false;
        }

        $productData = $sql->fetch();

        $product->setId($productData['id']);
        $product->setTitle($productData['title']);
        $product->setDescription($productData['description']);
        $product->setValue($productData['value']);
        $product->setImage($productData['image']);

        return $product;
    }
    public function findByCompanyId($company_id): array|int
    {
        $storeProducts = [];

        $product = $this->pdo->query(
            "SELECT *
            FROM itens
            WHERE company_id = '$company_id'"
        );

        if ($product->rowCount() <= 0) {
            return 0;
        }

        $products = $product->fetchAll(PDO::FETCH_ASSOC);

        foreach ($products as $key => $storeProduct) {
            $item = new Product;
            
            $item->setId($storeProduct['id']);
            $item->setTitle($storeProduct['title']);
            $item->setDescription($storeProduct['description']);
            $item->setValue($storeProduct['value']);
            $item->setImage($storeProduct['image']);

            $storeProducts[] = $item;
        }

        return $storeProducts;
    }
    public function findByTitle($title): bool|Product
    {
        $product = new Product;

        $sql = $this->pdo->prepare(
    "SELECT * 
            FROM itens
            WHERE title = :title"
        );
        $sql->bindValue(':title', $title);
        $sql->execute();

        if ($sql->rowCount() <= 0) {
            return false;
        } 

        $productData = $sql->fetch();

        $product->setId($productData['id']);
        $product->setTitle($productData['title']);
        $product->setDescription($productData['description']);
        $product->setValue($productData['value']);

        return $product;
    }

    public function updateProduct(Product $product): bool
    {
        $sql = $this->pdo->prepare(
    "UPDATE itens SET title = :title,
            value = :value,
            description = :description,
            image = :image
            WHERE id = :id"
        );

        $sql->bindValue(':title', $product->getTitle());
        $sql->bindValue(':value', number_format($product->getValue(), 2));
        $sql->bindValue(':description', $product->getDescription());
        $sql->bindValue(':image', $product->getImage());
        $sql->bindValue(':id', $product->getId());
        $sql->execute();

        return true;
    }

    public function deleteProduct($id): void
    {
        $sql = $this->pdo->prepare(
    "DELETE 
            FROM itens
            WHERE id = :id"
        );
        $sql->bindValue(':id', $id);
        $sql->execute();
    }
}
