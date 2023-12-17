<style>
    form{
        width: 50%;
        margin-inline: auto;
        margin-top: 150px;
        background: linear-gradient(to bottom, #fcb045, #fd1d1d, #833ab4);
        padding: 10px;
        color: #fff;
        font-size: 18px;
        
    }
    input,label{
        width:70%;
        height: 30px;
        margin-left: 15%;
    }
    p{
        text-align: center;
    }
    h1{
        color: #fff;
    text-shadow: 4px 4px #833ab4;
    text-align: center;
    }
    #button{
    width:40%;
    background-color:#fd1d1d;
 
    margin-left: 30%;
    border:none;
    border-radius:10px;
    height: 40px;
    font-size: 18px;
    }

</style>

<!-- login_form.php -->

<form action="login.php" method="post">
    <h1>LOGIN TO RED APPLE ACADEMY LIBRARY</h1>
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br><br>

    <input type="submit" id="button" value="Login">

    <p>Lost Username/Password? <a href="register_form.php" style="color:#fcb045;">Recover here</a></p>

</form>


