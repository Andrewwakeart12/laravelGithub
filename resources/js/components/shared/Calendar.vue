

<template>
<div width="200">
    <FullCalendar :options="calendarOptions" :events="calendarOptions.events"></FullCalendar>

</div>
</template>

<script>
    import '@fullcalendar/core/vdom';
import FullCalendar from  '@fullcalendar/vue';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import {route} from '../../routes.js';
    export default {
        components: {
            FullCalendar
        },
        methods:{
                     handleClickEvent(e){
                         console.log(e);
                    },
                    getApiKey(){
                    axios
                    .post(route('getApiKey'))
                    .then(response=> {
                    this.api_key = response.data;
                    this.getEvents();
                    });
                    }
                    ,
                    getEvents(){
                         axios
                    .get(route('events'))
                    .then(response=> {
                    this.calendarOptions.events = response.data.Events;
                    console.log(response.data.Events);
                    });
                    },
                    getTokenJson(ApiKey){
                        var token = {api_tokne: ApiKey};
                        return token;
                    }
        },
        data(){
            return {
                api_key:[],
                calendarOptions: {

                    plugins:[dayGridPlugin, interactionPlugin],
                    initialView:'dayGridMonth',
                    dateClick: this.handleClick,
                    dayMaxEvents: 2,
                    eventClick: this.handleClickEvent,
                    events : this.getEvents()
                }
            }
        },
        beforeMount(){
            this.getApiKey();
        }
    }
</script>
