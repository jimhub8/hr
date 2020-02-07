<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="700px">
        <v-card>
            <v-card-title>
                <span class="headline text-center" style="margin: auto;">Create Complain</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout row wrap>
                        <v-flex sm12>
                            <v-card-text>
                                <div>
                                    <label for="">Complain Against *</label>
                                    <el-input placeholder="Complain Against" v-model="form.complain_against"></el-input>
                                </div>
                                <div>
                                    <label for="">Complain Date *</label>
                                    <el-date-picker v-model="form.complain_date" type="date" placeholder="Pick a day" style="width: 100%;">
                                    </el-date-picker>
                                </div>
                                <div>
                                    <label for="">Complain Description</label>
                                    <!-- <el-input type="textarea" placeholder="Please input" v-model="form.description" maxlength="500" show-word-limit>
                                    </el-input> -->
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
        form: {
            designations: [],
        },
        payload: {
            model: 'complains',
            data: null,
        },
    }),
    created() {
        eventBus.$on("openCreateComplain", data => {
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
