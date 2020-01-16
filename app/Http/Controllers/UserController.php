<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }
 
    public function show($id){
        $user = User::find($id); 
        return response()->json($user, 200);
    }

    public function showClientes(){
        $users = DB::select('select u.* from users u, model_has_roles m where u.id = m.model_id and m.role_id = 3');
        return response()->json($users, 200);
    }

    public function showRecepcionistas(){
        $users = DB::select('select u.* from users u, model_has_roles m where u.id = m.model_id and m.role_id = 2');
        return response()->json($users, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            //'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        /*
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }
        */

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return response()->json($user, 200);
    }

    public function delete(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(null, 204);
    }
}
