<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="700px">
        <v-card>
            <v-card-title>
                <span class="headline text-center" style="margin: auto;">Create App</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout row wrap>
                        <v-flex sm12>
                            <v-card-text>
                                <v-layout row wrap>
                                    <v-flex sm6>
                                        <label for="">App Name</label>
                                        <el-input placeholder="App Name" v-model="form.app_name"></el-input>
                                    </v-flex>
                                    <v-flex sm6>
                                        <label for="">App Email</label>
                                        <el-input placeholder="doe@gmail.com" v-model="form.email"></el-input>
                                    </v-flex>
                                    <v-flex sm6>
                                        <label for="">Phone Number</label>
                                        <el-input placeholder="+254..." v-model="form.phone"></el-input>
                                    </v-flex>
                                    <v-flex sm6>
                                        <label for="">Website</label>
                                        <el-input placeholder="https://example.com" v-model="form.website"></el-input>
                                    </v-flex>
                                    <v-flex sm6>
                                        <label for="">Address</label>
                                        <el-input placeholder="Main street" v-model="form.address"></el-input>
                                    </v-flex>
                                </v-layout>
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

    }),
    created() {
        eventBus.$on("openEditApp", data => {
            this.form = data
            this.dialog = true;
        });
    },

    methods: {
        save() {
            var payload = {
                model: 'app_details/' + this.form.id,
                data: this.form,
            }
            // this.payload.data = this.form
            this.$store.dispatch('patchData', payload).then((res) => {
                eventBus.$emit("appEvent");
            })
        },
        close() {
            this.dialog = false;
        },
    },
};
</script>
