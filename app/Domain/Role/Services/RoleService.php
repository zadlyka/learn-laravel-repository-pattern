<?php

namespace App\Domain\Role\Services;

use App\Domain\Role\Repositories\RoleRepository;

class RoleService
{
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function create($data)
    {
        return $this->roleRepository->create($data);
    }

    public function delete($id)
    {
        return $this->roleRepository->delete($id);
    }

    public function findAll($data)
    {
        return $this->roleRepository->findAll($data);
    }

    public function findOne($id)
    {
        return $this->roleRepository->findOne($id);
    }

    public function update($id, $data)
    {
        return $this->roleRepository->update($id, $data);
    }
}
