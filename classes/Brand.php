<?php 
 //====old include===
 // include_once '../lib/Database.php';
 // include_once '../helpers/Format.php';

 $filepath = realpath(dirname(__FILE__));
 include_once ($filepath.'/../lib/Database.php');
 include_once ($filepath.'/../helpers/Format.php');



/**
 * Brand Class
 */

class Brand{
	
	private $db;
	private $fm;

	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();	
	}

	//insert method

	public function brandInsert($brandName,$brandDesc){
		$brandName = $this->fm->validation($brandName);
		$brandDesc = $this->fm->validation($brandDesc);

		$brandName = mysqli_real_escape_string($this->db->link, $brandName);	
		$brandDesc = mysqli_real_escape_string($this->db->link, $brandDesc);

		if (empty($brandName)) {
			$_SESSION['status'] = "Brand Name Must Not Be Empty";
			$_SESSION['status_code'] = "warning";
		}else{
			$query 		   = "INSERT INTO `tbl_brand`(`brandName`,`brandDesc`) VALUES ('$brandName','$brandDesc')";
			$insertBrand = $this->db->insert($query);

			if (insertBrand) {
				$_SESSION['status'] = "Brand Insert Successfully";
				$_SESSION['status_code'] = "success";
			}else{
				$_SESSION['status'] = "Brand Not Inserted";
				$_SESSION['status_code'] = "error";
			}
		}	
	}

	//Show Method

	public function getAllBrand(){
		$query  = "SELECT * FROM `tbl_brand` ORDER BY brandId DESC";
		$result = $this->db->select($query);
		return $result;	

		
	}

	//Edit Method

	public function getBrandById($id){
		$query  = "SELECT * FROM `tbl_brand` WHERE brandId = '$id'";
		$result = $this->db->select($query);
		return $result;
	}

	//Update Method
	public function brandUpdate($brandName,$brandDesc,$id){
		$brandName = $this->fm->validation($brandName);
		$brandDesc = $this->fm->validation($brandDesc);

		$brandName = mysqli_real_escape_string($this->db->link, $brandName);	
		$brandDesc = mysqli_real_escape_string($this->db->link, $brandDesc);
		$id = mysqli_real_escape_string($this->db->link, $id);

		if (empty($brandName)) {
			$_SESSION['status'] = "Brand Name Must Not Be Empty";
			$_SESSION['status_code'] = "warning";
		}else{
			$query ="UPDATE `tbl_brand` 
					SET 
					`brandName`='$brandName',
					`brandDesc`='$brandDesc'
					WHERE 
					brandId = '$id'";
			$updateBrand = $this->db->update($query);

			if ($updateBrand) {

				$_SESSION['status'] = "Brand Updated Successfully";
				$_SESSION['status_code'] = "success";

			}else{

				$_SESSION['status'] = "Brand Not Updated";
				$_SESSION['status_code'] = "error";

			}
		}


	}


	//Delete Method
	public function brandDelById($id){
		$query  ="DELETE FROM `tbl_brand` WHERE brandId = '$id'";
		$delBrand = $this->db->delete($query);
		if ($delBrand) {

			$_SESSION['status'] = "Brand Deleted Successfully";
			$_SESSION['status_code'] = "success";
			
		}else{

			$_SESSION['status'] = "Brand Not Deleted";
			$_SESSION['status_code'] = "error";
			
		}
		
	}
}

?>