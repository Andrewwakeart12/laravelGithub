

<template>
    <div class>
 <FullCalendar :options="calendarOptions" :events="calendarOptions.events"></FullCalendar>
<div>

<b-modal v-model="modalShow">
    <div class="col-12 row">
        <h2>{{this.event.title}}</h2>
        </br>
        <p v-if="this.event.extendedProps">{{this.event.extendedProps.description}}</p>
        <b-form-datepicker v-model="this.event.start"></b-form-datepicker>
        <b-form-datepicker v-model="this.event.end"></b-form-datepicker>
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
                     handleClickEvent(e){
                         this.event=e.event;
                         console.log(e.event.extendedProps);
                         this.modalShow = true;
                    },
                    getApiKey(){
                    axios
                    .post(route('getApiKey'))
                    .then(response=> {
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
                            id: 'eventId_'+element.id,
                             title : element.event_name ,
                             start : element.event_start,
                              end: element.event_end,
                              allDay : false,
                              editable : true,
                              description : element.event_description
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
        data(){
            return {
                modalShow:false,
                api_key:[],
                event:[],
                calendarOptions: {

                    plugins:[dayGridPlugin, interactionPlugin],
                    dateClick: this.handleClick,
                    dayMaxEvents: 2,
                    eventClick: this.handleClickEvent,
                    events : [],
                    eventDidMount : function(info){
                        console.log(info.event.start);
                    },
                    height : 400
                }
            }
        },
        beforeMount(){
            this.getApiKey();
        }
    }
</script>
