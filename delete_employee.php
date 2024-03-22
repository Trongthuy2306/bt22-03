<?php
// Kết nối cơ sở dữ liệu
$conn = mysqli_connect('localhost', 'root', '', 'ql_nhansu');

// Kiểm tra kết nối
if (!$conn) {
    die("Không thể kết nối: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Xóa nhân viên từ cơ sở dữ liệu
    $query = "DELETE FROM NHANVIEN WHERE Ma_NV = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Xóa nhân viên thành công";
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}

// Đóng kết nối
mysqli_close($conn);
