export default (axios) => ({
  getUserCards: function( data ){
    return axios.get('cards', data);
  },
  getUserCardById: function( id ){
    return axios.get(`cards/${id}`);
  },
  addBankCard: function( data ){
    return axios.post(`cards`, data);
  },
  updateBankCard: function( id, data){
    return axios.put(`cards/${id}`, data);
  },
  deleteBankCard: function( id){
    return axios.delete(`cards/${id}`);
  },
})