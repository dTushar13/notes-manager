<?php 

if($_POST['request'])
{
	$request=$_POST['request'];
	require 'vendor/autoload.php';
		// $conn=new MongoDB\Client("mongodb+srv://username:password@mynewcluster.eqtzy.mongodb.net/project?retryWrites=true&w=majority"); //to store in mongodb cloud
        $conn=new MongoDB\Client("mongodb://localhost:27017");//Uses local machine to store and access data
		$db=$conn->project;
		$collection=$db->notes;

}


 ?>
 			<table style="width:50%" border="solid" overflow="hidden" >
			  <tr>
			    <!-- <th>_id</th> -->
			    <th>Author <button type="submit" name="author_sort">sort</button></th>
			    <th>Subject</th>
			    <th>Title <button type="submit" name="title_sort">sort</button></th>
			    <th>Notes</th>
			    <th> Difficulty <button type="submit" name="diff_ascend" width>A</button><button type="submit" name="diff_descend">D</button> </th>
			    <th>Related Topics</th>
			    <th>Tags</th>
			    <th>Date</th>
			    <th>File name</th>
			    <th>Action</th>

			  </tr>

	<?php $data = $collection->find(array('date' => $current_date, 'author' => $_SESSION['username']),$options); ?>

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