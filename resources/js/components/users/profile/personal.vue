<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="500px">
        <v-card>
            <v-card-title>
                <span class="headline text-center" style="margin: auto;">Personal info</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout row wrap>
                        <v-flex sm12>
                            <v-card-text>
                                <div>
                                    <label for="">Address *</label>
                                    <el-input placeholder="address" v-model="form.institute"></el-input>
                                </div>
                                <div>
                                    <label for="">Date of Joining *</label>
                                    <el-date-picker v-model="form.joining_date" type="date" placeholder="Pick a day" style="width: 100%;">
                                    </el-date-picker>
                                </div>
                                <div>
                                    <label for="">Date of Birth</label>
                                    <el-date-picker v-model="form.dob" type="date" placeholder="Pick a day" style="width: 100%;">
                                    </el-date-picker>
                                </div>
                                <div>
                                    <label for="">Gender</label>
                                    <el-select v-model="form.gender" placeholder="Select">
                                        <el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value">
                                        </el-option>
                                    </el-select>
                                </div>
                                <div>
                                    <label for="">Religeon</label>
                                    <el-input placeholder="address" v-model="form.religion"></el-input>
                                </div>
                                <div>
                                    <label for="">Marital Status</label>
                                    <el-input placeholder="address" v-model="form.marital_status"></el-input>
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
        form: {},
        payload: {
            model: 'education',
            data: null,
        },
        options: [{
            value: 'Male',
            label: 'Male'
        }, {
            value: 'Female',
            label: 'Female'
        }],
    }),
    created() {
        eventBus.$on("personalEvent", data => {
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
    },
};
</script>
