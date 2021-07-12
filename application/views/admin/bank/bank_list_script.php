<script src="assets/js/jquery-ui.min.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="assets/js/dataTables.buttons.min.js"></script>
<script src="assets/js/buttons.flash.min.js"></script>
<script src="assets/js/buttons.html5.min.js"></script>
<script src="assets/js/buttons.print.min.js"></script>
<script src="assets/js/buttons.colVis.min.js"></script>
<script src="assets/js/dataTables.select.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/js/bootstrap-datepicker.min.js"></script>
<script src="assets/js/bootstrap-timepicker.min.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
	jQuery(function($) {
		var index = 0; //primary key index number

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

		//Delete button onclick
		$('#simple-table').on('dblclick', 'button.btn.btn-xs.btn-danger' , function(){
			var row = $(this).closest('tr');
			
			var ids = row.find("td").eq(index).find("label.data-id").text().trim();
			$.ajax({
				type:"POST",
				url:"admin/Bank/delete",
				data:{id:ids,
					idakun:"<?php echo $this->session->userdata('idakun') ?>"
				},
				success: function(e){
					row.next(".detail-row").toggleClass('open').remove();
					row.remove();
					return false;
				}
			});
		});

		//Edit button onclick
		$('#simple-table').on('click', 'button.btn.btn-xs.btn-info' , function(){
			var row = $(this).closest('tr');
			
			var ids = row.find("td").eq(index).find("label.data-id").text().trim();
			$.ajax({
				type:"POST",
				url:"admin/Bank/set_update",
				data:{id:ids,
					idakun:"<?php echo $this->session->userdata('idakun') ?>"
				},
				success: function(e){
					window.location="admin/Bank/update/" + e;
				}
			});
		});

		//datepicker plugin
		//link
		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		})
		//show datepicker when clicking on the icon
		.next().on(ace.click_event, function(){
			$(this).prev().focus();
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


	})
</script>