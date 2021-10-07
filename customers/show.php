<?php 
require_once "../functions.php";
require_once "../dblib.php";
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="customers.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
	
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><img src="../logo.jpeg" width=100% height="170px"></a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="../homepageadmin.php">Home</a></li>
      <li> <a href="../adminmenu.php">Menu</a></li>
      <li><a href="#">About Us</a></li>
	  <li><a href="#">Contact</a></li>
      <li><a href="../admin.php">Admin</a></li>
      <li class="active"><a href="show.php">Manage Enquiry</a></li>

    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> ADMIN</a>
				<ul class="dropdown-menu">
					<li><a href="profile.php">Profile</a></li>
					<li><a href="../logout.php">Logout</a></li>
				</ul>
			</li>
    </ul>
  </div>
</nav>

<div class="customers-section">
  <div class="customers-section-header">
      <h2>Manage Enquiry</h1>
  </div>
  <table class="customers-table" >
      <tr>
          <th>MSG ID</th>
          <th>Full Name</th>
          <th>Email ID</th>
          <th>Phone number</th>
          <th>Message</th>
          
      </tr>

    <?php   
        $details=show_enquiry_details();
        while($detail = mysqli_fetch_assoc($details)){   
    ?>
      <tr>
          <td><?php echo $detail['msg_id']; ?></td>
          <td><?php echo $detail['username']; ?></td>
          <td><?php echo $detail['email']; ?></td>
          <td><?php echo $detail['phone']; ?></td>
          <td><?php echo $detail['message']; ?></td>
         

      </tr>
    <?php } ?>
  </table>
</div>


 
</body>
</html>
