<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>上传pdf文件</title>
</head>
<body>
    <h1 align="center">图书馆</h1>
    <h3 align="left">请上传书籍 文件格式为:pdf</h3>
    <form action = "unload.php" method="post" enctype="multipart/form-data">
        <label for="file">选择pdf文件:</label>
        <input type ="file" id="file" name="file"><br><br>
        <input type = "submit" value = "上传">
    </form>
</body>
</html>
<?php
// 检查文件是否上传成功
if ($_FILES['file']['error'] > 0) {
    echo "文件上传失败";
} else {
    // 检查文件类型是否为PDF
    if ($_FILES['file']['type'] != 'application/pdf') {
        echo "只能上传PDF文件";
    } else {
        // 将文件保存到服务器
        move_uploaded_file($_FILES['file']['tmp_name'], './library/' . $_FILES['file']['name']);
        echo "文件上传成功";
    }
}
?>
<?php
// 遍历 library 目录下的所有 PDF 文件
$dir = './library/';
$files = scandir($dir);
foreach ($files as $file) {
    if ($file != '.' && $file != '..' && pathinfo($file, PATHINFO_EXTENSION) == 'pdf') {
        // 生成对应的 HTML 代码
        echo '<div>';
        echo '<a href="' . $dir . '/' . $file . '">' . $file . '</a>';
        echo '</div>';
    }
}
?>



