<!doctype html>
<html lang="en">

<head>
    <title>RMS | LOGIN</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">


</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;

    }

    .login {
        width: 400px;
        height: min-content;
        padding: 20px;
        border-radius: 12px;
        background: rgb(209, 207, 207);
    }

    .login h1 {
        font-size: 36px;
        margin-bottom: 25px;
        text-align: center;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    .btn {
        width: 100%;
        margin-bottom: 15px;
    }

    label {
        padding-bottom: 10px;
    }
</style>

<body>
    <div class="login">
        <h3 class="text-center">LOGIN (RMS)</h3>
        @include('helper._messages')
        <form method="post" action="/login">
            @csrf
            <input type="hidden" name="redirectto" value="{{ request()->redirectto }}">
            <div class="form-group mb-2">
                <label for="email">Email:</label>
                <input type="text" id="email" class="form-control" name="email">
            </div>
            <div class="form-group mb-3">
                <label for="password">Password:</label>
                <input type="password" id="password" class="form-control" name="password">
            </div>
            <div class="form-group">
                <button class="btn btn-success">Login</button>
            </div>
            <div class="text-center">New Here? <a href="/signup">Signup</a> </div>
</body>

</html>
