<?php include 'inc/header.php'; ?>	
<?php include 'inc/sidebar.php'; ?>	
<?php include '../classes/Brand.php'; ?>


<?php 
	$brand = new Brand(); 
	$fm = new Format(); 

	//Delete
	if (isset($_GET['delbrand'])) {
		$id 	= $_GET['delbrand'];
		$delBrand = $brand->brandDelById($id);

	}
?>

		<div class="main-container">
			<div class="pd-ltr-20 xs-pd-20-10">
				<div class="min-height-200px">
					<div class="page-header">
						<div class="row">
							<div class="col-md-4 col-sm-12">
								<div class="title">
									<h4>Brand List</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="#">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">
											Brand List
										</li>
									</ol>
								</nav>
							</div>
							<div class="col-md-4 col-sm-12">
								<div
								class="card-box min-height-600px pd- mb-"
								data-bgcolor="#455a64"
								>
								<div class="pb-10 text-white" style="text-align: center;">
									<div class="icon h1 text-white"> 
										<i class="fa fa-calendar" aria-hidden="true">
											
											<?php 
											 //echo $fm->getCount("tbl_brand");  
											?>
											


										</i>
										<!-- <i class="icon-copy fa fa-stethoscope" aria-hidden="true"></i> -->
									</div>
								</div>
								
							</div>
							</div>

							<div class="col-md-4 col-sm-12 text-right">
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
										<a class="dropdown-item" href="brandadd.php">Add Brand</a>
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
							<h4 class="text-blue h4">Brands  Data</h4>
							
								<?php 
									// if (isset($delCat)) {
									// 	echo $delCat;
									// }
								?>
							
						</div>
						<div class="pb-20">
							<table class="checkbox-datatable table nowrap">
								<thead>
									<tr>
										<th>
											<div class="dt-checkbox">
												<input
													type="checkbox"
													name="select_all"
													value="1"
													id="example-select-all"
												/>
												<span class="dt-checkbox-label"></span>
											</div>
										</th>
										<th class="table-plus datatable-nosort">Serial Number</th>
										<th>Brand Name</th>
										<th>Brand Description</th>
										<th class="datatable-nosort">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 

										$getBrands = $brand->getAllBrand();
										
										if ($getBrands) {
											$i = 0;
											while ($getBrand = $getBrands->fetch_assoc()) {
												$i++;
										

									 ?>
									<tr>
										<td ></td>
										<td class="table-plus"><?php echo $i ?></td>
										<td><?php echo $getBrand['brandName'];  ?></td>
										<td><?php echo $fm->textShorten($getBrand['brandDesc'], 20);  ?></td>
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
													<a class="dropdown-item" href="brandedit.php?brandid=<?php echo $getBrand['brandId']; ?>"
														><i class="dw dw-edit2"></i> Edit</a
													>
													<a class="dropdown-item"  href="?delbrand=<?php echo $getBrand['brandId']; ?>"
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
