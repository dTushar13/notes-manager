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
	table {
	  margin-left: auto;
  	  margin-right: auto;	
	  border-collapse: collapse;
	  width: 100%;
	}

	th, td {
		text-align: center;
	  padding: 8px;
	}

	/*for alternate color in table*/
	tr:nth-child(even) {background-color: #f2f2f2;}
	
	select { width: 400px; text-align-last:center; }

	div#daily-upload{
		text-align: center;
		width: 1200px;
		margin:0 auto;
		padding: 20px;
	}
	div#all-upload{
		text-align: center;
		width: 1200px;
		margin:0 auto;
		padding: 20px;
	}
	button{
		background-color: #f2f2f2;
		margin: 4px;
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
	?>

	<!-- <form method="post" enctype="multipart/form-data">
		<label for="author">Choose a author:</label>
			<select required="required" name="author" id="author" value="Null">
				<option value="">--Please Choose Subject--</option>
				<option value="Author A">Author A</option>
				<option value="Author B">Author B</option>
				<option value="Author C">Author C</option>
			</select><br>
		<h2>Add Data</h2>
			<div style="border: solid;padding: 20px; width: 50%">
				<label for="author">Choose a Subject:</label>
					<select required="required" name="subject" id="subject" value="Null">
						<option value="">--Please Choose Subject--</option>
						<option value="Physics">Physics</option>
						<option value="Chemistry">Chemistry</option>
						<option value="Maths">Maths</option>
						<option value="Biology">Biology</option>
					</select><br><br>
				Title: <input type="text" name="title">  <br><br>
				Notes: <textarea class="scrollabletextbox" name="notes"></textarea><br><br>
				  <label>Select Image</label>  
				  <input id="file" name="file" type="file" placeholder="">
				 
				Difficulty rating: <input type="range" type="number" min="1" max="10" value="0" class="slider" name='difficulty' id="myRange" onchange="show_value(this.value);">Current Value: <span id="slider_value" style="color:red;"></span><br><br>
				<script type="text/javascript">
					function show_value(x)
						{
						 document.getElementById("slider_value").innerHTML=x;
						}
				</script>
				Difficulty rating: <input type="number" name="difficulty" min="1" max="10" ><br><br>
				Related Topics: <input type="text" name="rel_topic"><br><br>
				Tags: <input style="width:10%" type="text" name="tag4">
				<input style="width:10%" type="text" name="tag2">
				<input style="width:10%" type="text" name="tag3">
				<input style="width:10%" type="text" name="tag1"><br><br> 
				Today's date is: <input name="date" value="<?php date_default_timezone_set("Asia/Kolkata"); echo date('Y-m-d'); ?>" readonly><br><br>
				<button type="submit" name="add">Add</button>
				 
			</div> -->

<!-- Author Addition -->

			<!-- <?php
			{
			if(isset($_POST['add'])){
			$add=array(
				'author' => $_POST['author'],
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
							echo "Failed to upload file.";
						}
					}
		
			try{
				$collection->insertOne($add);
				echo 'Data Inserted';
			}
			catch(Exception $e){
				echo 'Error '.$e->getMessage();
			}
			}
			}
			
			?>
		</form>	 -->


		<form method="post">
			 <!-- <br><a href='data.php'>VIEW ALL</a><br> -->

			 <br><h5 style="text-align: center; background-color: #f2f2f2; padding: 5px;">Daily Upload</h5><br>
 
			<div method="post" id="daily-upload">

			<table style="width:50%" border="solid" overflow="hidden" >
			  <tr>
			    <!-- <th>_id</th> -->
			    <th>Author</th>
			    <th>Subject</th>
			    <th>Title <button type="submit" name="title_sort"><img src="sort.png" width="15" height="16" /></button></th>
			    <th>Notes</th>
			    <th> Difficulty <button type="submit" name="diff_ascend" width>A</button><button type="submit" name="diff_descend">D</button> </th>
			    <th>Related Topics</th>
			    <th>Tags</th>
			    <th>Date</th>
			    <th>File name</th>
			    <th>Action</th>

			  </tr>

<!-- Data Insertion in table and Deletion Process -->
			
			<!-- Subject: <input type="text" name="sub-filter"> -->
			Subject: <select  name="subject-filter" id="subject" value="Null">
						<option value="">--Please Choose Subject--</option>
						<option value="ip">IP</option>
						<option value="adsa">ADSA</option>
						<option value="admt">ADMT</option>
						<option value="cns">CNS</option>
						<option value="mcep">MCEP</option>
					</select>
			<button name="sub_filter1">Filter</button>
			<button name="all">Remove Filter</button><br><br>
	

			<?php
			    date_default_timezone_set("Asia/Kolkata");
			    $current_date = date('Y-m-d'); 
			    $options = array(
    				"sort" => array("_id" => -1),
				);
				
				$data = $collection->find(array('date' => $current_date, 'author' => $_SESSION['username']),$options);

				if(isset($_POST['all'])){
				$data = $collection->find(array('date' => $current_date, 'author' => $_SESSION['username']),$options);
				}
				
				if(isset($_POST['sub_filter1'])){
			        $data = $collection->find(array('date' => $current_date, 'subject' => $_POST["subject-filter"], 'author' => $_SESSION['username']),$options);
			    }

				if(isset($_POST['diff_ascend'])){
					$options = array(
    				"sort" => array("difficulty" => 1),
					);
					$data = $collection->find(array('date' => $current_date, 'author' => $_SESSION['username']),$options);
				}

				if(isset($_POST['diff_descend'])){
					$options = array(
    				"sort" => array("difficulty" => -1),
					);
					$data = $collection->find(array('date' => $current_date, 'author' => $_SESSION['username']),$options);
				}
				
				if(isset($_POST['title_sort'])){
					$options = array(
    				"sort" => array("title" => 1),
					);
					$data = $collection->find(array('date' => $current_date, 'author' => $_SESSION['username']),$options);
				}
				
				if(isset($_POST['auth_filter'])){
			        $data = $collection->find(array('author' => $_POST["author-filter"], 'author' => $_SESSION['username']),$options);
			    }

						   	
				foreach($data as $document){
					
			 ?>	
			        <tr>
			        <!-- <td><?php echo $document['_id'] ?></td> -->
			        <td><?php echo $document['author'] ?></td> 
			        <td><?php echo $document["subject"] ?></td>
			        <td><?php echo $document["title"] ?></td>
			        <td><?php echo $document["notes"] ?></td> 
			        <td><?php echo $document["difficulty"] ?></td>
			        <td><?php echo $document["rel_topic"] ?></td> 
			        <td><?php echo $document["tags"]["tag4"].", ".$document["tags"]["tag3"].", ".$document["tags"]["tag2"].", ".$document["tags"]["tag1"]?></td> 
			        <td><?php echo $document["date"] ?></td>
			        <td><?php try {echo $document["fileName"];} catch(Exception $e){echo 'Error '.$e->getMessage();} ?></td>
			        <td><br><a href='download.php?id=<?php echo $document['_id'];?>' >Download</a><br>

			       <br><a href='delete.php?id=<?php echo $document['_id'];?>' >Delete</a><br><br><a href='update.php?id=<?php echo $document['_id'];?>' name='update'>Update</a><br></td>
			       
			        </tr>				    
					<?php }
					 ?>
		</table>
	</div>
	</form>	 


	<form method="post">
	<br><br><h5 style="text-align: center; background-color: #f2f2f2; padding: 5px;">ALL UPLOADS</h5><br><br>
	<div method="post" id="all-upload">
	<table style="width:50%" border="solid" overflow="hidden" >
	  <tr>
	    <!-- <th>_id</th> -->
	    <th>Author</th>
	    <th>Subject</th>
	    <th>Title <button type="submit" name="title_sort"><img src="sort.png" width="15" height="16" /></button></th>
	    <th>Notes</th>
	    <th> Difficulty <button type="submit" name="diff_ascend" width>A</button><button type="submit" name="diff_descend">D</button> </th>
	    <th>Related Topics</th>
	    <th>Tags</th>
	    <th>Date</th>
	    <th>File name</th>
	    <th>Action</th>
	  </tr>

	    Subject: <select  name="sub-filter" id="subject" value="Null">
						<option value="">--Please Choose Subject--</option>
						<option value="ip">IP</option>
						<option value="adsa">ADSA</option>
						<option value="admt">ADMT</option>
						<option value="cns">CNS</option>
						<option value="mcep">MCEP</option>
					</select>
			<button name="sub_filter2">Filter</button>
			<button name="all">Remove Filter</button><br><br>


	    Date: <input type="date" name="date-filter">
	    <button name="date_filter">Filter</button>
	    <button name="all">Remove Filter</button><br><br>

	    <?php
	    
	    
	    date_default_timezone_set("Asia/Kolkata");
	    $current_date = date('Y-m-d'); 
	    $options = array(
	        "sort" => array("_id" => -1),
	    );
	    
	    $data = $collection->find(array('author' => $_SESSION['username']),$options);

	    if(isset($_POST['all'])){
	    $data = $collection->find(array('author' => $_SESSION['username']),$options);
	    }
	    
	    if(isset($_POST['sub_filter2'])){
	        $data = $collection->find(array('subject' => $_POST["sub-filter"], 'author' => $_SESSION['username']),$options);
	    }

	    if(isset($_POST['diff_ascend'])){
	        $options = array(
	        "sort" => array("difficulty" => 1),
	        );
	        $data = $collection->find(array('author' => $_SESSION['username']),$options);
	    }

	    if(isset($_POST['diff_descend'])){
	        $options = array(
	        "sort" => array("difficulty" => -1),
	        );
	        $data = $collection->find(array('author' => $_SESSION['username']),$options);
	    }
	    
	    if(isset($_POST['title_sort'])){
	        $options = array(
	        "sort" => array("title" => 1),
	        );
	        $data = $collection->find(array('author' => $_SESSION['username']),$options);
	    }
	    
	    if(isset($_POST['auth_filter'])){
	        $data = $collection->find(array('author' => $_POST['author-filter'], 'author' => $_SESSION['username']));
	    }

	    if(isset($_POST['date_filter'])){
	        $data = $collection->find(array("date" => $_POST['date-filter'], 'author' => $_SESSION['username']));
	        
	    }

	    foreach($data as $document){
	    ?> 
	        <tr>
	        <!-- <td><?php echo $document['_id'] ?></td> -->
	        <td><?php echo $document['author'] ?></td> 
	        <td><?php echo $document["subject"] ?></td>
	        <td><?php echo $document["title"] ?></td>
	        <td><?php echo $document["notes"] ?></td> 
	        <td><?php echo $document["difficulty"] ?></td>
	        <td><?php echo $document["rel_topic"] ?></td> 
	        <td><?php echo $document["tags"]["tag4"].", ".$document["tags"]["tag3"].", ".$document["tags"]["tag2"].", ".$document["tags"]["tag1"]?></td>
	        <td><?php echo $document["date"] ?></td> 
	        <td><?php try {echo $document["fileName"];} catch(Exception $e){echo 'Error '.$e->getMessage();} ?></td>
	        <td><br><a href='download.php?id=<?php echo $document['_id'];?>' >Download</a><br>

			<br><a href='delete.php?id=<?php echo $document['_id'];?>' >Delete</a><br><br><a href='update.php?id=<?php echo $document['_id'];?>' name='update'>Update</a><br></td>
	    
	        </tr>                   
	     <!-- <?php 

	        if(!empty($_GET['id'])){
	            $id = $_GET['id']; 
	            try{
	            $id =new  MongoDB\BSON\ObjectId($id);
	            $collection->deleteOne(array('_id'=>$id));
	            header('location:data.php');
	            }
	            catch(Expection $e){}
	            }   
	                    
	            }       
	                        
	         ?> -->

		</table>
		</div>
	</form>  	