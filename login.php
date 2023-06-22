<?php
//开启会话
session_start();
//连接数据库
$conn=mysqli_connect('localhost:3307','root','123456','library');
if(!$conn){
    die("连接失败".mysqli_connect_error());
}
mysqli_set_charset($conn,"utf8");
//获取表单数据
$username = $_POST['username'];
$password = $_POST['password'];

// 对密码进行 hash 加密    
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// 将hashed密码存储到数据库
$sql = "update users set password ='$hashed_password' where username='$username'";
mysqli_query($conn,$sql);

//验证用户名和密码是否正确
$sql = "select * from users where username='$username'";
$result = mysqli_query($conn,$sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    if (password_verify($password, $row['password'])) {
        // 如果用户名和密码正确，将用户信息保存到会话中，并将用户重定向到主页
        $_SESSION['username'] = $username;
        header('Location: unload.php');
        exit();
    } else {
        // 如果密码不正确，返回错误信息
        echo "密码错误";
    }   
} else {
    // 如果用户名不存在，返回错误信息
    echo "用户不存在";
}

//关闭数据库连接
mysqli_close($conn);
?>