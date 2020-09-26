<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
</head>
<body>

<h1>Hello  All Data Are Listed Bellow</h1>
<ul>
        @foreach($posts as $post)

        <li style="color: darkviolet; width: fit-content;padding-bottom: 1rem">
            <a href="{{route('posts.show',$post->id)}}" style="cursor:pointer;"> {{$post->title }}</a>
                <a href="{{route('posts.edit',$post->id)}}" style="cursor:pointer;margin-left: 1rem">Edit</a>
            <span href="{{route('posts.edit',$post->id)}}" style="font-size:14px;cursor:pointer;margin-left: 1rem;padding: 0.25rem;background-color: darkred;color: white" type="_method" value="DELETE">Delete</span>
        </li>

        @endforeach
</ul>
</body>
</html>
