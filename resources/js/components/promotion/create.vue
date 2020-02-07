<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="500px">
        <v-card>
            <v-card-title>
                <span class="headline text-center" style="margin: auto;">Create Promotion</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout row wrap>
                        <v-flex sm12>
                            <v-card-text>
                                <div>
                                    <label for="">Transfer / Promotion For *</label>
                                    <el-input placeholder="Promotion Against" v-model="form.promotion"></el-input>
                                </div>
                                <h3>Transfer / Promotion From</h3>
                                <div>
                                    <label for="">Department</label>
                                    <el-select v-model="form.promotion_from" placeholder="Select Department" style="width: 100%;">
                                        <el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value">
                                        </el-option>
                                    </el-select>
                                </div>

                                <div>
                                    <label for="">Employee Name *</label>
                                    <el-input placeholder="Jane Doe" v-model="form.employee"></el-input>
                                </div>
                                <h3>Transfer / Promotion To</h3>
                                <div>
                                    <label for="">Department</label>
                                    <el-select v-model="form.promotion_to" placeholder="Select Department" style="width: 100%;">
                                        <el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value">
                                        </el-option>
                                    </el-select>
                                </div>


                                <div>
                                    <label for="">Notice Date *</label>
                                    <el-date-picker v-model="form.promotion_date" type="date" placeholder="Pick a day" style="width: 100%;">
                                    </el-date-picker>
                                </div>
                                <div>
                                    <label for="">Transfer Date *</label>
                                    <el-date-picker v-model="form.promotion_date" type="date" placeholder="Pick a day" style="width: 100%;">
                                    </el-date-picker>
                                </div>
                                <div>
                                    <label for="">Promotion Description</label>
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
            model: 'promotions',
            data: null,
        },
    }),
    created() {
        eventBus.$on("openCreatePromotion", data => {
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
