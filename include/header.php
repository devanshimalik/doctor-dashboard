<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css ">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-DrT5NfxfbHVMHux31Lkhxg42LY60f8TaYyK50jnxRnM=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <!-- menu $user has changed and replaced by admin need reset need only cjanges to rename Admin into $user-->
<nav class="navbar navbar-expand-lg navbar-info bg-info">
    <h5 class="text-white">Hospital Management System</h5>
    <div class="mr-auto"></div>
    <ul class="navbar-nav">
        <?php
        if (isset($_SESSION['admin'])) {
            $user = $_SESSION['admin'];
            echo '
                <li class="nav-item"><a href="admin.php" class="nav-link text-white">Admin</a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link text-white">Logout</a></li>';
        } else {
           
            echo '<li class="nav-item"><a href="../patient/dashboard.php" class="nav-link text-white">Home</a></li>';
            //echo '<li class="nav-item"><a href="onlinereport.php" class="nav-link text-white">Back</a></li>';
        }
        ?>
    </ul>
</nav>

</body>
</html>
