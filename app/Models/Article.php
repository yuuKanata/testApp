<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    protected $table = "articles";

    protected $primaryKey = 'articles_id';

    protected $guarded = array('articles_id');

    public $timestamps = true;

    public function articleUser()
    {
    	return $this->belongTo('App/User');
    }

    public function getData()
    {
    	/*
    	$query = DB::table($this->table);

    	$data = $query->get()->User;

    	return $data;

    	*/
    
    	$data = Article::join('users','users.id','=','articles.user_id')
                            ->orderBy('articles.created_at','desc')
                            ->get(["articles_id","title","body","name","articles.created_at as a_created"])
                            ;

    	return $data;
    }

    public function getUserArticle($user_id)
    {
        /*
        $query = DB::table($this->table);

        $data = $query->get()->User;

        return $data;

        */
    
        $data = Article::join('users','users.id','=','articles.user_id')
                            ->where('user_id',$user_id)
                            ->orderBy('articles.created_at','desc')
                            ->get(["articles_id","title","body","name","articles.created_at as a_created"]);

        return $data;
    }
}
