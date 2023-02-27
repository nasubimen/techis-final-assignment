@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>カテゴリー登録</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">カテゴリ一覧</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ route('type.create') }}" class="btn btn-default">カテゴリ登録</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>カテゴリ名</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($types as $type)
                                <tr>
                                    <td>{{ $type->name }}</td>
                                    <td><a href="{{route('type.edit',$type->id)}}" class="btn btn-outline-success">編集</a></td>
                                    <td><form action="{{route('type.destroy',$type->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="削除" class="btn btn-outline-danger" onclick="return confirm('本当に削除しますか??')">
                                    </form></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{ $types->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
