<template>
<v-content>
    <!-- <vue-topprogress ref="topProgress"></vue-topprogress> -->
    <v-container fluid fill-height>
        <v-layout justify-center align-center row wrap>
            <v-flex sm12>
                <div class="col-md-12">

                    <div class="row">
                        <div class="col-12 col-sm-3 col-xl-3 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="text-white mt-3">Employees</p>
                                            <p class="text-white mt-3">34</p>
                                            <!-- <h6 class="text-muted">Since last last week</h6> -->
                                        </div>
                                        <div class="icon-box icon-box-bg-image-warning">
                                            <v-icon color="indigo lighten-5">people</v-icon>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 col-xl-3 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="text-white mt-3">Departments</p>
                                            <p class="text-white mt-3">6</p>
                                            <!-- <h6 class="text-muted">Since {{ client.start_day }}</h6> -->
                                        </div>
                                        <div class="icon-box icon-box-bg-image-info">
                                            <v-icon color="white lighten-3">house</v-icon>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 col-xl-3 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="text-white mt-3">Present</p>
                                            <p class="text-white mt-3">33</p>
                                            <!-- <h6 class="text-muted">Since {{ client.start_day }}</h6> -->
                                        </div>
                                        <div class="icon-box icon-box-bg-image-danger">
                                            <v-icon color="white">offline_pin</v-icon>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 col-xl-3 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="text-white mt-3">Absent</p>
                                            <p class="text-white mt-3">1</p>
                                            <!-- <h6 class="text-muted">Since {{ client.start_day }}</h6> -->
                                        </div>
                                        <div class="icon-box icon-box-bg-image-success">
                                            <v-icon color="grey lighten-1">cancel_presentation</v-icon>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <v-card>
                    <v-card-title primary-title>
                        Today Attendance
                    </v-card-title>
                    <v-card-text>
                        <table class="table table-bordered table-dark table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">In time</th>
                                    <th scope="col">Out Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Jane Doe</td>
                                    <td>0800</td>
                                    <td>1700</td>
                                </tr>
                            </tbody>
                        </table>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</v-content>
</template>

<script>
// import myChart from '../charts/Screen'
// import {
//     vueTopprogress
// } from "vue-top-progress";
export default {
    // props: ['total', 'delivered', 'client'],
    components: {
        // myChart,
        // vueTopprogress
    },
    data() {
        return {
            total: null,
            delivered: null,
            client: [],
            clients: [],
        }
    },
    methods: {
        get_data() {
            eventBus.$emit('screenProgressEvent')
            axios.get('get_data')
                .then(response => {
                    eventBus.$emit('screenStopProgressEvent')
                    this.total = response.data.total
                    this.client = response.data.client
                    this.delivered = response.data.delivered
                    // eventBus.$emit('refreshChartEvent')
                    eventBus.$emit('getChartEvent', this.client)
                })
                .catch(error => {
                    eventBus.$emit('screenStopProgressEvent')
                    this.loading = false;
                    this.errors = error.response.data.errors;
                });
        },
        get_filter_data() {
            eventBus.$emit('refreshChartEvent')
            // console.log(id);
            eventBus.$emit('screenProgressEvent')
            axios.get(`get_filter_data/${this.client.id}`)
                .then(response => {
                    eventBus.$emit('screenStopProgressEvent')
                    this.total = response.data.total
                    this.client = response.data.client
                    this.delivered = response.data.delivered
                    eventBus.$emit('refreshChartEvent')
                })
                .catch(error => {
                    eventBus.$emit('screenStopProgressEvent')
                    this.loading = false;
                    this.errors = error.response.data.errors;
                });
        },
        getClients() {
            axios.get('clients')
                .then(response => {
                    this.clients = response.data
                })
                .catch(error => {
                    this.loading = false;
                    this.errors = error.response.data.errors;
                });
        }
    },
    computed: {
        delivered_perc() {
            return parseFloat((parseInt(this.delivered) / parseInt(this.total)) * 100).toFixed(2)
        },
        expected_del() {
            return parseInt(parseInt(this.total) * 60 / 100)
        },
        remaining_del() {
            return parseInt(this.expected_del - parseInt(this.delivered))
        },
        remaining_per() {
            return parseFloat(60 - this.delivered_perc).toFixed(2)
        },
    },
    mounted() {
        // this.get_data();
        // this.getClients();
    },
    created() {
        // this.timer = window.setInterval(() => {
        //     this.get_filter_data();
        //     // eventBus.$emit('refreshChartEvent')
        // }, 60000);
        // eventBus.$on("screenStopProgressEvent", data => {
        //     this.$refs.topProgress.done();
        // });

        // eventBus.$on("screenProgressEvent", data => {
        //     this.$refs.topProgress.start();
        // });
    },
    // beforeDestroy() {
    //     clearInterval(this.timer);
    // },
}
</script>

<style scoped>
.card-stats {
    margin-top: -10px;
    padding: 10px 0;
}

.progress-Ship {
    margin-top: 100px !important;
}

.v-icon {
    font-size: 50px !important;
}

.v-icon {
    /* box-shadow: 0 9px 30px -6px #fff; */
    box-shadow: -2px -3px 17px 7px #1d4dd47a;
    padding: 5px;
    border-radius: 50%;
}

.info-title {
    margin-top: 20px;
}

.card .card-body {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: rgb(52, 58, 64) !important;
    background-clip: border-box;
    border: 1px solid #313452;
    border-radius: 0;
}
</style>
