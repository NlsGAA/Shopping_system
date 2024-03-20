<?php
require_once __DIR__ . ("/../models/Cart_itens.php");
require_once __DIR__ . '/../models/Products.php';
class Cart_itensDAO implements Cart_action
{
    private $pdo;

    public function __construct(PDO $driver)
    {
        $this->pdo = $driver;
    }
    function takeItensByUserId($user_id)
    {
        $products = [];

        $sql = $this->pdo->prepare("SELECT * FROM cart WHERE user_id = :user_id");
        $sql->bindValue(':user_id', $user_id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $cart_itens = $sql->fetchAll(PDO::FETCH_ASSOC);

            foreach ($cart_itens as $key => $cart_item) {
                $item = new Cart_itens;
                $item->setId($cart_item['id']);
                $item->setUser_id($cart_item['user_id']);
                $item->setProduct_id($cart_item['product_id']);

                $products[] = $item;
            }
        } else {
            return $products[0] = 0;
        }
        return $products;
    }
    function takeItenInfoByProductId($product_id)
    {
        $product = $this->pdo->query("SELECT * FROM itens WHERE id='$product_id'");
        $products = [];

        if ($product->rowCount() > 0) {
            $itens = $product->fetchAll(PDO::FETCH_ASSOC);

            foreach ($itens as $key => $cart_iten) {
                $iten = new Product;
                $iten->setId($cart_iten['id']);
                $iten->setTitle($cart_iten['title']);
                $iten->setDescription($cart_iten['description']);
                $iten->setValue($cart_iten['value']);

                $products[] = $iten;
            }
        } else {
            return 0;
        }
        return $products;
    }
    function recordCustomerPurchase($user_id)
    {
        $bought_products = $this->takeItensByUserId($user_id);
        foreach ($bought_products as $key => $bought_product) {
            $purchased_items = $this->takeItenInfoByProductId($bought_product->getProduct_id());
            foreach ($purchased_items as $key => $purchased_item) {
                $sql = $this->pdo->prepare("INSERT INTO customer_purchase (title, description, value, user_id) VALUES (:title, :description, :value, :user_id)");
                $sql->bindValue(':title', $purchased_item->getTitle());
                $sql->bindValue(':description', $purchased_item->getDescription());
                $sql->bindValue(':value', number_format($purchased_item->getValue(), 2));
                $sql->bindValue(':user_id', $user_id);
                $sql->execute();

                $purchased_item->setId($this->pdo->lastInsertId());
            }
        }
        return $purchased_item;
    }
    function deleteItenById($product_id)
    {
        $sql = $this->pdo->prepare("DELETE FROM cart WHERE product_id = :id LIMIT 1");
        $sql->bindValue(':id', $product_id);
        $success = $sql->execute();
    }
    function deleteAllItens($user_id)
    {
        $sql = $this->pdo->prepare("DELETE FROM cart WHERE user_id = :id");
        $sql->bindValue(':id', $user_id);
        $success = $sql->execute();
    }
}
