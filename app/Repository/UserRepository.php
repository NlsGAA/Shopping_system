<?php 

namespace App\Repository;

use App\Repository\Contract\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct($pdo) {
        parent::__construct('users', $pdo);
    }
}