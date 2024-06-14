<div class="container"  id="registro">
    <div class="row justify-content-md-center d-flex align-items-center">
        <div class="col-4">
            <h3 class="text-center my-2">Iniciar Sesión</h3>
            <div class="card">
                <div class="card-body px-5">
                    <div class="d-flex justify-content-center">
                        <img src="<?=base_url()?>/public/logo.png" width="100" alt="">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo *</label>
                        <input type="email" class="form-control" name="correo" placeholder="Correo" v-model="correo">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña *</label>
                        <input type="password" class="form-control" placeholder="Contraseña" v-model="clave">
                    </div>
                    <div class="mb-3">
                        <button class="btn" style="width: 100%; background-color:#00162e; color:white" @click="onLogin">Iniciar Sesion</button>
                    </div>
                    <div class="mb-3 text-center" >
                        <strong class="text-center">¿No tienes una cuenta?</strong>
                    </div>
                    <div class="mb-3">
                        <button class="btn" style="width: 100%; background-color:#a04000; color:white" @click="onRedireccionarRegistro">Registrarse</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  const { createApp, ref } = Vue

  createApp({
    setup() {
        const correo = ref('');
        const clave = ref('');
      return {
        correo,
        clave,
        async onLogin() {
            //validamos que los campos esten llenos
            if(correo.value == '' || clave.value == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Todos los campos son obligatorios!',
                })
                return;
            }

            //enviamos los datos al servidor
            let url = '<?=base_url("Logueo")?>';
            let datos = {
                correo: correo.value,
                clave: clave.value
            };

            let formBody = new FormData();
            for (let key in datos) {
                formBody.append(key, datos[key]);
            }

            await fetch(url, {
                method: 'POST', // o 'PUT'
                body: formBody,
            })
            .then((response) => response.json())
            .then((result) => {
                if(result.status == 'ok'){
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: result.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        window.location.href = '<?=base_url("Inicio")?>';
                    });
                }
                else{
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: result.message
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
            
        },
        onRedireccionarRegistro(){
            window.location.href = '<?=base_url("RegistroEstudiante")?>';
        }
      }
    }
  }).mount('#registro')
</script>