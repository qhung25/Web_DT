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
            // kết nối cơ sở dữ liệu
            include 'dtb.php';

            $loai = $_GET['Loai'] ?? '';

            // truy vấn sản phẩm theo loại
            $stmt = $conn ->prepare("SELECT id, ten_san_pham, hinh_anh, gia, Giamgia FROM products WHERE Loại = ?");
            $stmt->bind_param("i", $loai); // 's' là kiểu dữ liệu string, 'i' là kiểu dữ liệu integer
            $stmt->execute();
            $result = $stmt->get_result();

            // Kiểm tra nếu có sản phẩm
            if ($result->num_rows > 0) {
                echo "<div class='products'>";
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product' href = 'chitietsanpham.php?id=" . $row['id'] . "'><div>";
                    echo "<img src='image/" . htmlspecialchars($row['hinh_anh']) . "' alt='" . htmlspecialchars($row['ten_san_pham']) . "' width='200px' height='200px'>";
                    echo "<h3>" . htmlspecialchars($row['ten_san_pham']) . "</h3>";
                    echo "<span class='price'>" . number_format($row['gia'], 0, ',', '.') . "đ</span>";
                    if ($row['Giamgia'] > 0) {
                        echo "<span class='original-price'>" . number_format($row['gia'], 0, ',', '.') . " VND</span> ";
                        echo "<span class='price'>" . number_format($row['Giamgia'], 0, ',', '.') . " VND</span>";
                    } else {
                        echo "<span class='price'>Giá: " . number_format($row['gia'], 0, ',', '.') . " VND</span>";
                    }
                    
                    echo "<div class='buttons'>";
                    // echo "<a href='chitietsanpham.php?id=" . $row['id'] . "' class='btn'>Chi tiết</a> ";
                    echo "<form method='post' action='cart.php' style='display:inline-block;'>
                    
                    <input type='hidden' name='product_id' value='" . $row['id'] . "'>
                    <input type='submit' class='btn' value='Thêm vào giỏ'>
                    
                    </form>"
                    
                    ;
                    
                    echo "</div>";
                    
                    echo "</div>";
                    echo "</a>";
                }
                echo "</div>";
            } else {
                echo "Không có sản phẩm nào.";
            }
     
            ?>




        </div>

    </div>


   
    <footer>
        <p>&copy; 2023 QH Store</p>
    </footer>
</body>
</html>