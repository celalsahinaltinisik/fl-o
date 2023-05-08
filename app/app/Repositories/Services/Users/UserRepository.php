<?php

namespace App\Repositories\Services\Users;

use App\Models\User;
use App\Repositories\Interfaces\Users\UserRepositoryInterface;
use App\Repositories\Services\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
