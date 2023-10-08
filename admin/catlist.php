<?php include 'inc/header.php'; ?>	
<?php include 'inc/sidebar.php'; ?>	
<?php include '../classes/Category.php'; ?>

<?php 
	$cat = new Category(); 

	//Delete
	if (isset($_GET['delcat'])) {
		$id 	= $_GET['delcat'];
		//sanetise
		$id 	=preg_replace('/(?<!^)([A-Z][a-z]|(?<=[a-z])[^a-z]|(?<=[A-Z])[0-9_])/', '', $_GET['delcat']);
		$delCat = $cat->catDelById($id);

	}
?>

		<div class="main-container">
			<div class="pd-ltr-20 xs-pd-20-10">
				<div class="min-height-200px">
					<div class="page-header">
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="title">
									<h4>Category List</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="index.html">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">
											Category List
										</li>
									</ol>
								</nav>
							</div>
							<div class="col-md-6 col-sm-12 text-right">
								<div class="dropdown">
									<a
										class="btn btn-primary dropdown-toggle"
										href="#"
										role="button"
										data-toggle="dropdown"
									>
										Pdf Or Exal
									</a>
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="#">Export List</a>
										<a class="dropdown-item" href="#">Policies</a>
										<a class="dropdown-item" href="#">View Assets</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Simple Datatable start -->
					<div class="card-box mb-30">
						<div class="pd-20">
							<h4 class="text-blue h4">Categorys  Data</h4>
							
								<?php 
									if (isset($delCat)) {
										echo $delCat;
									}
								?>
							
						</div>
						<div class="pb-20">
							<table class="data-table table stripe hover nowrap">
								<thead>
									<tr>
										<th class="table-plus datatable-nosort">Serial Number</th>
										<th>Name</th>
										<th class="datatable-nosort">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 

										$getCats = $cat->getAllCat();

										if ($getCats) {
											$i = 0;
											while ($getCat = $getCats->fetch_assoc()) {
												$i++;
											
									 ?>
									<tr>
										<td class="table-plus"><?php echo $i ?></td>
										<td><?php echo $getCat['catName'];  ?></td>
										<td>
											<div class="dropdown">
												<a
													class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
													href="#"
													role="button"
													data-toggle="dropdown"
												>
													<i class="dw dw-more"></i>
												</a>
												<div
													class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
												>
													<a class="dropdown-item" href="#"
														><i class="dw dw-eye"></i> View</a
													>
													<a class="dropdown-item" href="catedit.php?catid=<?php echo $getCat['catId']; ?>"
														><i class="dw dw-edit2"></i> Edit</a
													>
													<a class="dropdown-item"  href="?delcat=<?php echo $getCat['catId']; ?>"
														><i class="dw dw-delete-3"></i> Delete</a
													>
												</div>
											</div>
										</td>
									</tr>
									<?php } } ?>
								</tbody>
							</table>
						</div>
					</div>
					<!-- Simple Datatable End -->
			  </div>
			</div>
		</div>
		
		<!-- js -->
		<?php include 'inc/footer.php'; ?>	
		<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
		<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>

		<!-- buttons for Export datatable -->
		<script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
		<script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
		<script src="src/plugins/datatables/js/buttons.print.min.js"></script>
		<script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
		<script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
		<script src="src/plugins/datatables/js/pdfmake.min.js"></script>
		<script src="src/plugins/datatables/js/vfs_fonts.js"></script>
		<!-- Datatable Setting js -->
		<script src="vendors/scripts/datatable-setting.js"></script>

	</body>
</html>
