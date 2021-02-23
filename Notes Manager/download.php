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
		$filename= $docs['fileName'];
		$date=$docs['date'];
	
	
		$filepath='upload/'.$filename;
		if(!empty($filename) && file_exists($filepath)){
			header("Cache-Control: public");
			header("Content-Description: FIle Transfer");
			header("Content-Disposition: attachment; filename=$filename");
			header("Content-Type: application/zip");
			header("Content-Transfer-Emcoding: binary");

			readfile($filepath);
			exit;
		}
		else{
			echo "<script type='text/javascript'>alert('File Does not Exist ');</script>";
			echo "<script type='text/javascript'>window.location='home.php'</script>";
		}
	}
?>

