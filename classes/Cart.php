<?php 
 //====old include===
 // include_once '../lib/Database.php';
 // include_once '../helpers/Format.php';

 $filepath = realpath(dirname(__FILE__));
 include_once ($filepath.'/../lib/Database.php');
 include_once ($filepath.'/../helpers/Format.php');



/**
 * Cart Class
 */

class Cart{
	
	private $db;
	private $fm;

	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();	
	}

	//Cart Add Method
	public function addToCart($quantity, $id){
		$quantity    = $this->fm->validation($quantity);
		$quantity    = mysqli_real_escape_string($this->db->link, $quantity);
		$productId   = mysqli_real_escape_string($this->db->link, $id);
		$sId 	     = session_id();

		//Select Query for Show tbl_product table Data

		$query 	  	 ="SELECT * FROM tbl_product WHERE productId = '$productId'";
		$result    	 = $this->db->select($query)->fetch_assoc();

		//Show tbl_product table Data sample
		/*
		echo "<pre>";
			print_r($result);
		echo "</pre>";
		*/

		//je je data neya lagbe 
		$productName = $result['productName'];
		$price 		 = $result['price'];
		$image 		 = $result['image'];

		//SELECT Query for void Adding Same Product in cart

		$chquery = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND sId ='$sId'";
		$getPro  = $this->db->select($chquery);
		if ($getPro) {
			$msg = "Product Already Added";
			return $msg;
		}else{

			//INSERT Query for add data in tbl_cart table

			$insertQuery = "INSERT INTO `tbl_cart`(`sId`, `productId`, `productName`, `price`, `quantity`, `image`) VALUES ('$sId','$productId','$productName','$price','$quantity','$image')";

			$insertCartProduct = $this->db->insert($insertQuery);
			if (insertCartProduct) {
				echo "<script>window.location = 'cart.php'</script>";
			}else{
				echo "<script>window.location = '404.php'</script>";
			}
		}
	}

	//show product data in cart method
	public function getCartProduct(){
		$sId    = session_id();
		$query 	="SELECT * FROM tbl_cart WHERE sId = '$sId'";
		$result = $this->db->select($query);
		return $result;

	}

	//update product quantity in cart method
	public function updateCartQuantity($cartId, $quantity){
		$cartId      = mysqli_real_escape_string($this->db->link, $cartId);
		$quantity    = mysqli_real_escape_string($this->db->link, $quantity);
		$query 		= "UPDATE `tbl_cart` 
						SET 
						`quantity`='$quantity'
						WHERE cartId ='$cartId'";
					$updated_row = $this->db->update($query);
					if ($updated_row) {

						
						$msg = "<script> window.location = 'cart.php'</script>";
						return $msg;
					}else{
						
						$msg = "<span class='.warning'>Cart Not Updated.! </span>";
						return $msg;
					}

	}


	//delete Product from Cart

	public function delProductBycart($delId){
		$delId      = mysqli_real_escape_string($this->db->link, $delId);
		$query      ="DELETE FROM `tbl_cart` WHERE cartId = '$delId'";
		$deldata    = $this->db->delete($query);
		if ($deldata) {

			echo "<script>window.location = 'cart.php'</script>";
			
		}else{
			$msg = "<span class='.warning'>Product Not Deleted.! </span>";
			return $msg;
		}
	}


	//
	public function checkCartTable(){
		$sId    = session_id();
		$query 	="SELECT * FROM tbl_cart WHERE sId = '$sId'";
		$result = $this->db->select($query);
		return $result;
	}
}