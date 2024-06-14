<div class="container" id="registro">
<div class="row justify-content-md-center d-flex align-items-center">
    <div class="col-4">
        <h3 class="text-center my-2">Registrarse</h3>
        <div class="card">
            <div class="card-body  px-5">
                <div class="d-flex justify-content-center">
                        <img src="<?=base_url()?>/public/logo.png" width="100" alt="">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nombre *</label>
                    <input type="text" class="form-control" name="nombre" placeholder="Nombre" v-model="nombre">
                </div>
                <div class="mb-3">
                    <label class="form-label">Apellido *</label>
                    <input type="text" class="form-control" name="apellido" placeholder="Apellido" v-model="apellido">
                </div>
                <div class="mb-3">
                    <label class="form-label">Documento *</label>
                    <input type="number" class="form-control" name="documento" placeholder="Documento"  v-model="documento">
                </div>
                <div class="mb-3">
                    <label class="form-label">Telefono *</label>
                    <input type="number" class="form-control" name="telefono" placeholder="Telefono" v-model="telefono">
                </div>
                <div class="mb-3">
                    <label class="form-label">Correo *</label>
                    <input type="email" class="form-control" name="correo" placeholder="Correo" v-model="correo">
                </div>
                <div class="mb-3">
                    <label class="form-label">Clave *</label>
                    <input type="password" class="form-control" placeholder="Clave" v-model="clave">
                </div>
                <div class="mb-3">
                    <button class="btn" style="width: 100%; background-color:#00162e; color:white"  @click="onRegistrar">Registrar</button>
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
        const nombre = ref('');
        const apellido = ref('');
        const documento = ref('');
        const telefono = ref('');
        const correo = ref('');
        const clave = ref('');
      return {
        nombre,
        apellido,
        documento,
        telefono,
        correo,
        clave,
        async onRegistrar() {
            //validamos que los campos esten llenos
            if(nombre.value == '' || apellido.value == '' || documento.value == '' || telefono.value == '' || correo.value == '' || clave.value == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Todos los campos son obligatorios!',
                })
                return;
            }

            //enviamos los datos al servidor
            let url = '<?=base_url("Estudiante/Registrando")?>';
            let datos = {
                nombre: nombre.value,
                apellido: apellido.value,
                documento: documento.value,
                telefono: telefono.value,
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
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: result.message,
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    window.location.href = '<?=base_url("Login")?>';
                });
            })
            .catch((error) => {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: error.error
                });
            });
            
        }
      }
    }
  }).mount('#registro')
</script>