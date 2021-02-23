<?php
		require 'vendor/autoload.php';
		// $conn=new MongoDB\Client("mongodb+srv://username:password@mynewcluster.eqtzy.mongodb.net/project?retryWrites=true&w=majority");
		$conn=new MongoDB\Client("mongodb://localhost:27017");//Uses local machine to store and access data
		$db=$conn->project;
		$collection=$db->notes;

		if(!empty($_GET['id'])){
	        $id = $_GET['id']; 
	        try{
	        $id =new  MongoDB\BSON\ObjectId($id);
	        $collection->deleteOne(array('_id'=>$id));
	        header('location:home.php');
	        }
	        catch(Expection $e){}
	        }   
	    
	                    
	            
	?>