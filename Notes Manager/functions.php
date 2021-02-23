<?php 

	function get_price($find){

		$books=array(
			"c"=>200,
			"java"=>300,
			"php"=>400
		);
		foreach ($books as $book=>$price) {
			if ($book==$find) {
				return $price;
				break;
			}
		}

	}
 ?>