var loadViewInvoices= Vue.extend({
  template: '#componente-facturas',
  data: function () {
  	return	{
  		  invoices: [],
      	searchKey : '',
      	pagination: {
	        total: 0, 
	        per_page: 5,
	        from: 1, 
	        to: 0,
	        last_page: 0,
	        current_page: 1
      	},
        api_url: API_CRM_URL
  	}
  },
  ready: function(){
    this.getInvoices();
  },
  methods: {
  	  getInvoices: function(){

        var data = {
          paginate: this.pagination.per_page,
          page: this.pagination.current_page,
        };

        this.$http.get(API_CRM_URL+'client/'+API_CRM_CLIENT+'/invoice', data).then(function (response) {
          this.$set('invoices',response.data.invoices.data);
          this.$set('pagination.total', response.data.invoices.total);
          this.$set('pagination.per_page', response.data.invoices.per_page);
          this.$set('pagination.from', response.data.invoices.from);
          this.$set('pagination.to', response.data.invoices.to);
          this.$set('pagination.current_page', response.data.invoices.current_page);
          this.$set('pagination.last_page', response.data.invoices.last_page);
        }, function(error) {
          // handle error
        });
      },
      showInvoice: function(id){

		    this.$http.get(API_CRM_URL+'client/'+API_CRM_CLIENT+'/invoice/'+id).then(function(response){
        	
      	});
      },
      pdfInvoice: function(id){
        token = localStorage.getItem('token');
        //Add authentication headers as params
        var params = {
            token: token,
        };
        //Add authentication headers in URL
        var url = [API_CRM_URL+'client/'+API_CRM_CLIENT+'/invoice/'+id+'/pdf', $.param(params)].join('?');
        //Open window
        window.open(url,'_blank');
      }
  },
  components: {
    pagination: vue_bootstrap_pagination
  }
});