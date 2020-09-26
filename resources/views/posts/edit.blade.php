<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update</title>
</head>
<body>
<h1>Update Post</h1>
<form method="post" action="/posts/{{$post->id}}">
    {{csrf_field()}}
    <input type="hidden" name="_method" value="PUT">
    <input type="text" name="title" placeholder="Enter Title" value="{{$post->title}}">
    <input type="submit" name="submit" value="update">
</form>
<form action="/posts/{{$post->id}}" method="post">
    {{csrf_field()}}
    <input type="hidden" name="_method" value="DELETE">
    <input type="submit"  name="submit" value="Delete">
</form>
</body>
</html>
