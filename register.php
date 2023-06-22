<?php
    //连接数据库
    $conn=mysqli_connect('localhost:3307','root','123456','library');
    if(!$conn){
        die("连接失败".mysqli_connect_error());
    }

    //获取表单数据
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    
    //查询数据库中是否存在相同的用户名或电子邮件地址
    $sql = "select * from users where username='$username'or email='$email'";
    $result = mysqli_query($conn,$sql);

    if (mysqli_num_rows($result) > 0) {
        // 如果存在相同的用户名或电子邮件地址，返回错误信息
        echo "该用户名或电子邮件地址已被注册";
    } else {
        // 如果不存在相同的用户名或电子邮件地址，将用户信息保存到数据库中
        $sql = "INSERT INTO users (username,password, email) VALUES ('$username', '$password', '$email')";
        if (mysqli_query($conn, $sql)) {
            echo "注册成功";
            echo " Please <a href='login.html'>login</a> to continue.";
        } else {
            echo "注册失败: " . mysqli_error($conn);
        }
    }
// 关闭数据库连接
mysqli_close($conn);
?>