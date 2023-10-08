<?php include 'inc/header.php'; ?>	
<?php include 'inc/sidebar.php'; ?>	
<?php include '../classes/Product.php'; ?>
<?php include_once '../helpers/Format.php'; ?>


<?php 
	$pd = new Product(); 
	$fm = new Format(); 

	// Delete
	if (isset($_GET['delproduct'])) {
		$id 	= $_GET['delproduct'];
		$delProduct = $pd->productDelById($id);

	}
?>

		<div class="main-container">
			<div class="pd-ltr-20 xs-pd-20-10">
				<div class="min-height-200px">
					<div class="page-header">
						<div class="row">
							<div class="col-md-4 col-sm-12">
								<div class="title">
									<h4>Product List</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="#">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">
											Product List
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
										<a class="dropdown-item" href="productadd.php">Add Product</a>
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
							<h4 class="text-blue h4">Product Data</h4>
							
								<?php 
									// if (isset($delProduct)) {
									// 	echo $delProduct;
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
										<th class="table-plus datatable-nosort">#</th>
										<th>Product Title</th>
										<th>Category</th>
										<th>Brand Name</th>
										<th>Description</th>
										<th>Price</th>
										<th>Type</th>
										<th class="datatable-nosort">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 

										 $getProducts = $pd->getAllProduct();
										
										 if ($getProducts) {
										 	$i = 0;
										 	while ($getProduct = $getProducts->fetch_assoc()) {
										 		$i++;
										

									 ?>
									<tr>
										<td ></td>
										<td class="table-plus"><?php echo $i ?></td>
										<td> 
											<div class="name-avatar d-flex align-items-center">
												<div class="avatar mr-2 flex-shrink-0">
													<img
													src="<?php echo $getProduct['image'];  ?>"
													class="border-radius-100 shadow"
													width="40"
													height="40"
													alt=""
													/>
												</div>
												<div class="txt">
													<div class="weight-600"><?php echo $fm->textShorten($getProduct['productName'], 20);  ?></div>
												</div>
											</div>
										</td>
										<td><?php echo $getProduct['catName'];  ?> </td>
										<td><?php echo $getProduct['brandName'];  ?> </td>
										<td><?php echo $fm->textShorten($getProduct['body'], 10);  ?> </td>
										<td><?php echo $getProduct['price'];  ?> </td>
										<td>
											<?php 
											
												if ($getProduct['type'] == 0) {
												 	echo "<span class='badge badge-pill' data-bgcolor='#e7ebf5' data-color='#265ed7' >Featured</span>";	
												} else{
												 	echo "<span class='badge badge-pill' data-bgcolor='rgb(224 242 231 / 96%)' data-color='rgba(30, 184, 96, 0.96)' >General</span>";
												}
											?> 
										</td>
										<td>
											<div class="table-actions">
												<a href="#" data-color="rgb(8 187 98)"
													><i class="icon-copy dw dw-view"></i
												></a>
												<a href="productedit.php?productid=<?php echo $getProduct['productId']; ?>" data-color="#265ed7"
													><i class="icon-copy dw dw-edit2"></i
												></a>
												<a href="?delproduct=<?php echo $getProduct['productId']; ?>" data-color="#e95959"
													><i class="icon-copy dw dw-delete-3"></i
													
												></a>
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
