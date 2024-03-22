<?php
// Kết nối cơ sở dữ liệu
$conn = mysqli_connect('localhost', 'root', '', 'ql_nhansu');

// Kiểm tra kết nối
if (!$conn) {
    die("Không thể kết nối: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $tenNV = $_POST['tenNV'];
        $phai = $_POST['phai'];
        $noiSinh = $_POST['noiSinh'];
        $maPhong = $_POST['maPhong'];
        $luong = $_POST['luong'];

        $query = "UPDATE NHANVIEN
                  SET Ten_NV = '$tenNV', Phai = '$phai', Noi_Sinh = '$noiSinh', Ma_Phong = '$maPhong', Luong = '$luong'
                  WHERE Ma_NV = '$id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "Cập nhật thông tin nhân viên thành công";
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    } else {
        $query = "SELECT * FROM NHANVIEN WHERE Ma_NV = '$id'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
?>
        <!DOCTYPE html>
        <html>

        <head>
            <title>Sửa thông tin nhân viên</title>
            <style>
                /* CSS cho Form sửa thông tin nhân viên */
                form {
                    margin-bottom: 20px;
                }

                label {
                    display: block;
                    margin-bottom: 5px;
                }

                input[type="text"] {
                    width: 300px;
                    padding: 5px;
                    margin-bottom: 10px;
                }

                input[type="submit"] {
                    padding: 10px 15px;
                    background-color: #4CAF50;
                    color: white;
                    border: none;
                    cursor: pointer;
                }

                input[type="submit"]:hover {
                    background-color: #45a049;
                }
            </style>
        </head>

        <body>
            <!-- Form sửa thông tin nhân viên -->
            <form method="POST" action="">
                <label for="tenNV">Tên Nhân Viên:</label>
                <input type="text" name="tenNV" value="<?php echo $row['Ten_NV']; ?>"><br>

                <label for="phai">Giới Tính:</label>
                <input type="text" name="phai" value="<?php echo $row['Phai']; ?>"><br>

                <label for="noiSinh">Nơi Sinh:</label>
                <input type="text" name="noiSinh" value="<?php echo $row['Noi_Sinh']; ?>"><br>

                <label for="maPhong">Mã Phòng:</label>
                <input type="text" name="maPhong" value="<?php echo $row['Ma_Phong']; ?>"><br>

                <label for="luong">Lương:</label>
                <input type="text" name="luong" value="<?php echo $row['Luong']; ?>"><br>

                <input type="submit" value="Lưu">
            </form>
        </body>

        </html>
<?php
    }
}

// Đóng kết nối
mysqli_close($conn);
?>