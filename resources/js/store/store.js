import axios from "axios";
import { createStore } from "vuex";

const store = createStore({
    state: {
        message: "",
        filterTableData:[]
    },

    mutations: {
        message(state, message) {
            state.message = message
        },

        filterTableData(state, filterTableData) {
            state.filterTableData = filterTableData
        }
    },

    actions: {
        saveStudent({ commit }, payload) {
            let url = `/save-student`; 
            axios.post(url, payload).then(res => {
                commit('message', "Data has been sent.")
            })
            window.location.href='/students'
        },

        getStudents({commit}, payload) {
            let url = `/get-studentsdata`; 
            axios.post(url, payload).then(res => {
                commit('filterTableData', res.data)
            })
        }
    },

    getters: {
        filterTableData(state) {
            return state.filterTableData;
        }
    }
})

export default store