<?php

class Cart_itens
{

    private $id;
    private $user_id;
    private $product_id;

    function setId($id)
    {
        $this->id = $id;
    }
    function getId()
    {
        return $this->id;
    }
    function setUser_id($user_id)
    {
        $this->user_id = $user_id;
    }
    function getUser_id()
    {
        return $this->user_id;
    }
    function setProduct_id($product_id)
    {
        $this->product_id = $product_id;
    }
    function getProduct_id()
    {
        return $this->product_id;
    }
}

interface Cart_action
{
    function takeItensByUserId($user_id);
    function deleteItenById($product_id);
    function deleteAllItens($user_id);
    function takeItenInfoByProductId($product_id);
}
