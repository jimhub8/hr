<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="700px">
        <v-card>
            <v-card-title>
                <span class="headline text-center" style="margin: auto;">Create Termination</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout row wrap>
                        <v-flex sm12>
                            <v-card-text>
                                <div>
                                    <label for="">Employee *</label>
                                    <el-select v-model="form.user_id" filterable remote reserve-keyword placeholder="type at least 3 characters" :remote-method="getUsers" :loading="loading" style="width: 100%;">
                                        <el-option v-for="item in users.data" :key="item.id" :label="item.name" :value="item.id">
                                        </el-option>
                                    </el-select>
                                </div>
                                <div>
                                    <label for="">Termination Type *</label>
                                    <el-input placeholder="Termination type" v-model="form.termination"></el-input>
                                </div>
                                <div>
                                    <label for="">Notice Date *</label>
                                    <el-date-picker v-model="form.notice_date" type="date" placeholder="Pick a day" style="width: 100%;">
                                    </el-date-picker>
                                </div>
                                <div>
                                    <label for="">Termination Date *</label>
                                    <el-date-picker v-model="form.termination_date" type="date" placeholder="Pick a day" style="width: 100%;">
                                    </el-date-picker>
                                </div>
                                <div>
                                    <label for="">Description</label>
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
            model: 'terminations',
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
        eventBus.$on("openCreateTermination", data => {
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

        getUsers(query) {
            if (query.length > 2) {
                var payload = {
                    model: 'searchUsers',
                    update: 'updateUsersList',
                    search: query
                }
                this.$store.dispatch("searchItems", payload);
            }
        },
    },
    computed: {
        users() {
            return this.$store.getters.users
        }
    },
};
</script>
