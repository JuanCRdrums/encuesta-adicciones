var auth =  new Vue({
    data: function(){
      return {
        username: API_CRM_USER,
        password: API_CRM_PASSWORD,
        authenticated : false,
      }
    },
    methods: {
      login :  function(){
         // GET request
        if(this.username.length > 0 && this.password.length > 0){
          this.$http.get( API_CRM_URL+'auth/login?username='+this.username+'&password='+this.password).then(function(response){
             this.authenticated = true;
          },function(response){
             
          });
    
        }else{
          alertify.error('No se han configurado los datos de acceso a la API CRM');
        }
        
      },
      logout: function(){
        this.authenticated = false;
      }
    }

 });


Vue.http.interceptors.push(function () {
    return {
        request: function (request) {
          var token, headers
          token = 'Bearer ' + localStorage.getItem('token');
          headers = request.headers || (request.headers = {})

          if (token !== null && token !== 'undefined') {
            headers.Authorization = token
          }
            return request;
        },

        response: function (response) {

           if (response.data && response.data.error && response.data.error.length > 0) {

              if (response.data.error == 'token_expired' || response.data.error == '"token_not_provided"') 
                  auth.login();

              errorsHtml = '<ul>';

              $.each(response.data.error, function (key, value) {
                  errorsHtml += '<li>' + value + '</li>'; //showing only the first error.
              });

              errorsHtml += '</ul>';

              alertify.error(errorsHtml) //appending to a <div id="form-errors"></div> inside form
             
          };

          if (response.data && response.data.token && response.data.token.length > 10) {
            localStorage.setItem('token', response.data.token)
          }
            return response;
        }

    };
});
