<?php 

namespace App\Service;

use App\Repository\Contract\ProductRepositoryInterface;

class ProductService
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ){
        // $params = $this->__invoke(['testando' => 'teste']);
    }

    public function validate(int $id)
    {
        return $this->productRepository->find($id);
    }

    public function create(array $params)
    {
        return $this->productRepository->create($params);
    }

    public function delete(int $id)
    {
        return $this->productRepository->delete($id);
    }

    public function update(int $id, array $params)
    {
        return $this->productRepository->update($id, $params);
    }
}