/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 * 
 */

 "use strict";
 function datatables_serverside(
 	identity,
 	datatables_url,
 	datatables_data,
 	path_root = null){

 	/****************************
 	*
 	*	
 	* definisi variable
 	* 
 	*
 	*****************************/
 	var form_part = $("#modal-form-part").html(),
 	form_multiple = $("#elementer-form"),
 	modal_tambah = $("#modal-tambah"),
 	tombol_edit = ".tombol-edit", 	
 	tombol_hapus = ".tombol-hapus",
 	tombol_hapus_multiple = $('.tombol-hapus-multiple'),
 	rows_selected = [],
 	selectid = $("#table"),
 	selectinput = $("#table tbody");

 	/****************************
 	*
 	*
 	* Proses datatables
 	* show data, define button update and delete
 	*
 	*****************************/
 	var table = selectid.DataTable(
 	{ 
 		oLanguage: {
 			sProcessing: "loading..."
 		},
 		processing: true,
 		serverSide: true,
 		responsive: {
 			details: {
 				type: 'column',
 				target: 'button[name="tombol-view"]'
 			}
 		},
 		autoWidth: false,
 		ajax: {
 			"url": datatables_url,
 			"type": "POST",
 		},
 		columns: datatables_data,
 		"columnDefs": [ {
 			"targets": 'no-sort',
 			"orderable": false,
 		}],
 		/*paging: false,*/
 		order: [[1, 'asc']],
 		'lengthMenu': [[10, 100, 250, 500, 1000], [10, 100, 250, 500, 1000]],
 		'pageLength': 10,   
 		'rowCallback': function(row, data, dataIndex){
 			/* Get row ID */
 			var rowId = data['id'];

 			/* If row ID is in the list of selected row IDs */
 			if($.inArray(rowId, rows_selected) !== -1){
 				$(row).find('input[type="checkbox"]').prop('checked', true);
 				$(row).addClass('selected');
 			}
 		},
 		"initComplete": function(settings, json) {

			/****************************
		 	*
		 	*
		 	* Proses delete multiple from datatables checkbox
		 	* after datatables load > define on click tombol_hapus_multiple > confirm >  get all id from checkbox > delete by id checked
		 	*
		 	*****************************/
		 	tombol_hapus_multiple.on('click',function(e){
		 		e.preventDefault();
		 		Swal.fire({
		 			title: 'Peringatan !',
		 			text: 'Data yang terpilih akan dihapus.',
		 			icon: 'warning',
		 			showCancelButton: true,
		 			confirmButtonColor: '#fc544b',
		 			cancelButtonColor: '#6777ef',
		 			cancelButtonText: 'No',
		 			confirmButtonText: 'Yes'
		 		})
		 		.then((willDelete) => {
		 			if (willDelete.value){
		 				var form_data = [],
		 				form_url = form_multiple.attr("action");
		 				form_data.push({name: "id", value: rows_selected});
		 				form_data.push({name: "action", value: $(this).val()});		 				
		 				/* alert($.param(form_data)); */
		 				$.ajax({  
		 					url:form_url,  
		 					method:"POST",
		 					data : form_data,  
		 					success:function(data)  
		 					{ 

		 						if (data != '') {
		 							table.ajax.reload(); 
		 							table.page.len(5).draw();
		 						} else {
		 							swal("Peringatan !", "Terjadi Error saat menghapus data", "error");
		 						}

		 					}  
		 				});
		 			} 
		 		});
		 	});
		 }
		});

	/****************************
 	*
 	*
 	* Proses checkbox on click
 	* 
 	*
 	*****************************/	
 	selectinput.on('click', 'input[type="checkbox"]', function(e){

 		var $row = $(this).closest('tr'),
 		data = table.row($row).data(), 
 		/* JSON.stringify(table.row($row).data()), */
 		rowId = data['id'],
 		index = $.inArray(rowId, rows_selected);

 		if(this.checked && index === -1){
 			rows_selected.push(rowId);

 		} else if (!this.checked && index !== -1){
 			rows_selected.splice(index, 1);
 		}

 		if(this.checked){
 			$row.addClass('selected');
 		} else {
 			$row.removeClass('selected');
 		}

 		updateDataTableSelectAllCtrl(table);

 		e.stopPropagation();
 	});  

 	/* when select all clicked */
 	$('thead input[name="select_all"]', table.table().container()).on('click', function(e){
 		if(this.checked){
 			$('tbody input[type="checkbox"]:not(:checked)').trigger('click');
 		} else {
 			$('tbody input[type="checkbox"]:checked').trigger('click');
 		}

 		e.stopPropagation();
 	});

 	/* table on draw update select */ 
 	table.on('draw', function(){
 		updateDataTableSelectAllCtrl(table);
 	});


 }/* function datatables */

 function updateDataTableSelectAllCtrl(table){
 	var $table             = table.table().node();
 	var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
 	var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
 	var chkbox_select_all  = $('input[name="select_all2"], input[name="select_all"]', $table).get(0);

 	if($chkbox_checked.length === 0){
 		/* If none of the checkboxes are checked */
 		chkbox_select_all.checked = false;
 		$(".btn-opsi").prop('disabled',true);               
 		if('indeterminate' in chkbox_select_all){
 			chkbox_select_all.indeterminate = false;
 		}

 	}else if ($chkbox_checked.length === $chkbox_all.length){
 		/* If all of the checkboxes are checked */
 		chkbox_select_all.checked = true;
 		$(".btn-opsi").prop('disabled',true);
 		if('indeterminate' in chkbox_select_all){
 			chkbox_select_all.indeterminate = false;
 			$(".btn-opsi").prop('disabled',false);               
 		}
 	}else {
 		/* If some of the checkboxes are checked */
 		chkbox_select_all.checked = true;
 		$(".btn-opsi").prop('disabled',true);         
 		if('indeterminate' in chkbox_select_all){
 			chkbox_select_all.indeterminate = true;
 			$(".btn-opsi").prop('disabled',false);                  
 		}
 	}
 }
