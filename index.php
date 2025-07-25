<?php
$conn = new mysqli("localhost", "root", "", "userdata");

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// إضافة البيانات
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name']) && isset($_POST['age'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];

    $stmt = $conn->prepare("INSERT INTO users (name, age) VALUES (?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("si", $name, $age);
    $stmt->execute();
    $stmt->close();
}

// تبديل الحالة
if (isset($_GET['toggle_id'])) {
    $id = (int)$_GET['toggle_id'];
    $result = $conn->query("SELECT status FROM users WHERE id = $id");
    if ($result && $row = $result->fetch_assoc()) {
        $new_status = $row['status'] == 0 ? 1 : 0;
        $conn->query("UPDATE users SET status = $new_status WHERE id = $id");
    }
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>User Form</title>
  <style>
    form { margin-bottom: 20px; }
    table, th, td { border: 1px solid black; border-collapse: collapse; }
    th, td { padding: 10px; }
    .active { background-color: #d4ffd4; }
    .inactive { background-color: #ffd4d4; }
  </style>
</head>
<body>

<h2>📋 Form</h2>
<form method="post">
  <input type="text" name="name" placeholder="Name" required>
  <input type="number" name="age" placeholder="Age" required>
  <input type="submit" value="Submit">
</form>

<h2>📊 Records</h2>
<table>
  <tr>
    <th>ID</th><th>Name</th><th>Age</th><th>Status</th><th>Action</th>
  </tr>
  <?php
    $res = $conn->query("SELECT * FROM users");
    if ($res) {
        while ($row = $res->fetch_assoc()) {
            $class = $row['status'] == 1 ? 'active' : 'inactive';
            $status = $row['status'] == 1 ? '✅ Active' : '❌ Inactive';
            echo "<tr class='$class'>";
            echo "<td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['age']}</td>";
            echo "<td>$status</td>";
            echo "<td><a href='?toggle_id={$row['id']}'>Toggle</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No records found.</td></tr>";
    }
    $conn->close();
  ?>
</table>

</body>
</html>