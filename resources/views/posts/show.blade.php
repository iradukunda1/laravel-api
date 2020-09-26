<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post Details</title>
</head>
<body>
<div style="display: block">
    <h1>{{$post->title}}</h1><a href="{{route('posts.edit',$post->id)}}">Edit</a>
    <a href="{{route('posts.edit',$post->id)}}" style="cursor:pointer;margin-left: 1rem;padding: 0.25rem;background-color: darkred;color: white">Delete</a>
</div>
</body>
</html>
