<!doctype html>
<html lang="en">

<head>
    <title>RMS | SIGN UP</title>
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
        <h3 class="text-center">SIGN UP (RMS)</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" action="/signup">
            @csrf
            <div class="form-group mb-2">
                <label for="name">Name:</label>
                <input type="text" id="name" class="form-control" value="{{ old('name') }}" name="name">
            </div>

            <div class="form-group mb-2">
                <label for="email">Email:</label>
                <input type="text" id="email" class="form-control" value="{{ old('email') }}" name="email">
            </div>

            <div class="form-group mb-3">
                <label for="password">Password:</label>
                <input type="password" id="password" class="form-control" name="password">
            </div>

            <div class="form-group mb-3">
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" id="password_confirmation" class="form-control" name="password_confirmation">
            </div>
            <div class="form-group ">
                <button class="btn btn-success">Register</button>
            </div>
            <div class="text-center">Already a user? <a href="/">Login</a></->
            </div>
</body>

</html>
