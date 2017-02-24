<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel 上传图片到七牛存储方法 </title>
    </head>

    <body>
        <form action="{{ url('store') }}"  method="post" enctype="multipart/form-data">
            <input type="file" name="photo">
            <input type="submit" name="上传图片">
        </form>

        <br/>
        <br/>
        <br/>

        @if(Session::has('msg'))
            {{Session::get('msg')}}
        @endif
    </body>

</html>
