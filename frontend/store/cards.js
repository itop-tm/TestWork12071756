export const state = () => ({
    loadStatus: 0,
    cards: {},
    card: {},
    cardInput: {

    },
    queryParams: {
        page: 0
    },
})

export const mutations = {
    SET_CARDS(state, data) {
        state.cards = data
    },
    SET_CARD(state, data) {
        state.card = data
    },
    SET_CARD_INPUT( state, data ){
        Object.assign(state.cardInput, data)
    },
    SET_LOAD_STATUS( state, value ){
        state.loadStatus = value;
    }
}

export const actions = {
    GET_USER_CARDS({ commit, dispatch }, queryParams) {
        commit( 'SET_LOAD_STATUS', 1 );

        return this.$api.cards.getUserCards(queryParams)
            .then(function (response) {
                const r = response.data;
                commit('SET_CARDS', r.data);
                commit( 'SET_LOAD_STATUS', 0 );
                return Promise.resolve(response);
            })
            .catch(function (error) {
                commit( 'SET_LOAD_STATUS', 0 );
                return Promise.reject(error);
            });
    },
    GET_USER_CARD({ commit, dispatch }, id) {
        return this.$api.cards.getUserCardById(id)
            .then(function (response) {
                const r = response.data;
                commit('SET_CARD', r.data);
                return Promise.resolve(response);
            })
            .catch(function (error) {
                return Promise.reject(error);
            });
    },
    ADD_BANK_CARD({ commit, dispatch }, data) {
        return this.$api.cards.addBankCard(data)
            .then(function (response) {
                return Promise.resolve(response);
            })
            .catch(function (error) {
                return Promise.reject(error);
            });
    },
    UPDATE_BANK_CARD({ commit, dispatch }, data) {
        return this.$api.cards.updateBankCard(data.id, data)
            .then(function (response) {
                return Promise.resolve(response);
            })
            .catch(function (error) {
                return Promise.reject(error);
            });
    },
    DELETE_BANK_CARD({ commit, dispatch }, id) {
        return this.$api.cards.deleteBankCard(id)
            .then(function (response) {
                return Promise.resolve(response);
            })
            .catch(function (error) {
                return Promise.reject(error);
            });
    }
}
export const getters = {
    getCards: (state ) =>  {
        return state.cards
    },
    getCard: (state ) =>  {
        return state.card
    },
}
export default {
    state,
    mutations,
    actions,
    getters
}