import { reactive } from 'vue'

export const store = reactive({

    token: localStorage.getItem('token'),
    getToken() {
        this.token
    }
})