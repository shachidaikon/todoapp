<form action="/todos" method="POST">
  @csrf
  <input type="text" name="name" placeholder="タイトル" />
  <input type="submit" value="送信"/>
</form>