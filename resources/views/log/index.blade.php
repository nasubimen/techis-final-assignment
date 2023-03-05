@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>履歴一覧</h1>
@stop

@section('content')
<div class="pull-right d-flex flex-row-reverse">
    <a href="{{route('log.index')}}" class="reload">
        <i class="fas fa-sync-alt fa-2x"></i>
    </a>
</div>
<form action="{{route('log.index')}}" method="get" class="input-group mb-4">
    {{-- リロードした際に全一覧画面に戻るようにしたい --}}
    <input type="text" class="form-control" name="search" placeholder="ユーザー検索" value="{{request()->search}}" >
    <input type="text" class="form-control" name="search1" placeholder="商品名検索" value="{{request()->search1}}" >
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
                    <h3 class="card-title">履歴</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <tbody>
                            @foreach ($logs as $log)
                             <tr>
                                <td>
                                    @if ($log->log_id === 1)
                                    <i class="fas fa-plus-circle"></i>
                                    @elseif($log->log_id === 2)
                                    <i class="fas fa-edit"></i>
                                    @elseif($log->log_id === 3)
                                    <i class="fas fa-trash"></i>
                                    @else
                                    <i class="fas fa-question-circle"></i>
                                    @endif
                                    {{ $log->user()->name }} が
                                        @if (!empty($log->type()->name))
                                        {{ $log->type()->name }}
                                        @else
                                        未定
                                        @endif
                                        の{{$log->name}}を
                                        @if (!empty($log->log_type()->name))
                                        {{ $log->log_type()->name }}
                                        @else
                                        ???
                                        @endif
                                    しました
                                </td>
                                <td><a href="{{route('log.show',$log->id)}}" class="btn btn-outline-primary">詳細</a></td>
                                <td>{{ App\Models\Log::date_time($log->updated_at) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{ $logs->links() }}
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
