<template>
<VCard style="width: 100%">
    <v-layout row>
        <v-flex sm2 style="margin-left: 20px; margin-bottom: 20px;">
            <label for="">User</label>
            <!-- <el-select v-model="form.client" placeholder="User" clearable filterable>
                <el-option v-for="item in clients.data" :key="item.id" :label="item.name" :value="item.id">
                </el-option>
            </el-select> -->

            <el-select v-model="form.user" filterable remote reserve-keyword placeholder="type at least 3 characters" :remote-method="searchUser" :loading="loading" style="width: 100%;">
                <el-option v-for="item in users.data" :key="item.id" :label="item.name" :value="item.id">
                </el-option>
            </el-select>
        </v-flex>
        <v-flex sm2 style="margin-left: 5px; margin-bottom: 20px;">
            <label>Start date</label>
            <el-date-picker v-model="form.start_date" type="date" placeholder="Pick a day">
            </el-date-picker>
        </v-flex>
        <v-flex sm2 style="margin-left: 10px; margin-bottom: 20px;">
            <label>End date</label>
            <el-date-picker v-model="form.end_date" type="date" placeholder="Pick a day">
            </el-date-picker>
        </v-flex>
        <v-flex sm2 style="margin-left: 10px; margin-bottom: 20px;">
            <v-tooltip bottom>
                <v-btn icon class="mx-0" @click="filterData" slot="activator" style="margin-top: 32px;">
                    <v-icon small color="blue darken-2">search</v-icon>
                </v-btn>
                <span>Filter</span>
            </v-tooltip>
        </v-flex>
    </v-layout>
</VCard>
</template>

<script>
export default {
    props: ['model', 'update'],
    data() {
        return {
            form: {}
        }
    },
    methods: {
        getUsers() {
            var payload = {
                model: 'users',
                update: 'updateUsersList',
            }

            this.$store.dispatch('getData', payload)
                .then(() => {
                    this.loader = false
                })
        },
        searchUser(data) {
            var payload = {
                model: 'searchUsers',
                update: 'updateUsersList',
                search: data
            }
            this.$store.dispatch('searchItems', payload)
        },
        filterData() {
            var payload = {
                model: this.model,
                update: this.update,
                data: this.form
            }
            this.$store.dispatch('filterData', payload)
        }
    },
    mounted() {
        // this.getUsers()
    },
    computed: {
        users() {
            return this.$store.getters.users
        },
        loading() {
            return this.$store.getters.loading
        }
    },
}
</script>
