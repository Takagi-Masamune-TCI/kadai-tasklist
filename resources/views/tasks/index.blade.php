@extends('layouts.app')

@section('content')
    @if (Auth::check())

        {{-- ユーザーの情報 --}}
        <div class="mb-2">
            <h2 class="text-xl">{{ Auth::user()->name }}</h2>
        </div>

        {{-- タスク --}}
        <h2 class="prose ml-4">
            <h2 class="text-lg">タスク 一覧</h2>
        </h2>

        @if (isset($tasks))
            <table class="table table-zebra w-full my-4">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>内容</th>
                        <th>状態</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                    <tr>
                        <td><a class="link link-hover text-info" href="{{ route('tasks.show', $task->id) }}">{{ $task->id }}</a></td>
                        <td>{{ $task->content }}</td>
                        <td>{{ $task->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        {{-- タスク作成ページへのリンク --}}
        <a class="btn btn-primary" href="{{ route('tasks.create') }}">新規タスクの作成</a>

    @else
        <div class="prose hero bg-base-200 mx-auto max-w-full rounded">
        <div class="hero-content text-center my-10">
            <div class="max-w-md mb-10">
                <h2 class="text-2xl mb-2">タスク管理アプリ</h2>
                <div class="flex gap-2">
                    <a class="btn btn-primary btn-lg normal-case" href="{{ route('register') }}">サインアップ</a>
                    <a class="btn btn-soft btn-lg normal-case" href="{{ route('login') }}">ログイン</a>
                </div>
            </div>
        </div>
    @endif

@endsection