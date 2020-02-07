<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="700px">
        <v-card>
            <v-card-title>
                <span class="headline text-center" style="margin: auto;">Create Task</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout row wrap>
                        <v-flex sm12>
                            <v-card-text>
                                <div>
                                    <label for="">Task Name</label>
                                    <el-input placeholder="Task Name" v-model="form.task_name"></el-input>
                                </div>
                                <div class="block">
                                    <span class="demonstration">Start Date</span>
                                    <el-date-picker v-model="form.start_date" type="date" placeholder="Pick a day" style="width: 100%;">
                                    </el-date-picker>
                                </div>
                                <div class="block">
                                    <span class="demonstration">Due Date</span>
                                    <el-date-picker v-model="form.due_date" type="date" placeholder="Pick a day" style="width: 100%;">
                                    </el-date-picker>
                                </div>
                                <div class="block">
                                    <span class="demonstration">Reminder</span>
                                    <el-date-picker v-model="form.reminder_date" type="date" placeholder="Pick a day" style="width: 100%;">
                                    </el-date-picker>
                                </div>
                                <div>
                                    <label for="">Priority</label>
                                    <el-select v-model="form.priority" placeholder="Select" style="width: 100%;">
                                        <el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value">
                                        </el-option>
                                    </el-select>
                                </div>
                                <div>
                                    <label for="">Status</label>
                                    <el-select v-model="form.status" placeholder="Select" style="width: 100%;">
                                        <el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value">
                                        </el-option>
                                    </el-select>
                                </div>
                                <div>
                                    <label for="">Task Description</label>
                                    <vue-editor v-model="form.description"></vue-editor>
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
import { VueEditor } from "vue2-editor";
export default {
    components: {
        VueEditor,
    },
    data: () => ({
        dialog: false,
        loading: false,
        form: {},
        payload: {
            model: 'tasks',
            data: null,
        },
    }),
    created() {
        eventBus.$on("openCreateTaskType", data => {
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
