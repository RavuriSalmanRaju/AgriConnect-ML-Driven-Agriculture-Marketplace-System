<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if(isset($_POST['reply_btn'])){

    $id = intval($_POST['ticket_id']);
    $reply = $conn->real_escape_string($_POST['reply']);

    $conn->query("
        UPDATE support_tickets
        SET reply='$reply',
            status='CLOSED'
        WHERE ticket_id=$id
    ");

    header("Location: support_tickets.php");
    exit();
}

$tickets = $conn->query("
    SELECT *
    FROM support_tickets
    ORDER BY ticket_id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Support Tickets</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container my-4">

<h3 class="fw-bold">Support Tickets (Admin)</h3>

<table class="table table-bordered table-hover">

<thead class="table-success">
<tr>
<th>ID</th>
<th>Sender Type</th>
<th>Sender ID</th>
<th>Message</th>
<th>Reply</th>
<th>Status</th>
</tr>
</thead>

<tbody>

<?php while($t = $tickets->fetch_assoc()){ ?>

<tr>

<td>#<?php echo $t['ticket_id']; ?></td>

<td><?php echo $t['sender_type']; ?></td>

<td><?php echo $t['sender_id']; ?></td>

<td><?php echo $t['message']; ?></td>

<td>

<?php if(empty($t['reply'])){ ?>

<form method="POST" class="d-flex gap-2">

<input type="hidden"
       name="ticket_id"
       value="<?php echo $t['ticket_id']; ?>">

<input type="text"
       name="reply"
       class="form-control"
       placeholder="Type reply..."
       required>

<button class="btn btn-success btn-sm"
        name="reply_btn">
Send
</button>

</form>

<?php } else { ?>

<span class="text-success">
<?php echo $t['reply']; ?>
</span>

<?php } ?>

</td>

<td>

<span class="badge bg-<?php echo ($t['status']=="OPEN") ? "warning" : "success"; ?>">
<?php echo $t['status']; ?>
</span>

</td>

</tr>

<?php } ?>

</tbody>

</table>

<a href="dashboard.php" class="btn btn-secondary">
Back
</a>

</div>

</body>
</html>