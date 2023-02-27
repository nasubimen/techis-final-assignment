@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
@stop

@section('content')
<div class="pull-right d-flex flex-row-reverse">
    <a href="{{route('item.index')}}" class="reload">
        <i class="fas fa-sync-alt fa-2x"></i>
    </a>
</div>
<form action="{{route('item.index')}}" method="get" class="input-group mb-4">
    {{-- リロードした際に全一覧画面に戻るようにしたい --}}
    <input type="text" class="form-control" name="search" placeholder="名前検索" value="{{request()->search}}" >
    <input type="text" name="search2" class="form-control" placeholder="詳細検索" value="{{request()->search2}}" >
    <select name="search3" class="form-select" id='type'>
        <option value="">選択してください</option>
        @foreach ($types as $type)
        <option value="{{$type->id}}" {{request()->search3 == "$type->id" ? "selected" : "";}}>{{$type->name}}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-outline-success">検索</button>
</form>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">商品一覧</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ route('type.index') }}" class="btn btn-default">カテゴリ一覧</a>
                            </div>
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">商品登録</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>名前</th>
                                <th>種別</th>
                                <th>詳細</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @if (!empty($item->type()->name))
                                        {{ $item->type()->name }}
                                    @else
                                        未定
                                    @endif
                                    </td>
                                    <td>{{ $item->detail }}</td>
                                    <td><a href="{{route('item.show',$item->id)}}" class="btn btn-outline-primary">情報</a></td>
                                    <td><a href="{{route('item.edit',$item->id)}}" class="btn btn-outline-success">編集</a></td>
                                    <td><form action="{{route('item.destroy',$item->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="削除" class="btn btn-outline-danger" onclick="return confirm('本当に削除しますか??')">
                                    </form></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
<style>
    .pagination{
        justify-content: center;
    }
    .reload{
        padding: 10px;
    }
</style>
@stop

@section('js')
@stop
