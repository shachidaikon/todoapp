<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    </head>
<body>
    <h1>Todoの追加</h1>
        <form action="/todos" method="POST">
            @csrf
            <div class="title">
                <h2>Todo</h2>
                <input type="text" name="todo[title]" placeholder="タイトル" value="{{old('todo.title')}}" />
                <p class="title_error" style="color:red">{{$errors->first('title')}}</p>
            </div>
            <div class="content">
                <h2>内容詳細</h2>
                <textarea name="todo[content]" placeholder="Todoの詳細を入力してください" value="{{old('todo.content')}}"></textarea>
                <p style="color:red">{{$errors->first('content')}}</p>
            </div>
            <input type="submit" value="保存"/>
        </form>
        <div class="back">[<a href="/">back</a>]</div>
    </body>
</body>
</html>