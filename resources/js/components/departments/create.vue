<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="500px">
        <v-card>
            <v-card-title>
                <span class="headline text-center" style="margin: auto;">Create Department</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout row wrap>
                        <v-flex sm12>
                            <v-card-text>
                                <div>
                                    <label for="">Department Name</label>
                                    <el-input placeholder="Department Name" v-model="form.department_name"></el-input>
                                </div>
                                <div v-for="(designation, index) in form.designations" :key="index">
                                    <label for="">Designation</label>
                                    <el-input placeholder="Designation" v-model="designation.designation_name"></el-input>
                                </div>
                                <!-- <v-btn color="primary">text</v-btn> -->
                                <v-tooltip bottom>
                                    <VBtn text icon color="primary" @click="add_new">
                                        <!-- <VIcon>add</VIcon> -->
                                        <template v-slot:activator="{ on }">
                                            <VIcon>add</VIcon>
                                        </template>
                                    </VBtn>
                                    <span>Tooltip</span>
                                </v-tooltip>

                                <v-tooltip bottom>
                                <template v-slot:activator="{ on }">
                                    <v-btn v-on="on" icon class="mx-0" @click="add_new" slot="activator">
                                        <v-icon small color="blue darken-2">add</v-icon>
                                    </v-btn>
                                </template>
                                <span>add</span>
                            </v-tooltip>

                                <div>
                                    <label for="">Description</label>
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
            model: 'departments',
            data: null,
        },
    }),
    created() {
        eventBus.$on("openCreateDepartment", data => {
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
