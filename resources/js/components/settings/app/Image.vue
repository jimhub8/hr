<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="500px">
        <v-card>
            <v-card-title>
                <span class="headline text-center" style="margin: auto;">{{ form.app_name }}</span>
                <VSpacer />

                <v-tooltip bottom>
                    <template v-slot:activator="{ on }">
                        <v-btn v-on="on" icon class="mx-0" @click="close" slot="activator">
                            <v-icon small color="blue darken-2">close</v-icon>
                        </v-btn>
                    </template>
                    <span>close</span>
                </v-tooltip>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
                <v-container grid-list-md style="text-align: center;">
                    <v-layout row wrap>
                        <v-flex sm12>
                            <img v-show="imagePlaced" :src="avatar" style="width: 200px; height: 200px;">
                        </v-flex>
                        <v-flex sm12>
                            <v-btn color="red" darken-1 raised @click="onPickFile" style="color: #fff;">Choose image</v-btn>
                            <input type="file" @change="Getimage" accept="image/*" style="display: none" ref="fileInput">
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-btn @click="cancle" text v-show="imagePlaced" color="primary">Cancel</v-btn>
                <v-spacer></v-spacer>
                <v-btn @click="upload" text v-show="imagePlaced" :loading="loading" :disabled="loading" color="primary">Upload</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</v-layout>
</template>

<script>
export default {
    data: () => ({
        dialog: false,
        disapproved: false,
        avatar: "",
        imagePlaced: false,
        form: {},
        payload: {
            model: 'leaves',
        },
        loading: false,
    }),
    created() {
        eventBus.$on("openLogoApp", data => {
            this.dialog = true;
            this.form = data;
            this.avatar = data.logo;
        });
    },

    methods: {
        close() {
            this.dialog = false;
        },
        onPickFile() {
            this.$refs.fileInput.click();
        },
        onFilePicked(event) {
            this.imagePlaced = true;
            const files = event.target.files;
            let filename = files[0].name;
            if (filename.lastIndexOf(".") <= 0) {
                return alert("please upload a valid image");
            }
            const fileReader = new FileReader();
            fileReader.addEventListener("load", () => {
                this.avatar = fileReader.result;
            });
            fileReader.readAsDataURL(files[0]);
            this.image = files[0];
        },
        Getimage(e) {
            let image = e.target.files[0];
            // this.read(image);
            let reader = new FileReader();
            reader.readAsDataURL(image);
            reader.onload = e => {
                this.avatar = e.target.result;
            };
            this.imagePlaced = true;
            let form = new FormData();
            form.append("image", image);
            this.file = form;
            console.log(e.target.files);
        },

        upload() {
            // var payload = {
            //     model: 'logo/' + this.form.id,
            //     data: this.file,
            // }
            // this.payload.data = this.form
            // this.$store.dispatch('patchData', payload).then((res) => {
            //     eventBus.$emit("appEvent");
            // })

            axios
                .post(`/logo/1`, this.file)
                .then(response => {
                    this.loading = false;
                    // console.log(response);
                    // this.imagePlaced = false;
                    // this.close()
                    eventBus.$emit('alertRequest', 'logo uploaded')
                })
                .catch(error => {
                    this.loading = false;

                    if (error.response.status === 500) {
                        this.loading = false
                        eventBus.$emit('errorEvent', error.response.statusText)
                        return
                    } else if (error.response.status === 401 || error.response.status === 409) {
                        this.loading = false
                        eventBus.$emit('reloadRequest', error.response.statusText)
                    } else if (error.response.status === 422) {
                        this.loading = false
                        eventBus.$emit('errorEvent', error.response.statusText)
                    }
                    this.errors = error.response.data.errors;
                    this.errors = error.response.data.errors;
                });
        },

        cancle() {
            this.avatar = this.form.logo;
            this.imagePlaced = false;
            this.close()
        },
    },
    computed: {
        // loading() {
        //     return this.$store.getters.loading
        // }
    },
};
</script>
