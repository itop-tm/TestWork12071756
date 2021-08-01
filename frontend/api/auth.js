export default (axios) => ({
  login: function( credentials ){
    return axios.post('auth/sign-in', credentials);
  },

  sendVerificationCode: function( credentials ){
    return axios.post('auth/send-otp', credentials);
  },

  registerUser: function( credentials ){
    return axios.post('auth/sign-up', credentials);
  },
})
