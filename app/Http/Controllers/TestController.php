<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Frameworks;

class TestController extends Controller
{
    public function index()
    {
    	$data = array();

    	$data['name'] = 'yuu';
    	$data['message'] = 'こんにちは';

    	$today = date('Y年m月d日 H:i:s');

    	return view('test',['data' => $data, 'today' => $today]);
    }

    public function model($type=null)
    {
    	$md = new Frameworks();

    	$data = $md->getData($type);

    	return view('sample.model',['data' => $data]);
    }
}
