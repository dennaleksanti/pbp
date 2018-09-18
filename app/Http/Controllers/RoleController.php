<?php

namespace App\Http\Controllers;

use DB;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index()
    {
        return Role::all();
    }

   /* public function get($id)
    {
        $Role = Role::find($id);
        
        if(is_null($Role)) {
            return response()
            ->json(['errors' => ['Role_not_found']],404);
        }

        return response()->json($Role);
    }*/

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name',
        ]);

        if($validation->fails()) {
            return response()
            ->json($validation->errors(), 422);
        }

        $user_data = $request->all();

        try {
            DB::transaction(function () use ($user_data, &$Role) {
                $Role = Role::create($user_data);
            });

            return Role::find($Role->id);
        } catch (\Exception $e) {
            return response()
            ->json(['errors' => [$e->getMessage()]],500);
        }
    }

    public function update(Request $request, $id)
    {
        $Role = Role::find($id);

        if(is_null($Role)) {
            return response()
            ->json(['erros', ['roles_not_found']], 404);
        }

        $validation = Validator::make($request->all(), [
            'name' => 'sometimes|unique:roles,name',
        ]);

        if ($validation->fails()) {
            return response()
            ->json($validation->errors(), 422);
        }

        $user_data = $request->all();
        
        try {
            DB::transaction(function () use ($user_data, $Role) {
                $Role->update($user_data);
            });

            return Role::find($Role->id);
        } catch (\Exception $e) {
            return response()
            ->json(['errors' => [$e->getMessage()]], 500);
        }
    }

    public function destroy($id)
    {
        $Role = Role::find($id);
        
        if(is_null($Role)) {
            return response()
            ->json(['errors' => ['roles_not_found']],404);
        }

        $Role->delete();

        return response()->json();
    }
}
