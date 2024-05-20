
			<footer class="footer">
				<div class="container-fluid">
					<nav class="pull-left">
						<!-- <ul class="nav">
							<li class="nav-item">
								<a class="nav-link" href="https://www.themekita.com">
									ThemeKita
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									Help
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									Licenses
								</a>
							</li>
						</ul> -->
					</nav>
					<div class="copyright ml-auto">
						2024, All Rights Serve <i class="fa fa-heart heart text-danger"></i> by <a href="https://tamtechhub.com/">Tamaraw Technohub Inc</a>
					</div>				
				</div>
			</footer>
		</div>
	</div>
	
	<!--   Core JS Files   -->
	<script src="<?= base_url('template/assets/js/core/jquery.3.2.1.min.js') ?>"></script>
	<script src="<?= base_url('template/assets/js/core/popper.min.js') ?>"></script>
	<script src="<?= base_url('template/assets/js/core/bootstrap.min.js') ?>"></script>
	<!-- jQuery UI -->
	<script src="<?= base_url('template/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') ?>"></script>
	<script src="<?= base_url('template/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') ?>"></script>
	
	<!-- jQuery Scrollbar -->
	<script src="<?= base_url('template/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') ?>"></script>
	<!-- Datatables -->
	<script src="<?= base_url('template/assets/js/plugin/datatables/datatables.min.js') ?>"></script>
	<!-- Atlantis JS -->
	<script src="<?= base_url('template/assets/js/atlantis.min.js') ?>"></script>
	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="<?= base_url('template/assets/js/setting-demo2.js') ?>"></script>
	<script src="<?= base_url('template/sweetalert2@11.js') ?>"></script>


	<script >
		$(document).ready(function() {
			$('#basic-datatables').DataTable({
			});

			$('#multi-filter-select').DataTable( {
				"pageLength": 5,
				initComplete: function () {
					this.api().columns().every( function () {
						var column = this;
						var select = $('<select class="form-control"><option value=""></option></select>')
						.appendTo( $(column.footer()).empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
								);

							column
							.search( val ? '^'+val+'$' : '', true, false )
							.draw();
						} );

						column.data().unique().sort().each( function ( d, j ) {
							select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					} );
				}
			});

			// Add Row
			$('#add-row').DataTable({
				"pageLength": 5,
			});

			var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

			$('#addRowButton').click(function() {
				$('#add-row').dataTable().fnAddData([
					$("#addName").val(),
					$("#addPosition").val(),
					$("#addOffice").val(),
					action
					]);
				$('#addRowModal').modal('hide');

			});
		});
	</script>
</body>
</html>