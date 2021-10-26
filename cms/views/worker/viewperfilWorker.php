<script src="views/worker/vueperfil.js">
</script>
<div class="" id="app">
    <div class="page-title">
        <div class="title_left">
            <h3>
                Mi Perfil
            </h3>
        </div>
    </div>
    <div class="clearfix">
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        Mis Datos
                        <small>
                            Personales
                        </small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up">
                                </i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix">
                    </div>
                </div>
                <div class="x_content">
                    <div class="col-md-3 col-sm-3 profile_left">
                        <div class="profile_img">
                            <div id="crop-avatar">
                                <img alt="Avatar" class="img-responsive avatar-view" title="Change the avatar" v-bind:src="'assets/images/'+photop" width="100%" style="border-radius: 10px; box-shadow: 6px 6px 8px #00010a;">
                                </img>
                            </div>
                        </div>
                        <h3>
                            {{namep}}
                        </h3>
                        <ul class="list-unstyled user_data">
                            <li>
                                <i class="fa fa-map-marker user-profile-icon">
                                </i>
                                {{addressp}}
                            </li>
                            <li>
                                <i class="fa fa-briefcase user-profile-icon">
                                </i>
                                admin
                            </li>
                            <li class="m-top-xs">
                                <i class="fa fa-phone user-profile-icon">
                                </i>
                                {{phonep}}
                            </li>
                            <li class="m-top-xs">
                                <i class="fa fa-file user-profile-icon">
                                </i>
                                {{docp}}
                            </li>
                            <li class="m-top-xs">
                                <i class="fa fa-envelopee user-profile-icon">
                                </i>
                                {{emailp}}
                            </li>
                        </ul>
                        <button class="btn btn-outline-primary">
                            <i class="fa fa-edit">
                            </i>
                            Editar Mis Datos
                        </button>
                    </div>
                    <div class="col-md-9 col-sm-9 ">
                        <div class="" data-example-id="togglable-tabs" role="tabpanel">
                            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                                <li class="" role="presentation">
                                    <a aria-expanded="true" data-toggle="tab" href="#tab_content1" id="home-tab" role="tab">
                                        Editar Mis datos
                                    </a>
                                </li>
                                <li class="" role="presentation">
                                    <a aria-expanded="false" data-toggle="tab" href="#tab_content2" id="profile-tab" role="tab">
                                        Cambiar Contraseña
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div aria-labelledby="home-tab" class="tab-pane active " id="tab_content1" role="tabpanel">
                                    <!-- estar formulario -->
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <div class="x_panel">
                                                <h2>
                                                    Mis Datos Personales
                                                    <small>
                                                        Complete el formulario
                                                    </small>
                                                </h2>
                                                <form class="form-horizontal">
                                                    <div class="row">
                                                        <label class="control-label col-md-3">
                                                            Nombre Completo:
                                                            <span class="required is-invalid">
                                                                *
                                                            </span>
                                                        </label>
                                                        <div class="col-md-8 form-group has-feedback">
                                                            <input class="form-control has-feedback-left" placeholder="Nombre Completo" type="text" v-model="namep">
                                                                <span aria-hidden="true" class="fa fa-user form-control-feedback left">
                                                                </span>

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label class="control-label col-md-3">
                                                            Correo Personal:
                                                            <span class="required is-invalid">
                                                                *
                                                            </span>
                                                        </label>
                                                        <div class="col-md-8 form-group has-feedback">
                                                            <input class="form-control has-feedback-left" placeholder="Correo" type="email" v-model="emailp">
                                                                <span aria-hidden="true" class="fa fa-envelope form-control-feedback left">
                                                                </span>

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label class="control-label col-md-3">
                                                            Teléfono Personal:
                                                            <span class="required is-invalid">
                                                                *
                                                            </span>
                                                        </label>
                                                        <div class="col-md-8 form-group has-feedback">
                                                            <input class="form-control has-feedback-left" placeholder="Teléfono" type="number" v-model="phonep">
                                                                <span aria-hidden="true" class="fa fa-phone-square form-control-feedback left">
                                                                </span>

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label class="control-label col-md-3">
                                                            Numero de Documento:
                                                            <span class="required is-invalid">
                                                                *
                                                            </span>
                                                        </label>
                                                        <div class="col-md-8 form-group has-feedback">
                                                            <input class="form-control has-feedback-left" placeholder="N° Documento" type="number" v-model="docp">
                                                                <span aria-hidden="true" class="fa fa-file form-control-feedback left">
                                                                </span>

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label class="control-label col-md-3">
                                                            Dirección:
                                                            <span class="required is-invalid">
                                                                *
                                                            </span>
                                                        </label>
                                                        <div class="col-md-8 form-group has-feedback">
                                                            <input class="form-control has-feedback-left" placeholder="Dirección" type="text" v-model="addressp">
                                                                <span aria-hidden="true" class="fa fa-thumb-tack form-control-feedback left">
                                                                </span>

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label class="control-label col-md-3">
                                                            Foto De Perfil:
                                                            <span class="required is-invalid">
                                                                *
                                                            </span>
                                                        </label>
                                                        <div class="col-md-8 form-group has-feedback">
                                                            <input type="file" id="file" ref="file" v-on:change="setPicture" v-bind:class="[selectfoto]" class="form-control has-feedback-left" >
                                                                <span aria-hidden="true" class="fa fa-photo form-control-feedback left">
                                                                </span>

                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-12 col-sm-12 offset-md-0 ">
                                                            <button @click="saveperfil" class="btn btn-outline-success" type="button">
                                                                <i class="fa fa-save">
                                                                </i>
                                                                Guardar Mis Datos
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- END X-PANEL -->
                                        </div>
                                    </div>
                                    <!-- end formulario -->
                                </div>
                                <div aria-labelledby="profile-tab" class="tab-pane fade" id="tab_content2" role="tabpanel">
                                    <!-- Start Password -->
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <div class="x_panel">
                                                <h2>
                                                    Complete el formulario para cambiar la contraseña
                                                </h2>
                                                <form class="form-horizontal">
                                                    <div class="row">
                                                        <label class="control-label col-md-3">
                                                            Contraseña Antigua
                                                            <span class="required is-invalid">
                                                                *
                                                            </span>
                                                        </label>
                                                        <div class="col-md-8 form-group has-feedback">
                                                            <input class="form-control has-feedback-left" placeholder="Ingrese su contraseña actual" required="required" type="password" v-model="passuserold">
                                                                <span aria-hidden="true" class="fa fa-key form-control-feedback left">
                                                                </span>

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label class="control-label col-md-3">
                                                            Contraseña Nueva
                                                            <span class="required is-invalid">
                                                                *
                                                            </span>
                                                        </label>
                                                        <div class="col-md-8 form-group has-feedback">
                                                            <input class="form-control has-feedback-left" placeholder="Ingrese contraseña nueva" required="required" type="password" v-model="passuser1">
                                                                <span aria-hidden="true" class="fa fa-key form-control-feedback left">
                                                                </span>

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label class="control-label col-md-3">
                                                            Confirmar Contraseña Nueva
                                                            <span class="required is-invalid">
                                                                *
                                                            </span>
                                                        </label>
                                                        <div class="col-md-8 form-group has-feedback">
                                                            <input class="form-control has-feedback-left" placeholder="Confirme contraseña nueva" required="required" type="password" v-model="passuser2">
                                                                <span aria-hidden="true" class="fa fa-key form-control-feedback left">
                                                                </span>

                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-12 col-sm-12 offset-md-0 ">
                                                            <button @click="changePassword" class="btn btn-outline-success" type="button">
                                                                Cambiar Contraseña
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- endpassword -->
                                </div>
                            </div>
                        </div>
                        <div class="profile_title">
                            <div class="col-md-6">
                                <h2>
                                    Empresas donde estoy asignado
                                </h2>
                            </div>
                        </div>
                        <!-- start of user-activity-graph -->
                        <div id="graph_bar" style="width:100%; height:280px;">
                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                        <tr class="bg bg-info">
                                            <th class="column-title">
                                                Razon Social
                                            </th>
                                            <th class="column-title">
                                                RUC
                                            </th>
                                            <th class="column-title">
                                                Dirección
                                            </th>
                                            <th class="column-title">
                                                Teléfono
                                            </th>
                                            <th class="column-title">
                                                Sucursal
                                            </th>
                                            <th class="column-title">
                                                IGV
                                            </th>
                                            <th class="column-title">
                                                Logo
                                            </th>
                                            <th class="column-title">
                                                Opciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="even pointer" v-for="(b, index) in offices">
                                            <th class="">
                                                {{b.nameb}}
                                            </th>
                                            <th class="">
                                                {{b.rucb}}
                                            </th>
                                            <th class="">
                                                {{b.address}}
                                            </th>
                                            <th class="">
                                                {{b.phone}}
                                            </th>
                                            <th class="">
                                                {{b.nombre}}
                                            </th>
                                            <th class="">
                                                {{b.iva*100}}
                                            </th>
                                            <th class="">
                                                <img v-bind:src="'./assets/images/'+b.logob" width="45">
                                                </img>
                                            </th>
                                            <th class="">
                                                <button class="btn btn-outline-danger btn-sm">
                                                    <i class="fa fa-power-off">
                                                    </i>
                                                    Dejar
                                                </button>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end of user-activity-graph -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
