import axios from 'axios'

const API_URL = "http://localhost/ProyectoGrupal-IW/public/api/auth/"

export default {
    state: {
        status: '',
        user: JSON.parse(localStorage.getItem('loggedUser')) || '',
        role: JSON.parse(localStorage.getItem('userRole')) || ''
    },
    getters: {
        isLoggedIn: state => !!state.user,
        authStatus: state => state.status,
        loggedUser: state => state.user,
        userRole: state => state.role
    },
    mutations: {
        auth_request(state){
            state.status = 'loading'
        },
        auth_success(state, {user, role}){
            state.status = 'success'
            state.user = user
            state.role = role
        },
        auth_error(state){
            state.status = 'error'
        },
        logout(state){
            state.status = ''
            state.user = ''
            state.role = ''
        }
    },
    actions: {
        login({commit, dispatch}, user) {
            return new Promise((resolve, reject) => {
                commit('auth_request')
                axios({url: API_URL + 'login', data: user, method: 'POST' })
                .then(resp => {
                    let user = resp.data.user
                    let role = resp.data.role
                    localStorage.setItem('loggedUser', JSON.stringify(user))
                    localStorage.setItem('userRole', JSON.stringify(role))
                    axios.defaults.headers.common['Authorization'] = "Bearer " + user.api_token
                    commit('auth_success', {user, role})
                    resolve(resp)
                })
                .catch(err => {
                    commit('auth_error')
                    localStorage.removeItem('loggedUser')
                    reject(err)
                })
            })
        },
        register({commit}, user) {
            return new Promise((resolve, reject) => {
                axios({url: API_URL + 'signup', data: user, method: 'POST' })
                .then(resp => {
                    resolve(resp)
                })
                .catch(err => {
                    commit('auth_error', err)
                    localStorage.removeItem('loggedUser')
                    reject(err)
                })
            })
        },    
        logout({state, commit}) {
            return new Promise((resolve, reject) => {
                commit('logout')
                localStorage.clear();
                delete axios.defaults.headers.common['Authorization']
                //axios({url: API_URL + "logout", data: state.user, method: 'POST' })
                resolve()
            })
        }
    }
}