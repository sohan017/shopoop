<?php include 'inc/header.php';	?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Product.php'; ?> 
<?php include '../classes/Category.php'; ?> 
<?php include '../classes/Brand.php'; ?>  	

<?php
	$pb = new Product(); 

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
		$insertProduct = $pb->productInsert($_POST, $_FILES);
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
							<h4>Product Form</h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item">
									<a href="#">Dashboard</a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">
									Add Product
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
					<h4 class="text-blue h4">Product Form</h4>
					<p class="mb-30">Fill up The Product Form</p>
				</div>
				</div>
				<?php 

					if (isset($insertProduct)) {
						echo $insertProduct;
					}
				 ?>
				<form action="productadd.php" method="post" enctype="multipart/form-data">
				 	<div class="row">
				 		<div class="col-md-8 col-sm-12">
				 			<div class="form-group">
				 				<label>Product Title</label>
				 				<input type="text" class="form-control" placeholder="Enter Product Title" name="productName">
				 			</div>
				 			<div class="form-group ">
								<label >Producr Category</label>
								<div class="	">
									<select class="custom-select" name="catId">
										<option selected="">Choose Producr Category</option>
										<?php 
											$cat = new Category();
											$getcats = $cat->getAllCat();
											if ($getcats) {
												while ($getcat = $getcats->fetch_assoc()) {
													
												
										 ?>
										<option value="<?php echo $getcat['catId']; ?>"><?php echo $getcat['catName']; ?></option>
									<?php } } ?>
									</select>
								</div>
							</div>
							<div class="form-group ">
								<label >Brand Name</label>
								<div class="	">
									<select class="custom-select" name="brandId">
										<option selected="">Choose Brand Category</option>
										<?php 
											$brand = new Brand();
											$getBrands = $brand->getAllBrand();
											if ($getBrands) {
												while ($getbrand = $getBrands->fetch_assoc()) {
													
												
										 ?>
										<option value="<?php echo $getbrand['brandId']; ?>"><?php echo $getbrand['brandName']; ?></option>
									<?php } } ?>
									</select>
								</div>
							</div>
				 			<div class="html-editor pd-20 card-box mb-30">
				 				<label>Product Description</label>
				 				<textarea class="textarea_editor form-control border-radius-0" name="body" placeholder="Enter Product Description ..." >
				 					
				 				</textarea>
				 			</div>

				 			<div class="form-group">
				 				<label>Price</label>
				 				<input type="text" class="form-control" placeholder="Enter Product Price" name="price">
				 			</div>
				 			<div class="form-group">
								<label>Custom file input</label>
								<div class="custom-file">
									<input type="file" name="image" class="custom-file-input" />
									<label class="custom-file-label">Choose file</label>
								</div>
							</div>
				 			<div class="form-group ">
								<label >Product Type</label>
								<div class="	">
									<select class="custom-select" name="type">
										<option selected="">Choose Product Type.</option>
										<option value="0">Featured</option>
										<option value="1">General</option>
									</select>
								</div>
							</div>
				 		</div>
				 		
				 	</div>
				 	
				 	<div class="input-group mb-0">					
						<input class="btn btn-primary" name="submit" type="submit" value="Create">
					</div>	
				</form>		
			</div>
		</div>
	</div>
</div>

<?php include 'inc/footer.php'; ?>	
</body>
</html>