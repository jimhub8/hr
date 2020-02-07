<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="400px">
        <v-card>
            <v-card-title>
                <span class="headline text-center" style="margin: auto;">Create Shift</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout row wrap>
                        <v-flex sm12>
                            <v-card-text>
                                <div>
                                    <label for="">Work Shift Name </label>
                                    <el-input placeholder="Day" v-model="form.shift_name"></el-input>
                                </div>
                                <div>
                                    <span class="demonstration">Start Time</span>
                                    <el-time-select placeholder="Start time" v-model="form.start_time" :picker-options="{start: '07:30',step: '00:30',end: '20:30'}" style="width:100%">
                                    </el-time-select>
                                </div>
                                <div class="block">
                                    <span class="demonstration">End Time</span>
                                    <el-time-select placeholder="End time" v-model="form.end_time" :picker-options="{start: '07:30',step: '00:30',end: '20:30',minTime: form.start_time}" style="width:100%"> </el-time-select>
                                </div>
                                <div class="block">
                                    <span class="demonstration">Late Count Time</span>
                                    <el-time-select placeholder="Late Count Time" v-model="form.late_count_time" :picker-options="{start: '07:30',step: '00:30',end: '20:30',minTime: form.start_time}" style="width:100%"> </el-time-select>
                                </div>
                            </v-card-text>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-btn color="blue darken-1" text @click="close">Close</v-btn>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="save" :loading="loading" :disabled="loading">Save</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</v-layout>
</template>

<script>
import {
    VueEditor
} from "vue2-editor";
export default {
    components: {
        VueEditor,
    },
    data: () => ({
        dialog: false,
        loading: false,
        form: {},
        payload: {
            model: 'shifts',
            data: null,
        },
    }),
    created() {
        eventBus.$on("openCreateShift", data => {
            this.dialog = true;
        });
    },

    methods: {
        save() {
            this.payload.data = this.form
            this.$store.dispatch('postData', this.payload)
        },
        close() {
            this.dialog = false;
        }
    },
};
</script>
