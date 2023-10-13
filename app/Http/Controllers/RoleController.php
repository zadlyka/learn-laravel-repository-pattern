<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Response;
use App\Http\Resources\RoleResource;
use App\Http\Resources\RoleCollection;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::paginate();
        return new RoleCollection($roles, Response::HTTP_OK, 'List data.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $role = Role::create($request->all());
        return new RoleResource($role, Response::HTTP_CREATED, 'Created data.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return new RoleResource($role, Response::HTTP_OK, 'Detail data.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->all());
        return new RoleResource($role, Response::HTTP_OK, 'Updated data.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return new RoleResource(null, Response::HTTP_OK, 'Deleted data.');
    }
}
