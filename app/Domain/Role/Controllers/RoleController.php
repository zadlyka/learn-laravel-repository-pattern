<?php

namespace App\Domain\Role\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Domain\Role\Models\Role;
use App\Http\Controllers\Controller;
use App\Domain\Role\Services\RoleService;
use App\Domain\Role\Resources\RoleResource;
use App\Domain\Role\Resources\RoleCollection;
use App\Domain\Role\Requests\StoreRoleRequest;
use App\Domain\Role\Requests\UpdateRoleRequest;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $roles = $this->roleService->findAll($request->all());
        return new RoleCollection($roles, Response::HTTP_OK, 'List data.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $role = $this->roleService->create($request->all());
        return new RoleResource($role, Response::HTTP_CREATED, 'Created data.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $role = $this->roleService->findOne($role->id);
        return new RoleResource($role, Response::HTTP_OK, 'Detail data.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role = $this->roleService->update($role->id, $request->all());
        return new RoleResource($role, Response::HTTP_OK, 'Updated data.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $this->roleService->delete($role->id);
        return new RoleResource(null, Response::HTTP_OK, 'Deleted data.');
    }
}
