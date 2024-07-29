<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository
{
    public function __construct(protected User $user)
    {
    }

    public function getAllUsers(string $filter = ''): LengthAwarePaginator
    {
        return $this->user->when(!empty($filter), function ($query) use ($filter) {
            $query->where('name', 'LIKE', "%{$filter}%");
        })->paginate();
    }
}
