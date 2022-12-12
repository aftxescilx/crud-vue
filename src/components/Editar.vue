<template>

    <div class="container">
        
        <div class="card">
            <div class="card-header">
                Actualizar empleado
            </div>
            <div class="card-body">
                <form v-on:submit.prevent="actualizarRegistro">  
                    <div class="form-group">
                        <label for="my-input">ID:</label>
                        <input id="id" v-model="empleado.idEmpleado" class="form-control" type="text" name="id" readonly>
                    </div>   
                    <div class="form-group">
                        <label for="my-input">Nombre:</label>
                        <input id="nombre" required v-model="empleado.nombre" class="form-control" type="text" name="nombre">
                    </div>
                    <div class="form-group">
                        <label for="my-input">Correo:</label>
                        <input id="correo" required v-model="empleado.correo" class="form-control" type="email" name="correo">
                    </div>
                    <div class="btn-group-vertical" role="group" aria-label="">
                    <button class="btn btn-primary" type="submit">Editar</button> 
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
    created:function(){
        this.obtenerInformacion();
    },
    methods:{
        obtenerInformacion(){
            fetch('http://localhost/empleados/?consultar='+this.$route.params.idEmpleado)
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{
                console.log(datosRespuesta)
                this.empleado=datosRespuesta[0];
               
            })
            .catch(console.log)
        },
        actualizarRegistro(){
            var datosEnviar={idEmpleado:this.empleado.idEmpleado,nombre:this.empleado.nombre,correo:this.empleado.correo}
            fetch('http://localhost/empleados/?actualizar='+this.$route.params.idEmpleado,{
                method:"POST",
                body:JSON.stringify(datosEnviar)
            })
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta=>{
                console.log(datosRespuesta);
                window.location.href='../listar'
            }))
        }
    }
}
</script>