@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>商品登録</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                </div>
            @endif
            <div class="table-responsive container">
                <ul class="list-group m-2">
                  <li class="list-group-item active" aria-current="true">商品コード</li>
                  <li class="list-group-item">{{$item->id}}</li>
                </ul>
                <ul class="list-group m-2">
                  <li class="list-group-item active" aria-current="true">名前</li>
                  <li class="list-group-item">{{$item->name}}</li>
                </ul>
                <ul class="list-group m-2">
                  <li class="list-group-item active" aria-current="true">種別</li>
                  <li class="list-group-item">
                    @if (!empty($item->type()->name))
                    {{ $item->type()->name }}
                    @else
                    未定
                    @endif</li>
                </ul>
                <ul class="list-group m-2">
                  <li class="list-group-item active" aria-current="true">作成日</li>
                  <li class="list-group-item">{{$item->created_at}}</li>
                </ul>
                <ul class="list-group m-2">
                  <li class="list-group-item active" aria-current="true">更新日</li>
                  <li class="list-group-item">{{$item->updated_at}}</li>
                </ul>
                <ul class="list-group m-2">
                  <li class="list-group-item active" aria-current="true">詳細</li>
                  <li class="list-group-item">{{$item->detail}}</li>
                </ul>
                  <td><a class="btn btn-dark" href="{{route('item.index')}}">戻る</a></td>
              </div>
    </div>

@stop

@section('css')
<style>
.row{
    justify-content: center;
}
.table-responsive{
    margin-bottom: 20px;
}
</style>

@stop

@section('js')
@stop
