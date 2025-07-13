<?php
session_start();
require '../db.php'; // sửa đúng đường dẫn file kết nối

if (!isset($_SESSION['user_id'])) {
    header('Location:../DangNhap.php');
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT email, sdt, dia_chi FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($email, $sdt, $dia_chi);
$stmt->fetch(); //Lấy dòng kết quả đầu tiên từ truy vấn và đặt giá trị của từng cột vào các biến $email, $sdt, $dia_chi.//
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông Tin Cá Nhân</title>
    <link rel="stylesheet" href="thongtincanhan2.css">
</head>
<body>
    <div class="form-container">
        <h2>Thông Tin Cá Nhân</h2>

        <form action="capnhat_thongtin.php" method="post">
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">

            <label>Số điện thoại:</label>
            <input type="number" name="sdt" value="<?php echo htmlspecialchars($sdt); ?>">

            <label>Địa chỉ:</label>
            <input type="text" name="dia_chi" value="<?php echo htmlspecialchars($dia_chi); ?>">

            <?php
            if (isset($_SESSION['success'])) {
                echo '<p style="color:green; text-align:center;">' . $_SESSION['success'] . '</p>';
                unset($_SESSION['success']);
            }
            if (isset($_SESSION['error'])) {
                echo '<p style="color:red; text-align:center;">' . $_SESSION['error'] . '</p>';
                unset($_SESSION['error']);
            }
            ?>
            
            <button type="submit">Cập nhật</button>
        </form>

        <div style="text-align:center; margin-top: 20px;">
            <a href="../index.php">Quay về Trang Chính</a>
        </div>
    </div>
</body>
</html>
