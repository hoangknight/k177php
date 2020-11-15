<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Info;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function index(){

        $users = User::paginate(5);
        return view('backend.user.listuser', compact('users'));
    }
     public function detail($id){
        // find
        $user = Info::find($id)->user;
        dd($user);
        // return view('backend.user.listuser');
    }
    public function create(){
        return view('backend.user.adduser');
    }
    public function store(AddUserRequest $request){
        // thao tác với CSDL
        // use Illuminate\Support\Facades\Hash;
        $user = new User;
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->phone = $request->phone;
        $user->level = $request->level;
        $user->address = $request->address;
        $user->save();

        return redirect()->route('user.index')->with('success', 'Thêm người dùng thành công');

    }
    public function edit($id){
        $user = User::find($id);
        return view('backend.user.edituser', compact('user'));
    }
    public function update(EditUserRequest $request, $id){
        $user = User::find($id);
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->level = $request->level;
        $user->address = $request->address;
        $user->save();

        return redirect()->route('user.index')->with('success', 'Sửa thông tin người dùng thành công');
    }

    public function delete($id){
        $user = User::find($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'Xóa người dùng thành công');
    }
}
