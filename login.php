<?php
session_start();

// 하드코딩된 사용자명과 비밀번호
$correct_username = "testuser";
$correct_password = "testpass";

// 폼이 제출되었는지 확인
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // 자격증명 확인
    if ($user === $correct_username && $pass === $correct_password) {
        // 자격증명이 맞으면
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user;
        // 새 페이지로 리디렉션
        header("location: welcome.php");
        exit;
    } else {
        // 자격증명이 틀리면
        $error = "로그인 이름 또는 비밀번호가 유효하지 않습니다";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>로그인 페이지</title>
</head>
<body>

<div>
    <div>
        <h1>로그인</h1>
        <div><?php if(isset($error)){ echo $error; } ?></div>
        <div>
            <form action="" method="post">
                <label>사용자명 :</label>
                <input type="text" name="username" required>
                <label>비밀번호 :</label>
                <input type="password" name="password" required>
                <input type="submit" value=" 제출 ">
            </form>
        </div>
    </div>
</div>

</body>
</html>
