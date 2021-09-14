

<template>
    <div class>
 <FullCalendar :options="calendarOptions" :events="calendarOptions.events"></FullCalendar>
<div>

<b-modal v-model="modalShow">
     <div class="form" >

        <h2>{{this.event.title}}</h2>
        </br>
        <input  type="hidden" v-if="this.task.db_id"  v-model="task.db_id" />
        <label for="title">Title</label>
        <b-form-input @input="tChange" class="form-group h3" type="text" v-model="task.title" placeholdre="title"/>
        <label for="description">Description</label>
        <b-form-textarea @input="tChange" name="description" placeholder="Task description" v-model="task.description" cols="50" rows="5" max-rows="10"></b-form-textarea>
<label for="taskId">Title</label>
   <b-form-select name="taskId" class="m-2" @input="tChange" v-model="task.user_id">
                <option v-for="user in users"  :value="user.id">
                    {{user.email}}
                </option>
            </b-form-select>
            <b-form-datepicker  class="m-2"   v-model="task.start" @input="tChange"></b-form-datepicker>
        <b-form-datepicker  class="m-2"   v-model="task.end" @input="tChange"></b-form-datepicker>


    </div>
<template #modal-footer="{guardar,cancel}">
    <b-button size="sm" variant="success" @click="save()">Guardar</b-button>
    <b-button size="sm" variant="warning" @click="cancel()">Cancelar</b-button>
    <b-button size="sm" variant="danger" @click="deleteTask(task.db_id)">Delete</b-button>
</template>
</b-modal>

<b-modal title="Create Task"v-model="createTaskModal" >
    <div class="form" >

        <h2>{{this.event.title}}</h2>
        </br>
        <input  type="hidden" v-if="this.task.db_id"  v-model="task.db_id" />
        <label for="title">Title</label>
        <b-form-input @input="tChange" class="form-group h3" type="text" v-model="task.title" placeholdre="title"/>
        <label for="description">Description</label>
        <b-form-textarea @input="tChange" name="description"  v-model="task.description" placeholder="Task description" cols="50" rows="5" max-rows="10"></b-form-textarea>
        <b-form-select name="taskId" class="m-2" @input="tChange" v-model="task.user_id">
                <option v-for="user in users"  :value="user.id">
                    {{user.email}}
                </option>
            </b-form-select>
        <b-form-datepicker  class="m-2"   v-model="task.start" @input="tChange"></b-form-datepicker>
        <b-form-datepicker  class="m-2"   v-model="task.end" @input="tChange"></b-form-datepicker>


    </div>
<template #modal-footer="{guardar,cancel}">
    <b-button size="sm" variant="success" @click="save()">Guardar</b-button>
    <b-button size="sm" variant="warning" @click="cancel()">Cancelar</b-button>
    <b-button size="sm" variant="danger" @click="deleteTask()">Delete</b-button>
</template>
</b-modal>
</div>

</div>

</template>

<script>
import '@fullcalendar/core/vdom';
import FullCalendar from  '@fullcalendar/vue';
import listPlugin from  '@fullcalendar/list';
import dayGridPlugin from '@fullcalendar/daygrid';
import {formatDate} from '@fullcalendar/core';
import interactionPlugin from '@fullcalendar/interaction';
import {route} from '../../routes.js';

    export default {
        components: {
            FullCalendar
        },
        data(){
            return {
                users: [],
                user:[],
                thisUser: [],
                task:[],
                createTaskModal:false,
                modalShow:false,
                api_key:this.$apiKey,
                event:[],
                pri: this.prop,
                task:{
                },
                calendarOptions: {

                    plugins:[dayGridPlugin, interactionPlugin],
                    dateClick: this.handleClickDate,
                    dayMaxEvents: 2,
                    eventClick: this.handleClickEvent,
                    events : [],
                    eventStartEditable: true,
                    eventDrop : this.dropTask,
                    height : 400
                }
            }
        },
        methods:{

            //verifica si los datos existen en el arreglo de Fullcalendar, si existen isInArray = true si no :
            //guarda los datos en el arreglo principal
                dropTask(element){
                        var dbTask = {
                            db_id:element.event.extendedProps.db_id,
                             event_start : element.event.start,
                              event_end: element.event.end,

                              };
                        var token = this.$apiKey;
                        token = { task : element.event.extendedProps.db_id , api_token: token};
                        axios.patch(route('task.update', token),dbTask).then(response => {
                           console.log(response.data);
                           this.getTasks();
                       })
                    },
                save(){
                  var isInArray = false;
                    var i = 0;
                    if(this.task.db_id){

                    while(isInArray == false || i <= this.calendarOptions.events.length - 1){
                            if(this.calendarOptions.events[i].db_id == this.task.db_id){

                                if(this.thisUser.role.permissions.tasks.create){    this.$set(this.calendarOptions.events[i], this.task);
                                    this.update(this.task);
                                    this.task = {};
                                    this.modalShow= false;
                                    return isInArray = true;}

                                }

                        i++;
                        }
                    }
                        if(isInArray == false){
                            if(this.thisUser.role.permissions.tasks.update){
                                    this.task.db_id = this.calendarOptions.events.length + 1;
                                    this.task.id = 'eventId_'+  this.calendarOptions.events.length + 1;
                                    this.calendarOptions.events.push(this.task) ;
                                    this.$set(this.calendarOptions.events);
                                    this.$set(this.task, 'id');
                                    var token = this.$apiKey;

                                    var dbTask = {
                                        event_name : this.task.title,
                                        event_description: this.task.description,
                                        event_start: this.task.start,
                                        user_id : this.task.user_id,
                                        event_end : this.task.end,
                                    };
                                    token = {api_token: token};
                                    axios.post(route('task.store', token), dbTask).then(
                                        response =>{
                                            console.log(response.data)
                                            this.getTasks();
                                        }
                            )
                            }
                            this.task = {};

                        }
                   },
                   update(task){
                       var token = this.$apiKey;
                       var dbTask = {
                                event_name : task.title,
                                event_description: task.description,
                                event_start: task.start,
                                user_id : task.user_id,
                                event_end : task.end,
                            };
                       token = { task : task.db_id , api_token: token};
                       axios.patch(route('task.update', token),dbTask).then(response => {
                           console.log(response.data);
                           this.getTasks();
                       })
                   },
              //borra la tarea del arreglo principal, verificando por id si existe
                   deleteTask(id){
                       console.log(id);
                       var token = this.$apiKey;
                       token = {api_token: token, task: id };
                       axios.delete(route('task.destroy', token)).then(response =>{
                           console.log(response.data);
                           this.getTasks();
                       });
                    this.modalShow= false;

                },
                //cada vez que hay un cambio en el v-model= task modifica los datos en Fullcalendar
                //tambien verifica si task tiene extended props de modo que no regresa un error si no lo hay, de no existir hay un error en el codigo
                //y regresa la informacion de la tarea por consola para verificar los datos
                tChange(){
                    if(this.thisUser.role.permissions.tasks.update){
                        if(this.task.db_id)
                        {
                        this.$set(this.calendarOptions.events);
                        this.calendarOptions.events.forEach(element =>{
                        if(element.db_id == this.task.db_id)
                        {
                            element.title = this.task.title;
                            element.description = this.task.description;
                            element.user_id = this.task.user_id;
                            element.start = this.task.start;
                            element.end = this.task.end;
                        }
                    });
                    }}else{
                        console.log('actualizacion fallida');
                   }

        },
        //al hacer click en un evento configura las propiedades de task y las hace reactivas,
        //de modo que se puedan mostrar en el modal
                     handleClickEvent(e){
                         if(e.event){
                             this.task={};
                         this.$set(this.task, 'id', e.event.id);
                         this.$set(this.task, 'title', e.event.title);
                         this.$set(this.task, 'description', e.event.extendedProps.description);
                         this.$set(this.task, 'db_id', e.event.extendedProps.db_id);
                         this.$set(this.task, 'user_id', e.event.extendedProps.user_id);
                         this.$set(this.task, 'start', e.event.start);
                         this.$set(this.task, 'end', e.event.end);
                         console.log(this.task);
                         }
                         this.modalShow = true;
                    }
                    ,
                //hace lo mismo que handle click event
                    handleClickDate(e){
                         this.$set(this.task, 'id');
                         this.$set(this.task, 'title');
                         this.$set(this.task, 'description');
                         this.$set(this.task, 'db_id');
                         this.$set(this.task, 'start',e.date);
                         this.$set(this.task, 'end');
                         this.createTaskModal = true;
                    }
                    ,
                    //aqui es donde se optienen las tareas de la base de datos a traves de axios
                    getTasks(){
                        var token = this.getTokenJson();

                         axios
                    .get(route('task.index', token))
                    .then(response=> {
                         var events = []
                    response.data.events.forEach(element => {
                        var jsonEvents= {
                            id: 'eventId_'+ element.id,
                             title : element.event_name ,
                             start : element.event_start,
                              end: element.event_end,
                              allDay : false,
                              editable : true,
                              description : element.event_description,
                              db_id : element.id,
                              user_id: element.user_id
                              }
                        events.push(jsonEvents);

                            });
                        this.calendarOptions.events = events ;
                        this.$set(this.calendarOptions.events);
                    });
                    },
                    //optiene el token accediendo a la variable global ApiKey
                    getTokenJson(){
                        var token = {api_token: this.$apiKey};
                        return token;
                    },
                    getUsers(){
                        var token=this.$apiKey;
                            var token = {api_token : token};
                                axios
                      .get(route('getUsers', token))
                      .then(response=> {
                          this.users=response.data;
                          this.getThisUser();

                      });
                  },
                    getThisUser(){
                        this.users.forEach(element =>{
                            if(element.isThisUser){
                                this.thisUser = element;
                                console.log(element);
                            }
                        })
                    }
        },
        beforeMount(){
            this.getTasks();
            this.getUsers();
        },
        mounted(){
            console.log(this.users);
        }
    }



</script>
