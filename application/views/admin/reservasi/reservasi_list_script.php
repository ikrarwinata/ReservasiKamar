<script src="assets/js/jquery-ui.min.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="assets/js/dataTables.buttons.min.js"></script>
<script src="assets/js/buttons.flash.min.js"></script>
<script src="assets/js/buttons.html5.min.js"></script>
<script src="assets/js/buttons.print.min.js"></script>
<script src="assets/js/buttons.colVis.min.js"></script>
<script src="assets/js/dataTables.select.min.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
	jQuery(function($) {
		var index = 0; //primary key index number
		<?php if($gototab!=NULL){ ?>
		$('#myTab').find('#tab<?php echo $gototab ?>').trigger('click');
		<?php } ?>
		//And for the first simple table, which doesn't have TableTools or dataTables
		//select/deselect all rows according to table header checkbox
		var active_class = 'active';
		$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
			var th_checked = this.checked;//checkbox inside "TH" table header

			$(this).closest('table').find('tbody > tr').each(function(){
				var row = this;
				if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
				else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
			});
		});

		//select/deselect a row when the checkbox is checked/unchecked
		$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
			var $row = $(this).closest('tr');
			if($row.is('.detail-row ')) return;
			if(this.checked) $row.addClass(active_class);
			else $row.removeClass(active_class);
		});



		/********************************/
		//add tooltip for small view action buttons in dropdown menu
		$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});

		//tooltip placement on right or left
		function tooltip_placement(context, source) {
			var $source = $(source);
			var $parent = $source.closest('table')
			var off1 = $parent.offset();
			var w1 = $parent.width();

			var off2 = $source.offset();
			//var w2 = $source.width();

			if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
			return 'left';
		}




		/***************/
		$('.show-details-btn').on('click', function(e) {
			e.preventDefault();
			$(this).closest('tr').next().toggleClass('open');
			$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
		});
		/***************/

		//tooltips
		$(".tooltips-slide-down").tooltip({
			show: {
				effect: "slideDown",
				delay: 250
			}
		});
		
		//dropdown button
		$(".btn-group.btn-corner").find("button.btn").on("click",function(){
			var target = $(this).attr("dropdown-toggle");
			$(this).closest(".btn-group.btn-corner").find(".dropdown-menu").addClass("hide")
			$(this).closest(".btn-group.btn-corner").find("#"+target).removeClass("hide")
		});

		//Reject button onclick
		$('#simple-table').on('dblclick', 'button.btn.btn-xs.btn-danger' , function(){
			var row = $(this).closest('tr');
			var name = row.find("td").eq(2).find("a").text().trim();
			
			var ids = row.find("td").eq(index).find("label.data-id").text().trim();
			$.ajax({
				type:"POST",
				url:"admin/Reservasi/reject/0",
				data:{id:ids,
					idakun:"<?php echo $this->session->userdata('idakun') ?>",
					nama:name
				},
				success: function(e){
					if(e.toString()=="success"){
						row.next().remove();
						row.remove();
					}else{
						alert("Gagal menolak reservasi : " + e.toString())
					}
				}
			});
		});
		$('#simple-table2').on('dblclick', 'button.btn.btn-xs.btn-danger' , function(){
			var row = $(this).closest('tr');
			var name = row.find("td").eq(2).find("a").text().trim();
			
			var ids = row.find("td").eq(index).find("label.data-id").text().trim();
			$.ajax({
				type:"POST",
				url:"admin/Reservasi/reject/0",
				data:{id:ids,
					idakun:"<?php echo $this->session->userdata('idakun') ?>",
					nama:name
				},
				success: function(e){
					if(e.toString()=="success"){
						row.next().remove();
						row.remove();
					}else{
						alert("Gagal menolak reservasi : " + e.toString())
					}
				}
			});
		});
		$('#simple-table3').on('dblclick', 'button.btn.btn-xs.btn-danger' , function(){
			var row = $(this).closest('tr');
			var name = row.find("td").eq(2).find("a").text().trim();
			
			var ids = row.find("td").eq(index).find("label.data-id").text().trim();
			$.ajax({
				type:"POST",
				url:"admin/Reservasi/reject/0",
				data:{id:ids,
					idakun:"<?php echo $this->session->userdata('idakun') ?>",
					nama:name
				},
				success: function(e){
					if(e.toString()=="success"){
						row.next().remove();
						row.remove();
					}else{
						alert("Gagal menolak reservasi : " + e.toString())
					}
				}
			});
		});
		$('#simple-table4').on('dblclick', 'button.btn.btn-xs.btn-danger' , function(){
			var row = $(this).closest('tr');
			var name = row.find("td").eq(2).find("a").text().trim();
			
			var ids = row.find("td").eq(index).find("label.data-id").text().trim();
			$.ajax({
				type:"POST",
				url:"admin/Reservasi/reject/0",
				data:{id:ids,
					idakun:"<?php echo $this->session->userdata('idakun') ?>",
					nama:name
				},
				success: function(e){
					if(e.toString()=="success"){
						row.next().remove();
						row.remove();
					}else{
						alert("Gagal menolak reservasi : " + e.toString())
					}
				}
			});
		});
		
		var thisrow = null;
		//RejectMessage password on click
		$('#simple-table').on('click', 'a.btn.btn-xs.btn-warning' , function(){
			var row = $(this).closest('tr');
			thisrow = row;
			var ids = row.find("td").eq(index).find("label.data-id").text().trim();
			var nama = row.find("td").eq(2).find("a").text().trim();
			$("#modal-form").find("input[name=idpelanggan]").val(ids);
			$(".modal-header").find("h4").text("Tolak Reservasi "+nama);
		});
		$('#simple-table2').on('click', 'a.btn.btn-xs.btn-warning' , function(){
			var row = $(this).closest('tr');
			thisrow = row;
			var ids = row.find("td").eq(index).find("label.data-id").text().trim();
			var nama = row.find("td").eq(2).find("a").text().trim();
			$("#modal-form").find("input[name=idpelanggan]").val(ids);
			$(".modal-header").find("h4").text("Tolak Reservasi "+nama);
		});
		$('#simple-table3').on('click', 'a.btn.btn-xs.btn-warning' , function(){
			var row = $(this).closest('tr');
			thisrow = row;
			var ids = row.find("td").eq(index).find("label.data-id").text().trim();
			var nama = row.find("td").eq(2).find("a").text().trim();
			$("#modal-form").find("input[name=idpelanggan]").val(ids);
			$(".modal-header").find("h4").text("Tolak Reservasi "+nama);
		});
		$('#simple-table4').on('click', 'a.btn.btn-xs.btn-warning' , function(){
			var row = $(this).closest('tr');
			thisrow = row;
			var ids = row.find("td").eq(index).find("label.data-id").text().trim();
			var nama = row.find("td").eq(2).find("a").text().trim();
			$("#modal-form").find("input[name=idpelanggan]").val(ids);
			$(".modal-header").find("h4").text("Tolak Reservasi "+nama);
		});

		//Save messages on click
		$('#modal-form').find(".modal-footer").on('click', 'button.btn.btn-sm.btn-primary' , function(e){
			var ids = $("#modal-form").find("input[name=idpelanggan]").val();
			var ms = $("#modal-form").find("input[name=messages]").val();
			var name = thisrow.find("td").eq(2).find("a").text().trim()
			
			$.ajax({
				type:"POST",
				url:"admin/Reservasi/reject/1",
				data:{id:ids,
					idakun:"<?php echo $this->session->userdata('idakun') ?>",
					idpetugas:"<?php echo $this->session->userdata('id') ?>",
					nama:name,
					messages:ms
				},
				success: function(e){
					if(e.toString()=="success"){
						$("#modal-form").find("input[name=messages]").val("");
						thisrow.next().remove();
						thisrow.remove();
					}else{
						alert("Gagal konfirmasi reservasi : " + e.toString())
					}
				}
			});
		});

		//Confirm button onclick
		$('#simple-table').on('click', 'button.btn.btn-xs.btn-info' , function(){
			var row = $(this).closest('tr');
			var name = row.find("td").eq(2).find("a").text().trim();
			
			var ids = row.find("td").eq(index).find("label.data-id").text().trim();
			$.ajax({
				type:"POST",
				url:"admin/Reservasi/confirm",
				data:{id:ids,
					idakun:"<?php echo $this->session->userdata('idakun') ?>",
					idpetugas:"<?php echo $this->session->userdata('id') ?>",
					nama:name
				},
				success: function(e){
					if(e.toString()=="success"){
						row.next().remove();
						row.remove();
					}else{
						alert("Gagal konfirmasi reservasi : " + e.toString())
					}
				},
			});
		});
		$('#simple-table2').on('click', 'button.btn.btn-xs.btn-info' , function(){
			var row = $(this).closest('tr');
			var name = row.find("td").eq(2).find("a").text().trim();
			
			var ids = row.find("td").eq(index).find("label.data-id").text().trim();
			$.ajax({
				type:"POST",
				url:"admin/Reservasi/confirm",
				data:{id:ids,
					idakun:"<?php echo $this->session->userdata('idakun') ?>",
					idpetugas:"<?php echo $this->session->userdata('id') ?>",
					nama:name
				},
				success: function(e){
					if(e.toString()=="success"){
						row.next().remove();
						row.remove();
					}else{
						alert("Gagal konfirmasi reservasi : " + e.toString())
					}
				},
			});
		});
		$('#simple-table3').on('click', 'button.btn.btn-xs.btn-success' , function(){
			var row = $(this).closest('tr');
			var name = row.find("td").eq(2).find("a").text().trim();
			
			var ids = row.find("td").eq(index).find("label.data-id").text().trim();
			$.ajax({
				type:"POST",
				url:"admin/Reservasi/set_room",
				data:{id:ids,
					idakun:"<?php echo $this->session->userdata('idakun') ?>",
					idpetugas:"<?php echo $this->session->userdata('id') ?>",
					nama:name
				},
				success: function(e){
					if(e.toString()=="success"){
						row.next().remove();
						row.remove();
					}else{
						alert("Gagal konfirmasi reservasi : " + e.toString())
					}
				},
			});
		});
		$('#simple-table4').on('click', 'button.btn.btn-xs.btn-info' , function(){
			var row = $(this).closest('tr');
			var name = row.find("td").eq(2).find("a").text().trim();
			
			var ids = row.find("td").eq(index).find("label.data-id").text().trim();
			$.ajax({
				type:"POST",
				url:"admin/Reservasi/confirm",
				data:{id:ids,
					idakun:"<?php echo $this->session->userdata('idakun') ?>",
					idpetugas:"<?php echo $this->session->userdata('id') ?>",
					nama:name
				},
				success: function(e){
					if(e.toString()=="success"){
						row.next().remove();
						row.remove();
					}else{
						alert("Gagal konfirmasi reservasi : " + e.toString())
					}
				},
			});
		});

		/**
		//add horizontal scrollbars to a simple table
		$('#simple-table').css({'width':'100%', 'max-width': 'none'}).wrap('<div style="width: 100%;" />').parent().ace_scroll(
		  {
			horizontal: true,
			styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
			size: 2000,
			mouseWheelLock: true
		  }
		).css('padding-top', '12px');
		*/


		/////////
		$('#modal-form input[type=file]').ace_file_input({
			style:'well',
			btn_choose:'Drop files here or click to choose',
			btn_change:null,
			no_icon:'ace-icon fa fa-cloud-upload',
			droppable:true,
			thumbnail:'large'
		})
		
		//chosen plugin inside a modal will have a zero width because the select element is originally hidden
		//and its width cannot be determined.
		//so we set the width after modal is show
		$('#modal-form').on('shown.bs.modal', function () {
			if(!ace.vars['touch']) {
				$(this).find('.chosen-container').each(function(){
					$(this).find('a:first-child').css('width' , '210px');
					$(this).find('.chosen-drop').css('width' , '210px');
					$(this).find('.chosen-search input').css('width' , '200px');
				});
			}
		})
		/**
		//or you can activate the chosen plugin after modal is shown
		//this way select element becomes visible with dimensions and chosen works as expected
		$('#modal-form').on('shown', function () {
			$(this).find('.modal-chosen').chosen();
		})
		*/
	})
</script>