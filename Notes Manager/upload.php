<?php
		require 'vendor/autoload.php';
		// $conn=new MongoDB\Client("mongodb+srv://username:password@mynewcluster.eqtzy.mongodb.net/project?retryWrites=true&w=majority"); //to store in mongodb cloud
        $conn=new MongoDB\Client("mongodb://localhost:27017");//Uses local machine to store and access data
		$db=$conn->project;
		$collection=$db->notes;
	?>

	<form method="post">
		<!-- <label for="author">Choose a author:</label>
			<select required="required" name="author" id="author" value="Null">
				<option value="">--Please Choose Subject--</option>
				<option value="Author A">Author A</option>
				<option value="Author B">Author B</option>
				<option value="Author C">Author C</option>
			</select><br> -->
		<h2>Add Data</h2>
			<div style="border: solid;padding: 20px; width: 50%">
				<label for="author">Choose a Subject:</label>
					<select required="required" name="subject" id="subject" value="Null">
						<option value="">--Please Choose Author--</option>
						<option value="Physics">Physics</option>
						<option value="Chemistry">Chemistry</option>
						<option value="Maths">Maths</option>
						<option value="Biology">Biology</option>
					</select><br><br>
				Title: <input type="text" name="title">  <br><br>
				Notes: <textarea class="scrollabletextbox" name="notes"></textarea><br><br>
				Difficulty rating: <input type="range" type="number" min="1" max="10" value="0" class="slider" name='difficulty' id="myRange" onchange="show_value(this.value);">Current Value: <span id="slider_value" style="color:red;"></span><br><br>
				<script type="text/javascript">
					function show_value(x)
						{
						 document.getElementById("slider_value").innerHTML=x;
						}
				</script>
				<!-- Difficulty rating: <input type="number" name="difficulty" min="1" max="10" ><br><br> -->
				Related Topics: <input type="text" name="rel_topic"><br><br>
				Tags: <input style="width:10%" type="text" name="tag4">
				<input style="width:10%" type="text" name="tag2">
				<input style="width:10%" type="text" name="tag3">
				<input style="width:10%" type="text" name="tag1"><br><br> 
				Today's date is: <input name="date" value="<?php date_default_timezone_set("Asia/Kolkata"); echo date('Y-m-d'); ?>" readonly><br><br>
				<button type="submit" name="add">Add</button>
				 
			</div>

<!-- Author Addition -->

			<?php
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
		</form>	


		<form method="post">
			 <br><a href='data.php'>VIEW ALL --></a><br>

			 <br><h3>Daily Upload</h3><br>
 
			<div method="post">

			<table style="width:50%" border="solid" overflow="hidden" >
			  <tr>
			    <th>_id</th>
			    <th>Author <button type="submit" name="author_sort">sort</button></th>
			    <th>Subject</th>
			    <th>Title <button type="submit" name="title_sort">sort</button></th>
			    <th>Notes</th>
			    <th> Difficulty <button type="submit" name="diff_ascend" width>A</button><button type="submit" name="diff_descend">D</button> </th>
			    <th>Related Topics</th>
			    <th>Tags</th>
			    <th>Date</th>
			    <th>Action</th>
			  </tr>

<!-- Data Insertion in table and Deletion Process -->
			
			Subject: <input type="text" name="sub-filter">
			<button name="sub_filter">Filter</button>
			<button name="all">Remove Filter</button><br><br>

			Author: <input type="text" name="author-filter">
			<button name="auth_filter">Filter</button>
			<button name="all">Remove Filter</button><br><br>

	

			<?php
			    date_default_timezone_set("Asia/Kolkata");
			    $current_date = date('Y-m-d'); 
			    $options = array(
    				"sort" => array("_id" => -1),
				);
				
				$data = $collection->find(array('date' => $current_date),$options);

				if(isset($_POST['all'])){
				$data = $collection->find(array('date' => $current_date),$options);
				}
				
				if(isset($_POST['sub_filter'])){
			        $data = $collection->find(array('subject' => $_POST["sub-filter"]),$options);
			    }

				if(isset($_POST['diff_ascend'])){
					$options = array(
    				"sort" => array("difficulty" => 1),
					);
					$data = $collection->find(array('date' => $current_date),$options);
				}

				if(isset($_POST['diff_descend'])){
					$options = array(
    				"sort" => array("difficulty" => -1),
					);
					$data = $collection->find(array('date' => $current_date),$options);
				}
				
				if(isset($_POST['title_sort'])){
					$options = array(
    				"sort" => array("title" => 1),
					);
					$data = $collection->find(array('date' => $current_date),$options);
				}

				if(isset($_POST['author_sort'])){
					$options = array(
    				"sort" => array("title" => 1),
					);
					$data = $collection->find(array('date' => $current_date),$options);
				}
				
				if(isset($_POST['auth_filter'])){
			        $data = $collection->find(array('author' => $_POST["author-filter"]),$options);
			    }

						   	
				foreach($data as $document){
					
			 ?>	
			        <tr>
			        <td><?php echo $document['_id'] ?></td>
			        <td><?php echo $document['author'] ?></td> 
			        <td><?php echo $document["subject"] ?></td>
			        <td><?php echo $document["title"] ?></td>
			        <td><?php echo $document["notes"] ?></td> 
			        <td><?php echo $document["difficulty"] ?></td>
			        <td><?php echo $document["rel_topic"] ?></td> 
			        <td><?php echo $document["tags"]["tag4"].", ".$document["tags"]["tag3"].", ".$document["tags"]["tag2"].", ".$document["tags"]["tag1"]?></td> 
			        <td><?php echo $document["date"] ?></td> 
			       <td><br><a href='upload.php?id=<?php echo $document['_id'];?>' >Delete</a><br><br><a href='update.php?id=<?php echo $document['_id'];?>' name='update'>Update</a><br></td>
			       
			        </tr>				    
					 <?php 
						if(!empty($_GET['id'])){
							$id = $_GET['id']; 
							try{
							$id =new  MongoDB\BSON\ObjectId($id);
							$collection->deleteOne(array('_id'=>$id));
							header('location:upload.php');
							}
							catch(Expection $e){}
							}	
									
							}		
			 					 		
					 ?>
					
			</table>

		</form>	   	