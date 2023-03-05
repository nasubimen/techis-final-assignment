<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\Type;
use App\Models\User;

class LogController extends Controller
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

    public function index(Request $request)
    {

        $query = Log::query();
        $user = User::query();
        if (!empty($request->input('search'))) {
            $search_split = mb_convert_kana($request->input('search'), 's');
            $search_split2 = preg_split('/[\s]+/', $search_split);
            $user->where(function ($user) use ($search_split2) {
                foreach ($search_split2 as $value) {
                    $user->orWhere('name', 'LIKE', "%{$value}%");
                }
            });
            // ※補足
            // useは無名関数（クロージャ）の外側の変数を内側の無名関数で使うための仕組みです。
            // $search_split2は外側のif文の中で定義された変数であり、$userクエリビルダーの内側の無名関数でも使いたいため、
            // useを使ってこの変数を無名関数のスコープに導入しています。
            // 具体的には、use ($search_split2)を使うことで、$search_split2変数を内側の無名関数で使用できます。これによって、
            // $search_split2の値をループで回しながら、内側の無名関数でwhere条件を追加することができます。
            $users = $user->get();
            foreach ($users as $value) {
                $query->orWhere('user_id', $value->id);
            }
        }
        if (!empty($request->input('search1'))) {
            $search_split = mb_convert_kana($request->input('search1'), 's');
            $search_split2 = preg_split('/[\s]+/', $search_split);
            foreach ($search_split2 as $value) {
                $query->Where('name', 'LIKE', "%{$value}%");
            }
        }
        if (!is_null($request->input('search3'))) {
            $query->Where('type', $request->input('search3'));
        }
        $logs = $query->latest('updated_at')->paginate(15);
        $types = Type::all();
        return view('log.index', compact('logs', 'types'));
    }
    public function show($id)
    {
        $log = Log::find($id);
        return view('log.show', compact('log'));
    }
}
