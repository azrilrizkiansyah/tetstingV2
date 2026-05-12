<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReminderOS</title>
   @csrf
</head>

<body>
    <div class="login-container">    
        <h1>Login</h1>
        <form action="/login" method="POST">
            @csrf
            <div class="form-username">
                <label for="username">Username</label>
                <input type="username" id="username" name="username" required>
            </div>
            <div class="form-password">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="register">
                <p>belum punya akun? <a href="/register">daftar </a></p>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>