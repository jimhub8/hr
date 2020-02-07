<template>
<v-content>
    <v-container fluid fill-height>
        <v-layout justify-center align-center wrap>
            <v-flex sm12>
                <v-card style="padding: 20px 0;">
                    <el-breadcrumb separator-class="el-icon-arrow-right">
                        <el-breadcrumb-item :to="{ path: '/' }">Dashboard</el-breadcrumb-item>
                        <el-breadcrumb-item>App</el-breadcrumb-item>
                    </el-breadcrumb>
                </v-card>
            </v-flex>
            <v-flex sm12>
                <!-- <myFilter :form="form" :user="user" style></myFilter> -->
            </v-flex>
            <v-flex sm12>
                <v-card style="padding: 10px 0;">
                    <v-layout row>
                        <v-flex sm1 style="margin-left: 10px;">
                            <v-tooltip right>
                                <template v-slot:activator="{ on }">
                                    <v-btn icon v-on="on" slot="activator" class="mx-0" @click="getApp">
                                        <v-icon color="blue darken-2" small>refresh</v-icon>
                                    </v-btn>
                                </template>
                                <span>Refresh</span>
                            </v-tooltip>
                        </v-flex>
                        <v-flex sm2>
                            <h3 style="margin-left: 30px !important;margin-top: 10px;">App</h3>
                        </v-flex>
                        <v-flex offset-sm8 sm2 v-if="app.length < 1">
                            <v-btn color="info" @click="openCreate" text>Create App</v-btn>
                        </v-flex>
                    </v-layout>
                </v-card>
            </v-flex>
            <v-flex sm12>
                <vue-good-table class="table-hover" :columns="columns" :rows="app" :search-options="{ enabled: true }" :pagination-options="{enabled: true,mode: 'pages'}" v-loading="isLoading" :sort-options="{enabled: true, initialSortBy: {field: 'id', type: 'asc'}}">
                    <template slot="table-row" slot-scope="props">
                        <span v-if="props.column.field == 'created_at'">
                            <span>
                                <el-tag type="success">{{props.formattedRow.created_at}}</el-tag>
                            </span>
                        </span>
                        <span v-else-if="props.column.field == 'actions'">
                            <v-tooltip bottom>
                                <template v-slot:activator="{ on }">
                                    <v-btn v-on="on" icon class="mx-0" @click="openEdit(props.row)" slot="activator">
                                        <v-icon small color="blue darken-2">edit</v-icon>
                                    </v-btn>
                                </template>
                                <span>Edit {{ props.row.name }}</span>
                            </v-tooltip>
                            <v-tooltip bottom>
                                <template v-slot:activator="{ on }">
                                    <v-btn v-on="on" icon class="mx-0" @click="openLogo(props.row)" slot="activator">
                                        <v-icon small color="blue darken-2">image</v-icon>
                                    </v-btn>
                                </template>
                                <span>Logo</span>
                            </v-tooltip>
                            <!-- <v-tooltip bottom>
                                <template v-slot:activator="{ on }">
                                    <v-btn icon v-on="on" class="mx-0" @click="confirm_delete(props.row)" slot="activator">
                                        <v-icon small color="pink darken-2">delete</v-icon>
                                    </v-btn>
                                </template>
                                <span>Delete {{ props.row.name }}</span>
                            </v-tooltip> -->
                        </span>

                        <span v-else-if="props.column.field == 'description'" id="description_tab">
                            <el-tooltip class="item" effect="dark" :content="props.row.description" placement="top-start">
                                <span>
                                    {{ props.row.description }}
                                </span>
                            </el-tooltip>
                        </span>
                        <span v-else-if="props.column.field == 'amount'">
                            <el-tooltip class="item" effect="dark" :content="props.row.qty" placement="top-start">
                                <span>
                                <el-tag type="danger">{{props.row.amount}}</el-tag>
                                </span>
                            </el-tooltip>
                        </span>
                        <span v-else-if="props.column.field == 'qty'">
                            <el-tooltip class="item" effect="dark" :content="props.row.qty" placement="top-start">
                                <span>
                                <el-tag>{{props.row.qty}}</el-tag>
                                </span>
                            </el-tooltip>
                        </span>

                        <span v-else>{{ props.formattedRow[props.column.field] }}</span>
                    </template>
                </vue-good-table>
            </v-flex>
        </v-layout>
    </v-container>
    <Create></Create>
    <Edit></Edit>
    <myImage></myImage>
</v-content>
</template>

<script>
import Create from "./create";
import Edit from "./edit";
import myImage from "./Image";

export default {
    props: ['user'],
    components: {
        Create, Edit, myImage
    },
    data() {
        return {
            form: {},
            loader: false,
            search: "",
            payload: {
                model: 'app_details',
                update_list: 'updateAppList'
            },
            checkedRows: [],
            columns: [{
                    label: "Id#",
                    field: "id",
                    type: "number"
                },
                {
                    label: "App",
                    field: "app_name"
                },
                {
                    label: "Email",
                    field: "email"
                },
                {
                    label: "Phone",
                    field: "phone"
                },
                {
                    label: "Website",
                    field: "website"
                },
                {
                    label: "Created On",
                    field: "created_at",
                    // type: "date",
                    // dateInputFormat: "YYYY-MM-DD",
                    // dateOutputFormat: "Do MMMM YYYY"
                },
                {
                    label: "Actions",
                    field: "actions",
                    sortable: false
                }
            ]
        };
    },
    methods: {
        openCreate() {
            eventBus.$emit("openCreateApp");
        },
        openEdit(data) {
            eventBus.$emit("openEditApp", data);
        },
        openLogo(data) {
            eventBus.$emit("openLogoApp", data);
        },

        // confirm_delete(item) {
        //     this.$confirm('This will permanently delete the app. Continue?', 'Warning', {
        //         confirmButtonText: 'OK',
        //         cancelButtonText: 'Cancel',
        //         type: 'warning'
        //     }).then(() => {
        //         this.deleteItem(item)
        //     }).catch(() => {
        //         this.$message({
        //             type: 'error',
        //             message: 'Delete canceled'
        //         });
        //     });
        // },

        // deleteItem(item) {
        //     this.$store.dispatch("deleteItem", "app/" + item.id).then(response => {
        //         this.$message({
        //             type: 'success',
        //             message: 'Delete completed'
        //         });
        //         this.getApp();
        //     });
        // },
        getApp() {
            this.$store.dispatch("getData", this.payload);
        },
    },
    computed: {
        app() {
            return this.$store.getters.app;
        },

        isLoading() {
            return this.$store.getters.loading;
        }
    },
    mounted() {
        // this.$store.dispatch('getApp');
        eventBus.$emit("LoadingEvent");
        this.getApp();
    },
    created() {
        eventBus.$on("appEvent", data => {
            this.getApp();
        });
    },

    //   beforeRouteEnter(to, from, next) {
    //     next(vm => {
    //       if (vm.user.can["view app"]) {
    //         next();
    //       } else {
    //         next("/");
    //       }
    //     });
    //   }
};
</script>

<style scoped>
.el-input--prefix .el-input__inner {
    border-radius: 50px !important;
}

#description_tab span {
    font-style: inherit;
    font-weight: inherit;
    white-space: nowrap;
    text-overflow: ellipsis;
    max-width: 200px;
    overflow: hidden;
    display: block;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
}
</style>
