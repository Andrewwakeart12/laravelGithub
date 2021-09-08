

<template>
    <div class>
 <FullCalendar :options="calendarOptions" :events="calendarOptions.events"></FullCalendar>
<div>

<b-modal v-model="modalShow">
    <div class="col-12 row">
        <h2>{{this.event.title}}</h2>
        </br>
        <input  type="hidden" v-if="this.task.extendedProps" v-model="task.extendedProps.db_id" />
        <p v-if="this.task.extendedProps">{{this.task.extendedProps.description}}</p>
        <b-form-datepicker  v-model="task.start" @input="tChange"></b-form-datepicker>
        <b-form-datepicker  v-model="task.end" @input="tChange"></b-form-datepicker>
    </div>
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
                deleteTask(id){
                     this.calendarOptions.events.forEach(element =>{
                        if(element.db_id == id){
                            element = null;
                        }
                    });
                    this.modalShow= false;

                },
                tChange(){
                    console.log(this.calendarOptions.events);
                    this.calendarOptions.events.forEach(element =>{
                        if(element.id == this.task.id){
                             console.log('watcher: ' + this.task.start);
                            element.start = this.task.start;
                            element.end = this.task.end;
                            console.log(element.db_id);
                        }
                    });

        },
                     handleClickEvent(e){
                         if(e.event){
                         this.event=e.event;
                         this.$set(this.task, 'id', e.event.id);
                         this.$set(this.task, 'extendedProps', e.event.extendedProps);
                         this.$set(this.task, 'start', e.event.start);
                         this.$set(this.task, 'end', e.event.end);
                         }
                         this.modalShow = true;
                    },
                    getApiKey()
                    {
                        axios
                        .post(route('getApiKey'))
                        .then(response=>
                            {
                                this.api_key = response.data;
                                this.getTasks();
                            });
                    }
                    ,
                    getTasks(){
                         axios
                    .get(route('task.index'))
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
                    getTokenJson(ApiKey){
                        var token = {api_tokne: ApiKey};
                        return token;
                    }
        },
        props:['prop'],
        data(){
            return {
                modalShow:false,
                api_key:[],
                event:[],
                pri: this.prop,
                task:{
                },
                calendarOptions: {

                    plugins:[dayGridPlugin, interactionPlugin],
                    dateClick: this.handleClick,
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
            this.getApiKey();
        },
        mounted(){
            console.log('prop = ' + this.pri);
        }
    }
</script>
