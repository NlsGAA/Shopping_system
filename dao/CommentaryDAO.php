<?php
require_once __DIR__ . ("/../models/Commentary.php");

class CommentaryDAO implements CommentaryDAOModel
{
    private $pdo;

    public function __construct(PDO $driver)
    {
        $this->pdo = $driver;
    }
    public function addCommentary(Commentary $commentary)
    {
        $sql = $this->pdo->prepare("INSERT INTO user_product_opnion (user_name, product_id, commentary_id, user_commentary) VALUES (:user_name, :product_id, :commentary_id, :user_commentary)");
        $sql->bindValue(':user_name', $commentary->getAuthor());
        $sql->bindValue(':product_id', $commentary->getProductId());
        $sql->bindValue(':commentary_id', $commentary->getId());
        $sql->bindValue(':user_commentary', $commentary->getCommentary());
        $sql->execute();

        $commentary->setId($this->pdo->lastInsertId());
        return $commentary;
    }
    public function commentaryInProduct($id)
    {
        $commentarySelected = [];

        $sql = $this->pdo->prepare("SELECT * FROM user_product_opnion WHERE product_id=:product_id");
        $sql->bindValue(':product_id', $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $commentaryData = $sql->fetchAll(PDO::FETCH_ASSOC);

            foreach ($commentaryData as $key_commentaryData => $value_commentaryData) {

                $commentary = new commentary;
                $commentary->setId($value_commentaryData['id']);
                $commentary->setAuthor($value_commentaryData['user_name']);
                $commentary->setCommentary($value_commentaryData['user_commentary']);
                $commentary->setCommentaryDate($value_commentaryData['creation_time']);

                $commentarySelected[] = $commentary;
            }
        } else {
            return 0;
        }
        return $commentarySelected;
    }
    public function deleteCommentary($id)
    {
    }
}
