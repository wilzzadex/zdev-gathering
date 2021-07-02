<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data['user'] = User::where('role','Admin')->orderBy('name', 'asc')->get();
        return view('back.pages.user.user', $data);
    }

    public function add()
    {
        return view('back.pages.user.user_add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'unique:users,email',
            'username' => 'unique:users,username',
        ]);

        $user = new User();
        $user->name = $request->nama;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->role = 'Admin';
        $user->save();

        return redirect(route('user'))->with('success', 'Data User berhasil di simpan');
    }

    public function edit($id)
    {
        $data['user'] = User::findOrFail($id);
        return view('back.pages.user.user_edit',$data);
    }

    public function update(Request $request,$id)
    {
        // dd($request->all());
        $cm = [
            'unique' => 'Username tersebut telah terdaftar !',
        ];
        $this->validate($request,[
            'email' => 'unique:users,email,' . $id,
            'username' => 'unique:users,username,' . $id,
        ],$cm);

        $user = User::find($id);
        $user->name = $request->nama;
        $user->username = $request->username;
        $user->role = 'Admin';
        if(isset($request->password)){
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect(route('user'))->with('success','Data User berhasil di ubah');
    }

    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        $cek = 0;
        // $cek = Penjualan::where('user_id',$user->id)->count();
        if($cek == 0){
            $user->delete();
            return response()->json('oke');
        }else{
            return response()->json('no');
        }
    }
}
