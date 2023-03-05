@extends('adminlte::page')

@section('title', 'カテゴリ編集')

@section('content_header')
    <h1>カテゴリー編集</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">
                <form method="POST" action="{{route('type.update',$type->id)}}">
                    @method('put')
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">カテゴリ名</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$type->name}}">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">編集</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
