export const state = () => ({
        token: null,
        refreshToken: true,
        data: {},
        defaultData: {
            id: null,
            phone: null,
            email: null,
            firstname: null,
            lastname: null,
        }
})

export const mutations = {
    setUserData(state, value ) {
        Object.assign(state.data, value)
    },
    setTokenStatus(state, value ) {
        state.refreshToken = value
    },
    setDataFromCookie ( state ) {
        var cookie = this.$cookie.get('tp_user') ? this.$cookie.get('tp_user') : false;
  
        if (state.refreshToken === false) {
            return
        }
        
        if (!cookie) {
            state.data = state.defaultData
            return
        }

        state.token = cookie.token;
        state.data = cookie.data;
        state.refreshToken = false;
    },
    
}

export const getters = {
    getToken: (state ) =>  {
        return state.token
    },
    getData: (state ) =>  {
        return state.data
    },
    getId: (state ) =>  {
        return state.data.id
    },
    getEmail: (state ) =>  {
        return state.data.email
    },
    getPhone: (state ) =>  {
        return state.data.phone
    },
    getName: (state ) =>  {
        return `${state.data.firstname ?? ''} ${state.data.lastname ?? ''}`
    }
}

export default {
    state,
    mutations,
    getters
}