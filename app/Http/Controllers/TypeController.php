<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;

class TypeController extends Controller
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
     * 商品登録画面
     */
    public function create(Request $request)
    {
        return view('type.create');
    }
    /**
     * カテゴリー登録
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        // dd($request);
        $type = new Type;
        $type->name = $request->name;
        $type->save();
        return redirect('/items');
    }

    
}
