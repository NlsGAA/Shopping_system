<?php 

namespace App\Service;

use InvalidArgumentException;
use App\Repository\Contract\UserRepositoryInterface;

class UserService 
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {
    }

    private function validateLogin(?int $id)
    {
        return $this->userRepository->find($id);
    }
    
    public function login(array $params)
    {
        $response = $this->validateLogin($params['id']);

        if(!$response) {
            new InvalidArgumentException("Usuário não encontrado!");
        }
        return $response;
    }

    public function create(array $params)
    {
        return $this->userRepository->create($params);
    }

    public function update(int $id, array $params)
    {
        return $this->userRepository->update($id, $params);
    }

    public function delete(int $id)
    {
        return $this->userRepository->delete($id);
    }

}