<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Article;
use App\Models\UserModel;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function model()
    {
        $md = new Article();

        $data = $md->getData();

        return view('entry',['data'=> $data]);
    }

    public function show()
    {
        $user_id = Auth::id();
        $article = new Article();
        $data = $article->getUserArticle($user_id);

        return view('userentry',['data' => $data]);
    }

    public function insert()
    {
        return view('insert');
    }

    public function edit(Request $request)
    {
        $user_id = Auth::id();
        $id = $request->input('a_id');
        $data = Article::findOrFail($id);
        
        //$roles = ['user_id' => $user_id];
        //$request->validate($data,$roles,'不正のデータを確認しました');

        return view('editer',['data' => $data]);
    }

    public function update(Request $request)
    {
        $user_id = Auth::id();
        $id = $request->input('articles_id');
        $data = Article::findOrFail($id);
        $a_uid = $data ->user_id;

        if($a_uid !== $user_id)
        {
            redirect('userentry')->with('status','不正なデータを確認しました');
        }

        $data->fill($request->all())->save();

        return redirect('userentry')->with('status','更新完了しました');
    }

    public function delete(Request $request)
    {
        $id = $request->input('a_id');
        $article = Article::findOrFail($id)->delete();
        return redirect('userentry')->with('status','削除完了しました');
    }

 

    public function comfirm(Request $request)
    {
        $article = new Article;
        //$id = Auth::id();
        /*
        $article->title = $request->title;
        $article->body = $request->body;
        $article->user_id = $id;

        $article->save();
        */
       
        $validatedData = $request->validate([
            'title' => 'regex:/^(?!.*}}).*$/m',
        ]);

        $validatedData = $request->validate([
            'body' => 'regex:/^(?!.*}}).*$/m',
        ]);
        
        $article->fill($request->all());
        $article->user_id = Auth::id();
        $article->save();


        return view('comfirm');
    }

    public function users(Request $request)
    {
        $user_id = Auth::id();
        $user = UserModel::findOrFail($user_id);
        return view('userView',['data' => $user]);
    }

    public function userEdit(Request $request)
    {
        $user_id = Auth::id();
        $user = UserModel::findOrFail($user_id);
        $flg = 'user';
        return view('adminUserEdit',['data' => $user,'flg' => $flg]);
    }

    public function userUpdate(Request $request)
    {
        $user_id = Auth::id();
        $u = UserModel::findOrFail($user_id);
        $u->name = $request->name;
        $u->email = $request->email;
        $u->save();
        return redirect('home')->with('status','更新完了しました');
    }

    public function passedit(Request $request)
    {
        $user_id = Auth::id();
        $u = UserModel::findOrFail($user_id);
        return view('userpass',['data' => $u]);
    }

    public function userspass(Request $request)
    {
        $validatedData = $request->validate([
            'password' => 'required|string|confirmed'
        ]);
        $user_id = Auth::id();
        $u = UserModel::findOrFail($user_id);
        if(Hash::check($request->oldpassword, $u->password))
        {
            $u = UserModel::findOrFail($user_id);
            $u->password = Hash::make($request->password);
            $u->save();
            return redirect('home')->with('status','パスワードが更新されました');
        }


        //return view('userpass',['data'=>$u,'errors',$errors]);
        return redirect()->back()->with('passerror','パスワードが違います');

    }

}
