<!DOCTYPE html>
<head>
	<Title>Home</Title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
	form#update{
		text-align: center;
	}
	input{
		margin:5px;
		text-align: center
	}
	label{
		font-weight: bold;
	}

</style>

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
	        <a class="nav-link" href="logout.php">LOGOUT</a>
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
	if(!empty($_GET['id'])){
		$id = $_GET['id'];
		$id =new  MongoDB\BSON\ObjectId($id);
		$docs=[];
		$docs=$collection->findOne(array('_id'=>$id));
		$author=$docs['author'];
		$date=$docs['date'];
		?>

		<?php 
	
		try{
			if(isset($_POST['update'])){
			$collection->updateOne(
				array('_id' => $id),
				array(
					'$set' => array(
						'author' => $author,
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
						'date' => $date
					)
				)
				
			);
			$_SESSION['success'] = "Updated successfully";
			header("location:home.php");
		}
		}
		catch(Exception $e){
			echo 'Error '.$e->getMessage();
		}
		
	}
	
		
	?>
	<form method="post" id="update">
		
		<p name="author">Author: <?php echo $docs['author']?></p>
		<p name="date">Date: <?php echo $docs['date']?></p>

		<label>Title:</label><br><input type='text' id='title' name='title' value='<?php echo $docs['title']?>'/><br>
		<label>Subject:</label><br><input type='text' id='subject' name='subject' value='<?php echo $docs['subject']?>'/><br>
		<label>Notes:</label><br><input type='text' id='notes' name='notes' style="overflow:scroll;" value='<?php echo $docs['notes']?>'/><br>
		<label>Difficulty:</label><br><input type='text' id='difficulty' name="difficulty" value='<?php echo $docs['difficulty']?>'/><br>
		<label>Tags:</label><br><input style="width:10%" type='text' id='tag4' name="tag4" value='<?php echo $docs['tags']['tag4']?>'/>
		<input style="width:10%" type='text' id='tag3' name="tag3" value='<?php echo $docs['tags']['tag3']?>'/>
		<input style="width:10%" type='text' id='tag2' name="tag2" value='<?php echo $docs['tags']['tag2']?>'/>
		<input style="width:10%" type='text' id='tag1' name="tag1" value='<?php echo $docs['tags']['tag1']?>'/><br>
		<label>Related Topic:</label><br><input type='text' id='rel_topic' name="rel_topic" value='<?php echo $docs['rel_topic']?>'/><br>
		<button type="submit" name="update">Update</button>
	</form><br>

	





