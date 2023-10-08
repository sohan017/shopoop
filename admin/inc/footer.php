<div class="footer-wrap pd-20 mb-20 card-box">
	DeskApp - Bootstrap 4 Admin Template By
	<a href="https://github.com/dropways" target="_blank"
	>Ankit Hingarajiya</a
	>
</div>
</div>
</div>

<!-- js -->
<script src="vendors/scripts/core.js"></script>
<script src="vendors/scripts/script.min.js"></script>
<script src="vendors/scripts/process.js"></script>
<script src="vendors/scripts/layout-settings.js"></script>

<script src="vendors/scripts/sweetalert.min.js"></script>

<?php 
	//sweet alart enable
	if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
		?>
			<script>
				swal({
				  title: "<?php echo $_SESSION['status']; ?>",
				  //text: "You clicked the button!",
				  icon: "<?php echo $_SESSION['status_code']; ?>",
				  button: "Done",
				});
			</script>
		<?php 
		unset($_SESSION['status']);
	}
?>
<!--  -->


<!-- Google Tag Manager (noscript) -->
<noscript
><iframe
src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
height="0"
width="0"
style="display: none; visibility: hidden"
></iframe
></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>
</html>