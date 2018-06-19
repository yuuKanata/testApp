<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Article;
use App\Models\UserModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Session;
use Hash;

class AdminController extends Controller
{
    public function index()
    {
    	return view('adminHome');
    }

    public function entryView()
    {
    	$articles = New Article();
    	$data = $articles->getData();
    	return view('adminEntryView' , ['data' => $data]);
    }

    public function entryEdit(Request $request,$article_id)
    {
    	$data = Article::findOrFail($article_id);
    	$request->session()->put('article_id' , $article_id);
    	return view('adminEntryEdit',['data' => $data]);
    }

    public function entryUpdate(Request $request)
    {
    	$id = $request->session()->get('article_id');
    	//$id = $request->input('articles_id');
    	$data = Article::findOrFail($id);
    	$data->fill($request->all())->save();
    	return redirect('/admin/entry/')->with('status','更新完了しました');
    }

    public function entryDel(Request $request)
    {
    	$id = $request->input('a_id');
    	$article = Article::findOrFail($id)->delete();
    	return redirect('/admin/entry/')->with('status','削除完了しました');
    }

    public function account()
    {
        $data = UserModel::all();
        return view('adminUserView',['data'=>$data]);
    }

    public function edit(Request $request,$user_id)
    {
        $userData = UserModel::findOrFail($user_id);
        $request->session()->put('user_id' , $user_id);
        $flg = 'admin';
        return view('adminUserEdit',['data'=>$userData,'flg'=>$flg]);
    }

    public function updateData(Request $request)
    {
        $user_id = $request->session()->get('user_id');

        $u = UserModel::findOrFail($user_id);
        $u->name = $request->name;
        $u->email = $request->email;
        $u->role = $request->role;
        $u->save();
        return redirect('/admin/account')->with('status','更新完了しました');
    }

    public function userpass(Request $request,$user_id)
    {
        $userData = UserModel::findOrFail($user_id);
        $request->session()->put('user_id',$user_id);
        return view('adminUpass',['data'=>$userData]);
    }

    public function pwup(Request $request)
    {
        $user_id = $request->session()->get('user_id');

        $u = UserModel::findOrFail($user_id);
        $u->password = Hash::make($request->password);
        $u->save();
        return redirect('/admin/account')->with('status','パスワードが更新されました。ユーザーに通知してください');
    }

    public function deleteData(Request $request,$user_id)
    {
        $userData = UserModel::findOrFail($user_id);
        $request->session()->put('user_id',$user_id);
        return view('userDel',['data'=>$userData]);
    }

    public function val(Request $request)
    {
        $user_id = $request->session()->get('user_id');
        $userData = UserModel::findOrFail($user_id);
        return view('userDel',['data'=>$userData]);
    }

    public function userdel(Request $request)
    {
        $systemid = Auth::id();
        $s = UserModel::findOrFail($systemid);

        if($s->role !==1)
        {
            return redirect()->back();
        }

        $validatedData = $request->validate([
            'password' => 'required|string|confirmed'
        ]);

        if(Hash::check($request->password, $s->password))
        {
            $user_id = $request->session()->get('user_id');
            $u = UserModel::findOrFail($user_id)->delete();
            return redirect('/admin/account')->with('status','削除完了しました');
        }

        return redirect()->back();
    }

    public function regist(Request $request)
    {
        $flg = 'adminInsert';
        return view('adminUserEdit',['flg'=>$flg]);
    }

    public function createData(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        UserModel::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role' => $request['role']
        ]);


        return redirect('/admin/account')->with('status','ユーザーを登録しました');
    }
}
