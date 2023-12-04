<?php
session_start();

// 데이터베이스에 연결
$host = "localhost";
$username = "사용자명";
$password = "비밀번호";
$dbname = "데이터베이스명";

// 연결 생성
$conn = new mysqli($host, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

// 폼이 제출되었는지 확인
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    // 자격증명 확인
    $query = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // 자격증명이 맞으면
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user;
        // 새 페이지로 리디렉션
        header("location: welcome.php");
    } else {
        // 자격증명이 틀리면
        $error = "로그인 이름 또는 비밀번호가 유효하지 않습니다";
    }
}
$conn->close();
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
