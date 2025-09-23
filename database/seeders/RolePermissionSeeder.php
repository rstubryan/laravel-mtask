<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'create projects',
            'view projects',
            'edit projects',
            'delete projects',
            'create tasks',
            'view tasks',
            'edit tasks',
            'update task status',
            'delete tasks',
            'create groups',
            'view groups',
            'edit groups',
            'delete groups',
            'create grouptasks',
            'view grouptasks',
            'edit grouptasks',
            'delete grouptasks',
            'create issues',
            'view issues',
            'edit issues',
            'update issue status',
            'delete issues',
            'create related tasks',
            'assign related tasks to grouptasks',
        ];

        $roles = [
            'admin' => $permissions,
            'user' => [
                'view projects',
                'view tasks',
                'view groups',
                'view issues',
                'update task status',
                'update issue status',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::create(['name' => $roleName]);
            $role->syncPermissions($rolePermissions);
        }
    }
}
