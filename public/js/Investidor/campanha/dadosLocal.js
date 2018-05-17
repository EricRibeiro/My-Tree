
 jQuery(function ($) {

 var table = $('#locais').DataTable();
 $('#locais tbody').on( 'click', 'tr', function () {
   $("#modals").detach().appendTo('body');
   var linhaSelecionada= table.row(this).index();
   var data = table.rows(linhaSelecionada).data();
   
   $("#modals").detach().appendTo('body');
   
   var infoLocal=data[0];
   var idLocal=infoLocal[1];
   var cidade=infoLocal[2];
   var uf=infoLocal[3];
   var bairro=infoLocal[4];

   var cep= infoLocal[5];
   var complemento= infoLocal[7];
   var logradouro=infoLocal[8];
   var telConcedente=infoLocal[9];
   var emailConcedente=infoLocal[10];
   var nomeConcedente=infoLocal[11];
   var espacoLocal=infoLocal[12];

   var cadastro="Cidade: ";
   cadastro+=cidade+"<br>";
   cadastro+= "Estado: "
   cadastro+=uf+"<br>";
   cadastro+="Cep: ";
   cadastro+=cep+"<br>";
   cadastro+="Bairro: ";
   cadastro+=bairro+"<br>";
   cadastro+="Logradouro: ";
   cadastro+=logradouro+"<br>";
   cadastro+="Complemento: ";
   cadastro+=complemento+"<br>";
   cadastro+="<h4 class='modal-title' align='center'>Concedente</h4>";
   cadastro+="<hr>";
   cadastro+="Nome: ";
   cadastro+=nomeConcedente+"<br>";
   cadastro+="Telefone: ";
   cadastro+=telConcedente+"<br>";
   cadastro+="Email: ";
   cadastro+=emailConcedente+"<br>";
   cadastro+="Espaco: ";
   cadastro+=espacoLocal+"<br>";

   $('#corpo').html(cadastro);
 } );
});