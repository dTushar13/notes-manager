<?php
		require 'vendor/autoload.php';
		// $conn=new MongoDB\Client("mongodb+srv://username:password@mynewcluster.eqtzy.mongodb.net/project?retryWrites=true&w=majority"); //to store in mongodb cloud
        $conn=new MongoDB\Client("mongodb://localhost:27017");//Uses local machine to store and access data
		$db=$conn->project;
		$collection=$db->notes;
?>
<form method="post">
<table style="width:50%" border="solid" overflow="hidden" >
  <tr>
    <th>_id</th>
    <th>Author</th>
    <th>Subject</th>
    <th>Title <button type="submit" name="title_sort">sort</button></th>
    <th>Notes</th>
    <th> Difficulty <button type="submit" name="diff_ascend" width>A</button><button type="submit" name="diff_descend">D</button> </th>
    <th>Related Topics</th>
    <th>Tags</th>
    <th>Date</th>
    <th>Action</th>
  </tr>

    Subject: <input type="text" name="subject-filter">
    <button name="sub_filter">Filter</button>
    <button name="all">Remove Filter</button><br><br>

    Author: <input type="text" name="author-filter">
    <button name="auth_filter">Filter</button>
    <button name="all">Remove Filter</button><br><br>

    Date: <input type="date" name="date-filter">
    <button name="date_filter">Filter</button>
    <button name="all">Remove Filter</button><br><br>

    <?php
    
    $data = $collection->find();
    
    date_default_timezone_set("Asia/Kolkata");
    $current_date = date('Y-m-d'); 
    $options = array(
        "sort" => array("_id" => -1),
    );
    
    $data = $collection->find(array(),$options);

    if(isset($_POST['all'])){
    $data = $collection->find(array(),$options);
    }
    
    if(isset($_POST['sub_filter'])){
        $data = $collection->find(array('subject' => $_POST["subject-filter"]));
    }

    if(isset($_POST['diff_ascend'])){
        $options = array(
        "sort" => array("difficulty" => 1),
        );
        $data = $collection->find(array(),$options);
    }

    if(isset($_POST['diff_descend'])){
        $options = array(
        "sort" => array("difficulty" => -1),
        );
        $data = $collection->find(array(),$options);
    }
    
    if(isset($_POST['title_sort'])){
        $options = array(
        "sort" => array("title" => 1),
        );
        $data = $collection->find(array(),$options);
    }
    
    if(isset($_POST['auth_filter'])){
        $data = $collection->find(array('author' => $_POST['author-filter']));
    }

    if(isset($_POST['date_filter'])){
        $data = $collection->find(array("date" => $_POST['date-filter']));
        
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
        <td><a href='data.php?id=<?php echo $document['_id'];?>' >Delete</a>  <a href='update.php?id=<?php echo $document['_id'];?>' name='update'>
        Update</a></td>
        </tr>                   
     <?php 

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
                        
         ?>

</table>

<br><a href="upload.php"> <--BACK </a>

</form>    