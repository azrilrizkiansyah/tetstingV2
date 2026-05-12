<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReminderOS</title>
    @vite(['resources/css/registrasi.css'])
</head>

<body>
    <div class="register">
        <div class="form-login">
            <h1>silakan daftar</h1>
             <form method="POST" action="{{ route('register') }}">
                <div class="form-username">
                    <label for="" class="label">Username</label>
                    <input type="text" class="input-group" required>
                </div>
                <div class="form-email">
                    <label for="" class="label">Email</label>
                    <input type="text" class="input-group" required>
                </div>
                <div class="form-password">
                    <label for="" class="label">Password</label>
                    <input type="password" class="input-group" required>
                </div>
                <div class="form-konfirmasi-password">
                    <label for="" class="label">konfirmasi Password</label>
                    <input type="password" class="input-group" required>
                </div>
                <div class="login"><p>sudah mempunyai akun?<a href="/login">login</a></p></div>
                <button class="button-register" type="submit">daftar</button>
            </form>
        </div>
    </div>
</body>

</html>
