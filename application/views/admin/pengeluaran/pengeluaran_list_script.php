<script src="assets/js/bootstrap-datepicker.min.js"></script>
<script src="assets/js/jquery.jqGrid.min.js"></script>
<script src="assets/js/grid.locale-en.js"></script>
<script src="assets/js/jquery.colorbox.min.js"></script>

<!-- inline scripts related to pengeluaran page -->
<script type="text/javascript">
	var selecttedRowId = 0;
	var grid_data = 
	[ 
		<?php foreach($pengeluaran_data as $pengeluaran){ ?>
		{
			id:"<?php echo($pengeluaran->idpengeluaran) ?>",
			idakun:"<?php echo($pengeluaran->idakun) ?>",
			nama:"<?php echo($pengeluaran->nama) ?>",
			pengeluaran:"<?php echo number_format($pengeluaran->pengeluaran) ?>",
			deskripsi:"<?php echo($pengeluaran->deskripsi) ?>",
			tgl:"<?php echo($pengeluaran->tgl) ?>"
		},
		<?php } ?>
	];

	var subgrid_data = 
	[
	];

	jQuery(function($) {
		var grid_selector = "#grid-table";
		var pager_selector = "#grid-pager";

		var parent_column = $(grid_selector).closest('[class*="col-"]');
		//resize to fit page size
		$(window).on('resize.jqGrid', function () {
			$(grid_selector).jqGrid( 'setGridWidth', parent_column.width() );
		})

		//resize on sidebar collapse/expand
		$(document).on('settings.ace.jqGrid' , function(ev, event_name, collapsed) {
			if( event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed' ) {
				//setTimeout is for webkit only to give time for DOM changes and then redraw!!!
				setTimeout(function() {
					$(grid_selector).jqGrid( 'setGridWidth', parent_column.width() );
				}, 20);
			}
		})

		//if your grid is inside another element, for example a tab pane, you should use its parent's width:
		
		// $(window).on('resize.jqGrid', function () {
		// 	var parent_width = $(grid_selector).closest('.tab-pane').width();
		// 	$(grid_selector).jqGrid( 'setGridWidth', parent_width );
		// })
		// //and also set width when tab pane becomes visible
		// $('#myTab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		//   if($(e.target).attr('href') == '#table') {
		// 	var parent_width = $(grid_selector).closest('.tab-pane').width();
		// 	$(grid_selector).jqGrid( 'setGridWidth', parent_width );
		//   }
		// })

		jQuery(grid_selector).jqGrid({
			//direction: "rtl",

			//subgrid options
			subGrid : false,
			//subGridModel: [{ name : ['No','Item Name','Qty'], width : [55,200,80] }],
			//datatype: "xml",
			subGridOptions : {
				plusicon : "ace-icon fa fa-plus center bigger-110 blue",
				minusicon  : "ace-icon fa fa-minus center bigger-110 blue",
				openicon : "ace-icon fa fa-chevron-right center orange"
			},
			//for this example we are using local data
			subGridRowExpanded: function (subgridDivId, rowId) {
				var subgridTableId = subgridDivId + "_t";
				$("#" + subgridDivId).html("<table id='" + subgridTableId + "'></table>");
				$("#" + subgridTableId).jqGrid({
					datatype: 'local',
					data: subgrid_data,
					colNames: [],
					colModel: [
						{ }
					]
				});
			},


			data: grid_data,
			datatype: "local",
			height: 250,
			colNames:[' ', 'ID','Id Akun','Nama Akun', 'Nominal (Rp.)', 'Keterangan','Tanggal'],
			colModel:[
				{name:'myac',index:'idpengeluaran', width:80, fixed:true, sortable:false, resize:false,
					formatter:'actions', 
					formatoptions:{ 
						keys:true,
						delbutton: true,

						delOptions:{recreateForm: true, beforeShowForm:beforeDeleteCallback},
//								editformbutton:true, editOptions:{recreateForm: true, beforeShowForm:beforeEditCallback}
					}
				},
				{name:'id',index:'id', width:60, sorttype:"int", editable: false},
				{name:'idakun',index:'idakun',width:60, editable:false, sortable:true,sorttype:"int"},
				{name:'nama',index:'nama', width:150,editable:false,editoptions:{size:"25",maxlength:"35"}},
				{name:'pengeluaran',index:'pengeluaran', width:130, sorttype:"int",editable:true,edittype:"number",editoptions:{size:"25",maxlength:"35"}},
				{name:'deskripsi',index:'deskripsi', width:350,editable: true,editoptions:{size:"25",maxlength:"50"}},
				{name:'tgl',index:'tgl', width:60,editable:true,editoptions:{size:"20",maxlength:"35"}}
			], 

			viewrecords : true,
			rowNum:10,
			rowList:[10,20,30],
			pager : pager_selector,
			altRows: true,
			//toppager: true,

			multiselect: false,
			//multikey: "ctrlKey",
			multiboxonly: true,

			loadComplete : function() {
				var table = this;
				setTimeout(function(){
					styleCheckbox(table);

					updateActionIcons(table);
					updatePagerIcons(table);
					enableTooltips(table);
				}, 0);
			},

			editurl: "admin/Pengeluaran/update_action/",
			deleteurl: "admin/Pengeluaran/delete/",
			caption: "Data Pengeluaran",

//					,autowidth: true


			/**
			,
			grouping:true, 
			groupingView : { 
				 groupField : ['name'],
				 groupDataSorted : true,
				 plusicon : 'fa fa-chevron-down bigger-110',
				 minusicon : 'fa fa-chevron-up bigger-110'
			},
			caption: "Grouping"
			*/

		});
		$(window).triggerHandler('resize.jqGrid');//trigger window resize to make the grid get the correct size



		//enable search/filter toolbar
		//jQuery(grid_selector).jqGrid('filterToolbar',{defaultSearch:true,stringResult:true})
		//jQuery(grid_selector).filterToolbar({});


		//switch element when editing inline
		function aceSwitch( cellvalue, options, cell ) {
			setTimeout(function(){
				$(cell) .find('input[type=checkbox]')
					.addClass('ace ace-switch ace-switch-5')
					.after('<span class="lbl"></span>');
			}, 0);
		}
		//enable datepicker
		function pickDate( cellvalue, options, cell ) {
			setTimeout(function(){
				$(cell) .find('input[type=text]')
					.datepicker({format:'yyyy-mm-dd' , autoclose:true}); 
			}, 0);
		}


		//navButtons
		jQuery(grid_selector).jqGrid('navGrid',pager_selector,
			{ 	//navbar options
				edit: true,
				editicon : 'ace-icon fa fa-pencil blue',
				add: false,
				addicon : 'ace-icon fa fa-plus-circle purple',
				del: false,
				delicon : 'ace-icon fa fa-trash-o red',
				search: true,
				searchicon : 'ace-icon fa fa-search orange',
				refresh: true,
				refreshicon : 'ace-icon fa fa-refresh green',
				view: true,
				viewicon : 'ace-icon fa fa-search-plus grey',
			},
			{
				//edit record form
				//closeAfterEdit: true,
				//width: 700,
				recreateForm: true,
				beforeShowForm : function(e) {
					var form = $(e[0]);
					form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
					style_edit_form(form);
				}
			},
			{
				//new record form
				//width: 700,
				closeAfterAdd: true,
				recreateForm: true,
				viewPagerButtons: false,
				beforeShowForm : function(e) {
					var form = $(e[0]);
					form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar')
					.wrapInner('<div class="widget-header" />')
					style_edit_form(form);
				}
			},
			{
				//delete record form
				recreateForm: true,
				beforeShowForm : function(e) {
					var form = $(e[0]);
					if(form.data('styled')) return false;

					form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
					style_delete_form(form);

					form.data('styled', true);
				},
				onClick : function(e) {

				}
			},
			{
				//search form
				recreateForm: true,
				afterShowSearch: function(e){
					var form = $(e[0]);
					form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
					style_search_form(form);
				},
				afterRedraw: function(){
					style_search_filters($(this));
				}
				,
				multipleSearch: true,
				/**
				multipleGroup:true,
				showQuery: true
				*/
			},
			{
				//view record form
				recreateForm: true,
				beforeShowForm: function(e){
					var form = $(e[0]);
					form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
				}
			}
		)



		function style_edit_form(form) {
			//enable datepicker on "sdate" field and switches for "stock" field
			form.find('input[name=sdate]').datepicker({format:'yyyy-mm-dd' , autoclose:true})

			form.find('input[name=stock]').addClass('ace ace-switch ace-switch-5').after('<span class="lbl"></span>');
					   //don't wrap inside a label element, the checkbox value won't be submitted (POST'ed)
					  //.addClass('ace ace-switch ace-switch-5').wrap('<label class="inline" />').after('<span class="lbl"></span>');


			//update buttons classes
			var buttons = form.next().find('.EditButton .fm-button');
			buttons.addClass('btn btn-sm').find('[class*="-icon"]').hide();//ui-icon, s-icon
			buttons.eq(0).addClass('btn-primary').prepend('<i class="ace-icon fa fa-check"></i>');
			buttons.eq(1).prepend('<i class="ace-icon fa fa-times"></i>')

			buttons = form.next().find('.navButton a');
			buttons.find('.ui-icon').hide();
			buttons.eq(0).append('<i class="ace-icon fa fa-chevron-left"></i>');
			buttons.eq(1).append('<i class="ace-icon fa fa-chevron-right"></i>');		
		}

		function style_delete_form(form) {
			var buttons = form.next().find('.EditButton .fm-button');
			buttons.addClass('btn btn-sm btn-white btn-round').find('[class*="-icon"]').hide();//ui-icon, s-icon
			buttons.eq(0).addClass('btn-danger').prepend('<i class="ace-icon fa fa-trash-o"></i>');
			buttons.eq(1).addClass('btn-default').prepend('<i class="ace-icon fa fa-times"></i>')
		}

		function style_search_filters(form) {
			form.find('.delete-rule').val('X');
			form.find('.add-rule').addClass('btn btn-xs btn-primary');
			form.find('.add-group').addClass('btn btn-xs btn-success');
			form.find('.delete-group').addClass('btn btn-xs btn-danger');
		}
		function style_search_form(form) {
			var dialog = form.closest('.ui-jqdialog');
			var buttons = dialog.find('.EditTable')
			buttons.find('.EditButton a[id*="_reset"]').addClass('btn btn-sm btn-info').find('.ui-icon').attr('class', 'ace-icon fa fa-retweet');
			buttons.find('.EditButton a[id*="_query"]').addClass('btn btn-sm btn-inverse').find('.ui-icon').attr('class', 'ace-icon fa fa-comment-o');
			buttons.find('.EditButton a[id*="_search"]').addClass('btn btn-sm btn-purple').find('.ui-icon').attr('class', 'ace-icon fa fa-search');
		}

		function beforeDeleteCallback(e) {
			var form = $(e[0]);
			if(form.data('styled')) return false;

			form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />');
			style_delete_form(form);

			form.data('styled', true);
		}

		function beforeEditCallback(e) {
			var form = $(e[0]);
			form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
			style_edit_form(form);
		}



		//it causes some flicker when reloading or navigating grid
		//it may be possible to have some custom formatter to do this as the grid is being created to prevent this
		//or go back to default browser checkbox styles for the grid
		function styleCheckbox(table) {
		/**
			$(table).find('input:checkbox').addClass('ace')
			.wrap('<label />')
			.after('<span class="lbl align-top" />')


			$('.ui-jqgrid-labels th[id*="_cb"]:first-child')
			.find('input.cbox[type=checkbox]').addClass('ace')
			.wrap('<label />').after('<span class="lbl align-top" />');
		*/
		}


		//unlike navButtons icons, action icons in rows seem to be hard-coded
		//you can change them like this in here if you want
		function updateActionIcons(table) {
			/**
//			var replacement = 
//			{
//				'ui-ace-icon fa fa-pencil' : 'ace-icon fa fa-pencil blue',
//				'ui-ace-icon fa fa-trash-o' : 'ace-icon fa fa-trash-o red',
//				'ui-icon-disk' : 'ace-icon fa fa-check green',
//				'ui-icon-cancel' : 'ace-icon fa fa-times red'
//			};
//			$(table).find('.ui-pg-div span.ui-icon').each(function(){
//				var icon = $(this);
//				var $class = $.trim(icon.attr('class').replace('ui-icon', ''));
//				if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
//			})
			*/
		}

		//replace icons with FontAwesome icons like above
		function updatePagerIcons(table) {
			var replacement = 
			{
				'ui-icon-seek-first' : 'ace-icon fa fa-angle-double-left bigger-140',
				'ui-icon-seek-prev' : 'ace-icon fa fa-angle-left bigger-140',
				'ui-icon-seek-next' : 'ace-icon fa fa-angle-right bigger-140',
				'ui-icon-seek-end' : 'ace-icon fa fa-angle-double-right bigger-140'
			};
			$('.ui-pg-table:not(.navtable) > tbody > tr > .ui-pg-button > .ui-icon').each(function(){
				var icon = $(this);
				var $class = $.trim(icon.attr('class').replace('ui-icon', ''));

				if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
			})
		}

		function enableTooltips(table) {
			$('.navtable .ui-pg-button').tooltip({container:'body'});
			$(table).find('.ui-pg-div').tooltip({container:'body'});
		}

		//var selr = jQuery(grid_selector).jqGrid('getGridParam','selrow');

		$(document).one('ajaxloadstart.page', function(e) {
			$.jgrid.gridDestroy(grid_selector);
			$('.ui-jqdialog').remove();
		});
		
		$(".ui-paging-pager").find("td.ui-pg-button.ui-corner-all").each(function(){
			$(this).on("click", function(){
				deletebuttonaction();
			})
		});
		
		var $overflow = '';
		var colorbox_params = {
			rel: 'colorbox',
			reposition:true,
			scalePhotos:true,
			scrolling:false,
			previous:'<i class="ace-icon fa fa-arrow-left"></i>',
			next:'<i class="ace-icon fa fa-arrow-right"></i>',
			close:'&times;',
			current:'{current} of {total}',
			maxWidth:'100%',
			maxHeight:'100%',
			onOpen:function(){
				$overflow = document.body.style.overflow;
				document.body.style.overflow = 'hidden';
			},
			onClosed:function(){
				document.body.style.overflow = $overflow;
			},
			onComplete:function(){
				$.colorbox.resize();
			}
		};

		$('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
		$("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange fa-spin'></i>");//let's add a custom loading icon
		
		$(".ace-thumbnails.clearfix").on("click","#grid-edit",function(){
			var ids = $(this).closest(".tools.tools-top").attr("data-id");
			$.ajax({
				type:"POST",
				url:"Kendaraan/set_update",
			data:{
				id:ids,
				idakun:"<?php echo $this->session->userdata("idakun") ?>"
			},
				success: function(e){
					window.location="admin/Pengeluaran/update/" + e;
				}
			});
			return false;
		});
		
		//tooltips
		$(".tooltips-slide-down").tooltip({
			show: {
				effect: "slideDown",
				delay: 250
			}
		});
		
		//dropdown button
		$("#form-submit").on("click",function(){
			var desk = $("input[name=deskripsi]").val();
			var pengel = $("input[name=pengeluaran]").val();
			var tanggal = "<?php echo date('d-m-Y') ?>";
			var ida = "<?php echo $this->session->userdata('idakun') ?>";
			$(this).button('loading');

			$.ajax({
				type:"POST",
				url:"admin/Pengeluaran/create_action",
			data:{
				pengeluaran:pengel,
				deskripsi:desk,
				tgl:tanggal,
				idakun:ida,
			},
				success: function(e){
					window.location="admin/Pengeluaran";
				}
			});
		});
		
		//dropdown button
		$(".btn-group.btn-corner").find("button.btn").on("click",function(){
			var target = $(this).attr("dropdown-toggle");
			$(this).closest(".btn-group.btn-corner").find(".dropdown-menu").addClass("hide")
			$(this).closest(".btn-group.btn-corner").find("#"+target).removeClass("hide")
		});
	});
</script>