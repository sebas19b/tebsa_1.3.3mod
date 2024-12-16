function login(){
    $.ajax({
           type:"POST",
           url:"ingresar.php",
           dataType:"HTML",
           data:{
       	        user: $('#txtuser').val(),
       	        pass: $("#txtpass").val()
            },
             beforeSend: function(){
                 $("#mensj").html("cargando...");
                  },

             success:function(datos){
                     $('#mensj').html(datos)
             },
          error: function ( jqXHR, textStatus, errorThrown ){
                  alert (errorThrown);
             }

    })

}
function buscar(){
  $.ajax({
      type:'POST',
      url:'bus.php',
      dataType:'HTML',
      data:{
                  produc: $("#Buproduct").val()
                     },
                beforeSend: function(){
                    $("#resultado").html('<center><img width="10%" src="cargando.gif"></center>');
                          },
                success:function(datos){
                    $("#resultado").html(datos);
                          }
             })

}
function cerrar() {
  $.ajax({
         type:"POST",
         url:"cerrar_s.php",
         dataType:"HTML",
         data:{

            },
           beforeSend: function(){
              $("#cer").hmtl();
                },

           success:function(datos){
              $("#cer").html(datos);
           }
      })
}

   function mostrar() {
     document.getElementById('cuadrodebusqueda').style.display = 'block';
      document.getElementById('listaarchivos').style.display = 'none';
   }
   function ocultar() {
     document.getElementById('listaarchivos').style.display = 'block';
      document.getElementById('cuadrodebusqueda').style.display = 'none';
   }
  function mostrarbus() {
    var caja = document.getElementsById('cuadrodebusqueda');

      if (caja.style.display == 'none') {
        mostrar();
      } else {
        ocultar();
      }
  }
  function mosarc() {
     document.getElementById('uparc').style.display='block';
     document.getElementById('agus').style.display='none';
  }
  function mosusu() {
    document.getElementById('agus').style.display='block';
    document.getElementById('uparc').style.display='none';
  }


  function validar() {

      var co =0;

     var nu,v = true;
  if(v==true){
    re=/^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
      if (!re.test($('#userlog').val().trim())) {
        alert("Llene Todos los Campos");
        $('#userlog').val('');
        $('#userlog').focus();
        nu=false;
      } else {
        nu=true;
        co=co+1;
      }
    }
      var ap;
       if(nu==true){
            if ($('#apass').val().length<1) {
              window.alert("Ingrese una Contraseña");
              ap=false;
            } else {
              ap=true;
              co=co+1;
            }


            var cp
            if(ap==true){
              if ($('#cpass').val().length<1) {
                window.alert("Complete");

                cp=false;
              } else {
                cp=true;
                co=co+1;
              }
            }
            if(cp==true){
                if ($('#apass').val()==$('#cpass').val()) {
                    window.alert("Usuario Creado");
                    co=co+1;
                }else{
                  window.alert("No Coinciden las Contraseña");
                }
            }
          }

        if (co!=4) {
        }else{

      $.ajax({
                type:'POST',
                url:'reg.php',
                dataType:'HTML',
                  data:{
                            nu:$('#userlog').val(),
                            ap:$('#apass').val(),
                            cp:$('#cpass').val()
                       },
                       beforeSend: function () {
                         $("#resregi").html("Guardando");
                              },
                        success:function(datos) {
                          $("#resregi").html(datos);
                        }

              });
          }
  }



