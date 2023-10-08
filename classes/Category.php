
<?php

 //====old include===
 // include_once '../lib/Database.php';
 // include_once '../helpers/Format.php';

 $filepath = realpath(dirname(__FILE__));
 include_once ($filepath.'/../lib/Database.php');
 include_once ($filepath.'/../helpers/Format.php'); 

/**
 * Category Class
 */
class Category {
	private $db;
	private $fm;

	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();	
	}

	//Insert method
	public function catInsert($catName){
		$catName = $this->fm->validation($catName);

		$catName = mysqli_real_escape_string($this->db->link, $catName);

		if (empty($catName)) {

			$_SESSION['status'] = "Category Must Not Be Empty";
			$_SESSION['status_code'] = "warning";
			// $msg = "Category Must Not Be Empty";
			// return $msg;
		}else{
			$query     = "INSERT INTO `tbl_category`(`catName`) VALUES ('$catName')";
			$catInsert = $this->db->insert($query);

			if ($catInsert) {

				$_SESSION['status'] = "Category Inserted Successfully";
				$_SESSION['status_code'] = "success";

				// $msg = "<span class='.success'>Category Inserted Successfully</span>";
				// return $msg;
			}else{
				$_SESSION['status'] = "Category Not Inserted";
				$_SESSION['status_code'] = "error";
				// $msg = "<span class='.warning'>Category Not Inserted </span>";
				// return $msg;
			}
		}
	}

	//Show method
	public function getAllCat(){
		$query  = "SELECT * FROM `tbl_category` ORDER BY catId DESC";
		$result = $this->db->select($query);
		return $result;
	}

	//Edit method
	public function getCatId($id){
		$query  = "SELECT * FROM `tbl_category` WHERE catId = '$id'";
		$result = $this->db->select($query);
		return $result;
	}

	//Update method
	public function catUpdate($catName,$id){
		$catName = $this->fm->validation($catName);

		$catName = mysqli_real_escape_string($this->db->link, $catName);
		$id = mysqli_real_escape_string($this->db->link, $id);

		if (empty($catName)) {

			$_SESSION['status'] = "Category Must Not Be Empty";
			$_SESSION['status_code'] = "warning";
			// $msg = "Category Must Not Be Empty";
			// return $msg;
		}else{
			$query = "UPDATE `tbl_category` 
					SET 
					`catName`='$catName'
					WHERE catId ='$id'";
			$updated_row = $this->db->update($query);
			if ($updated_row) {

				$_SESSION['status'] = "Category Updated Successfully";
				$_SESSION['status_code'] = "success";
				// $msg = "<span class='.success'>Category Updated Successfully..</span>";
				// return $msg;
			}else{
				$_SESSION['status'] = "Category Not Updated";
				$_SESSION['status_code'] = "error";
				// $msg = "<span class='.warning'>Category Not Updated.! </span>";
				// return $msg;
			}

		}
	}

//Delete Method
	public function catDelById($id){
		$query  ="DELETE FROM `tbl_category` WHERE catId = '$id'";
		$delcat = $this->db->delete($query);
		if ($delcat) {

			$_SESSION['status'] = "Category Deleted Successfully";
			$_SESSION['status_code'] = "success";
			// $msg = "<span class='.success'>Category Deleted Successfully..</span>";
			// return $msg;
		}else{

			$_SESSION['status'] = "Category Not Deleted";
			$_SESSION['status_code'] = "error";
			// $msg = "<span class='.warning'>Category Not Deleted.! </span>";
			// return $msg;
		}
	}

}

?>