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
	}
?>

<br><br>
<form method="get">
	<!-- Contents: <input type='text' id='content' name='title' src="upload/<?php echo $docs['fileName']?>" value='upload/<?php echo $docs['fileName']?>'/> -->

	<!-- <?php
	$myfile = fopen("upload/".$docs['fileName'], "r") or die("Unable to open file!");
	echo fread($myfile,filesize("upload/".$docs['fileName']));
	fclose($myfile);
	?> -->

	<?php
		$file = 'upload/'.$docs['fileName'];
		$filename = $docs['fileName'];
		header('Content-type: application/pdf');
		header('Content-Disposition: inline; filename="' . $filename . '"');
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: ' . filesize($file));
		header('Accept-Ranges: bytes');
		@readfile($file);
		?>

	<input type="button" name="button" href="upload_test.php">
</form>
