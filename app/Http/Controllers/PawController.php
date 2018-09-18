<?php

namespace App\Http\Controllers;

use DB;
use App\Paw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PawController extends Controller
{
    public function index()
    {
        return Paw::all();
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
            'name' => 'required|unique:Paw,name',
            'jenis_hewan' => 'required',
            'jenis_kelamin' => 'required',
            'warna' => 'required',
            'berkembang_biak' => 'required',
            'catatan' => 'required'
            //'paw_id' => 'required',
        ]);

        if($validation->fails()) {
            return response()
            ->json($validation->errors(), 422);
        }

        $user_data = $request->all();

        try {
            DB::transaction(function () use ($user_data, &$Register) {
                $Register = Register::create($user_data);
            });

            return Register::find($Register->username);
        } catch (\Exception $e) {
            return response()
            ->json(['errors' => [$e->getMessage()]],500);
        }
    }

    public function update(Request $request, $id)
    {
        $Register = Register::find($id);

        if(is_null($Register)) {
            return response()
            ->json(['erros', ['registers_not_found']], 404);
        }

        $validation = Validator::make($request->all(), [
            'username' => 'sometimes|unique:registers,username',
            'email' => 'sometimes',
            'password' => 'sometimes',
            'role_id' => 'sometimes|exists:roles,id',
        ]);

        if ($validation->fails()) {
            return response()
            ->json($validation->errors(), 422);
        }

        $user_data = $request->all();
        
        try {
            DB::transaction(function () use ($user_data, $Register) {
                $Register->update($user_data);
            });

            return Register::find($Register->id);
        } catch (\Exception $e) {
            return response()
            ->json(['errors' => [$e->getMessage()]], 500);
        }
    }

    public function destroy($id)
    {
        $Register = Register::find($id);
        
        if(is_null($Register)) {
            return response()
            ->json(['errors' => ['registers_not_found']],404);
        }

        $Register->delete();

        return response()->json();
    }

   /* public function login(Request $request){

        $validation = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            
        ]);

        if($validation->fails()) {
            return response()
            ->json($validation->errors(), 422);
        }

        $user_data = $request->all();

            public function get($id)
            {
                $Register = Register::find($id);
                
                if(is_null($Register)) {
                    return response()
                    ->json(['errors' => ['registers_not_found']],404);
                }

                return response()->json($Register);
            }
    }*/
}
