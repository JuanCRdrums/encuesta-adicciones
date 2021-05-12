
// register modal component
var  comShowTicket= Vue.component('show-ticket',{
  template: '#modal-show-ticket',
  props: {
    show: {type: Boolean,required: true,twoWay: true},
    subject: {type: String,required: false},
    body: {type: String,required: false},
    ticket_code: {type: String,required: false},
    status: {type: String,required: false},
    created: {type: String,required: false},
    replies: {type: Array,required: false},
  }
});

var loadViewTickets = Vue.extend({
  template: '#componente-tickets',
  data: function () {
    return {
      tickets: [],
      fields:{
        body: '',
        subject: '',
        departments_id:  1
      },
      showModal: false,
      showData:{
        replies : [],
        subject : '',
        ticket_code: '',
        created: '',
        status: '',
        body : '',
      },
      searchKey : '',
      pagination: {
        total: 0, 
        per_page: 5,
        from: 1, 
        to: 0,
        last_page: 0,
        current_page: 1
      }
    }
  },
  ready: function(){
    this.getTickets();
  },
  methods : {
      getTickets: function(){

        var data = {
          paginate: this.pagination.per_page,
          page: this.pagination.current_page,
        };

        this.$http.get(API_CRM_URL+'client/'+API_CRM_CLIENT+'/ticket', data).then(function (response) {
          this.$set('tickets',response.data.tickets.data);
          this.$set('pagination.total', response.data.tickets.total);
          this.$set('pagination.per_page', response.data.tickets.per_page);
          this.$set('pagination.from', response.data.tickets.from);
          this.$set('pagination.to', response.data.tickets.to);
          this.$set('pagination.current_page', response.data.tickets.current_page);
          this.$set('pagination.last_page', response.data.tickets.last_page);
        }, function(error) {
          // handle error
        });
      },
      AddNewTicket:  function () {
      // User input
      var ticket = this.fields
      // Clear form input
      this.fields = { subject:'', body:'',departments_id:  1}
      // Send post request
      this.$http.post(API_CRM_URL+'client/'+API_CRM_CLIENT+'/ticket', ticket).then(function(response){
          alertify.success('Se agrego la solicitud correctamente');
          // Reload page
          this.getTickets();

      }, function(response){

          alertify.error('Ocurrio un error al crear la solicitud');
      });
    },
    ShowTicket :  function(id){
      this.$http.get(API_CRM_URL+'client/'+API_CRM_CLIENT+'/ticket/'+id).then(function(response){
        this.showModal = true;
        this.showData.subject = response.data.ticket.subject;
        this.showData.body = response.data.ticket.body;
        this.showData.ticket_code = response.data.ticket.ticket_code;
        this.showData.created = response.data.ticket.created;
        this.showData.status = response.data.ticket.status;
        this.showData.replies = response.data.ticket.replies;
      });
    }
  },
  components: {
    pagination: vue_bootstrap_pagination
  }
});