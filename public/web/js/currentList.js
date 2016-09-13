$(document).ready(function(){
	$('#modalOpen').click(function(){	  
		loadModal(0);
	});

	});

	function loadModal(id){
		$('.modal-body').load('../editar/' + id,function(result){
		    $('#confirm-submit').modal({show:true});
		});
	}

	function redirect(id){
		var url = '../eliminar/' + id;
		location.href = url;
	}