<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <title>Post</title>
    </head>
    <body>
        <div class="container">
        <h1>This is also my post number : {{$id}}</h1>
        @if (count($people))
            <ul>
                @foreach($people as $person)
                <li>{{$person}}</li>
                @endforeach
            </ul>
        @endif
        </div>
    </body>
</html>
