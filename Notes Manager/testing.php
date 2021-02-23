<?php 
		require 'vendor/autoload.php';
		$conn=new MongoDB\Client("mongodb://localhost:27017");
		$db=$conn->project;
		$collection=$db->notes;
	if (isset($_POST["submit"])) {
		$add=array('pic' => $_POST['pic'] );
  		
  		try{
				$collection->insertOne($add);
				echo 'Data Inserted';
			}
			catch(Exception $e){
				echo 'Error '.$e->getMessage();
			}
}
 ?>
<form method="POST" enctype="multipart/form-data">
    <label for="pic">Please upload a profile picture:</label>
    <input type="file" name="pic" id="pic" />
    <input type="submit" name="submit" />
</form>