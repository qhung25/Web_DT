
<?php
session_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QH Store-iPhone Chính hãng</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <header>
        <h1>Welcome to QH Store</h1>
    </header>
    <div>
        <img src="image/slideshow1.jpg" alt="bia"width="100%" height="250px">
    </div>

    <nav>
        <a href="index.php">Trang Chủ</a>
            <div class="dropdown">
                <a href="#" class="dropdown-btn">Sản Phẩm <span class="arrow">&#9662;</span></a>
                    <div class="dropdown-content">
                        <a href="loaisanpham.php?Loại=1">iPhone 13 Series</a>
                        <a href="loaisanpham.php?Loại=2">iPhone 14 Series</a>
                        <a href="loaisanpham.php?Loại=3">iPhone 15 Series</a>
                        <a href="loaisanpham.php?Loại=4">iPhone 16 Series</a>
                </div>
            </div>
        <a href="khuyenMai.html"> Khuyến Mãi </a>   
        <a href="lienhe.html"> Liên Hệ </a>
        <a href="gioithieu.html"> Giới Thiệu </a>
    </nav>

    <div class="main-content">
        <div class="products">
            <?php
            // Kết nối cơ sở dữ liệu
            $conn = mysqli_connect("localhost", "username", "password", "database");
            if (!$conn) {
                die("Kết nối thất bại: " . mysqli_connect_error());
            }

            // Truy vấn dữ liệu
            $sql = "SELECT id, ten_san_pham, hinh_anh, gia, Giamgia FROM products";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                die("Lỗi truy vấn: " . mysqli_error($conn));
            }

            // Hiển thị sản phẩm
            if ($result->num_rows > 0) {
                echo "<div class='products'>";
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product'>";
                    echo "<img src='image/" . htmlspecialchars($row['hinh_anh']) . "' alt='" . htmlspecialchars($row['ten_san_pham']) . "' width='200' height='200'>";
                    echo "<h3>" . htmlspecialchars($row['ten_san_pham']) . "</h3>";
                    if ($row['Giamgia'] > 0) {
                        echo "<span class='price'><del>" . number_format($row['gia'], 0, ',', '.') . " VND</del></span>";
                        echo "<span class='price'>" . number_format($row['Giamgia'], 0, ',', '.') . " VND</span>";
                    } else {
                        echo "Giá: <span class='price'>" . number_format($row['gia'], 0, ',', '.') . " VND</span>";
                    }
                    
                    echo "<div class='buttons'>";
                    // echo "Chi tiết ";
                    echo "<a href='chitietsanpham.php?id=" . $row['id'] . "' class='btn chi tiet' style='display:inline-block;'>Chi tiết</a>";
                    echo "
                    <form method='post' action='cart.php' style='display:inline-block;'>
                        <input type='hidden' name='product_id' value='" . $row['id'] . "'>
                        <input type='submit' class='btn' value='Thêm vào giỏ'>
                    </form>
                    ";
                    
                    echo "</div>";
                    
                    echo "</div>";
                }
                echo "</div>";
            } else {
                echo "Không có sản phẩm nào.";
            }

            // Đóng kết nối
            mysqli_close($conn);
            ?>

        </div>


</body>


   <footer>
       <p>&copy; 2023 QH Store</p>
    </footer>
</body>
</html>