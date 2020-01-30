@extends('layouts.master')
@section('title', '代辦清單')
@section('head_title', '待辦事項清單')
@section('content')

    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    建立新待辦事項
                </div>

                <div class="panel-body">
                @if ($errors->any())
                    <!-- 錯誤訊息顯示區塊 -->
                        <div class="alert alert-danger">
                            <strong>請檢查您輸入的資料！</strong>
                            <br><br>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                @endif

                <!-- 建立新 Task 表單 -->
                    <form action="/tasks" method="POST" class="form-horizontal">

                    @csrf

                    <!-- Task 名稱 -->
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">待辦事項</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="task-name" class="form-control" value="">
                            </div>
                        </div>

                        <!-- 建立新 Task 按鈕 -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-plus"></i>建立待辦事項
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tasks 清單 -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    所有待辦事項清單:
                </div>

                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <thead>
                        <tr>
                            <th>待辦事項</th>
                            <th width="200">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td class="table-text">
                                    @if ($task->completed)
                                        <div class="check">{{ $task->name }}</div>
                                    @else
                                        <div class="">{{ $task->name }}</div>
                                    @endif
                                </td>
                                <td>
                                @if (!$task->completed)
                                    <!-- 完成 Task 按鈕 -->
                                        <form action="/tasks/{{ $task->id }}" method="POST" class="form-inline">

                                            @csrf
                                            @method('PATCH')

                                            <button type="submit" class="btn btn-success">
                                                <i class="fa fa-check"></i>完成
                                            </button>
                                        </form>
                                @endif

                                <!-- 刪除 Task 按鈕 -->
                                    <form action="/tasks/{{ $task->id }}" method="POST" class="form-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>刪除
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
