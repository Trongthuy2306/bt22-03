<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $birthplace = $_POST['birthplace'];
    $department = $_POST['department'];
    $salary = $_POST['salary'];

    $conn = mysqli_connect('localhost', 'root', '', 'ql_nhansu');
    if (!$conn) {
        die('Kết nối không thành công: ' . mysqli_connect_error());
    }

    $sql = "INSERT INTO NHANVIEN (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong)
            VALUES ('$id', '$name', '$gender', '$birthplace', '$department', '$salary')";
    $result = mysqli_query($conn, $sql);

    mysqli_close($conn);

    header('Location: index.php');
    exit;
}
?>

<div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEmployeeModalLabel">Thêm Nhân viên</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="add_employee.php">
                    <div class="form-group">
                        <label for="name">Mã Nhân viên:</label>
                        <input type="text" class="form-control" id="id" name="id" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Tên Nhân viên:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Giới tính:</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="birthplace">Nơi Sinh:</label>
                        <input type="text" class="form-control" id="birthplace" name="birthplace" required>
                    </div>
                    <div class="form-group">
                        <label for="department">Tên Phòng:</label>
                        <input type="text" class="form-control" id="department" name="department" required>
                    </div>
                    <div class="form-group">
                        <label for="salary">Lương:</label>
                        <input type="number" class="form-control" id="salary" name="salary" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </form>
            </div>
        </div>
    </div>
</div>