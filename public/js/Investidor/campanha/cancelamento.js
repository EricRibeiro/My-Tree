 window.onload = function () {
 	
 	
 	var table = $('#locais').DataTable();
 	$('#locais tbody').on( 'click', 'tr', function () {
 		var linhaSelecionada= table.row(this).index();
 		var data = table.rows(linhaSelecionada).data();
 		$("#modals").detach().appendTo('body');
 		var motivoCancelamento=$("#motivoCancelamento").val();

 		$('#corpoCancelamento').html(motivoCancelamento);

 	});


 	
 	

 };



 





 