<?php
	require 'vendor/autoload.php';
	// $conn=new MongoDB\Client("mongodb+srv://username:password@mynewcluster.eqtzy.mongodb.net/project?retryWrites=true&w=majority"); //to store in mongodb cloud
        $conn=new MongoDB\Client("mongodb://localhost:27017");//Uses local machine to store and access data
	$db=$conn->project;
	$collection=$db->login;

   include 'DataEncryptionDecryption.php'; 
?>

<?php 
	if(isset($_POST['submit'])){
		$add=array(
			'name' => $_POST['name'],
			'user' => encrypt_decrypt('encrypt',$_POST['username']),
			'password' => encrypt_decrypt('encrypt',$_POST['password']),
			'conf_password' => encrypt_decrypt('encrypt',$_POST['conf_password']),
			'email' => $_POST['email'],
		);
		try{
				$collection->insertOne($add);
				echo "<script type='text/javascript'>alert('Account Created !! ');</script>";
				// header("location:login.php");
        echo "<script type='text/javascript'>window.location='login.php'</script>";
			}
			catch(Exception $e){
				echo "<script type='text/javascript'>alert('Username already exist !! Please Try Another ');</script>";
			}
			
	}

 ?>


 <!DOCTYPE html>
<head>
<Title>Register</Title>
<link rel="stylesheet" href="css/register.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
<link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>
<script type="text/javascript">       
    // Function to check Whether both passwords 
    // is same or not. 
    function checkPassword(form) { 
        password1 = form.password.value; 
        password2 = form.conf_password.value; 
              
        // If Not same return False.     
        else if (password1 != password2) { 
            alert ("\nPassword did not match: Please try again...") 
            return false; 
        }          
    } 
</script>
<script type="text/javascript">
function checkAvailability(){
  $("#loaderIcon").show();
  
  $.ajax({
    type:"POST",
    url:"check_availability.php",
    cache:false,
    data:{
      type:1,
      username:$("#username").val(),
    },
    success:function(data){
      $("#user-availability-status").html(data);
      $("#loaderIcon").hide(1000);
    }
  });
}
</script>
<body>
    <!-- Navigation-->
    <section id="nav-bar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Notes Manager</a>
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
<!-----Register------>

<div id="register" style="text-align:center">
	<form method="post" onsubmit="return checkPassword(this)">
		<div class="register_name">
			<h3>Register</h3>
		</div>
		<input type="text" name="name" placeholder="Name" required="required"><br><br>
		<input name="username" type="text" id="username" class="demoInputBox" onBlur="checkAvailability()" placeholder="Username"><span id="user-availability-status"></span><br><br>
		<input type="password" id="password" name="password" placeholder="Password" required="required"><br><br>
		<input type="password" id="conf_password" name="conf_password" placeholder="Confirm Password" required="required"><br><br>
		<input type="email" name="email"placeholder="Email" required="required"><br><br>
		<input type="submit" name="submit">
    <p><img src="loder.gif" id="loaderIcon" style="display:none" /></p>
	
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