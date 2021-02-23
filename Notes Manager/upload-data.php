<!DOCTYPE html>
<head>
<Title>Upload</Title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
<link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
	div#upload{
		text-align: center;
		width: 1200px;
		margin:0 auto;
		padding: 20px;
	}
	label{
		font-weight: bold;
	}
</style>

<body>
    <!-- Navigation-->
    <section id="nav-bar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="home.php">Notes Manager</a>
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


<?php
		require 'vendor/autoload.php';
		// $conn=new MongoDB\Client("mongodb+srv://username:password@mynewcluster.eqtzy.mongodb.net/project?retryWrites=true&w=majority"); //to store in mongodb cloud
        $conn=new MongoDB\Client("mongodb://localhost:27017");//Uses local machine to store and access data
		$db=$conn->project;
		$collection=$db->notes;
		// session_start();
		error_reporting(E_ALL & ~E_NOTICE);
	?>

<form method="post" enctype="multipart/form-data">
		<br><h2 style="text-align: center; background-color: #f2f2f2; padding: 5px;">Add Data</h2><br>
			<div id="upload" style="border: solid;padding: 20px; width: 50%">
				<label for="author">Choose a Subject:</label>
					<select required="required" name="subject" id="subject" value="Null">
						<option value="">--Please Choose Subject--</option>
						<option value="ip">IP</option>
						<option value="adsa">ADSA</option>
						<option value="admt">ADMT</option>
						<option value="cns">CNS</option>
						<option value="mcep">MCEP</option>
					</select><br><br>
				<label>Title: </label>  <input type="text" name="title">  <br><br>
				<label>Notes: </label>  <textarea class="scrollabletextbox" name="notes"></textarea><br><br>
				  <label>Select File</label>  
				  <input id="file" name="file" type="file" placeholder="">
				 
				<br><br><label>Difficulty rating: </label>  <input type="range" type="number" min="1" max="10" value="0" class="slider" name='difficulty' id="myRange" onchange="show_value(this.value);">Current Value: <span id="slider_value" style="color:red;"></span><br><br>
				<script type="text/javascript">
					function show_value(x)
						{
						 document.getElementById("slider_value").innerHTML=x;
						}
				</script>
				<!-- Difficulty rating: <input type="number" name="difficulty" min="1" max="10" ><br><br> -->
				<label>Related Topics: </label>  <input type="text" name="rel_topic"><br><br>
				<label>Tags: </label>  <input style="width:10%" type="text" name="tag4">
				<input style="width:10%" type="text" name="tag2">
				<input style="width:10%" type="text" name="tag3">
				<input style="width:10%" type="text" name="tag1"><br><br> 
				<label>Today's date is: </label>  <input name="date" value="<?php date_default_timezone_set("Asia/Kolkata"); echo date('Y-m-d'); ?>" readonly><br><br>
				<button type="submit" name="add">Add</button>
				 
			</div>

<!-- Author Addition -->

			<?php
			{
			if(isset($_POST['add'])){
			$add=array(
				'author' => $_SESSION['username'],
				'subject' => $_POST['subject'],
				'title' => $_POST['title'],
				'notes' => $_POST['notes'],
				'tags' => array('tag1' => $_POST['tag1'],
								'tag2' => $_POST['tag2'],
								'tag3' => $_POST['tag3'],
								'tag4' => $_POST['tag4']
								),
				'difficulty' => (int)$_POST['difficulty'],
				'rel_topic' => $_POST['rel_topic'],
				'date' => $_POST['date'],
			);
			if($_FILES['file']) {
						if(move_uploaded_file($_FILES['file']['tmp_name'], 'upload/'.$_FILES['file']['name'])) {
							$add['fileName'] = $_FILES['file']['name'];
						} else {
							$add['fileName'] = "No files";
						}
					}
		
			try{
				$collection->insertOne($add);
				echo "<script type='text/javascript'>alert('  Upload Successful !!  ');</script>";
			}
			catch(Exception $e){
				echo 'Error '.$e->getMessage();
			}
			}
			}
			
			?>