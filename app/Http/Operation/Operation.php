<?php
namespace App\Http\Operation;

use App\Models\PerHasRol;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class Operation
{
    public function operationDb($empl){
        $permission = count(Permission::all());
        if ($permission == 0){
            $data = config('permission.permission');
            foreach ($data as $name => $title) {
                Permission::create([
                    'name' => $name,
                    'title' => $title
                ]);
            }
        }

        $role = Role::all();
        if (count($role) == 0){
            $data = config('permission.roles');
            foreach ($data as $name => $title) {
                Role::create([
                    'name' => $name,
                    'title' => $title
                ]);
            }
        }
        if (count($empl) == 1){
            $per = Permission::all();
            foreach ($per as $id){
                PerHasRol::create([
                    'permission_id' => $id->id,
                    'role_id' => 1
                ]);
            }
        }


        return;
    }
}
