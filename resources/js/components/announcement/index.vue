<template>
<v-content>
    <v-container fluid fill-height>
        <v-layout justify-center align-center wrap>
            <v-flex sm12>
                <v-card style="padding: 20px 0;">
                    <el-breadcrumb separator-class="el-icon-arrow-right">
                        <el-breadcrumb-item :to="{ path: '/' }">Dashboard</el-breadcrumb-item>
                        <el-breadcrumb-item>Announcement</el-breadcrumb-item>
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
                                    <v-btn icon v-on="on" slot="activator" class="mx-0" @click="getAnnouncements">
                                        <v-icon color="blue darken-2" small>refresh</v-icon>
                                    </v-btn>
                                </template>
                                <span>Refresh</span>
                            </v-tooltip>
                        </v-flex>
                        <v-flex sm3>
                            <h3 style="margin-left: 30px !important;margin-top: 10px;">Announcement</h3>
                        </v-flex>
                        <v-flex offset-sm8 sm2>
                            <v-btn color="info" @click="openCreate" text>Create Announcement</v-btn>
                        </v-flex>
                    </v-layout>
                </v-card>
            </v-flex>
            <v-flex sm12>
                <v-pagination v-model="announcements.current_page" :length="announcements.last_page" total-visible="5" @input="next_page(announcements.path, announcements.current_page)" circle v-if="announcements.last_page > 1"></v-pagination>
            </v-flex>
            <v-flex sm12>
                <vue-good-table class="table-hover" :columns="columns" :rows="announcements.data" :search-options="{ enabled: true }" :pagination-options="{enabled: true,mode: 'pages'}" v-loading="isLoading" :sort-options="{enabled: true, initialSortBy: {field: 'id', type: 'asc'}}">
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
                                    <v-btn v-on="on" icon class="mx-0" @click="openShow(props.row)" slot="activator">
                                        <v-icon small color="blue darken-2">visibility</v-icon>
                                    </v-btn>
                                </template>
                                <span>View</span>
                            </v-tooltip>
                            <v-tooltip bottom>
                                <template v-slot:activator="{ on }">
                                    <v-btn icon v-on="on" class="mx-0" @click="confirm_delete(props.row)" slot="activator">
                                        <v-icon small color="pink darken-2">delete</v-icon>
                                    </v-btn>
                                </template>
                                <span>Delete {{ props.row.name }}</span>
                            </v-tooltip>
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
    <Show></Show>
</v-content>
</template>

<script>
import Create from "./create";
import Edit from "./edit";
import Show from "./show";

export default {
    props: ['user'],
    components: {
        Create, Edit, Show
    },
    data() {
        return {
            form: {},
            loader: false,
            search: "",
            payload: {
                model: 'announcements',
                update_list: 'updateAnnouncementsList'
            },
            checkedRows: [],
            columns: [{
                    label: "Id#",
                    field: "id",
                    type: "number"
                },
                {
                    label: "Announcement",
                    field: "announcement"
                },
                {
                    label: "Start Date",
                    field: "start_date"
                },
                {
                    label: "End Date",
                    field: "end_date"
                },
                {
                    label: "Description",
                    field: "description"
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
            eventBus.$emit("openCreateAnnouncement");
        },
        openEdit(data) {
            eventBus.$emit("openEditAnnouncement", data);
        },
        openShow(data) {
            eventBus.$emit("openShowAnnouncement", data);
        },

        confirm_delete(item) {
            this.$confirm('This will permanently delete the file. Continue?', 'Announcement', {
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel',
                type: 'announcement'
            }).then(() => {
                this.deleteItem(item)
            }).catch(() => {
                this.$message({
                    type: 'error',
                    message: 'Delete canceled'
                });
            });
        },

        deleteItem(item) {
            this.$store.dispatch("deleteItem", "announcements/" + item.id).then(response => {
                this.$message({
                    type: 'success',
                    message: 'Delete completed'
                });
                this.getAnnouncements();
            });
        },
        getAnnouncements() {
            this.$store.dispatch("getData", this.payload);
        },
        updateSelected(url) {
            // alert('test')
            if (this.checkedRows.length < 1) {
                eventBus.$emit("errorEvent", "Please select atleast one row");
                return;
            }

            this.$store
                .dispatch("updateSelected", {
                    url,
                    checked: this.checkedRows
                })
                .then(response => {
                    eventBus.$emit("alertRequest", "Updated");
                    this.checkedRows = [];
                    this.getAnnouncements();
                });
        },
        selectionChanged(params) {
            this.checkedRows = params.selectedRows;
        },

        next_page(path, page) {
            var payload = {
                path: path,
                page: page,
                update_list: 'updateAnnouncementsList'
            }
            this.$store.dispatch("nextPage", payload);
        }
    },
    computed: {
        announcements() {
            return this.$store.getters.announcements;
        },

        isLoading() {
            return this.$store.getters.loading;
        }
    },
    mounted() {
        // this.$store.dispatch('getAnnouncements');
        eventBus.$emit("LoadingEvent");
        this.getAnnouncements();
    },
    created() {
        eventBus.$on("announcementEvent", data => {
            this.getAnnouncements();
        });

        eventBus.$on("responseChooseEvent", data => {
            console.log(data);
            if (data == "Excel") {
                eventBus.$emit("openEditAnnouncement");
            } else {
                eventBus.$emit("openCreateAnnouncement");
            }
        });
    },

    //   beforeRouteEnter(to, from, next) {
    //     next(vm => {
    //       if (vm.user.can["view announcements"]) {
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
