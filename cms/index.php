<?php
      session_start();          
      if (!isset($_SESSION['token']) || !isset($_COOKIE['token'])) {  exit(header("Location: ../login/"));     }
      $user = $_SESSION['ux'];       
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="icon" href="assets/images/favicon.ico" type="image/ico" />

    <title>Gestiene su negocio: ventas, compras, inventario, Contabilidad PLE</title>

    <!-- Bootstrap -->
    <link href="assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/DataTables/datatables.min.css" rel="stylesheet">
    <link href="assets/select2/select2.min.css" rel="stylesheet">
    
   
    <!-- Custom Theme Style -->
    <link href="assets/build/css/custom.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="assets/switchery/dist/switchery.min.css" rel="stylesheet">

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title">
                <img src="" alt=""> 
                <span>CONTABLE</span>
              </a>
            </div>
            <!-- <div class="clearfix"></div> -->
            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="assets/images/<?php echo $user[7];?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenido </span>
                <h2><?php echo $user[2]; ?> </h2>
              </div>
              <div class="infocontact">
                <h2 class="text-center"><small class="text-white"><?php echo $user[3]; ?></small></h2>
                <h2 class="text-center"><small class="text-white"><?php echo $user[5]; ?></small></h2>
              </div>
            </div>

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Inicio <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a>Dashboard</a></li>
                    </ul>
                  </li>
                  <li>
                    <a><i class="fa fa-desktop"></i> Facturación <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                      <li><a onclick="callresource('views/sales/viewsavesales.php')">Registrar Venta</a></li>
                      <li><a onclick="callresource('views/sales/viewlistsales.php')">Lista de Ventas</a></li>
                      <li><a>Reportes</a></li>
                      <li><a>Devoluciones</a></li>                
                    </ul>
                  </li>

                  <li><a><i class="fa fa-edit"></i> Artículos <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a onclick="callresource('views/article/viewarticle.php')">Lista de Articulos</a></li>
                      <li><a onclick="callresource('views/article/viewarticle.php')">Reporte de Articulos</a></li>                      
                    </ul>
                  </li>

                  <li><a><i class="fa fa-clone"></i>Compras <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a onclick="callresource('views/purchase/viewpurchaseregister.php')">Registrar Compras</a></li>
                      <li><a onclick="callresource('views/purchase/viewlistpurchase.php')">Lista de compras</a></li>
                      <!--<li><a onclick="callresource('views/purchase/viewpurchase.php')">Reporte de compras</a></li> -->
                    </ul>
                  </li>
                  
                  <li><a><i class="fa fa-clone"></i>Clientes <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a onclick="callresource('views/customer/viewcustomer.php')">Lista de CLientes</a></li>
                      <li><a onclick="callresource('views/customer/viewcustomer.php')">Reporte de Clientes</a></li>
                    </ul>
                  </li>


                  <li><a><i class="fa fa-clone"></i>Proveedores <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a onclick="callresource('views/supplier/viewsupplier.php')">Lista de Proveedores</a></li>
                      <li><a onclick="callresource('views/supplier/viewsupplier.php')">Reporte de Proveedores</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-clone"></i>Usuarios <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a onclick="callresource('views/worker/viewworker.php')">Lista de Usuarios</a></li>
                      <li><a onclick="callresource('views/worker/viewgraficworker.php')">Reporte de Usuarios</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-clone"></i>Kardex <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a onclick="callresource('views/kardex/viewstokpoduct.php')">Stock por producto</a></li>
                      <li><a onclick="callresource('views/kardex/viewskarde.php')">Administrar Kardex</a></li>
                      <li><a onclick="callresource('views/kardex/viewskarde.php')">Cierre y Apertura de kardex</a></li>
                    </ul>
                  </li>

                </ul>
              </div>
              <div class="menu_section">
                <h3>Configuracion de Sistema</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bug"></i> Configuracion <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a onclick="callresource('views/business/viewbusiness.php')">Mi Empresa</a></li>
                      <li><a href="#">Projects</a></li>
                    </ul>
                  </li>
                </ul>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bug"></i> Soporte <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#">E-commerce</a></li>
                      <li><a href="#">Projects</a></li>
                    </ul>
                  </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="../logout/" style="color:red;">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <img src="assets/images/<?php echo $user[7]; ?>" alt=""><?php echo $user[2]; ?>
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" onclick="callresource('views/worker/viewperfilWorker.php')">
                      <span class="badge bg-red pull-right"><i class="glyphicon glyphicon-user"></i></span>
                      <span>Perfil</span>
                    </a>
                    <a class="dropdown-item">
                      <span class="badge bg-red pull-right">50%</span>
                      <span>Configurar</span>
                    </a>
                  <a class="dropdown-item"  href="javascript:;">Ayuda</a>
                    <a class="dropdown-item"  href="../logout/"><i class="fa fa-sign-out pull-right"></i> Salir del Sistema</a>
                  </div>
                </li>

                <li role="presentation" class="nav-item dropdown open">
                  <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="assets/images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                   
                   
                   
                    <li class="nav-item">
                      <div class="text-center">
                        <a class="dropdown-item">
                          <strong>Ver todo los Mensajes</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->



        <div class="right_col" role="main" id="pagecontent">
            <script src="assets/vue@2.6.14.js"></script>
            <script src="assets/axios.js"></script>
            <!-- Show all tables of databases -->
            <div style="margin-top: 50px;"></div>

            <!-- div para renderizar el contenido de las paginas -->
            <div id="secctiontable"></div>
          
        </div>
        <!-- /page content -->


        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Derechos y reservados:  <a> Tu sistema a la medida</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    
    <!-- jQuery -->
    <script src="assets/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Databales -->
    <script src="assets/DataTables/datatables.min.js"></script>
    <script src="assets/DataTables/buttons.html5.styles.min.js"></script>
    <script src="assets/DataTables/buttons.html5.styles.templates.min.js"></script>

    <!-- select for combo -->
    <script src="assets/select2/select2.min.js"></script>
    
    <!-- swel alert2 -->
    <script src="assets/sweetalert2/sweetalert2.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="assets/build/js/custom.js"></script>

    <script type="text/javascript">
      var idioma_espanol = {
      select: {
      rows: "%d fila seleccionada"
      },
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":    '<div class="alert alert-danger" role="alert"> <strong>No hay registros</strong></div>',
      "sInfo":           "Registros del (_START_ al _END_) total de _TOTAL_ registros",
      "sInfoEmpty":      "Registros del (0 al 0) total de 0 registros",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "<b>No se encontraron datos</b>",
      "oPaginate": {
          "sFirst":    "Primero",
          "sLast":     "Último",
          "sNext":     "Siguiente",
          "sPrevious": "Anterior"
      },
      "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
   }

      function callresource(viewpage){
        const stable = "secctiontable";
        const content = viewpage;        
        $("#"+stable).load(content);

      }
      if('<?php echo $user[5];?>'=='admin'){
        $("#secctiontable").load("views/home/viewhome.php");
      }
      if('<?php echo $user[5];?>'=='worker'){
        $("#secctiontable").load("views/sales/viewsavesales.php");
      }



      //verificamos cookie
      //get cookie
        function getCookie(cname) {
          var name = cname + "=";
          var ca = document.cookie.split(';');
          for(var i = 0; i <ca.length; i++) {
              var c = ca[i];
              while (c.charAt(0)==' ') {
                  c = c.substring(1);
              }
              if (c.indexOf(name) == 0) {
                  return c.substring(name.length,c.length);
              }
          }
          return "";
        }

      function tokenlive(){
        var token = getCookie("token")
        if(token==""){
          location.reload();
        }
     }
      

      setInterval(function(){ 
         this.tokenlive()
      },3000);

    </script>

    <style type="text/css">
      .col-form-label{
          text-align: right;
        }
        /** logo de perfil **/
        .img-circle.profile_img{
        padding: 2px;
        margin-top: 0;
        border: 1px solid rgb(3 121 177);
        margin-left: 0;
        width: 100%
        }
        .profile_info{
          padding: 3px 2px 10px;
          text-align: center;
        }
        .profile .infocontact *{
          font-size: 11px;
        }

    </style>


    <?php if (!isset($_SESSION['idbus'])) { ?>
    <form autocomplete="false" method="POST"  onsubmit="return false" id="formListBusiness">
      <div class="modal fade " id="listbussiness" role="document"> 
          <div class="modal-dialog modal-lg modal-dialog-centered ">
              <div class="modal-content">
                
                <div class="modal-header bg-info">  
                  <h3 class="modal-title text-white"><b>Seleccione una empresa para Trabajar</b></h3>
                  
                </div>
                <div class="modal-body">
                  <div class="form-group row" >
                      <label class="col-md-2 col-form-label" for="form-label">Empresas: <span class="required text-danger">*</span></label>
                      <select name="idbus" id="idbus" class="form-control col-md-9">
                        
                      </select>
                  </div>
                </div>

                <div class="modal-footer">                  
                  <button type="button" onclick="saveBus()" class="btn btn-outline-success"  style="vertical-align: inherit;" >Seleccionar Empresa                  
                  </button>
                </div>
            </div>
          </div>
        </div>
      </form>
      
      <script type='text/javascript'>

      /*$("#listbussiness").on('hide.bs.modal', function () {  
        return false
      });  */  

      function listBusess(){
        let url = "controllers/business/listBusinessByPerController.php";
        const config ={headers: {"Content-Type": "multipart/form-data"}}
        let datos = {method: "POST"} 

        fetch(url, datos, config)  
        .then(jso=>jso.json())
        .then(data=>{
          if(data[0]!=0){
              let res = data[1];
              let list = "";
              if(res.length>0){
                for (var i=0; i<res.length; i++) {
                    list +='<option  value="'+res[i].idof+'">'+res[i].name+' '+res[i].ruc+' Sucursal: '+res[i].nombre+'</option>';
                }

                $("#idbus").html(list);
                $("#listbussiness").modal("show");
                $("#listbussiness").modal({backdrop:"static", keyboard:true})
              }else{
                $("#secctiontable").load("views/business/viewbusiness.php");                
                alert("Para continuar Crea un empresa en su nombre");
              }

          }else{
            $("#secctiontable").load("views/business/viewbusiness.php");            
            alert("Para continuar Crea un empresa en su nombre");
          }
                    
        })
      }
      
     function saveBus (){

      let idb = $("#idbus").val();
      
      let fordata= new FormData();
          fordata.append("idb",idb);
        let url = "controllers/business/listBusid.php";
        const config ={headers: {"Content-Type": "multipart/form-data"}}
        let datos = {method: "POST", body: fordata} 

      fetch(url, datos, config)  
        .then(jso=>jso.json())
        .then(data=>{
          console.log("resp: "+data);
          /*$("#listbussiness").on('hide.bs.modal', function () {  
            return true
          });*/ 

          $("#listbussiness").modal("hide");

        })

    }
      
      <?php 

        if (!isset($_SESSION['idbus'])) {
          echo 'listBusess();';
        }

      ?>

 
    </script>

      <?php } ?>

  </body>
</html>


