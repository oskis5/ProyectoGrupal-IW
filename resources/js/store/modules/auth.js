import axios from 'axios'
//import jwtDecode from 'jwt-decode'

import {Users_API} from '../actions/users_API.js'
const users_API = new Users_API("http://localhost:81/ProyectoGrupal-IW/public/api/");

export default {
    state: {
        status: '',
        token: localStorage.getItem('token') || '',
        user: JSON.parse(localStorage.getItem('loggedUser')) || {},
    },
    getters: {
        isLoggedIn: state => !!state.token,
        authStatus: state => state.status,
        loggedUser: state => state.user
    },
    mutations: {
        auth_request(state){
            state.status = 'loading'
        },
        auth_success(state, token, user){
            state.status = 'success'
            state.token = token
        },
        auth_error(state){
            state.status = 'error'
        },
        logout(state){
            state.status = ''
            state.token = ''
        },
        set_user(state, user){
            state.user = user
        }
    },
    actions: {
        login({commit, dispatch}, user) {
            
            
            return new Promise((resolve, reject) => {
                commit('auth_request')

                /*users_API.login().then(function(datos){
                    return datos
                })*/

                axios({url: API_URL + 'login', data: user, method: 'POST' })
                .then(resp => {
                    
                    const token = resp.data
                    localStorage.setItem('token', token)
                    axios.defaults.headers.common['Authorization'] = token
                    commit('auth_success', token, user)
                    dispatch('setLoggedUser', token)
                    resolve(resp)
                })
                .catch(err => {
                    commit('auth_error')
                    localStorage.removeItem('token')
                    reject(err)
                })
            })
        },
        register({commit}, user) {
            return new Promise((resolve, reject) => {
                commit('auth_request')
                axios({url: API_URL + 'users/', data: user, method: 'POST' })
                .then(resp => {
                    resolve(resp)
                })
                .catch(err => {
                    commit('auth_error', err)
                    localStorage.removeItem('token')
                    reject(err)
                })
            })
        },    
        logout({commit}) {
            return new Promise((resolve, reject) => {
                commit('logout')
                localStorage.clear();
                delete axios.defaults.headers.common['Authorization']
                resolve()
            })
        },
        setLoggedUser({commit}, token) {
            return new Promise((resolve, reject) => {
                let decoded_token = jwtDecode(token)
                axios({url: API_URL+decoded_token._id, method: 'GET' })
                .then(resp => {
                    localStorage.setItem('loggedUser', JSON.stringify(resp.data.user))
                    commit('set_user', resp.data.user)
                    resolve(resp)
                })
            })
        }
    }
}