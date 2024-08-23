<?php
require ('../../config.php');

if(!empty($_SESSION['id'])){
    $id = $_SESSION['id'];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);
} else {
    echo 
        "
        <script>
            alert('You must log in to access this page');
            window.location.href = '../../login.php';
        </script>
        ";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <title>F&L Boutique Store</title>
</head>
<body>
    <nav class="navbar navbar navbar-expand-lg" style="background-color: orange;">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">F&L</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="../users/index.php">Users</a></li>
                    <li class="nav-item"><a class="nav-link" href="../products/index.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="../news/index.php">News</a></li>
                    <li class="nav-item"><a class="nav-link" href="../reviews/index.php">Reviews</a></li>
                    <li class="nav-item"><a class="nav-link" href="../messages/index.php">Messages</a></li>
                </ul>
            </div>
            <div class="d-flex" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="../../logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <p style="font-size: 50px; font-weight: bold; text-align: center;" id="greet"></p>
        <p style="font-size: 50px; font-weight: bold; text-align: center;"><?php echo $row['first_name'].' '.$row['last_name'] ?></p>
        <br>
        <a href="create.php" class="btn btn-success mb-3">Add Messages</a>

        <table class="table table-hover text-center">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Messages</th>
                    <th scope="col">Recipient Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $sql = "SELECT sm.id, m.message, u.first_name, u.last_name
                    FROM shared_messages sm
                    INNER JOIN messages m ON sm.message_id = m.id
                    INNER JOIN users u ON sm.user_id = u.id";
                    $result = mysqli_query($conn, $sql);
                    if($result && mysqli_num_rows($result) > 0){
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></th>
                                <td><?php echo $row['message']; ?></td>
                                <td><?php echo $row['first_name'].' '.$row['last_name']; ?></td>
                                <td>
                                    <div class="dropdown">
                                        <a href="" class="fa-solid fa-bars dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none; color: black;"></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="show.php?id=<?php echo $row['id'] ?>" class="dropdown-item link-dark">Show</a></li>
                                            <li><a href="edit.php?id=<?php echo $row['id'] ?>" class="dropdown-item link-dark">Edit</a></li>
                                            <li><a onclick="return confirm('Are you sure you want to delete this review?')" href="delete.php?id=<?php echo $row['id'] ?>" class="dropdown-item link-dark">Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        echo "<tr><td colspan='6'>No messages found.</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
<script>
    var today = new Date()
    var curHr = today.getHours()

    if (curHr >= 0 && curHr < 6) {
        document.getElementById("greet").innerHTML = 'What are you doing that early?';
    } else if (curHr >= 6 && curHr < 12) {
        document.getElementById("greet").innerHTML = 'Good Morning';
    } else if (curHr >= 12 && curHr < 17) {
        document.getElementById("greet").innerHTML = 'Good Afternoon';
    } else if (curHr >= 17 && curHr < 21) {
        document.getElementById("greet").innerHTML = 'Good Evening';
    } else {
        document.getElementById("greet").innerHTML = 'Good Night';
    }
</script>
</html>