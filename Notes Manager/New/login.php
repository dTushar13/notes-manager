<?php
	require 'vendor/autoload.php';
	// $conn=new MongoDB\Client("mongodb+srv://TusharD:tushardesh@mynewcluster.eqtzy.mongodb.net/project?retryWrites=true&w=majority");
	$conn=new MongoDB\Client("mongodb://localhost:27017");
	$db=$conn->project;
	$collection=$db->login;
?>



<?php 
	if(isset($_POST["submit"]))
	{
		$data=$collection->findOne(['user' => $_POST['user'] , 'password' => $_POST['password']]);
		if($data['user'] != $_POST["user"] || $data['password'] != $_POST['password'])
		{
			echo "Check Credentials";
		}
		else
		{
			// echo "Welcome ",$_POST['user'];
			header("location:index.php");

		}
		// $flag=0;	
		// if($key['user'] == $_POST["user"])
		// {
		// 	if($key["password"]== $_POST["password"])
		// 	{
		// 		echo "Welcome ",$_POST["user"];
		// 		$flag=1;
		// 		break;
		// 	}
		// 	else{
		// 		echo "Incorrect password";
		// 	}
		// }
	
	// if($flag=0)
	// 	echo "Check Credentials";
	}


 ?>





<!DOCTYPE html>
<head>
<Title>New Website</Title>
<link rel="stylesheet" href="css/about.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
<link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
</head>

<body>
    <!-- Navigation-->
    <section id="nav-bar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Notes Manager</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">HOME<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">LOGIN</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">SIGN UP</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.html">ABOUT US</a>
      </li>
     
    </ul>
  </div>
</nav>
    </section>

<!-- Login Form -->
<div id="login">
	<form method="post">
		Username: <input type="text" name="user"><br>
		Password: <input type="password" name="password">
		<br><input type="submit" name="submit">
	</form>
</div>

<!------FOoter---->
<section id="footer">
    <div class="container">
         Copyright<i class="fa fa-copyright" aria-hidden="true"></i> 2020
    </div>
</section>

</body>
</html>