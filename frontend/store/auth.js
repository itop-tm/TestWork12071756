export const state = () => ({
    verification_code_sended: false,
    user_not_found: false,
    user_already_exists: false,
    invalid_otp: false,
})

export const mutations = {
    SET_ERRORS(state, data) {
        if (data['error'] == 'USER_NOT_FOUND') {
            state.user_not_found = true;
        }

        if (data['error'] == 'INVALID_OTP') {
            state.invalid_otp = true;
        }

        if (data['error'] == 'ALREADY_EXISTS') {
            state.user_already_exists = true;
        }
    },
    RESET_STATE(state) {
        state.verification_code_sended = false
        state.user_not_found = false
        state.user_already_exists = false
        state.invalid_otp = false
    },
    VERIFICATION_CODE_SENDING_STATUS(state, status) {
        state.verification_code_sended = status
    }
}

export const actions = {
    SET_USER_PAYLOAD({ commit }, data) {
        this.$cookie.set('tp_user', data, {
            path: '/',
            maxAge: 60 * 60 * 24 * 7,
            // httpOnly: true
        })
    },
    SEND_VERIFICATION_CODE({ commit, dispatch }, data) {
        return this.$api.auth.sendVerificationCode(data)
            .then(function (r) {
                const data = r.data;
                if (data.success) {
                    commit('VERIFICATION_CODE_SENDING_STATUS', true)
                }
                return Promise.resolve(r);
            })
            .catch(function (error) {
                commit('SET_ERRORS', error.response.data);
                return Promise.reject(error);
            });
    },
    LOGIN({ commit, dispatch }, data) {
        return this.$api.auth.login(data)
            .then(function (response) {
                const data = response.data;
                dispatch('SET_USER_PAYLOAD', {
                    token: data.access_token,
                    data: data.user
                });
                
                return Promise.resolve(response);
            })
            .catch(function (error) {
                commit('SET_ERRORS', error.response.data);
                return Promise.reject(error);
            });
    },
    REGISTER_USER({ commit, dispatch }, data) {
        return this.$api.auth.registerUser(data).then(function (response) {
            // dispatch( 'successMessage', 'registered' );
            return Promise.resolve(response);
        })
            .catch(function (error) {
                commit('SET_ERRORS', error.response.data);
                return Promise.reject(error);
            });

    },

}
export default {
    state,
    mutations,
    actions
}