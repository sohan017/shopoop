<?php include 'inc/header.php';	?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Product.php'; ?> 
<?php include '../classes/Category.php'; ?> 
<?php include '../classes/Brand.php'; ?>  	

<?php 

	$pd = new Product(); 
	//Edit
	if (!isset($_GET['productid']) || $_GET['productid'] == NULL ) {
		echo "<script>window.location = 'productlist.php';</script>";
	}else{
		$id = $_GET['productid'];
		//preg_replace('/(?<!^)([A-Z][a-z]|(?<=[a-z])[^a-z]|(?<=[A-Z])[0-9_])/', '', $_GET['catid']);
	}


	//update
	

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
		$updateProduct = $pd->productUpdate($_POST, $_FILES, $id);
	}

?>


<div class="mobile-menu-overlay"></div>

<div class="main-container">
	<div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
			<div class="page-header">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="title">
							<h4>Update Product Form </h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item">
									<a href="#">Dashboard</a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">
									Product Update
								</li>
							</ol>
						</nav>
					</div>
					<div class="col-md-6 col-sm-12 text-right">
						<div class="dropdown">
							<a
							class="btn btn-secondary dropdown-toggle"
							href="#"
							role="button"
							data-toggle="dropdown"
							>
							Product
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="productlist.php">Product List</a>
								<a class="dropdown-item" href="#">Export List</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Default Basic Forms Start -->
			<div class="pd-20 card-box mb-30">
				<div class="clearfix">
				<div class="pull-left">
					<h4 class="text-blue h4">Update Product Form</h4>
					<p class="mb-30">Update The Product Form</p>
				</div>
				</div>
				<?php 

					// if (isset($insertProduct)) {
					// 	echo $insertProduct;
					// }
				 ?>

				 <?php 

				 	$getProduct = $pd->getProductById($id);

				 	if ($getProduct) {
				 		while ($data = $getProduct->fetch_assoc()) {
				 			
				 		

				  ?>
				<form action="" method="post" enctype="multipart/form-data">
				 	<div class="row">
				 		<div class="col-md-8 col-sm-12">
				 			<div class="form-group">
				 				<label>Product Title</label>
				 				<input type="text" class="form-control" value="<?php echo $data['productName']; ?>" name="productName">
				 			</div>
				 			<div class="form-group ">
								<label >Product Category</label>
								<div class="	">
									<select class="custom-select" name="catId">
										<option>Choose Product Category</option>
										<?php 
											$cat = new Category();
											$getcats = $cat->getAllCat();
											if ($getcats) {
												while ($getcat = $getcats->fetch_assoc()) {
													
												
										 ?>
										<option <?php 
											if ($data['catId'] == $getcat['catId'] ) { ?>
												selected="selected"
											<?php } ?> value="<?php echo $getcat['catId']; ?>">
											<?php echo $getcat['catName']; ?>
											
										</option>
									<?php } } ?>
									</select>
								</div>
							</div>
							<div class="form-group ">
								<label >Brand Name</label>
								<div class="	">
									<select class="custom-select" name="brandId">
										<option selected="">Select Brand</option>
										<?php 
											$brand = new Brand();
											$getBrands = $brand->getAllBrand();
											if ($getBrands) {
												while ($getbrand = $getBrands->fetch_assoc()) {
													
												
										 ?>
										<option 
											<?php 
											if ($data['brandId'] == $getbrand['brandId']) { ?>
												selected="selected"
											<?php } ?> value="<?php echo $getbrand['brandId']; ?>">
											<?php echo $getbrand['brandName']; ?>
										</option>
										<?php } } else { ?> 
											<option >Brand data not avaiable </option> 
										<?php } ?>
									</select>
								</div>
							</div>
				 			<div class="html-editor pd-20 card-box mb-30">
				 				<label>Product Description</label>
				 				<textarea class="textarea_editor form-control border-radius-0" name="body" placeholder="Enter Product Description ..." >
				 					<?php echo $data['body']; ?>
				 				</textarea>
				 			</div>

				 			<div class="form-group">
				 				<label>Price</label>
				 				<input type="text" class="form-control" value="<?php echo $data['price']; ?>" name="price">
				 			</div>
				 			<div class="form-group">
								<label>Custom file input</label>
								<div class="custom-file">
									<input type="file" name="image" class="custom-file-input" />
									<label class="custom-file-label">Choose file</label>
									<td> 
										<div class="name-avatar d-flex align-items-center">
											<div class="avatar mr-2 flex-shrink-0">
												<img
												src="<?php echo $data['image'];  ?>"
												class="border-radius-100 shadow"
												width="40"
												height="40"
												alt=""
												/>
											</div>
										</div>
									</td>
								</div>
							</div>
				 			<div class="form-group ">
								<label >Product Type</label>
								<div class="	">
									<select class="custom-select" name="type">
										<option>Choose Product Type.</option>
										<?php if ($data['type'] == 0) {?>
										<option selected="selected" value="0">Featured</option>
										<option value="1">General</option>
										<?php }else{?>
										<option selected="selected" value="0">Featured</option>
										<option value="1">General</option>
										<?php } ?>
										
									</select>
								</div>
							</div>
				 		</div>
				 		
				 	</div>
				 	
				 	<div class="input-group mb-0">					
						<input class="btn btn-primary" name="submit" type="submit" value="Update">
					</div>	
				</form>	
				<?php } } ?>	
			</div>
		</div>
	</div>
</div>

<?php include 'inc/footer.php'; ?>	
</body>
</html>