<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Type;

class ItemController extends Controller
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
        // 商品一覧取得
        $query = Item::query();
        // Item
        //     ::where('items.status', 'active')
        //     ->select()
        //     ->paginate(15);
        if (!empty($request->input('search'))) {
            $search_split = mb_convert_kana($request->input('search'), 's');
            $search_split2 = preg_split('/[\s]+/', $search_split);
            foreach ($search_split2 as $value) {
                $query->Where('name', 'LIKE', "%{$value}%");
            }
        }
        if (!empty($request->input('search2'))) {
            $search_split = mb_convert_kana($request->input('search2'), 's');
            $search_split2 = preg_split('/[\s]+/', $search_split);
            foreach ($search_split2 as $value) {
                $query->Where('detail', 'LIKE', "%{$value}%");
            }
        }
        if (!is_null($request->input('search3'))) {
            $query->Where('type', $request->input('search3'));
        }
        $items = $query->latest('updated_at')->paginate(15);
        $types = Type::all();

        return view('item.index', compact('items', 'types'));
    }

    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'detail' => $request->detail,
            ]);


            return redirect('/items');
        }

        $types = Type::all();

        return view('item.add', compact('types'));
    }

    /**
     * 商品情報
     */
    public function show($id)
    {
        // 商品一覧取得
        $item = Item::all()->find($id);
        // dd($item);

        return view('item.show', compact('item'));
    }
    /**
     * 商品情報
     */
    public function edit($id)
    {
        // 商品一覧取得
        $item = Item::all()->find($id);
        
        $types = Type::all();

        return view('item.edit', compact('item','types'));
    }
    /**
     * 商品情報
     */
    public function update(Request $request,$id)
    {
        // 商品一覧取得
        $item = Item::all()->find($id);
        // dd($item);

        $item->name = $request->input('name');
        $item->type = $request->input('type');
        $item->detail = $request->input('detail');
        $item->save();

        return redirect()->route('item.index');
    }

    public function destroy($id)
    {
        Item::destroy($id);
        return redirect()->route('item.index');
    }
}
