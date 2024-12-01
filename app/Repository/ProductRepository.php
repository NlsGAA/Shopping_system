<?php 

namespace App\Repository;

require_once __DIR__ . '/BaseRepository.php';
require_once __DIR__ . '/contract/ProductRepositoryInterface.php';
require_once __DIR__ . '/contract/BaseRepositoryInterface.php';

use App\Repository\Contract\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct($pdo) {
        parent::__construct('product', $pdo);
    }
}