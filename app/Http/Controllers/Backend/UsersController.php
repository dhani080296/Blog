<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests;
use App\Post;
class UsersController extends BackendController
{
    

    public function index(){
    	$users=User::orderBy('name')->paginate($this->limit);
    	$usersCount=User::count();
    	return view("backend.users.index",compact('users','usersCount'));
    }
    public function create(){
    	$user= new User();
    	return view("backend.users.create",compact('user'));
    }
    public function store(Requests\UserStoreRequest $request){
    $data = $request->all();
    $data['password'] = crypt($data['password']);
    User::create($data);
    return redirect("/backend/users")->with("message","New user was created successfully!");
    }
    public function edit($id){
    $user= User::findOrFail($id);
    return view("backend.users.edit",compact('user'));	
    }
    public function update(Requests\UserUpdateRequest $request,$id){
    user::findOrFail($id)->update($request->all());
    return redirect("/backend/users")->with("message","User was Updated successfully!");
    }
   public function destroy(Requests\UserDestroyRequest $request,$id){
   
    $user =User::findOrFail($id);
    $deleteOption=$request->delete_option;
    $selectedUser=$request->selected_user;
    if($deleteOption=="delete"){
        // delete posts
        $user->posts()->delete();
        // delete user
    }else if($deleteOption=="attribute"){
      $user->posts()->update(['author_id'=>$selectedUser]);  
    }
    // $User->delete();
    return redirect("/backend/users")->with("message","User was Deleted Successfully!");
    }
    public function confirm(Requests\UserDestroyRequest $request,$id){
   
    $user =User::findOrFail($id);
    $users=User::where('id','!=',$user->id)->pluck('name','id');
    return view("backend.users.confirm",compact('user','users'));
    }
}
