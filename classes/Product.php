<?php 
 //====old include===
 // include_once '../lib/Database.php';  
 // include_once '../helpers/Format.php'; 

 $filepath = realpath(dirname(__FILE__));
 include_once ($filepath.'/../lib/Database.php');
 include_once ($filepath.'/../helpers/Format.php');
 

/**
 * Product Class
 */
class Product{
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();	
	}

	
	 /*
     	*Insert Method
     */

	public function productInsert($data, $file){ 

		$productName = $this->fm->validation($data['productName']);
		$catId 		 = $this->fm->validation($data['catId']);
		$brandId 	 = $this->fm->validation($data['brandId']);
		$body 		 = $this->fm->validation($data['body']);
		$price 		 = $this->fm->validation($data['price']);
		$type 		 = $this->fm->validation($data['type']);

		$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
		$catId 		 = mysqli_real_escape_string($this->db->link, $data['catId']);
		$brandId 	 = mysqli_real_escape_string($this->db->link, $data['brandId']);
		$body 		 = mysqli_real_escape_string($this->db->link, $data['body']);
		$price 		 = mysqli_real_escape_string($this->db->link, $data['price']);
		$type 		 = mysqli_real_escape_string($this->db->link, $data['type']);


		$permited  = array('jpg', 'jpeg', 'png', 'gif');
    	$file_name = $file['image']['name'];
	    $file_size = $file['image']['size'];
	    $file_temp = $file['image']['tmp_name'];

	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "uploads/".$unique_image;

	    if ($productName == "" || $catId =="" || $brandId == "" || $body == "" || $price == "" || $file_name == "" || $type == "") {

	    	$msg = "<span class='error'>File cannot blan</span>";
			return $msg;

			// $_SESSION['status'] = "File cannot blank";
			// $_SESSION['status_code'] = "warning";
	    }elseif ($file_size >1048567) {
	     	echo "<span class='error'>Image Size should be less then 1MB!</span>";

	    } elseif (in_array($file_ext, $permited) === false) {
	    	 echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";

	    }else{
	    	move_uploaded_file($file_temp, $uploaded_image);
	    	$query = "INSERT INTO `tbl_product`(`productName`, `catId`, `brandId`, `body`, `price`, `image`, `type`) VALUES ('$productName','$catId','$brandId','$body','$price','$uploaded_image','$type')";

	    	$productInsert = $this->db->insert($query);

			if ($productInsert) {

				$_SESSION['status'] = "Product Inserted Successfully";
				$_SESSION['status_code'] = "success";

				// $msg = "<span class='.success'>Category Inserted Successfully</span>";
				// return $msg;
			}else{
				$_SESSION['status'] = "Product Not Inserted";
				$_SESSION['status_code'] = "error";
				// $msg = "<span class='.warning'>Category Not Inserted </span>";
				// return $msg;
			}
	    }

	}

	/*
     	*View Method
    */

    public function getAllProduct(){

    	/*
			*INNER JOIN Query
		*/

		/*
    	$query  = "SELECT `tbl_product`.*, tbl_category.catName, tbl_brand.brandName
    	FROM tbl_product
    	INNER JOIN tbl_category
    	ON tbl_product.catId = tbl_category.catId
    	INNER JOIN tbl_brand
    	ON tbl_product.brandId = tbl_brand.brandId
    	ORDER BY tbl_product.productId DESC";
    	*/


    	/*
			*Alias Query
		*/

		$query  = "SELECT `p`.*, c.catName, b.brandName
		FROM tbl_product as p, tbl_category as c, tbl_brand as b
		WHERE p.catId = c.catId and p.brandId = b.brandId
		ORDER BY p.productId DESC";
    	$result = $this->db->select($query);
    	return $result;
    }

    /*
     	*Edit Method
    */

    public function getProductById($id){
    	$query  = "SELECT * FROM `tbl_product` WHERE productId = '$id'";
		$result = $this->db->select($query);
		return $result;
    }

    /*
     	*Update Method
    */

    public function productUpdate($data, $file, $id){
    	$productName = $this->fm->validation($data['productName']);
		$catId 		 = $this->fm->validation($data['catId']);
		$brandId 	 = $this->fm->validation($data['brandId']);
		$body 		 = $this->fm->validation($data['body']);
		$price 		 = $this->fm->validation($data['price']);
		$type 		 = $this->fm->validation($data['type']);

		$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
		$catId 		 = mysqli_real_escape_string($this->db->link, $data['catId']);
		$brandId 	 = mysqli_real_escape_string($this->db->link, $data['brandId']);
		$body 		 = mysqli_real_escape_string($this->db->link, $data['body']);
		$price 		 = mysqli_real_escape_string($this->db->link, $data['price']);
		$type 		 = mysqli_real_escape_string($this->db->link, $data['type']);


		$permited  = array('jpg', 'jpeg', 'png', 'gif');
    	$file_name = $file['image']['name'];
	    $file_size = $file['image']['size'];
	    $file_temp = $file['image']['tmp_name'];

	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "uploads/".$unique_image;

	    if ($productName == "" || $catId =="" || $brandId == "" || $body == "" || $price == "" || $type == "") {

	    	$msg = "<span class='error'>File cannot blan</span>";
			return $msg;

			// $_SESSION['status'] = "File cannot blank";
			// $_SESSION['status_code'] = "warning";
	    }else{
	    	if (!empty($file_name)) {

			    if ($file_size >1048567) {
			     	echo "<span class='error'>Image Size should be less then 1MB!</span>";
			    } elseif (in_array($file_ext, $permited) === false) {
			    	echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
			    }else{
			    	move_uploaded_file($file_temp, $uploaded_image);
			    	$query ="UPDATE `tbl_product` 
			    				SET 
			    				`productName`='$productName',
			    				`catId`='$catId',
			    				`brandId`='$brandId',
			    				`body`='$body',
			    				`price`='$price',
			    				`image`='$uploaded_image',
			    				`type`='$type' 
			    				WHERE `productId`='$id'";

			    	$productUpdate = $this->db->update($query);

					if ($productUpdate) {

						$_SESSION['status'] = "Product Updated Successfully";
						$_SESSION['status_code'] = "success";

						// $msg = "<span class='.success'>Category Inserted Successfully</span>";
						// return $msg;
					}else{
						$_SESSION['status'] = "Product Not Updated";
						$_SESSION['status_code'] = "error";
						// $msg = "<span class='.warning'>Category Not Inserted </span>";
						// return $msg;
					}
			   }
			}else{
		    	$query ="UPDATE `tbl_product` 
		    				SET 
		    				`productName`='$productName',
		    				`catId`='$catId',
		    				`brandId`='$brandId',
		    				`body`='$body',
		    				`price`='$price',
		    				`type`='$type' 
		    				WHERE `productId`='$id'";

		    	$productUpdate = $this->db->update($query);

				if ($productUpdate) {

					$_SESSION['status'] = "Product Updated Successfully";
					$_SESSION['status_code'] = "success";

					// $msg = "<span class='.success'>Category Inserted Successfully</span>";
					// return $msg;
				}else{
					$_SESSION['status'] = "Product Not Updated";
					$_SESSION['status_code'] = "error";
					// $msg = "<span class='.warning'>Category Not Inserted </span>";
					// return $msg;
				}
			} 
	  	}
    }

    /*
     	*Delete Method
    */

    public function productDelById($id){

    	$query   = "SELECT * FROM `tbl_product` WHERE productId = '$id'";
    	$getdata = $this->db->select($query);
    	if ($getdata) {
    		while ($delimage = $getdata->fetch_assoc()) {
    			$delImageLink = $delimage['image'];
    			unlink($delImageLink);
    		}
    		
    	}

    	$delquery   = "DELETE FROM `tbl_product` WHERE productId = '$id'";
		$delProduct = $this->db->delete($delquery);
		if ($delProduct) {

			 $_SESSION['status'] = "Product Deleted Successfully";
			 $_SESSION['status_code'] = "success";
		}else{

			 $_SESSION['status'] = "Product Not Deleted";
			 $_SESSION['status_code'] = "error";
		}	
    }

    //Feature Product

    public function getFeaturedProduct(){
    	// $query  = "SELECT * FROM `tbl_product` WHERE type= '0' ORDER BY productId DESC LIMIT 4";
		// $result = $this->db->select($query);
		// return $result;

		$query  = "SELECT `p`.*, c.catName, b.brandName
		FROM tbl_product as p, tbl_category as c, tbl_brand as b
		WHERE p.catId = c.catId and p.brandId = b.brandId and p.type= '0'
		ORDER BY p.productId DESC LIMIT 4";
    	$result = $this->db->select($query);
    	return $result;
    } 

    //New Product

    public function getNewProduct(){
    	// $query = "SELECT * FROM `tbl_product` ORDER BY productId DESC LIMIT 5";
    	// $result = $this->db->select($query);
		// return $result;

		$query  = "SELECT `p`.*, c.catName, b.brandName
		FROM tbl_product as p, tbl_category as c, tbl_brand as b
		WHERE p.catId = c.catId and p.brandId = b.brandId
		ORDER BY p.productId DESC LIMIT 5";
    	$result = $this->db->select($query);
    	return $result;

    	
    }

    //Single Product 

    public function getSingleProduct($id){

    	$query  = "SELECT `p`.*, c.catName, b.brandName 
    	FROM tbl_product as p,tbl_category as c, tbl_brand as b 
    	WHERE p.catId = c.catId and p.brandId = b.brandId  and p.productId = '$id';";
    	$result = $this->db->select($query); 
    	return $result; 
    }
}

 ?>