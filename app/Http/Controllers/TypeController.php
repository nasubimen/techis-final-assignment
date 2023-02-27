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
     * 商品一覧
     */
    public function index(Request $request)
    {
        $types = Type::paginate(15);
        return view('type.index', compact('types'));
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
        return redirect()->route('type.index');
    }
    /**
     * カテゴリー編集
     */
    public function edit($id)
    {
        $type = Type::all()->find($id);

        return view('type.edit', compact('type'));
    }
    /**
     * カテゴリー編集
     */
    public function update(Request $request, $id)
    {
        // 商品一覧取得
        $type = Type::all()->find($id);
        // dd($item);

        $type->name = $request->input('name');
        $type->save();

        return redirect()->route('type.index');
    }
    /**
     * カテゴリー削除
     */
    public function destroy($id)
    {
        Type::destroy($id);
        return redirect()->route('type.index');
    }
}
