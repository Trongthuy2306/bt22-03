<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Thông tin Nhân viên</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            width: 20px;
            height: 20px;
        }
    </style>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</head>

<body>
    <h1>THÔNG TIN NHÂN VIÊN</h1>
    <table>
        <tr>
            <th>Mã Nhân Viên</th>
            <th>Tên Nhân Viên</th>
            <th>Giới tính</th>
            <th>Nơi Sinh</th>
            <th>Tên Phòng</th>
            <th>Lương</th>
            <th>Thao tác</th>
        </tr>
        <a href="add_employee.php" class="btn btn-success">Thêm</a>
        <?php
        $conn = mysqli_connect('localhost', 'root', '', 'ql_nhansu');

        // Kiểm tra kết nối
        if (!$conn) {
            die("Không thể kết nối: " . mysqli_connect_error());
        }

        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $per_page = 5;
        $start_index = ($page - 1) * $per_page;

        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $per_page = 5;
        $start_index = ($page - 1) * $per_page;

        $query = "SELECT NV.Ma_NV, NV.Ten_NV, NV.Phai, NV.Noi_Sinh, PB.Ten_Phong, NV.Luong
          FROM NHANVIEN NV
          INNER JOIN PHONGBAN PB ON NV.Ma_Phong = PB.Ma_Phong
          LIMIT $start_index, $per_page";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['Ma_NV'] . "</td>";
                echo "<td>" . $row['Ten_NV'] . "</td>";
                echo "<td>";
                if ($row['Phai'] == 'NU') {
                    echo "<img src='nu.png'>";
                } else {
                    echo "<img src='nam.png'>";
                }
                echo "</td>";
                echo "<td>" . $row['Noi_Sinh'] . "</td>";
                echo "<td>" . $row['Ten_Phong'] . "</td>";
                echo "<td>" . $row['Luong'] . "</td>";
                echo "<td>";
                echo "<a href='delete_employee.php?id=" . $row['Ma_NV'] . "' class='btn btn-danger'>Xóa</a> ";
                echo "<a href='edit_employee.php?id=" . $row['Ma_NV'] . "' class='btn btn-primary'>Sửa</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Không có nhân viên</td></tr>";
        }

        $count_query = "SELECT COUNT(*) AS total FROM NHANVIEN";
        $count_result = mysqli_query($conn, $count_query);
        $count_row = mysqli_fetch_assoc($count_result);
        $total_employees = $count_row['total'];

        $total_pages = ceil($total_employees / $per_page);

        echo "<div>";
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<a href='?page=$i'>$i</a> ";
        }
        echo "</div>";
        // Đóng kết nối
        mysqli_close($conn);
        ?>