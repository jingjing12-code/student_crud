<?php include 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (int)$_POST['id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $age = (int)$_POST['age'];
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $yrlevel = mysqli_real_escape_string($conn, $_POST['yrlevel']);

    if ($age > 0) {
        $sql = "UPDATE students SET name='$name', age=$age, course='$course', yrlevel='$yrlevel' WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Age must be a positive number.";
    }
} else {
    $id = (int)$_GET['id'];
    $sql = "SELECT * FROM students WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $student = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
    
body {
    background: linear-gradient(135deg, #667eea, #764ba2);
    font-family: 'Poppins', sans-serif;
    color: #f4f4f9;
    min-height: 100vh;
    margin: 0;
    padding: 40px 20px;
    display: flex;
    justify-content: center;
    align-items: flex-start;
}


.container {
    background-color: rgba(255, 255, 255, 0.95);
    color: #2d2d2d;
    padding: 40px 50px;
    border-radius: 20px;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
    max-width: 900px;
    width: 100%;
    transition: all 0.3s ease;
}

.container:hover {
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.35);
}


h2 {
    text-align: center;
    color: #4a148c;
    font-weight: 900;
    font-size: 2.8rem;
    letter-spacing: 4px;
    margin-bottom: 40px;
    font-family: 'Montserrat', sans-serif;
}

.btn {
    border-radius: 45px;
    font-weight: 700;
    text-transform: uppercase;
    padding: 12px 28px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    border: none;
    transition: all 0.4s ease;
    cursor: pointer;
    letter-spacing: 1.2px;
    user-select: none;
    outline: none;
}

.btn-success {
    background: linear-gradient(45deg, #43cea2, #185a9d);
    color: white;
}

.btn-success:hover {
    background: linear-gradient(45deg, #185a9d, #43cea2);
    box-shadow: 0 7px 25px rgba(24, 90, 157, 0.7);
    transform: translateY(-3px);
}

.btn-primary {
    background: linear-gradient(45deg, #6d3fce, #a36cf7);
    color: white;
}

.btn-primary:hover {
    background: linear-gradient(45deg, #a36cf7, #6d3fce);
    box-shadow: 0 7px 25px rgba(163, 108, 247, 0.7);
    transform: translateY(-3px);
}

.btn-danger {
    background: linear-gradient(45deg, #f85032, #e73827);
    color: white;
}

.btn-danger:hover {
    background: linear-gradient(45deg, #e73827, #f85032);
    box-shadow: 0 7px 25px rgba(231, 56, 39, 0.7);
    transform: translateY(-3px);
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #5a6268;
    box-shadow: 0 7px 20px rgba(90, 98, 104, 0.7);
    transform: translateY(-3px);
}

a.btn-success.mb-3 {
    display: block;
    max-width: 200px;
    margin-left: auto;
    margin-bottom: 40px;
}

.table {
    width: 100%;
    border-collapse: separate !important;
    border-spacing: 0 12px !important;
}

.table thead th {
    background-color: #6a1b9a;
    color: #ffffff;
    text-transform: uppercase;
    font-weight: 700;
    font-size: 0.9rem;
    letter-spacing: 1.5px;
    padding: 16px 18px;
    border: none !important;
    border-radius: 8px;
}

.table tbody tr {
    background: linear-gradient(90deg, #f3e5f5, #e1bee7);
    box-shadow: 0 5px 20px rgba(107, 42, 141, 0.15);
    border-radius: 15px;
    transition: all 0.35s ease;
}

.table tbody tr:hover {
    background: linear-gradient(90deg, #ce93d8, #ba68c8);
    box-shadow: 0 10px 30px rgba(107, 42, 141, 0.3);
    transform: translateY(-4px);
    color: #fff;
}

.table tbody td {
    vertical-align: middle;
    padding: 18px 20px;
    font-weight: 600;
    color: #4a148c;
}

.table tbody td:last-child {
    text-align: center;
}
.table .btn-sm {
    padding: 6px 14px !important;
    font-size: 0.8rem;
    font-weight: 700;
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    user-select: none;
}

.table .btn-sm + .btn-sm {
    margin-left: 12px;
}

form {
    background: #ffffff;
    padding: 35px 40px;
    border-radius: 25px;
    max-width: 600px;
    margin: 0 auto 50px auto;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
}

form input[type="text"],
form input[type="number"],
form select {
    display: block;
    width: 100%;
    padding: 14px 18px;
    margin-bottom: 20px;
    border-radius: 12px;
    border: 2px solid #ced4da;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    outline: none;
    box-sizing: border-box;
}

form input[type="text"]:focus,
form input[type="number"]:focus,
form select:focus {
    border-color: #6a1b9a;
    box-shadow: 0 0 8px 2px rgba(106, 27, 154, 0.5);
}

form button[type="submit"] {
    width: 100%;
    font-weight: 800;
    font-size: 1.1rem;
    border-radius: 40px;
    cursor: pointer;
}

form a.btn-secondary {
    margin-top: 15px;
    display: block;
    width: 100%;
}

@media (max-width: 768px) {
    .container {
        padding: 30px 20px;
        width: 95%;
        margin-top: 20px;
    }

    .table thead {
        display: none;
    }

    .table, .table tbody, .table tr, .table td {
        display: block;
        width: 100%;
    }

    .table tbody tr {
        margin-bottom: 20px;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(106, 27, 154, 0.1);
        background: #fff;
        color: #4a148c;
    }

    .table tbody td {
        display: flex;
        justify-content: space-between;
        padding: 12px 15px;
        border-top: 1px solid #eee;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .table tbody td::before {
        content: attr(data-label);
        font-weight: 700;
        color: #6a1b9a;
        text-transform: uppercase;
    }

    .table tbody td:last-child {
        display: flex;
        justify-content: flex-start;
        gap: 12px;
    }

    .btn {
        font-size: 0.85rem;
        padding: 8px 18px;
        border-radius: 30px;
    }

    form {
        padding: 25px 20px;
        width: 100%;
    }
}
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Edit Student</h2>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
        <input type="text" name="name" class="form-control mb-2" placeholder="Name" value="<?php echo $student['name']; ?>" required>
        <input type="number" name="age" class="form-control mb-2" placeholder="Age" value="<?php echo $student['age']; ?>" required>
        <input type="text" name="course" class="form-control mb-2" placeholder="Course" value="<?php echo $student['course']; ?>" required>
        <input type="text" name="yrlevel" class="form-control mb-2" placeholder="Year Level" value="<?php echo $student['yrlevel']; ?>" required>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </form>
</body>
</html>
