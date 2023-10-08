<?php include 'inc/header.php'; ?>	
<?php include 'inc/sidebar.php'; ?>	
<?php include '../classes/Category.php'; ?>

<?php 

	$cat = new Category(); 
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$catName = $_POST['catName'];

		$insertCat = $cat->catInsert($catName);
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
									Add Category
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
							Category
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a class="dropdown-item" href="catlist.php">Category List</a>
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
					<h4 class="text-blue h4">Category Form</h4>
					<p class="mb-30">Fill up The Category Form</p>
				</div>
			</div>
				<?php 
					if (isset($insertCat)) {
						echo $insertCat;
					}
				 ?>
			<form action="catadd.php" method="post">
				<div class="form-group">
					<label for="exampleInputEmail1">Category Name</label>
					<input type="text" class="form-control" id="catname" name="catName" placeholder="Category Name">

				</div>
				<div class="input-group mb-0">					
					<input class="btn btn-primary" type="submit" value="Create">
				</div>	
				<!-- <button type="submit" class="btn btn-primary">Submit</button> -->
			</form>
		</div>
	</div>
</div>
<!-- horizontal Basic Forms End -->


</div>

<?php include 'inc/footer.php'; ?>	
</body>
</html>