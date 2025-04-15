<?php 
include("../dbConnection.php");
session_start();

if (!isset($_SESSION['stuLogEmail'])) {
    echo "<script>alert('You must log in first to access the checkout page.');</script>";
    echo "<script>location.href='../index.php'</script>";
    exit();
}

$stuEmail = $_SESSION['stuLogEmail'];

$course_id = "";
$amount = "";

if (isset($_POST['id'])) {
    $data = explode(",", $_POST['id']);
    if (count($data) == 2) {
        $course_id = trim($data[0]);
        $amount = trim($data[1]);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            <h3 class="mb">Welcome to checkout</h3>
            <form method="POST" action=""> 
                <div class="form-group row">
                    <label for="ORDER_ID" class="col-sm-4">Order ID</label>
                    <div class="col-sm-8">
                        <input id="ORDER_ID" class="form-control" name="ORDER_ID" value="<?php echo rand(10000,99999999); ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="CUST_ID" class="col-sm-4">Student Email</label>
                    <div class="col-sm-8">
                        <input id="CUST_ID" class="form-control" name="CUST_ID" value="<?php echo $stuEmail; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="TXN_Amount" class="col-sm-4">Amount</label>
                    <div class="col-sm-8">
                        <input id="TXN_Amount" class="form-control" name="TXN_Amount" value="<?php echo $amount; ?>" readonly>
                    </div>
                </div>
                <!-- Hidden course ID -->
                <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">

                <div class="text-center">
                    <input value="Checkout" type="submit" class="btn btn-primary" name="checkout_btn">
                    <a href="../index.php" class="btn btn-secondary ml-2">Cancel</a>
                </div>
            </form>
            <small class="form-text text-muted mt-3">Complete payment by clicking checkout button</small>
        </div>
    </div>
</div>
</body>
</html>

<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout_btn'])) {
    $order_id = $_POST['ORDER_ID'];
    $cust_id = $_POST['CUST_ID'];
    $amount = $_POST['TXN_Amount'];
    $course_id = $_POST['course_id'];
    $date = date("Y-m-d H:i:s");

    $check_sql = "SELECT * FROM courseorder WHERE stu_email='$cust_id' AND status='ongoing'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo "<script>alert('You cannot purchase a new mechanic until you complete your ongoing mechanic.');</script>";
        echo "<script>setTimeout(() => { window.location.href = '../Student/myCourse.php'; }, 2000);</script>";
    } else {
        $check_course_sql = "SELECT * FROM courseorder WHERE stu_email='$cust_id' AND course_id='$course_id'";
        $check_course_result = $conn->query($check_course_sql);

        if ($check_course_result->num_rows > 0) {

            $update_sql = "UPDATE courseorder SET status='ongoing' WHERE stu_email='$cust_id' AND course_id='$course_id'";
            if ($conn->query($update_sql) === TRUE) {
                echo "<script>alert('You have already purchased this Mechanic.');</script>";
                echo "<script>setTimeout(() => { window.location.href = '../Student/myCourse.php'; }, 2000);</script>";
            } else {
                echo "<script>alert('Error updating status: " . $conn->error . "');</script>";
            }
        } else {
    
            $sql = "INSERT INTO courseorder (order_id, stu_email, course_id, order_date, amount, status) 
                    VALUES ('$order_id', '$cust_id', '$course_id', '$date', '$amount', 'ongoing')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Order placed successfully!');</script>";
                echo "<script>setTimeout(() => { window.location.href = '../Student/myCourse.php'; }, 2000);</script>";
            } else {
                echo "<script>alert('Error placing order: " . $conn->error . "');</script>";
            }
        }
    }
}
?>

