<template>
<v-content>
    <v-container fluid fill-height>
        <v-row justify-center>
            <v-card class="mx-auto" tile style="width: 100%">
                <v-card-title primary-title>
                    <div style="width: 100%">
                        <v-avatar style="width: 100px !important; height: 100px !important;">
                            <img src="https://cdn.vuetifyjs.com/images/john.jpg" alt="John">
                        </v-avatar>
                    </div>
                    <div style="width: 88%;text-align: center !important;">
                        <h4 class="text-center">{{ user.name }}</h4>
                        <small class="text-center">{{ user.email }}</small>
                    </div>
                </v-card-title>
                <VDivider />
                <v-card-text>
                    <v-subheader>Today</v-subheader>

                    <v-expansion-panels popout>

                        <v-expansion-panel hide-actions>
                            <v-expansion-panel-header>
                                PROFESSIONAL EXPERIENCE
                            </v-expansion-panel-header>

                            <v-expansion-panel-content>
                                <v-tooltip bottom>
                                    <template v-slot:activator="{ on }">
                                        <v-btn v-on="on" icon class="mx-0" @click="openDialog('expirience')" slot="activator">
                                            <v-icon small color="blue darken-2">add</v-icon>
                                        </v-btn>
                                    </template>
                                    <span>Add expirience</span>
                                </v-tooltip>
                                <v-divider></v-divider>
                                <v-card-text>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores delectus incidunt officia architecto tempore ut enim! Omnis ratione repudiandae libero accusamus, nihil modi fugit saepe accusantium quas tenetur. Laudantium, accusantium!
                                </v-card-text>
                            </v-expansion-panel-content>
                        </v-expansion-panel>

                        <v-expansion-panel hide-actions>
                            <v-expansion-panel-header>
                                PERSONAL INFORMATION
                            </v-expansion-panel-header>

                            <v-expansion-panel-content>

                                <v-tooltip bottom>
                                    <template v-slot:activator="{ on }">
                                        <v-btn v-on="on" icon class="mx-0" @click="openDialog('personal')" slot="activator">
                                            <v-icon small color="blue darken-2">add</v-icon>
                                        </v-btn>
                                    </template>
                                    <span>Add expirience info</span>
                                </v-tooltip>
                                <v-divider></v-divider>
                                <v-card-text>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores delectus incidunt officia architecto tempore ut enim! Omnis ratione repudiandae libero accusamus, nihil modi fugit saepe accusantium quas tenetur. Laudantium, accusantium!
                                </v-card-text>
                            </v-expansion-panel-content>
                        </v-expansion-panel>

                        <v-expansion-panel hide-actions>
                            <v-expansion-panel-header @click="getWarnings">
                                Warnings
                            </v-expansion-panel-header>

                            <v-expansion-panel-content>
                                <v-divider></v-divider>
                                <v-card-text v-if="warnings.data">
                                    <el-table :data="warnings.data.filter(data => !search || data.name.toLowerCase().includes(search.toLowerCase()))" style="width: 100%">
                                        <el-table-column label="Warning against" prop="warning_against"></el-table-column>
                                        <el-table-column label="Warning type" prop="warning_type"></el-table-column>
                                        <el-table-column label="Warning Date" prop="warning_date"></el-table-column>
                                        <el-table-column label="Description" prop="description"></el-table-column>
                                    </el-table>
                                </v-card-text>
                            </v-expansion-panel-content>
                        </v-expansion-panel>

                        <v-expansion-panel hide-actions>
                            <v-expansion-panel-header>
                                Attendance
                            </v-expansion-panel-header>

                            <v-expansion-panel-content>
                                <v-divider></v-divider>
                                <v-card-text v-if="attendances.data">
                                    <el-table :data="attendances.data.filter(data => !search || data.name.toLowerCase().includes(search.toLowerCase()))" style="width: 100%">
                                        <el-table-column label="Warning against" prop="warning_against"></el-table-column>
                                        <el-table-column label="Warning type" prop="warning_type"></el-table-column>
                                        <el-table-column label="Warning Date" prop="warning_date"></el-table-column>
                                        <el-table-column label="Description" prop="description"></el-table-column>
                                    </el-table>
                                </v-card-text>
                            </v-expansion-panel-content>
                        </v-expansion-panel>
                    </v-expansion-panels>
                </v-card-text>
            </v-card>
        </v-row>
    </v-container>
    <myPersonal></myPersonal>
    <myExpirience></myExpirience>
</v-content>
</template>

<script>
import myExpirience from './expirience'
import myPersonal from './personal'
export default {
    components: {
        myPersonal,
        myExpirience
    },
    props: ['user'],
    methods: {
        openDialog(data) {
            eventBus.$emit(data + 'Event')
        },

        getWarnings() {
            var payload = {
                    model: 'warnings',
                    update: 'updateWarningsList',
                    id: this.user.id
                }
                this.$store.dispatch("getShowData", payload);
        },
    },
    computed: {
        warnings() {
            return this.$store.getters.warnings;
        },
        attendances() {
            return this.$store.getters.attendances;
        },
    },
}
</script>
