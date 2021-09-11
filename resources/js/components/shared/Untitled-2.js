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

        methods:{
            //verifica si los datos existen en el arreglo de Fullcalendar, si existen isInArray = true si no :
            //guarda los datos en el arreglo principal
                save(){
                  var isInArray = false;
                    var i = 0;
                    while(isInArray == false || i <= this.calendarOptions.events.length - 1){
                        console.log(this.task);
                        console.log(i);
                        if(this.task.db_id){

                            if(this.calendarOptions.events[i].db_id == this.task.db_id){
                                    this.$set(this.calendarOptions.events[i], this.task);
                                    console.log(this.calendarOptions.events[i]);
                                    console.log('el objeto esta en el array');
                                    console.log(this.calendarOptions.events[i]);
                                    this.task = {};
                                    this.modalShow= false;
                                    return isInArray = true;

                                }
                        }else{
                             isInArray = false;
                        }
                        i++;
                        }

                        if(isInArray == false){
                            console.log('comprobacion 1 exitosa');
                        }

                        if(isInArray === false){
                            console.log('comprobacion 2 exitosa');
                        }
                       console.log(isInArray);
                        if(isInArray == false){
                            console.log('funcion de creacion iniciada');
                            this.task.db_id = this.calendarOptions.events.length + 1;
                            this.task.id = 'eventId_'+  this.calendarOptions.events.length + 1;
                            this.calendarOptions.events.push(this.task) ;
                            this.$set(this.calendarOptions.events);
                            this.$set(this.task, 'id');
                            this.task = {};
                            console.log('objeto creado');
                        }
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
                    if(this.task.db_id){
                    this.$set(this.calendarOptions.events);
                    this.calendarOptions.events.forEach(element =>{
                        if(element.db_id == this.task.db_id){
                            element.title = this.task.title;
                            console.log('task: ');
                            console.log(this.task);
                            element.description = this.task.description;
                            element.start = this.task.start;
                            element.end = this.task.end;
                            console.log(element.db_id);
                        }
                    });
                    }else{
                         console.log(this.task);
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

                         this.$set(this.task, 'start', e.event.start);
                         this.$set(this.task, 'end', e.event.end);
                         }
                         console.log(this.task);
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
                              db_id : element.id
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
                    }
        },
        data(){
            return {
                createTaskModal:false,
                modalShow:false,
                api_key:[],
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
                            id:element.event.extendedProps.db_id,
                             title : element.event.title ,
                             start : element.event.start,
                              end: element.event.end,
                              description : element.event.extendedProps.description,

                              }
                        console.log(task);
                    },
                    height : 400
                }
            }
        },
        beforeMount(){
            this.getTasks();
        },
        mounted(){
            console.log('prop = ' + this.pri);
        }
    }
