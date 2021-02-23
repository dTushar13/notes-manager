<?php
	require 'vendor/autoload.php';
	// $conn=new MongoDB\Client("mongodb+srv://username:password@mynewcluster.eqtzy.mongodb.net/project?retryWrites=true&w=majority");
	$conn=new MongoDB\Client("mongodb://localhost:27017");//Uses local machine to store and access data
	$db=$conn->project;
	$collection=$db->login;
	include 'DataEncryptionDecryption.php'; 

	if(isset($_POST['type']) == 1){
		$username =$_POST['username'];

		$data=$collection->findOne(array('user'=> encrypt_decrypt('encrypt',$username)));

		if(empty($data)){
			
			echo "<br><span class='status-available' style='color:green'> Username Available.</span>";
		}
		else{
			echo "<br><span class='status-not-available' style='color:red'> Username Not Available.</span>";
		}
	}
?>