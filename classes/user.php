<?php 
 //====old include===
 // include_once '../lib/Database.php';
 // include_once '../helpers/Format.php';

 $filepath = realpath(dirname(__FILE__));
 include_once ($filepath.'/../lib/Database.php');
 include_once ($filepath.'/../helpers/Format.php');


/**
 * User Class
 */

class User{
	
	private $db;
	private $fm;

	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();	
	}
}