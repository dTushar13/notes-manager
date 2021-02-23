<?php
		include 'DataEncryptionDecryption.php';
		require 'vendor/autoload.php';
		// $conn=new MongoDB\Client("mongodb+srv://username:password@mynewcluster.eqtzy.mongodb.net/project?retryWrites=true&w=majority"); //to store in mongodb cloud
        $conn=new MongoDB\Client("mongodb://localhost:27017");//Uses local machine to store and access data
		$db=$conn->project;
		$collection=$db->login;
		session_start();
	
		$data=$collection->findOne(array('user' => encrypt_decrypt('encrypt',$_SESSION['username'])));
		error_reporting(E_ALL & ~E_NOTICE);
		
?>

<head>
	<Title>PROFILE</Title>
	<link rel="stylesheet" href="css/style.css">
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
	        <a class="nav-link" href="home.php">HOME<span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="upload-data.php">UPLOAD</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="about-log.html">ABOUT US</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="profile.php"><?php 
	        	session_start();
	        	echo $_SESSION['username'];
	         ?></a>
	      </li>
	      <li class="nav-item">
	       <a class="nav-link" href="index.php" onclick="return confirm('Are You sure you want to logout?');">LOGOUT</a>
	      </li>
	     
	    </ul>
	  </div>
	</nav>
    </section>
    <h2>
	    <?php 
	    	echo $_SESSION['username'];
	     ?>
 	</h2>
 	<h4>Name:
 		<?php 
 			echo $data['name'];
 		 ?>
 	</h4>
 	<h4>Email:
 		<?php echo $data['email']; ?>
 	</h4>	
</body>

