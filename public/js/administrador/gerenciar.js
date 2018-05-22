 jQuery(function ($) {

   var table = $('#campanhas').DataTable();
   $('#campanhas tbody').on( 'click','tr' ,function () {

    var linhaSelecionada= table.row(this).index();
    var data = table.rows(linhaSelecionada).data();
    
    $("#modals").detach().appendTo('body');
    var infoCampanha=data[0];
    var nome=infoCampanha[0];
    var idCampanha= infoCampanha[6];
    var Tmudas=infoCampanha[8];

    var mudas=Tmudas.split(";");

    var option="";
    var select= $('select');

    select.html('');
    
    for(var i=0;i<mudas.length-1;i++){
      var dadosTipoMuda=mudas[i].split('-');
      option="<option value='"+dadosTipoMuda[0]+"'>" +dadosTipoMuda[1]+"-"+dadosTipoMuda[2]+ "</option>";
      
      select.append(option);
    }

    $("input[name='idCampanhaLiberar']").val(idCampanha);
    $("input[name='idCampanhaCancelar']").val(idCampanha);

  } );

   $('select').change(function(){
    var idTipoMuda=$("option:selected", this).val();
    $("input[name='idTipoMuda']").val(idTipoMuda);
  });
  

 });