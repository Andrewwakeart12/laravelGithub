

<template>
    <div class>
 <FullCalendar :options="calendarOptions" :events="calendarOptions.events"></FullCalendar>
<div>

<b-modal v-model="modalShow">
    <div class="col-12 row" >
        <h2 v-if="this.task.title">{{this.event.title}}</h2>
        </br>
        <input  type="hidden" v-if="this.task.extendedProps" v-model="task.extendedProps.db_id" />
        <p                    v-if="this.task.extendedProps">{{this.task.extendedProps.description}}</p>
        <b-form-datepicker     v-model="task.start" @input="tChange"></b-form-datepicker>
        <b-form-datepicker     v-model="task.end" @input="tChange"></b-form-datepicker>
    </div>
</b-modal>
<b-modal title="Create Task"v-model="createTaskModal" >
    <div class="form" >

        <h2>{{this.event.title}}</h2>
        </br>
        <input  type="hidden" v-if="this.task.extendedProps"  v-model="task.extendedProps.db_id" />
        <b-form-label for="title">Title</b-form-label>
        <b-form-input @input="tChange" class="form-group h3" type="text" v-model="task.title" placeholdre="title"/>
        <b-form-label for="description">Description</b-form-label>
        <b-form-textarea @input="tChange" name="description" v-model="task.description" cols="50" rows="5" max-rows="10"></b-form-textarea>

            <b-form-datepicker  class="m-2"   v-model="task.start" @input="tChange"></b-form-datepicker>
        <b-form-datepicker  class="m-2"   v-model="task.end" @input="tChange"></b-form-datepicker>


    </div>
<template #modal-footer="{guardar,cancel}">
    <b-button size="sm" variant="success" @click="save()">Guardar</b-button>
    <b-button size="sm" variant="warning" @click="cancel()">Cancelar</b-button>
    <b-button size="sm" variant="warning" @click="deleteTask()">Delete</b-button>
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

        methods:{
                save(){
                                        this.task.db_id = this.calendarOptions.events.length + 1;
                                        this.task.id = 'eventId_'+  this.calendarOptions.events.length + 1;
                                        this.calendarOptions.events.push(this.task) ;
                                         this.$set(this.calendarOptions.events);
                                        console.log(this.calendarOptions.events);
                                         this.$set(this.task, 'id');
                                         this.task = {};
                   },
                deleteTask(id){
                     this.calendarOptions.events.forEach(element =>{
                        if(element.db_id == id){
                            element = null;
                        }
                    });
                    this.modalShow= false;

                },
                tChange(){
                    console.log('task: ')
;                    console.log(this.task);
                    if(this.task.extendedProps){

                    this.calendarOptions.events.forEach(element =>{
                        if(element.db_id == this.task.extendedProps.db_id){
                             console.log('watcher: ' + this.task.start);
                            element.start = this.task.start;
                            element.end = this.task.end;
                            console.log(element.db_id);
                        }
                    });
                    }else{
                         console.log(this.task);
                    }

        },
                     handleClickEvent(e){
                         if(e.event){
                             this.task={};
                         this.event=e.event;
                         this.$set(this.task, 'id', e.event.id);
                         this.$set(this.task, 'title', e.event.title);
                         this.$set(this.task, 'extendedProps', e.event.extendedProps);
                         this.$set(this.task, 'start', e.event.start);
                         this.$set(this.task, 'end', e.event.end);
                         }
                         console.log(e.event);
                         this.modalShow = true;
                    }
                    ,
                    handleClickDate(e){
                         console.log(e)
                         this.$set(this.task, 'id');
                         this.$set(this.task, 'title');
                         this.$set(this.task, 'extendedProps');
                         this.$set(this.task, 'start',e.date);
                         this.$set(this.task, 'end');
                         this.createTaskModal = true;
                    }
                    ,
                    getTasks(){
                        var token = this.getTokenJson();
                        console.log(token);
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
                    });
                    },
                    getTokenJson(){
                        var token = {api_token: this.$apiKey};
                        return token;
                    }
        },
        props:['prop'],
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
                        var task= {
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
</script>
