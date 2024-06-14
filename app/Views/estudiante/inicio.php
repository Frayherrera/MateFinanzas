<div class="container-fluid" id="inicio">
    <div class="row" style="height: 100vh;">
        <div class="col-2" style="background-color: #3a3981;">
            <div class="btnTema text-center" v-for="item in aTemas" :class="(oTemaSeleccionado.id==item.id)?'btnSeleccionado':''" @click="onSeleccionarTema(item)">
                <strong>{{item.titulo}}</strong>
            </div>

            <div class=" btnTema text-center btnCerrarSesion d-flex align-items-center justify-content-center" @click="onCerrarSesion">
                <span class="material-symbols-outlined me-1" style="color: red;">power_settings_new</span>
                <strong class="me-2">
                    Cerrar Sesion
                </strong>
            </div>
        </div>

        <div class="col-10 text-center py-4 px-5" v-if="nVistaMostrar==1">
            <h4>{{oTemaSeleccionado.titulo?.toUpperCase()}}</h4>
            <div class="alert alert-light" role="alert">
                {{oTemaSeleccionado.descripcion}}
            </div>
            <div class="row">
                <div class="col-12" v-for="item in aModulos">
                    <div class="btnModulos text-center" @click="onSeleccionarModulo(item)">
                        <strong>{{item.titulo}}</strong>
                    </div>
                </div>
                <div class="col-12">
                    <div class="btnExamen text-center" @click="onValidarIniciarExamen">
                        <strong>Examen</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-10 py-4 px-5" v-else-if="nVistaMostrar==2">
            <h4 class="text-center">Examen sobre {{oTemaSeleccionado.titulo}}</h4>
            <div class="alert " :class="item.res==1?'alert-success':(item.res==0)?'alert-danger':'alert-light'" role="alert" v-for="item in aPreguntas">
                <fieldset>
                    <strong>{{item.titulo}}</strong>
                    <div class="form-check my-2" v-for="(opcion,i) in item.opciones">
                        <input class="form-check-input" type="radio" :name="item.id+'pregunta'" :id="opcion.id" :value="opcion.id" v-model="item.seleccionado" :disabled="bExamenResuelto">
                        <label class="form-check-label" :for="opcion.id">
                            {{i+1}} - {{opcion.descripcion}}
                        </label>
                    </div>
                </fieldset>
            </div>
            <button v-if="!bExamenResuelto" style="float: right;" @click="onFinalizarPrueba" type="button" class="btn btn-primary">Finalizar Prueba</button>
        </div>

        <div class="col-10 py-4 px-5" v-else-if="nVistaMostrar==3">
            <h4 class="  d-flex align-items-center">Mi perfil | <span class="material-symbols-rounded" style="font-size: 40px;">person</span></h4>
            <div class="row  mt-5">
                <div class="col-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label"><strong>Nombres</strong></label>
                    <input type="text" class="form-control" v-model="oUsuario.nombre">
                </div> 
                <div class="col-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label"><strong>Apellidos</strong></label>
                    <input type="text" class="form-control" v-model="oUsuario.apellido">
                </div> 
                <div class="col-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label"><strong>Numero de documento</strong></label>
                    <input type="text" class="form-control" v-model="oUsuario.documento">
                </div> 
                <div class="col-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label"><strong>Telefono</strong></label>
                    <input type="text" class="form-control" v-model="oUsuario.telefono">
                </div> 
                <div class="col-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label"><strong>Correo Electronico</strong></label>
                    <input type="text" class="form-control" v-model="oUsuario.correo" disabled>
                </div> 
                <div class="col-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label"><strong>Contraseña</strong></label>
                    <input type="password" class="form-control" v-model="oUsuario.clave">
                </div> 
            </div>
            
            <div class="row">
                <div class="col-4 mb-3">
                    <button class="btn btn-primary mb-3" @click="onActualizarUsuario">Actualizar Datos</button>
                </div> 
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">{{oModuloSeleccionado.titulo}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-light" role="alert">
                    {{oModuloSeleccionado.descripcion}}
                </div>
                <div class="alert alert-light" role="alert">
                    <iframe width="100%" height="315" :src="oModuloSeleccionado.video" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btnTema{
        border-radius: 5px;
        margin: 10px;
        padding: 10px;
        color: white;
        cursor: pointer;
    }

    .btnTema:hover {
        background-color: #1d2758;
    }

    .btnSeleccionado{
        background-color: #1d2758;
    }
    .btnCerrarSesion{
        bottom: 0; 
        position: fixed;
    }
    .btnModulos{
        border-radius: 5px;
        margin: 10px;
        padding: 10px;
        color: black;
        cursor: pointer;
        background-color: #e9e9e9;
    }
    .btnModulos:hover {
        background-color: #8284a5;
    }
    .btnExamen{
        border-radius: 5px;
        margin: 10px;
        padding: 10px;
        color: black;
        cursor: pointer;
        background-color: #1d6ac5;
    }
    .btnExamen:hover {
        background-color: #8284a5;
    }
</style>

<script>

const { createApp, ref } = Vue

createApp({
    setup() {
        const aTemas = ref([]);
        const oTemaSeleccionado = ref({});
        const aModulos = ref([]);
        const oModuloSeleccionado = ref({});
        const aPreguntas = ref([]);
        const aResultados = ref([]);
        const bExamenResuelto = ref(false);
        /* 
            1. mostramos los modulos
            2. mostramos las preguntas
            3. mostramos el perfil del usuario
        */
        const nVistaMostrar = ref(1);
        const oUsuario = ref({});


        const cargarTemas = async () => {
            let url = '<?=base_url("obtenerTemas")?>';
            await fetch(url, {
                method: 'GET'
            })
            .then((response) => response.json())
            .then((result) => {
                aTemas.value = result;
                oTemaSeleccionado.value = result[0];
                cargarModulo();
            })
            .catch((error) => {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: error.error
                });
            });
        }

        const cargarModulo= async () => {
            //validmos que tengan un tema seleccionado
            if(!oTemaSeleccionado.value?.id){
                return;
            }
                
            let url = '<?=base_url("obtenerModulos")?>?idTema='+oTemaSeleccionado.value.id;
            await fetch(url, {
                method: 'GET',
            })
            .then((response) => response.json())
            .then((result) => {
                aModulos.value = result;
                // onCargarPreguntas();
            })
            .catch((error) => {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: error.error
                });
            });
        }
        
        const onSeleccionarTema = (oTema) => {
            oTemaSeleccionado.value = oTema;
            cargarModulo();
            nVistaMostrar.value = 1;
        }

        const onSeleccionarModulo = (oModulo) => {
            oModuloSeleccionado.value = oModulo;
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {});
            myModal.show();
        }

        const onCerrarSesion = () => {
            Swal.fire({
                title: "Seguro que deseas cerrar sesion?",
                showDenyButton: true,
                confirmButtonText: "Cerrar Sesion",
                denyButtonText: `Cancelar`
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire("Cerrando sesion!", "", "success");
                    window.location.href = '<?=base_url("CerrarSesion")?>';
                } 
            });
            
        }

        const onCargarPreguntas = async () => {
            let url = '<?=base_url("obtenerPreguntas")?>?idTema='+oTemaSeleccionado.value.id;
            await fetch(url, {
                method: 'GET'
            })
            .then((response) => response.json())
            .then((result) => {
                aPreguntas.value = result;
                validarRespuestas();
            })
            .catch((error) => {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: error.error
                });
            });
        }

        const onValidarIniciarExamen = () => {
            Swal.fire({
                title: "Seguro que deseas iniciar el examen?",
                showDenyButton: true,
                confirmButtonText: "Iniciar Examen",
                denyButtonText: `Cancelar`
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire("Iniciando examen!", "", "success");
                    nVistaMostrar.value = 2;
                    onCargarPreguntas();
                } 
            });
        }

        const onFinalizarPrueba = () => {
            //validamos que todas las preguntas esten seleccionadas
            let aPreguntasSinSeleccionar = aPreguntas.value.filter(item => item.seleccionado == undefined);
            if(aPreguntasSinSeleccionar.length > 0){
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Por favor responde todas las preguntas"
                });
                return;
            }
            
            Swal.fire({
                title: "Seguro que deseas finalizar el examen?",
                showDenyButton: true,
                confirmButtonText: "Finalizar Examen",
                denyButtonText: `Cancelar`
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire("Finalizando examen!", "", "success");
                    enviarRespuestas();
                } 
            });
        }

        const enviarRespuestas = async () => {
            let formBody = new FormData();
            //enviamos las respuestas al servidor
            let aRespuestasEnviar = [];
            aPreguntas.value.forEach(element => {
                aRespuestasEnviar.push({idPregunta: element.id, seleccionado: element.seleccionado});
            });
            formBody.append('respuestas', JSON.stringify(aRespuestasEnviar));
            formBody.append('idTema', oTemaSeleccionado.value.id);
            let url = '<?=base_url("enviarRespuestas")?>';
            await fetch(url, {
                method: 'POST',
                body: formBody,
            })
            .then((response) => response.json())
            .then((result) => {
                aPreguntas.value.forEach(element => {
                    let aTemp = result.aCorrectas.filter(item => item.idPregunta == element.id);
                    if (aTemp.length > 0) {
                        element.res = 1;
                    } else {
                        element.res = 0;
                    }
                });
                bExamenResuelto.value = true;

                //indicamos cuantas buenas saco
                Swal.fire({
                    title: "Resultado!",
                    text: "Tienes "+result.nCorrectas+" correctas y "+result.nIncorrectas+" incorrectas",
                });
            })
            .catch((error) => {
                console.log(error,"error");
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: error.error
                });
            });
        }

        //validamos si el estudiante ya respondio este tema
        const validarRespuestas = async () => {
            let formBody = new FormData();
            //enviamos las respuestas al servidor
            formBody.append('idTema', oTemaSeleccionado.value.id);
            let url = '<?=base_url("validarRespuestas")?>';
            await fetch(url, {
                method: 'POST',
                body: formBody,
            })
            .then((response) => response.json())
            .then((result) => {
                if(result.pendienteRealizar == 'ok'){
                    return;
                }
                result.aRespuestas.forEach(element => {
                    let oPregunta = aPreguntas.value.find(item => item.id == element.idPregunta);
                    if(oPregunta){
                        oPregunta.seleccionado = element.idOpcion;
                        if(element.correcta==1){
                            oPregunta.res = 1;
                        }
                        else{
                            oPregunta.res = 0;
                        }
                    }
                });
                bExamenResuelto.value = true;

                //indicamos cuantas buenas saco
                Swal.fire({
                    title: "Resultado!",
                    text: "Tienes "+result.nCorrectas+" correctas y "+result.nIncorrectas+" incorrectas",
                });
            })
            .catch((error) => {
                console.log(error,"error");
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: error.error
                });
            });
        }

        const onCargarPerfilUsuairo = async () => {
            let url = '<?=base_url("datosUsuario")?>';
            await fetch(url, {
                method: 'GET'
            })
            .then((response) => response.json())
            .then((result) => {
                oUsuario.value = result;
            })
            .catch((error) => {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: error.error
                });
            });
        }

        //validamos si estamos en el perfil
        var urlParams = new URLSearchParams(window.location.search);
        var perfil = urlParams.get('perfil');

        if(perfil === 'si') {
            nVistaMostrar.value = 3;
            onCargarPerfilUsuairo();
        }


        const onActualizarUsuario = async () => {

            //validamos que todos los campos esten llenos
            if(oUsuario.value.nombre == '' || oUsuario.value.apellido == '' || oUsuario.value.documento == '' || oUsuario.value.telefono == ''){
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Por favor llena todos los campos"
                });
                return;
            }

            //organizamos la data para enviar en el formulario
            let formBody = new FormData();
            formBody.append('nombre', oUsuario.value.nombre);
            formBody.append('apellido', oUsuario.value.apellido);
            formBody.append('documento', oUsuario.value.documento);
            formBody.append('telefono', oUsuario.value.telefono);
            formBody.append('clave', oUsuario.value.clave);

            let url = '<?=base_url("actualizarUsuario")?>';
            await fetch(url, {
                method: 'POST',
                body: formBody,
            })
            .then((response) => response.json())
            .then((result) => {
                if(result?.status=="ok"){
                    Swal.fire({
                        icon: "success",
                        title: "Datos actualizados correctamente",
                    });
                }
                else{
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Error al actualizar los datos"
                    });
                }
            })
            .catch((error) => {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: error.error
                });
            });
        }
        

        // Llama a la función cargarTemas cuando se inicia la aplicación
        cargarTemas();
        
        return {
            aTemas,
            oTemaSeleccionado,
            aModulos,
            oModuloSeleccionado,
            onSeleccionarTema,
            onSeleccionarModulo,
            onCerrarSesion,
            nVistaMostrar,
            onValidarIniciarExamen,
            onCargarPreguntas,
            aPreguntas,
            aResultados,
            onFinalizarPrueba,
            bExamenResuelto,
            oUsuario,
            onCargarPerfilUsuairo,
            onActualizarUsuario
        }
    }
}).mount('#inicio')
</script>