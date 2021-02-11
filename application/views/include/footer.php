

	</div> <!-- row -->
</div> <!-- Container Fluid -->

<div class="container-fluid p-0 mt-5">
	<div class="d-block bg-dark" style="height: 25px;padding: 20px;color: #fff;">
		<h6 class="text-right" style="font-size: 12px; margin-bottom: 0px;">Copyright © 2020. All right reserved.</h6>
	</div>
</div>

<!-- JS Bootstrap -->
<script src="<?= base_url('assets/js/popper.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/select2.min.js') ?>"></script>
<script src="<?= base_url('assets/js/moment.min.js') ?>"></script>
<script src="<?= base_url('assets/js/daterangepicker.js') ?>"></script>

<!-- Datatables -->
<script src="<?= base_url('assets/datatables/datatables.min.js') ?>"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('.js-example-basic-multiple').select2();

		var select = $('.js-example-basic-multiple');

		select.on("select2:unselect", function(e) {
			var id 			= e.params.data.id;
			var ss	 		= e.params.data;
			
			$.ajax({
                data: {id : id},
                type: "POST",
                url: "<?= base_url('pegawai/update_pegawai_workgroup')?>",
                cache: false,
                success: function(response) {
                	ss.disabled = false;
                }
            });
		});

		function getnew_pegawai(){
			$.ajax({
				url : "<?= base_url('pegawai/get_pagawai_noWorkgroup/'); ?>",
				method : "POST",
				dataType: "json",
				async : true,
				success: function(data){
					var newOption = new Option(data.nama, data.id, false, false);
					select.append(newOption).trigger('change');
				},
				error: function(data) {
					console.log(data);
				}
			});
		}
	});
	
	$('.alert').fadeIn(400).delay(3000).fadeOut(400);

	$(document).ready(function() {
		$('#list-table').DataTable({
			"oLanguage": {
				"sEmptyTable": "Tidak Ada Data !"
			}
		});
		$('#list-masuk').DataTable({
			"oLanguage": {
				"sEmptyTable": "Tidak Ada Data !"
			},
			"scrollX": true
		});
		$('#list-keluar').DataTable({
			"oLanguage": {
				"sEmptyTable": "Tidak Ada Data !"
			}
		});

		$('#datepicker').daterangepicker({
			locale: {
				format: 'YYYY/MM/DD'
			},
			"autoApply": true,
			"maxSpan": {
				"days": 7
			},
        });
	});
</script>

</body>
</html>