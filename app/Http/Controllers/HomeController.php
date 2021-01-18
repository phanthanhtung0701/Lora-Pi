<?php

namespace App\Http\Controllers;

use App\Http\Models\NodeModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $query = NodeModel::getAllNode();
        $data=[];
        foreach ($query as $n) {
            $node=[
                'id' => $n->id,
                'name' => $n->name,
                'position' => $n->position,
                'status' => $n->status
            ];
            $data[] = $node;
        }

        return view('layouts.master', ['data'=>$data]);
    }
}
