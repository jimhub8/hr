<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="500px">
        <v-card>
            <v-card-title>
                <span class="headline text-center" style="margin: auto;">Create Announcement</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout row wrap>
                        <v-flex sm12>
                            <v-card-text>
                                <div>
                                    <label for="">Title *</label>
                                    <el-input placeholder="Announcement" v-model="form.announcement"></el-input>
                                </div>
                                <div>
                                    <label for="">Start Date *</label>
                                    <el-date-picker v-model="form.start_date" type="date" placeholder="Pick a day" style="width: 100%;">
                                    </el-date-picker>
                                </div>
                                <div>
                                    <label for="">End Date *</label>
                                    <el-date-picker v-model="form.end_date" type="date" placeholder="Pick a day" style="width: 100%;">
                                    </el-date-picker>
                                </div>
                                <div>
                                    <label for="">Department</label>
                                    <el-select v-model="form.departments" multiple collapse-tags style="width:100%;" placeholder="Select Departments">
                                        <el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value">
                                        </el-option>
                                    </el-select>
                                </div>
                                <div>
                                    <label for="">Announcement Description</label>
                                    <el-input type="textarea" placeholder="Please input" v-model="form.description" maxlength="500" show-word-limit>
                                    </el-input>
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
export default {
    data: () => ({
        dialog: false,
        loading: false,
        form: {
            designations: [],
        },
        payload: {
            model: 'announcements',
            data: null,
        },
        options: [{
            value: 'Option1',
            label: 'Option1'
        }, {
            value: 'Option2',
            label: 'Option2'
        }, {
            value: 'Option3',
            label: 'Option3'
        }, {
            value: 'Option4',
            label: 'Option4'
        }, {
            value: 'Option5',
            label: 'Option5'
        }],
    }),
    created() {
        eventBus.$on("openCreateAnnouncement", data => {
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
        },
        add_new() {
            this.form.designations.push({
                designation_name: ''
            })
        }
    },
};
</script>
