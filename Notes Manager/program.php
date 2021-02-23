<form method="POST">
	<h2>Book Price</h2>
 	<!-- BOOK NAME: <input type="text" name="name"> -->
 	Book Name: <select  name="name" id="name" value="Null">
						<option value="">--Please Choose Book--</option>
						<option value="java">Java</option>
						<option value="c">C</option>
						<option value="php">PHP</option>
					</select>
 	<br>
 	<input type="submit" name="submit" id="submit">
 	<br>
 	<?php 

//simple get req

if (isset($_POST['submit'])) {
	# code...
	$name=$_POST['name'];

	//Resource address

	$url="http://localhost/IP/services.php/?name=$name";

	//send req

	$client=curl_init($url);
	curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
	//get response

	$response=curl_exec($client);

	//decode

	$result=json_decode($response);

	echo "PRICE= Rs. ".$result->data;
}


 ?>
 </form>
<a href="index.php">To Home Page</a>
<style type="text/css">
	form{
		margin: 0 auto;
		width:300px;
		height:150px;
		padding-top: 20px;
		padding-bottom: 30px;
		padding-right: 20px;
		padding-left:30px;
		background-color: #000066;
		color:white;
		font-family: sans-serif;
	}

	input#submit{
		margin: 15px;
		margin-left: 100px; 
		font-family: sans-serif;
		padding:5px;
	}


	h2{
		text-align: center;
	}

</style>



