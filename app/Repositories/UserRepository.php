<?php

namespace App\Repositories;

use App\DTO\Users\CreateUserDTO;
use App\DTO\Users\UpdateUserDTO;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository
{
    public function __construct(protected User $user)
    {
    }

    public function getPaginate(int $totalPerPage = 15,int $page = 1,string $filter = ''): LengthAwarePaginator
    {
        return $this->user->when(!empty($filter), function ($query) use ($filter) {
            $query->where('name', 'LIKE', "%{$filter}%");
        })->paginate($totalPerPage, ['*'], 'page', $page);
    }

    public function createNew(CreateUserDTO $dto): User
    {
        $data = (array) $dto;
        $data['password'] = bcrypt($data['password']);
        return $this->user->create($data);
    }

    public function findById(string $id): ?User
    {
        return $this->user->find($id);
    }

    public function update(UpdateUserDTO $dto): bool
    {
        if(!$user = $this->findById($dto->id))
        {
            return false;
        }

        $data = (array) $dto;
        unset($data['password']);
        if($dto->password !== null) {
            $data['password'] = bcrypt($dto->password);
        }

        return $user->update($data);
    }
}
