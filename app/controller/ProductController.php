<?php 

namespace App\Controller;

include_once __DIR__ . '/../Repository/ProductRepository.php';
include_once __DIR__ . '/../Service/ProductService.php';
include_once __DIR__ . '/BaseController.php';

use PDO;
use App\Service\ProductService;
use App\Repository\ProductRepository;

class ProductController extends BaseController
{
    private $productRepository;
    private $productService;

    // public function __construct(
    //     PDO $pdo
    // ){
    //     $this->productRepository = new ProductRepository($pdo);
    //     $this->productService = new ProductService($this->productRepository);
    // }

    public function index() {
        var_dump('acessou');
    }

    public function create() {
        try {
            $product = $this->productService->create($_POST);
        } catch (\Throwable $e) {
            return json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    
        return json_encode([
            'success' => true,
            'message' => 'Produto cadastrado com sucesso',
            'product' => $product
        ]);
    }
    
    public function update()
    {
        try {
            $product = $this->productService->update($_POST['id'], $_POST);
        } catch (\Throwable $e) {
            return json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }

        return json_encode([
            'success' => true,
            'message' => 'Produto editado com sucesso!',
            'product' => $product
        ]);
    }

}