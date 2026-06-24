<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

$cid = $_SESSION['customer_id'];

if(isset($_POST['msg'])){

    $msg = $conn->real_escape_string($_POST['msg']);

    $conn->query("
        INSERT INTO support_tickets
        (sender_type, sender_id, message)
        VALUES
        ('CUSTOMER', $cid, '$msg')
    ");

    header("Location: chatbot.php");
    exit();
}

$tickets = $conn->query("
    SELECT *
    FROM support_tickets
    WHERE sender_type='CUSTOMER'
    AND sender_id=$cid
    ORDER BY ticket_id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Customer Chat Support</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-3 text-end">
<a href="dashboard.php" class="btn btn-outline-success">Back</a>
</div>

<div class="container my-4">

<h3>Customer Chat Support</h3>

<form method="POST" class="mb-4">
<textarea name="msg" class="form-control" rows="4" placeholder="Type your message..." required></textarea>
<button class="btn btn-success mt-2">Send Message</button>
</form>

<div class="card">
<div class="card-body">

<h5>My Messages</h5>

<?php
if($tickets && $tickets->num_rows > 0){

    while($t = $tickets->fetch_assoc()){
?>
        <div class="border rounded p-3 mb-3">

            <b>Message:</b><br>
            <?php echo $t['message']; ?>

            <br><br>

            <b>Admin Reply:</b><br>

            <?php
            if(!empty($t['reply'])){
                echo "<span class='text-success'>".$t['reply']."</span>";
            }else{
                echo "<span class='text-danger'>Pending...</span>";
            }
            ?>

            <hr>

            <small><?php echo $t['created_at']; ?></small>

        </div>
<?php
    }

}else{

    echo "<p>No messages yet.</p>";

}
?>

</div>
</div>

</div>

</body>
</html>