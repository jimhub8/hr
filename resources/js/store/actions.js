import axios from "axios";
export default {
    alertEvent(context, payload) {
        eventBus.$emit('alertRequest', payload)
        // context.commit('alertEvent', payload)
    },

    errorEvent(context, payload) {
        eventBus.$emit('errorEvent', payload)
        // context.commit('alertEvent', payload)
    },

    // GET
    getData(context, payload) {

        var model = payload.model
        var update = payload.update_list
        context.commit('loading', true)
        axios.get(model).then((response) => {
            // console.log(update);
            context.commit('loading', false)
            context.commit(update, response.data)
        }).catch((error) => {
            // console.log(error);
            context.commit('loading', false)
            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            } else if (error.response.status === 422) {
                eventBus.$emit('errorEvent', error.response.data.message + ': ' + error.response.statusText)
                    context.commit('errors', error.response.data.errors)

                return
            }
            context.commit('errors', error.response.data.errors)

        })
    },

    getShowData(context, payload) {
        var model = payload.model
        var update = payload.update_list
        var id = payload.id
        context.commit('loading', true)
        axios.get(model + '/' + id).then((response) => {
            console.log(update, response.data);
            context.commit('loading', false)
            context.commit(update, response.data)
        }).catch((error) => {
            console.log(error);
            context.commit('loading', false)
            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            } else if (error.response.status === 422) {
                eventBus.$emit('errorEvent', error.response.data.message + ': ' + error.response.statusText)
                    context.commit('errors', error.response.data.errors)

                return
            }
            context.commit('errors', error.response.data.errors)

        })
    },

    // POST
    postData(context, payload) {

        var model = payload.model
        var data = payload.data
        context.commit('loading', true)
        axios.post(model, data)
            .then((response) => {
                context.commit('loading', false)
                console.log(response);
                context.commit('alertEvent','Successfully Created')
                return
            }).catch((error) => {
                context.commit('loading', false)
                if (error.response.status === 500) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                } else if (error.response.status === 422) {
                    eventBus.$emit('errorEvent', error.response.data.message + ': ' + error.response.statusText)
                    context.commit('errors', error.response.data.errors)
                    return
                }
                context.commit('errors', error.response.data.errors)
                return
            })
    },

    // Patch
    patchData(context, payload) {
        console.log(payload);
        var model = payload.model
        var id = payload.id
        var data = payload.data
        context.commit('loading', true)
        axios.patch(model, data)
            .then((response) => {
                context.commit('loading', false)
                context.commit('alertEvent','Successfully Updated')
                return
            }).catch((error) => {
                context.commit('loading', false)
                if (error.response.status === 500) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                } else if (error.response.status === 422) {
                    eventBus.$emit('errorEvent', error.response.data.message + ': ' + error.response.statusText)
                    context.commit('errors', error.response.data.errors)
                    return
                }
                context.commit('errors', error.response.data.errors)
                return
            })
    },

    nextpage(context, payload) {
        var path = payload.path
        var page = payload.page
        var data = payload.data

        context.commit('loading', true)
        axios.get(path + `?page=` + page)
            .then((response) => {
                context.commit('updateReturnList', response.data)
                context.commit('loading', false)
            }).catch((error) => {

                if (error.response.status === 500) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                }
                context.commit('loading', false)
            context.commit('errors', error.response.data.errors)

            })
    },

    deleteItem(context, payload) {
        var model = payload.model
        var id = payload.id
        context.commit('loading', true)
        axios.delete(model + '/' +id).then((response) => {
            context.commit('loading', false)
        }).catch((error) => {
            context.commit('loading', false)
            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            } else if (error.response.status === 422) {
                eventBus.$emit('errorEvent', error.response.data.message + ': ' + error.response.statusText)
                context.commit('errors', error.response.data.errors)
                return
            }
            context.commit('errors', error.response.data.errors)

        })
    },

    filterData(context, payload) {
        var model = payload.model
        var update = payload.update
        var data = payload.data
        context.commit('loading', true)
        axios.post(model, data)
            .then((response) => {
                context.commit(update, response.data)
                context.commit('loading', false)
            }).catch((error) => {
                context.commit('loading', false)
                if (error.response.status === 500) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                } else if (error.response.status === 422) {
                    eventBus.$emit('errorEvent', error.response.data.message + ': ' + error.response.statusText)
                    context.commit('errors', error.response.data.errors)
                    return
                }
                context.commit('errors', error.response.data.errors)

            })
    },
    searchItems(context, payload) {
        var model = payload.model
        var update = payload.update
        var search = payload.search
        context.commit('loading', true)
        axios.get(model + '/' + search).then((response) => {
            context.commit('loading', false)
            context.commit(update, response.data)
        }).catch((error) => {
            context.commit('loading', false)
            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            } else if (error.response.status === 422) {
                eventBus.$emit('errorEvent', error.response.data.message + ': ' + error.response.statusText)
                context.commit('errors', error.response.data.errors)
                return
            }
            context.commit('errors', error.response.data.errors)

        })
    },




    getDistance(context, payload) {
        // console.log(payload);
        var model = payload.model
        var data = payload.data
        context.commit('loading', true)
        axios.post(model, data)
            .then((response) => {
                context.commit('loading', false)
                var dist = response.data
                if (dist < 1) {
                    eventBus.$emit('alertRequest', 'Successfully checked in')
                } else {
                    eventBus.$emit('errorEvent', 'Please checked in when you get into the office')
                }
                return
            }).catch((error) => {
                context.commit('loading', false)
                if (error.response.status === 500) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                } else if (error.response.status === 422) {
                    eventBus.$emit('errorEvent', error.response.data.message + ': ' + error.response.statusText)
                    context.commit('errors', error.response.data.errors)
                    return
                }
                context.commit('errors', error.response.data.errors)
                return
            })
    },

}
