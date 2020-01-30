<template>
<v-content>
    <v-container fluid fill-height>
        <v-layout justify-center align-center wrap>
            <!-- <FullCalendar defaultView="dayGridMonth" :plugins="calendarPlugins" /> -->
            <!-- <FullCalendar defaultView="dayGridMonth" :plugins="calendarPlugins" :events="[{ title: 'event 1', date: '2020-02-01' },{ title: 'event 2', date: '2020-28-01' }]" /> -->
            <FullCalendar defaultView="dayGridMonth" :plugins="calendarPlugins" :events="[{ title: 'event 1', date: '2020-02-01' },{ title: 'event 2', date: '2020-01-28' }]" selectable="true" @dateClick="handleDateClick" :header="header" />
        </v-layout>
    </v-container>
</v-content>
</template>

<script>
import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'; // for selectable
import timeGrid from '@fullcalendar/timegrid'; // for selectable

export default {
    components: {
        FullCalendar // make the <FullCalendar> tag available
    },
    data() {
        return {
            calendarPlugins: [dayGridPlugin, interactionPlugin, timeGrid],
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
        }
    },
    methods: {
        handleDateClick(arg) {
            console.log(arg.dateStr);
        }
    },
}
</script>
