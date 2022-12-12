<template>
    <div class="container">
        
        <div class="card">
            <div class="card-header">
                Crear nuevo empleado
            </div>
            <div class="card-body">
                <form v-on:submit.prevent="agregarRegistro">     
                    <div class="form-group">
                        <label for="my-input">Nombre:</label>
                        <input id="nombre" required v-model="empleado.nombre" class="form-control" type="text" name="nombre">
                    </div>
                    <div class="form-group">
                        <label for="my-input">Correo:</label>
                        <input id="correo" required v-model="empleado.correo" class="form-control" type="email" name="correo">
                    </div>
                    <div class="btn-group-vertical" role="group" aria-label="">
                    <button class="btn btn-primary" type="submit">Guardar</button> 
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            empleado:{}
        }
    },
    methods:{
        agregarRegistro(){
            console.log(this.empleado);
            var datosEnviar={nombre:this.empleado.nombre,correo:this.empleado.correo}
            fetch('http://localhost/empleados/?insertar=1',{
                method:"POST",
                body:JSON.stringify(datosEnviar)
            })
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta=>{
                console.log(datosRespuesta);
                window.location.href='listar'
            }))
        }
    }
}
</script>