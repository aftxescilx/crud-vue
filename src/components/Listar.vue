<template>
    <div class="container">
        
        <div class="card-header">
                Lista de Empleados   
        </div>
        <div class="card-body">
            <table class="table table-light">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="empleado in empleados" :key="empleado.idEmpleado">
                        <td>{{empleado.idEmpleado}}</td>
                        <td>{{empleado.nombre}}</td>
                        <td>{{empleado.correo}}</td>
                        <td> 
                            <div class="btn-group" role="group">
                                <router-link :to="{name:'Editar',params:{idEmpleado:empleado.idEmpleado}}" class="btn btn-link">Editar</router-link> | 
                                <a type="button" v-on:click="borrarEmpleado(empleado.idEmpleado)" class="btn btn-link">Eliminar</a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </div>
</template>
<script>
export default {
    data(){
        return{
            empleados:[]
        }
    },
    created:function(){
        this.consultarEmpleados();
    },
    methods:{
        consultarEmpleados(){
            fetch('http://localhost/empleados/')
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{
                console.log(datosRespuesta)
                this.empleados=[]
                if(typeof datosRespuesta[0].success==='undefined'){
                    this.empleados=datosRespuesta;
                }
            })
            .catch(console.log)
        },
        borrarEmpleado(idEmpleado){
            fetch('http://localhost/empleados/?borrar='+idEmpleado)
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{
                console.log(datosRespuesta)
                window.location.href="listar"
            })
            .catch(console.log)     
        }
    }
}
</script>