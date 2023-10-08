<?php include 'inc/header.php'; ?>	
<?php include 'inc/sidebar.php'; ?>	
<?php include '../classes/Brand.php'; ?>

<?php 

	$brand = new Brand(); 
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	 	$brandName = $_POST['brandName'];
	 	$brandDesc = $_POST['brandDesc'];

		$insertBrand = $brand->brandInsert($brandName,$brandDesc);
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
							<h4>Form</h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item">
									<a href="index.html">Dashboard</a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">
									Add Brand
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
							Brand
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="brandlist.php">Brand List</a>
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
					<h4 class="text-blue h4">Brand Form</h4>
					<p class="mb-30">Fill up The Brand Form</p>
				</div>
				</div>
					<?php 
						// if (isset($insertCat)) {
						// 	echo $insertCat;
						// }
					 ?>

				<form action="brandadd.php" method="post">
				 	<div class="row">
				 		<div class="col-md-8 col-sm-12">
				 			<div class="form-group">
				 				<label>Brand Name</label>
				 				<input type="text" class="form-control" placeholder="Enter Brand Name" name="brandName">
				 			</div>
				 		</div>
				 		
				 	</div>
				 	<div class="row">
				 		<div class="col-md-8 col-sm-12">
				 			<div class="html-editor pd-20 card-box mb-30">
				 				<label>Brand Description</label>
				 				<textarea class="textarea_editor form-control border-radius-0" name="brandDesc" placeholder="Enter text ..." >
				 					
				 				</textarea>
				 			</div>
				 		</div>
				 	</div>
				 	<div class="input-group mb-0">					
						<input class="btn btn-primary" type="submit" value="Create">
					</div>	
				</form>		
			</div>
		</div>
	</div>
</div>

<?php include 'inc/footer.php'; ?>	
</body>
</html>