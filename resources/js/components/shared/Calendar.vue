

<template>
    <div class>
 <FullCalendar :options="calendarOptions" :events="calendarOptions.events"></FullCalendar>
<div>

<b-modal v-model="modalShow">Hello From modal</b-modal>
</div>

</div>

</template>

<script>
    import '@fullcalendar/core/vdom';
import FullCalendar from  '@fullcalendar/vue';
import listPlugin from  '@fullcalendar/list';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import {route} from '../../routes.js';
    export default {
        components: {
            FullCalendar
        },
        methods:{
                     handleClickEvent(e){
                         console.log(e.event.start)
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
