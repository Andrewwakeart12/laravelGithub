

<template>
<div width="200">
    <FullCalendar :options="calendarOptions"></FullCalendar>

</div>
</template>

<script>
    import '@fullcalendar/core/vdom';
import FullCalendar from  '@fullcalendar/vue';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

    export default {
        components: {
            FullCalendar
        },
        methods:{
                    handleClick : function(arg){
                        console.log(arg);
                    },
                     handleClickEvent : function(arg){
                        console.log(arg);
                    }
        },
        data(){
            return {
                calendarOptions: {
                    plugins:[dayGridPlugin, interactionPlugin],
                    initialView:'dayGridMonth',
                    dateClick: this.handleClick,
                    eventClick: this.handleClickEvent,
                    events:[
                        {title:'event 1', date : '2021-09-01'},
                        {title:'event 2', date : '2021-09-01'},
                        {title:'event 3', date : '2021-09-01'},
                    ]
                }
            }
        }
    }
</script>
