@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">商品一覧</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ route('type.create') }}" class="btn btn-default">カテゴリ登録</a>
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
</style>
@stop

@section('js')
@stop
