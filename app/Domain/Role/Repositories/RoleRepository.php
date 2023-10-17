<?php

namespace App\Domain\Role\Repositories;

use App\Domain\Role\Models\Role;

class RoleRepository
{
    public function create($data)
    {
        return Role::create($data);
    }

    public function delete($id)
    {
        $role = self::findOne($id);
        return $role->delete();
    }

    public function findAll($data)
    {
        $search = $data['search'] ?? null;
        $sort = $data['sort'] ?? null;
        $filter = $data['filter'] ?? null;
        $limit = $data['limit'] ?? 10;

        return Role::search($search)->sort($sort)->filter($filter)->paginate($limit);
    }

    public function findOne($id)
    {
        return Role::where('id', $id)->firstOrFail();
    }

    public function update($id, $data)
    {
        $role = self::findOne($id);
        $role->update($data);
        return $role;
    }
}
