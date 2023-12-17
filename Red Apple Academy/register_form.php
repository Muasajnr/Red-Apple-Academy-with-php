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
    margin-top: 10px;
    margin-left: 30%;
    border:none;
    border-radius:10px;
    height: 40px;
    font-size: 18px;
    }

</style>


<!-- register_form.php -->
<form action="register.php" method="post">
<h1>RECOVER ACCOUNT IN RED APPLE ACADEMY LIBRARY</h1>
    <label for="new_username">New Username:</label>
    <input type="text" id="new_username" name="new_username" required><br><br>

    <label for="new_password">New Password:</label>
    <input type="password" id="new_password" name="new_password" required><br>

    <input type="submit" id="button" value="Register">
</form>
