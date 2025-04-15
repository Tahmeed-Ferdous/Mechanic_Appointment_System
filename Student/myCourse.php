<?php 
if(!isset($_SESSION)){
    session_start();
}

include("stuinclude/header.php");
include("../dbConnection.php");

if(isset($_SESSION['stuLogEmail'])) {
    $stuLogEmail = $_SESSION['stuLogEmail'];
} else {
    echo "<script>alert('Login to access this page');</script>";
    echo "<script>location.href='../index.php'</script>";
    exit();
}
?>
<title>My Mechanic</title>

<style>
    body {
        background-color: #f9fafb;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .main-content {
        margin-left: 250px;
        padding: 2rem;
    }

    .course-title {
        font-weight: 600;
        font-size: 2rem;
        color: #2c3e50;
    }

    .card {
        border: none;
        border-radius: 15px;
        transition: all 0.3s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    }

    .card-img-top {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .card-body {
        padding: 1.25rem;
    }

    .btn-primary {
        border-radius: 20px;
        padding: 6px 18px;
        font-weight: 500;
        background-color: #3498db;
        border: none;
    }

    .btn-primary:hover {
        background-color: #2980b9;
    }

    .course-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: 2rem;
    }

    @media(max-width: 992px) {
        .course-grid {
            grid-template-columns: repeat(2, 1fr); 
        }
    }

    @media(max-width: 768px) {
        .course-grid {
            grid-template-columns: 1fr; 
        }

        .main-content {
            margin-left: 0;
        }
    }
</style>

<div class="main-content">
    <h4 class="text-center course-title mb-5">🎓 My Mechanic Work update</h4>

    <?php 
    $sql = "SELECT co.order_id, c.course_id, c.course_name, c.course_duration, c.course_desc, 
                   c.course_img, c.course_author, c.course_price 
            FROM courseorder AS co 
            JOIN course AS c ON co.course_id = c.course_id 
            WHERE co.stu_email = '$stuLogEmail'";

    $result = $conn->query($sql);

    if (!$result) {
        echo "<div class='alert alert-danger'>SQL Error: " . $conn->error . "</div>";
    }

    if($result && $result->num_rows > 0){ ?>
        <div class="course-grid">
        <?php while($row = $result->fetch_assoc()){ ?>
            <div class="card shadow-sm h-100">
                <img src="<?php echo $row['course_img']; ?>" alt="Course Image" class="card-img-top" style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?php echo $row['course_name']; ?></h5>
                    <p class="card-text text-muted small mb-2"><?php echo $row['course_desc']; ?></p>
                    <p class="mb-1"><strong>⏱ Duration:</strong> <?php echo $row['course_duration']; ?></p>
                    <p class="mb-1"><strong>👨‍🏫 Number:</strong> <?php echo $row['course_author']; ?></p>
                    <p class="mb-3"><strong>💰 Price:</strong> 
                        <small><del>&#8377;<?php echo $row['course_price']; ?></del> (Paid)</small>
                    </p>
                    <a class="btn btn-primary mt-auto align-self-start">▶ Call</a>
                    <form method="POST" action="">
                        <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                        <button type="submit" name="delete_course" class="btn btn-danger">🗑 Delete</button>
                    </form>
                </div>
            </div>
        <?php } ?>
        </div>
    <?php } else {
        echo "<div class='text-center'><p>No Mechanic found. Find a Mechanic first!</p></div>";
    } ?>

    <?php 
    if (isset($_POST['delete_course'])) {
        $order_id = $_POST['order_id'];
        $delete_sql = "DELETE FROM courseorder WHERE order_id = '$order_id' AND stu_email = '$stuLogEmail'";
        if ($conn->query($delete_sql) === TRUE) {
            echo "<script>alert('Mechanic removed successfully!');</script>";
        } else {
            echo "<div class='alert alert-danger'>Error deleting Mechanic: " . $conn->error . "</div>";
        }
    }
    ?>
</div>



