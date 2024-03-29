<template>
<v-content>
    <v-container fluid fill-height>
        <v-tooltip right>
            <template v-slot:activator="{ on }">
                <v-btn icon v-on="on" slot="activator" class="mx-0" @click="getAttendance(0)">
                    <v-icon color="blue darken-2" small>refresh</v-icon>
                </v-btn>
            </template>
            <span>Refresh</span>
        </v-tooltip>
        <div>
            <label for="">Users</label>
            <el-select v-model="form.users" clearable filterable remote reserve-keyword placeholder="type at least 3 characters" :remote-method="getUsers" :loading="loading" style="width: 100%;" @change="getAttendance">
                <el-option v-for="item in users.data" :key="item.id" :label="item.name" :value="item.id">
                </el-option>
            </el-select>
        </div>
        <v-row class="fill-height" justify-center wrap>
            <v-col>
                <v-sheet height="64">
                    <v-toolbar flat color="white">
                        <v-btn outlined class="mr-4" color="grey darken-2" @click="setToday">
                            Today
                        </v-btn>
                        <v-btn fab text small color="grey darken-2" @click="prev">
                            <v-icon small>mdi-chevron-left</v-icon>
                        </v-btn>
                        <v-btn fab text small color="grey darken-2" @click="next">
                            <v-icon small>mdi-chevron-right</v-icon>
                        </v-btn>
                        <v-toolbar-title>{{ title }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-menu bottom right>
                            <template v-slot:activator="{ on }">
                                <v-btn outlined color="grey darken-2" v-on="on">
                                    <span>{{ typeToLabel[type] }}</span>
                                    <v-icon right>mdi-menu-down</v-icon>
                                </v-btn>
                            </template>
                            <v-list>
                                <v-list-item @click="type = 'day'">
                                    <v-list-item-title>Day</v-list-item-title>
                                </v-list-item>
                                <v-list-item @click="type = 'week'">
                                    <v-list-item-title>Week</v-list-item-title>
                                </v-list-item>
                                <v-list-item @click="type = 'month'">
                                    <v-list-item-title>Month</v-list-item-title>
                                </v-list-item>
                                <v-list-item @click="type = '4day'">
                                    <v-list-item-title>4 days</v-list-item-title>
                                </v-list-item>
                            </v-list>
                        </v-menu>
                    </v-toolbar>
                </v-sheet>
                <v-sheet height="600">
                    <v-calendar ref="calendar" v-model="focus" color="primary" :events="attendances" :event-color="getEventColor" :now="today" :type="type" @click:event="showEvent" @click:more="viewDay" @click:date="viewDay" @change="updateRange" @click:day="apply_leave"></v-calendar>
                    <v-menu v-model="selectedOpen" :close-on-content-click="false" :activator="selectedElement" offset-x>
                        <v-card color="grey lighten-4" min-width="350px" flat>
                            <v-toolbar :color="selectedEvent.color" dark>

                                <v-toolbar-title v-html="selectedEvent.name"></v-toolbar-title>
                                <v-spacer></v-spacer>
                            </v-toolbar>
                            <v-card-text>
                                <span v-html="selectedEvent.details"></span>
                            </v-card-text>
                            <v-card-actions>
                                <v-btn text color="secondary" @click="selectedOpen = false">
                                    Cancel
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-menu>
                </v-sheet>
            </v-col>
        </v-row>
    </v-container>
    <myCreate></myCreate>
</v-content>
</template>

<script>
import myCreate from '../leave/create'
export default {
    components: {
        myCreate,
    },
    data: () => ({
        form: {},
        focus: '',
        today: '',
        type: 'month',
        typeToLabel: {
            month: 'Month',
            week: 'Week',
            day: 'Day',
            '4day': '4 Days',
        },
        start: null,
        end: null,
        selectedEvent: {},
        selectedElement: null,
        selectedOpen: false,
        events: [],
        colors: ['blue', 'indigo', 'deep-purple', 'cyan', 'green', 'orange', 'grey darken-1'],
        names: ['Meeting', 'Holiday', 'PTO', 'Travel', 'Event', 'Birthday', 'Conference', 'Party'],
    }),
    computed: {
        loading() {
            return this.$store.getters.loading
        },
        attendances() {
            return this.$store.getters.attendances
        },
        users() {
            return this.$store.getters.users
        },
        title() {
            const {
                start,
                end
            } = this
            if (!start || !end) {
                return ''
            }

            const startMonth = this.monthFormatter(start)
            const endMonth = this.monthFormatter(end)
            const suffixMonth = startMonth === endMonth ? '' : endMonth

            const startYear = start.year
            const endYear = end.year
            const suffixYear = startYear === endYear ? '' : endYear

            const startDay = start.day + this.nth(start.day)
            const endDay = end.day + this.nth(end.day)

            switch (this.type) {
                case 'month':
                    return `${startMonth} ${startYear}`
                case 'week':
                case '4day':
                    return `${startMonth} ${startDay} ${startYear} - ${suffixMonth} ${endDay} ${suffixYear}`
                case 'day':
                    return `${startMonth} ${startDay} ${startYear}`
            }
            return ''
        },
        monthFormatter() {
            return this.$refs.calendar.getFormatter({
                timeZone: 'UTC',
                month: 'long',
            })
        },
    },
    mounted() {
        this.$refs.calendar.checkChange()
        this.getAttendance(0);
    },
    methods: {
        viewDay({
            date
        }) {
            this.focus = date
            this.type = 'day'
        },
        getEventColor(event) {
            return event.color
        },
        setToday() {
            this.focus = this.today
        },
        prev() {
            this.$refs.calendar.prev()
        },
        next() {
            this.$refs.calendar.next()
        },
        showEvent({
            nativeEvent,
            event
        }) {
            const open = () => {
                this.selectedEvent = event
                this.selectedElement = nativeEvent.target
                setTimeout(() => this.selectedOpen = true, 10)
            }

            if (this.selectedOpen) {
                this.selectedOpen = false
                setTimeout(open, 10)
            } else {
                open()
            }

            nativeEvent.stopPropagation()
        },
        updateRange({
            start,
            end
        }) {
            const events = []

            const min = new Date(`${start.date}T00:00:00`)
            const max = new Date(`${end.date}T23:59:59`)
            const days = (max.getTime() - min.getTime()) / 86400000
            const eventCount = this.rnd(days, days + 20)

            for (let i = 0; i < eventCount; i++) {
                const allDay = this.rnd(0, 3) === 0
                const firstTimestamp = this.rnd(min.getTime(), max.getTime())
                const first = new Date(firstTimestamp - (firstTimestamp % 900000))
                const secondTimestamp = this.rnd(2, allDay ? 288 : 8) * 900000
                const second = new Date(first.getTime() + secondTimestamp)

                events.push({
                    name: this.names[this.rnd(0, this.names.length - 1)],
                    start: this.formatDate(first, !allDay),
                    end: this.formatDate(second, !allDay),
                    color: this.colors[this.rnd(0, this.colors.length - 1)],
                })
            }

            this.start = start
            this.end = end
            this.events = events
        },
        nth(d) {
            return d > 3 && d < 21 ?
                'th' : ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'][d % 10]
        },
        rnd(a, b) {
            return Math.floor((b - a + 1) * Math.random()) + a
        },
        formatDate(a, withTime) {
            return withTime ?
                `${a.getFullYear()}-${a.getMonth() + 1}-${a.getDate()} ${a.getHours()}:${a.getMinutes()}` :
                `${a.getFullYear()}-${a.getMonth() + 1}-${a.getDate()}`
        },
        getAttendance(data) {

            var payload = {
                model: 'attendance',
                update_list: 'updateAttendancesList',
                id: data,
            }
            this.$store.dispatch("getShowData", payload);
        },

        getUsers(query) {
            var payload = {
                model: 'searchUsers',
                update: 'updateUsersList',
                search: query
            }
            this.$store.dispatch("searchItems", payload);
            // if (query.length > 2) {
            //     this.loading = true;
            //     this.form.search = query
            //     axios.get(`searchClient/${query}`).then((response) => {
            //         this.loading = false
            //         this.clients = response.data

            //     }).catch((error) => {
            //         this.loading = true;
            //     })
            // }
        },
        apply_leave(data) {
            eventBus.$emit('openCreateLeave', data)
        }
    },
}
</script>
