export default {
    loading(state) {
        return state.loading;
    },
    errors(state) {
        return state.errors;
    },
    alertEvent(state) {
        eventBus.$emit('alertEvent', state)
        // return state.alertEvent;
    },

    app(state) {
        return state.app
    },
    app_show(state) {
        return state.app_show
    },
    users(state) {
        return state.users
    },
    roles(state) {
        return _.orderBy(state.roles, 'name', 'asc')
    },
    user_perm(state) {
        return state.user_perm;
    },
    role_perm(state) {
        return state.role_perm;
    },
    permissions(state) {
        return _.orderBy(state.permissions, 'name', 'asc')
        // return state.permissions;
    },
    clients(state) {
        return state.clients;
    },
    clientSearch(state) {
        return state.clientSearch;
    },
    deleted_clients(state) {
        return state.deleted_clients
    },


    leaves(state) {
        return state.leaves
    },
    leaves_type(state) {
        return state.leaves_type
    },
    expenses(state) {
        return state.expenses
    },
    attendances(state) {
        return state.attendances
    },

    tasks(state) {
        return state.tasks;
    },
    departments(state) {
        return state.departments;
    },
    warnings(state) {
        return state.warnings;
    },
    complains(state) {
        return state.complains;
    },
    promotions(state) {
        return state.promotions;
    },
    announcements(state) {
        return state.announcements;
    },
    shifts(state) {
        return state.shifts;
    },
    terminations(state) {
        return state.terminations;
    },
}
