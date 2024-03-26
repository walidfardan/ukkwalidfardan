<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style/loginstyle.css">
</head>
<body>

<div  class="form-container" id="login-form" >
                <form action="proses_login.php" method="post">
                   
                    <div class="text-form" style="padding-top: 100px;">
                        <h1>Welcome to WebGallery</h1>
                        <p>Find new ideas to try</p>
                    </div>
                    <div class="con-login">
                    <ul>
                        <li>
                            <label for="username">Username <br> </label>
                            <input type="text" name="username" id="username" placeholder="Create new username">  
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <label for="password">Password <br> </label>
                            <input type="password" id="pw" name="password" placeholder="Create a password" required>
                            <span class="toggle-pw" onclick="togglePasswordVisibility2()" style="margin-left: -30px;"><i class="far fa-eye-slash"></i></span>
                        </li>
                    </ul>
                        
                    <ul>
                        <li>
                            <input type="submit" value="Continue" class="button-login">
                        </li>
                    </ul>
                    <ul style="margin-left: 120px; margin-bottom: 6px; ">
                        <span>OR</span>
                    </ul>
                    <ul>
                        <li>
                            <a href="#" id="register-link" class="button-login">Belum punya akun ? Register</a>
                        </li>
                    </ul>
                </div>
                </form>
    
            </div>
    
</body>
</html>