<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    </head>
    <body class="antialiased">
        <h1>Todoリスト</h1>
            <h3>タスク{{$todo->title}}</h3>
            タスク内容:{{$todo->content}}
            作成日時:{{$todo->created_at}}
            <p class="edit">[<a href="/todos/{{ $todo->id }}/edit">編集する</a>]</p>
            <form action="/todos/{{$todo->id}}" id="form_delete", method="post" style="display:inline">
                @csrf
                @method('DELETE')
                <button class="delete" type="button" onclick="return deletePost(this);">delete</button>
            </form>

            <div class="footer">
                <a href="/">戻る</a>
            </div>

            <script>
                'use strict'
                    const deletePost = e => {
                        if(confirm('本当に削除しますか？')){
                            document.getElementById('form_delete').submit();
                        }
                    }
                </script>
    </body>
</html>