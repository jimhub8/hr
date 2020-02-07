<template>
<v-app id="inspire">
    <v-navigation-drawer v-model="drawer" :clipped="clipped" app>

        <v-list dense id="navigation">
            <v-img :aspect-ratio="16/9" src="/storage/landS.jpg">
                <v-layout pa-2 column fill-height class="lightbox white--text">
                    <v-spacer></v-spacer>
                    <v-flex shrink>
                        <div class="subheading">{{ user.name }}</div>
                        <div class="body-1">{{ user.email }}</div>
                    </v-flex>
                </v-layout>
            </v-img>
            <template>
                <v-card>
                    <router-link to="/" class="v-list-item v-list-item--link theme--light">
                        <div class="v-list__tile__action">
                            <v-icon>dashboard</v-icon>
                        </div>
                        <div class="v-list-item__content">
                            <div class="v-list-item__title">Dashboard</div>
                        </div>
                    </router-link>
                    <router-link to="/expenses" class="v-list-item v-list-item--link theme--light">
                        <div class="v-list__tile__action">
                            <v-icon>explicit</v-icon>
                        </div>
                        <div class="v-list-item__content">
                            <div class="v-list-item__title">Requisition</div>
                        </div>
                    </router-link>
                    <router-link to="/tasks" class="v-list-item v-list-item--link theme--light">
                        <div class="v-list__tile__action">
                            <v-icon>work</v-icon>
                        </div>
                        <div class="v-list-item__content">
                            <div class="v-list-item__title">Tasks</div>
                        </div>
                    </router-link>
                    <router-link to="/warnings" class="v-list-item v-list-item--link theme--light">
                        <div class="v-list__tile__action">
                            <v-icon>warning</v-icon>
                        </div>
                        <div class="v-list-item__content">
                            <div class="v-list-item__title">Warnings</div>
                        </div>
                    </router-link>

                    <router-link to="/complains" class="v-list-item v-list-item--link theme--light">
                        <div class="v-list__tile__action">
                            <v-icon>compare_arrows</v-icon>
                        </div>
                        <div class="v-list-item__content">
                            <div class="v-list-item__title">Complains</div>
                        </div>
                    </router-link>

                    <v-list-group prepend-icon="calendar_view_day">
                        <template v-slot:activator>
                            <v-list-item-title>Attendance</v-list-item-title>
                        </template>
                        <router-link to="/attendance" class="v-list-item v-list-item--link theme--light">
                            <div class="v-list__tile__action">
                                <v-icon>picture_in_picture_alt</v-icon>
                            </div>
                            <div class="v-list-item__content">
                                <div class="v-list-item__title">Attendance</div>
                            </div>
                        </router-link>
                        <router-link to="/calendar" class="v-list-item v-list-item--link theme--light">
                            <div class="v-list__tile__action">
                                <v-icon>calendar_today</v-icon>
                            </div>
                            <div class="v-list-item__content">
                                <div class="v-list-item__title">Calendar</div>
                            </div>
                        </router-link>
                    </v-list-group>
                    <v-list-group prepend-icon="account_circle">
                        <template v-slot:activator>
                            <v-list-item-title>Leave</v-list-item-title>
                        </template>
                        <router-link to="/Leave" class="v-list-item v-list-item--link theme--light">
                            <div class="v-list__tile__action">
                                <v-icon>book</v-icon>
                            </div>
                            <div class="v-list-item__content">
                                <div class="v-list-item__title">Leave</div>
                            </div>
                        </router-link>
                        <router-link to="/leave_type" class="v-list-item v-list-item--link theme--light">
                            <div class="v-list__tile__action">
                                <v-icon>business</v-icon>
                            </div>
                            <div class="v-list-item__content">
                                <div class="v-list-item__title">Leave Type</div>
                            </div>
                        </router-link>
                    </v-list-group>

                    <v-list-group prepend-icon="account_circle">
                        <template v-slot:activator>
                            <v-list-item-title>Users</v-list-item-title>
                        </template>
                        <router-link to="/users" class="v-list-item v-list-item--link theme--light">
                            <div class="v-list__tile__action">
                                <v-icon>people_outline</v-icon>
                            </div>
                            <div class="v-list-item__content">
                                <div class="v-list-item__title">Users</div>
                            </div>
                        </router-link>
                        <router-link to="/roles" class="v-list-item v-list-item--link theme--light">
                            <div class="v-list__tile__action">
                                <v-icon>gavel</v-icon>
                            </div>
                            <div class="v-list-item__content">
                                <div class="v-list-item__title">Roles</div>
                            </div>
                        </router-link>
                    </v-list-group>

                    <v-list-group prepend-icon="settings_applications">
                        <template v-slot:activator>
                            <v-list-item-title>App Settings</v-list-item-title>
                        </template>
                        <router-link to="/app" class="v-list-item v-list-item--link theme--light">
                            <div class="v-list__tile__action">
                                <v-icon>apps</v-icon>
                            </div>
                            <div class="v-list-item__content">
                                <div class="v-list-item__title">App</div>
                            </div>
                        </router-link>
                        <router-link to="/shift" class="v-list-item v-list-item--link theme--light">
                            <div class="v-list__tile__action">
                                <v-icon>filter_tilt_shift</v-icon>
                            </div>
                            <div class="v-list-item__content">
                                <div class="v-list-item__title">Shifts</div>
                            </div>
                        </router-link>
                    </v-list-group>
                </v-card>
            </template>
        </v-list>
    </v-navigation-drawer>

    <v-app-bar :clipped-left="clipped" app color="blue darken-3" dark>
        <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
        <v-toolbar-title style="width: 300px" class="ml-0 pl-4">
            {{ app_show.app_name }}
            <img :src="app_show.logo" alt style="width: 130px; height: 60px;border-radius: 20px;">
        </v-toolbar-title>
        <v-spacer />
        <div @click="check_in" style="cursor: pointer">
            <digital-clock displaySeconds="true" :blink="true" id="clock" />
        </div>
        <Logout :user="user"></Logout>
        <!-- <VDivider vertical style="margin-top: 0px;" /> -->
        <!-- <v-badge color="black" right overlap>
            <template v-slot:badge>
                {{ notifications.length }}
            </template>
            <v-btn icon @click.stop="drawerRight = !drawerRight">
                <v-icon color="white lighten-1" large>
                    notifications
                </v-icon>
            </v-btn>
        </v-badge> -->
    </v-app-bar>

    <v-snackbar :timeout="timeout" bottom :color="Snackcolor" right v-model="snackbar">
        {{ message }}
        <v-icon dark right>{{ icon }}</v-icon>
    </v-snackbar>
    <v-footer style="background: #e2e0e0 !important;" app>
        <span style="color: #000; margin: auto;">Mft fulfillment center &copy; {{ new Date().getFullYear() }}</span>
    </v-footer>
</v-app>
</template>

<script>
import Logout from "./Logout";
import DigitalClock from "vue-digital-clock";
export default {
    components: {
        Logout,
        DigitalClock
    },
    props: ["user"],
    data() {
        return {
            clipped: true,
            icon: "",
            Snackcolor: '',
            color: "rgb(25, 117, 210)",
            loading: false,
            drawer: true,
            drawerRight: false,
            right: null,
            mode: "",
            snackbar: false,
            timeout: 5000,
            message: "Success",
            dif_: null,
            location_coordinates: {
                long: 36.900340899999996,
                lat: -1.3016203,
            }
        };
    },
    methods: {
        successAlert(data) {
            // this.message = data;
            // this.Snackcolor = "black";
            // this.snackbar = true;
            // this.icon = 'check_circle'
            this.$message({
                showClose: true,
                message: data,
                type: 'success'
            });
        },

        errorAlert(data) {
            // this.message = data;
            // this.Snackcolor = "red";
            // this.snackbar = true;
            // this.icon = 'block'
            this.$message({
                showClose: true,
                message: data,
                type: 'error'
            });
        },
        openFullScreen() {
            this.loading = this.$loading({
                lock: true,
                text: 'Loading',
                spinner: 'el-icon-loading',
                background: 'rgba(0, 0, 0, 0.7)'
            });
        },
        closeFullScreen() {
            this.loading.close();
        },
        getnotifications() {
            this.$store.dispatch('getnotifications')
        },

        // Location

        check_in() {
            if (navigator.geolocation) {
                var self = this;
                var c = {}
                navigator.geolocation.getCurrentPosition(function (position) {
                    // console.log(position);

                    self.location = position;
                    // console.log(position.coords);
                    // console.log(self.location);

                    self.distance_(position)
                    // console.log(position.coords.latitude, position.coords.longitude)
                })

            }
        },

        getDifference() {
            // console.log(lat1, lng1);

            var lat1 = this.location.lat
            var lng1 = this.location.long

            var lat2 = this.location_coordinates.lat
            var lng2 = this.location_coordinates.long
            console.log(lat1, lng1, lat2, lng2);
            var R = 6371; // km
            var dLat = toRad(lat2 - lat1);
            var dLon = toRad(lon2 - lon1);
            var lat1 = toRad(lat1);
            var lat2 = toRad(lat2);

            var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.sin(dLon / 2) * Math.sin(dLon / 2) * Math.cos(lat1) * Math.cos(lat2);
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            var d = R * c;
            return d;
        },

        // Converts numeric degrees to radians
        toRad(Value) {
            return Value * Math.PI / 180;
        },

        distance_(position) {
            // console.log(this.location.coords.latitude);
            // console.log(position.coords);

            var unit = 'K'
            var lat1 = position.coords.latitude
            var lon1 = position.coords.longitude

            var lat2 = this.location_coordinates.lat
            var lon2 = this.location_coordinates.long
            // console.log(lat1, lon1, lat2, lon2);

            var payload = {
                data: {
                    lat1: lat1,
                    lon1: lon1,
                    lat2: lat2,
                    lon2: lon2,
                },
                model: 'attendance',
            }
            this.$store.dispatch('getDistance', payload)

            return

            if ((lat1 == lat2) && (lon1 == lon2)) {
                return 0;
            } else {
                var radlat1 = Math.PI * lat1 / 180;
                var radlat2 = Math.PI * lat2 / 180;
                var theta = lon1 - lon2;
                var radtheta = Math.PI * theta / 180;
                var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
                if (dist > 1) {
                    dist = 1;
                }

                dist = Math.acos(dist);
                dist = dist * 180 / Math.PI;
                dist = dist * 60 * 1.1515;
                if (unit == "K") {
                    dist = dist * 1.609344
                }
                if (unit == "N") {
                    dist = dist * 0.8684
                }
                // console.log(dist);
                this.dif_ = dist;
            }
        },

        getApp() {
            var payload = {
                model: 'app_details',
                update_list: 'updateAppShowList',
                id: 1,
            }

            // this.payload.data = this.form
            this.$store.dispatch('getShowData', payload).then((res) => {
                eventBus.$emit("appEvent");
            })
        },
    },
    created() {
        eventBus.$on("progressEvent", data => {
            this.$Progress.start()
        });
        eventBus.$on("StoprogEvent", data => {
            this.$Progress.finish()
        });
        eventBus.$on("alertRequest", data => {
            this.successAlert(data)
        });
        eventBus.$on("errorEvent", data => {
            this.errorAlert(data)
        });
        eventBus.$on("LoadingEvent", data => {
            // this.openFullScreen(data)
        });
        eventBus.$on("stopLoadingEvent", data => {
            // this.closeFullScreen(data)
        });

        eventBus.$on("notificationCountEvent", data => {
            this.notification = data
        });
    },
    computed: {
        notifications() {
            return this.$store.getters.notifications
        },
        app_show() {
            return this.$store.getters.app_show
        }
    },
    mounted() {
        this.getApp()
        // this.getnotifications();
    },

};
</script>

<style scoped>
.v-expansion-panel__container:hover {
    border-radius: 10px !important;
    width: 90% !important;
    margin-left: 15px !important;
    background: #e3edfe !important;
    color: #1a73e8 !important;
}

.theme--light {
    background-color: #212120 !important;
    /* background: url('storage/logo1.jpg') !important; */
    color: #fff !important;
}

.v-toolbar[data-booted=true] {
    transition: .2s cubic-bezier(.4, 0, .2, 1);
    z-index: 100 !important;
}

.theme--light[data-v-67cb1297] {
    z-index: 101 !important;
}

.theme--dark.v-btn:not(.v-btn--text):not(.v-btn--text):not(.v-btn--outlined) {
    background-color: transparent !important;
}

#clock {
    margin-right: 70px;
    width: 95px;
    font-size: 22px;
    font-family: "LatoWeb";
    height: 45px;
    position: absolute;
    border-radius: 4px;
    right: 25px;
    top: 6px;
    width: 145px;
    padding: 10px;
    padding-right: 5px;
    border: 0;
    box-shadow: 0px 0px 4px 0px #ccc;
    background: #122f51;
    text-align: center;
}
</style>
