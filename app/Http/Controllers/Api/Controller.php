<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;

use App\User;
class Controller extends BaseController
{
    public function index(Request $request)
    {
       //$users = User::paginate(5);
       $users = User::all();
       return response([
               'error' => false,
               'users' => $users->toArray(),
             ],200)->header('Content-Type', 'text/plain');
    }
    public function store(Request $request)
    {
       User::create($request->all());
       return response([
               'error' => false,
               'message' =>'User created successfully',
             ],200)->header('Content-Type', 'text/plain');
    }
    public function show($id)
    {
       $user = User::find($id);
       return response([
               'error' => false,
               'user' => $user,
             ],200)->header('Content-Type', 'text/plain');
    }
    public function update(Request $request, $id)
    {
       User::find($id)->update($request->all());
       return response([
               'error' => false,
               'message' =>'User updated successfully',
             ],200)->header('Content-Type', 'text/plain');
    }
    public function destroy($id)
    {
       User::find($id)->delete();
       return response([
               'error' => false,
               'message' =>'User deleted successfully',
             ],200)->header('Content-Type', 'text/plain');
    }
}
