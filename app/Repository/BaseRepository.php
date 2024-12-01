<?php 

namespace App\Repository;

use Exception;
use PDO;

abstract class BaseRepository
{
    private $model;
    private PDO $pdo;

    public function __construct($model, PDO $pdo)
    {
        $this->model = $model;
        $this->pdo = $pdo;
    }

    public function all()
    {
        $sql = $this->pdo->prepare("SELECT * FROM itens");
        $sql->execute();
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function find($id)
    {
        $sql = $this->pdo->prepare("SELECT * FROM itens WHERE id = $id");
        $sql->execute();
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function create($data)
    {
        array_pop($data);
        if (!is_array($data) || empty($data)) {
            throw new Exception("Nenhum dado fornecido para inserção no banco de dados.");
        }
        
        $fields = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));
        $sql = $this->pdo->prepare("INSERT INTO itens ($fields) VALUES ($values)");
        
        foreach ($data as $key => $value) {
            $sql->bindValue(':' . $key, $value);
        }
        
        $sql->execute();
        $productId = $this->pdo->lastInsertId();
        $product = $this->find($productId);
        
        return $product;
    }

    public function update($id, $data)
    {
        if (!is_array($data) || empty($data)) {
            throw new Exception("Nenhum dado fornecido para atualização no banco de dados.");
        }
        
        $updateData = [];
        foreach ($data as $key => $value) {
            $updateData[] = "$key = $value";
        }
        $columnsToUpdate = implode(', ', $updateData);

        $sql = $this->pdo->prepare("UPDATE itens SET $columnsToUpdate WHERE id = $id");
        $sql->execute();
        $response = $sql->fetch(PDO::FETCH_ASSOC);
        return $response;
    }

    public function delete($id)
    {
        $sql = $this->pdo->prepare("DELETE FROM itens WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }
}