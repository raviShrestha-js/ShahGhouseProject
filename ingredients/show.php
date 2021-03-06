<?php
require_once "../functions.php";
require_once "../htmllib.php";
require_once "../dblib.php";

$id = $_GET['ProductID'];
$products= find_product_matching($id);
$ingredients = find_ingredients_by_product_id($id);



?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="../adminview.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 40px ;
}

* {
  box-sizing: border-box;
}

.container {
  position: relative;
  max-width: 500px;
}
html {
	font-family: sans-serif;
	-webkit-text-size-adjust: 100%;
	-ms-text-size-adjust:     100%;
}
body {
    font-family: Arial, Helvetica, sans-serif;
    margin: 40px ;
  }
  
  * {
    box-sizing: border-box;
  }
  

/* Search Button css */
form.search-bar input[type=text] {
    padding: 10px;
    font-size: 17px;
    border: 1px solid grey;
    float: left;
    width: 80%;
    background: #f1f1f1;
    border-radius: 10px;
  }
  
  /* Style the submit button */
  form.search-bar button {
    float: left;
    width: 20%;
    padding: 10px;
    background: #2196F3;
    color: white;
    font-size: 17px;
    border: 1px solid grey;
    border-left: none; /* Prevent double borders */
    cursor: pointer;
    border-radius: 10px;
    height:47px;
    
  }
  
  form.search-bar button:hover {
    background: #0b7dda;
  }
  
  /* Clear floats */
  form.search-bar::after {
    content: "";
    clear: both;
    display: table;
  }
 /* Search bar end */ 

img {
	display: block;
	border: 0;
	width: 100%;
    border-radius:20px;
}

.admin-add {
    background-color: green;
    border: none;
    color: white;
    width: 25%;
    padding: 15px 32px;
    position: relative;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 5px;
    cursor: pointer;
    border-radius: 20px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
  }
  
  
.admin-add:hover {
    box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
    opacity:0.7;
  }


.nav-whole{
    margin-bottom:20px;
}

.column1{
    margin-bottom:5px;
}

.quality-image{
        display: block;
        border-radius: 4px;
        margin : 20px;
        
        
}
.deleteButton {
    margin-top: 5px;
    width:16px;
	height:18px;
	background-image:url(../images/deleteCross.png);
	background-repeat:no-repeat;
	background-size:cover;
  
}

@media screen and (min-width: 40em){

    .nav-whole{
        display:flex;
        flex-wrap:wrap;
        justify-content: space-between;
    
    }

    .column1{
    
        flex-basis:20%;
        align-self:flex-start;
    }

    .column2{
        flex-basis: 40%;
        padding-top: 40px;
        margin-left:auto;
        align-self:flex-end;
        
    }

    .cart-icon{
        flex-basis: 10%;
        padding-top:40px;
        margin-left:20px;;
        align-self:flex-end;
    }

    .admin-area{
        display: flex;
        flex-direction:column;
    }
    /* Menu area applying flex */
    .menu-area{
        display : flex;
        flex-wrap : wrap;
        flex-direction: column;
        justify-content: space-between;
    }
    
}
@media screen and (min-width : 60em) {
   
    .menu-area{
        display : flex;
        flex-wrap : wrap;
        flex-direction: column;
        justify-content: space-between;
    }
    .product-area{
        flex: 0 1 calc(60% - 1em);
    }

    .ingredients-area{
        flex: 0 1 calc(40% - 1em);
    }
}

</style>
<body>
<div class= "nav-whole">
  <div class="column1">
    <a class="brand" href="#"><img src="../logo.jpeg"  width="100%" height="180px"></a>
  </div>
  <div class= "column2">
    
  </div>
  <div class="cart-icon" style="margin-bottom: 15px;">
  </div>
</div><!-- nav-whole-->
    <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Shah Ghouse Restaurant</a>
      </div>
      <ul class="nav navbar-nav">
          <li><a href="../homepageadmin.php">Home</a></li>
          <li class="active"> <a href="../adminmenu.php">Menu</a></li>
          <li><a href="#">About Us</a></li>
			    <li><a href="#">Contact</a></li>
          <li ><a href="../admin.php">Admin</a></li>
          <li><a href="../customers/show.php">Manage Customers</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> ADMIN</a>
				  <ul class="dropdown-menu">
					  <li><a href="profile.php">Profile</a></li>
					  <li><a href="logout.php">Logout</a></li>
				  </ul>
			  </li>
      </ul>
    </div>
  </nav>



<div class="whole">
  <div class="menu-area">
    <div class="product-area">
        <!-- Fetching Category Names -->
      <?php
        $catid = $_GET['CategoryID'] ?? '1';
        $headings = find_categories($catid);

        while($heading = mysqli_fetch_assoc($headings)){
      ?>
      <h3> Category: <?php echo $heading['Name']; ?> </h3>
      <?php } ?>
      <div class="product-heading">
          <?php 
              while($product = mysqli_fetch_assoc($products)){
                   
          ?>
         <h2>  <?php echo $product['ProductName']; ?> </h2>
      <div class ="quality-image">   
         <img src="../<?php echo $product['Image']; ?>" alt="Food Items" height="400px" width=100%>
      </div>
        </div><!--product-heading-->
        
        Price: <?php echo $product['Price']; ?></br>
        Description: <?php echo $product['Description']; ?>
        <?php } ?>
        
      </div> <!--product-area--> 
              <hr>
     <div class= "ingredients-area">
       <h3> Ingredients </h3>

          <?php 
          while($ingredient = mysqli_fetch_assoc($ingredients)){
            echo $ingredient['Name'];
          ?>
          <br>
          <?php } ?>
     </div>
    </div><!--menu-area-->  
 </div><!--whole-->
</html>