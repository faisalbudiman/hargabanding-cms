<script src="<?php echo base_url('storage/assets/js/all-modules.js') ?>"></script>
<script src="<?php echo base_url('storage/assets/js/main.js') ?>"></script>
<script src="<?php echo base_url('storage/assets/js/custom.js') ?>"></script>

<!-- JS Libraies -->
<?php if (!empty($datatables)): ?>
	<script>
	<?php  
	echo trim("datatables_serverside(
			".$identity.",
			".$datatables_url.",
			".trim($datatables_data).")");
	?>
	</script>
<?php endif ?>
<!-- </body></html> -->
</body>
</html>