import axios from "axios";
import { createStore } from "vuex";

const store = createStore({
    state: {
        message:"",
    },

    mutations: {
        message(state, message) {
            state.message = message
        }
    },

    actions: {
        saveStudent({ commit }, payload) {
            let url = `/save-student`; 
            axios.post(url, payload).then(res => {
                commit('message', res)
            })
            window.location.href='/students'
        }
    },

    getters: {
        
    }
})

export default store