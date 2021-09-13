import '@fullcalendar/core/vdom';
import FullCalendar from  '@fullcalendar/vue';
import listPlugin from  '@fullcalendar/list';
import dayGridPlugin from '@fullcalendar/daygrid';
import {formatDate} from '@fullcalendar/core';
import interactionPlugin from '@fullcalendar/interaction';
import {route} from '../../routes.js';
import { axios } from 'vue/types/umd';

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
                    eventDrop : function(element){
                        var task = {
                            db_id:element.event.extendedProps.db_id,
                             title : element.event.title ,
                             start : element.event.start,
                              end: element.event.end,
                              description : element.event.extendedProps.description,

                              }
                    },
                    height : 400
                }
            }
        },
        methods:{

            //verifica si los datos existen en el arreglo de Fullcalendar, si existen isInArray = true si no :
            //guarda los datos en el arreglo principal
                save(){
                  var isInArray = false;
                    var i = 0;
                    if(this.task.db_id){

                    while(isInArray == false || i <= this.calendarOptions.events.length - 1){
                            if(this.calendarOptions.events[i].db_id == this.task.db_id){
                                    this.$set(this.calendarOptions.events[i], this.task);
                                    this.update(this.task);
                                    this.task = {};
                                    this.modalShow= false;
                                    return isInArray = true;

                                }

                        i++;
                        }
                    }
                        if(isInArray == false){
                            this.task.db_id = this.calendarOptions.events.length + 1;
                            this.task.id = 'eventId_'+  this.calendarOptions.events.length + 1;
                            this.calendarOptions.events.push(this.task) ;
                            this.$set(this.calendarOptions.events);
                            this.$set(this.task, 'id');
                            'event_name','event_description', 'event_start','event_end','user_id';
                            var token = this.$apiKey;
                            token = {api_token: token};
                            var dbTask = {
                                event_name : this.task.title,
                                event_description: this.task.description,
                                event_start: this.task.start,
                                event_end : this.task.end,
                            }
                   },
                   update(task){
                       var token = this.$apiKey;
                       token = { task : task.db_id , api_token: token};
                       axios.patch(route('task.update', token)).then(response => {
                           console.log(response.data);
                       })
                   },
              //borra la tarea del arreglo principal, verificando por id si existe
                   deleteTask(id){
                     this.calendarOptions.events.forEach(element =>{
                        if(element.db_id == id){
                            element = null;
                        }
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


