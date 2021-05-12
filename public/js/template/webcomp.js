  /**
     * WEBCOMPONENT = MODAL VIEW
     * DESCRIPCIÓN: Carga una vista dentro de un modal
     */
alertify.defaults.glossary.title = 'Mensaje';
alertify.defaults.glossary.ok = ui_btn_accept;
alertify.defaults.glossary.cancel = ui_btn_cancel;
alertify.defaults.theme.ok = 'ajs-ok btn btn-success';
alertify.defaults.theme.cancel = 'ajs-ok btn btn-danger';
function getModalView(){
  
    $("modal-view").each(function (i) {
        var $this = $(this);

        if ($this.hasClass('initilized')) 
                return;

        var title = $(this).attr("title");
        var btn_text = $(this).attr("button-text");
        var custom_class = $(this).attr("custom-class");
        var large = ($(this).attr("large") == "true");
        var tooltip = $(this).attr("tooltip");
        var disabled = $(this).attr("data-disabled");
        var n = Math.floor((Math.random() * 100000) + 1);

        $this.attr('id','modal-view-'+n);

        $(this).after("<button  "+((tooltip == undefined) ? null :  " type='button'  href='javascript:void(0)' data-ref='#modal-view-"+n+"'  data-toggle='tooltip' data-large='"+large+"' title='"+tooltip+"'")+" id='btn-open-modal-view-" + n + "' class='btn  "+ (disabled == 'true'? 'disabled' : null) +"  " + ((custom_class == undefined) ? "btn-default" : custom_class) + "'  "+ (disabled == 'true'? 'disabled' : null) +"   >" + ((btn_text == undefined) ? "Modal view" : btn_text) + "</button>");
        
        $this.addClass('initilized');

        $("button#btn-open-modal-view-" + n).off('click').on('click',function (e) {
            e.preventDefault();
            var $this = $(this);
            var large = $this.attr('data-large');
            var close_modal = ($this.hasClass('not-close-modal')? false : true);

            var modal_view = $($this.attr('data-ref'));

            var dataSend = new Object();
            dataSend.json = modal_view.attr("data-json");
            dataSend.resource = modal_view.attr("resource");
            dataSend.path = modal_view.attr("path");
            var id_modal = modal_view.attr("data-id");
            var title = modal_view.attr("title");
            var url = modal_view.attr("url-request");
            var reload = (modal_view.attr("reload") == "true");

            $.ajax({
                data: {data: dataSend},
                url: url, type: 'POST',
                beforeSend: function(){
                     $("#loading-ajax").fadeIn('400');
                },
                success: function (data) {
                    $("body").append(data);
                    $("#"+id_modal+" .modal-title").html(title);
                
                    if (large == 'true') {
                        $("#"+id_modal+" .modal-dialog").addClass("modal-lg");
                    }else{
                        $("#"+id_modal+" .modal-dialog").removeClass("modal-lg");
                    }

                    $("#"+id_modal).modal("show");
                },
                complete: function(){
                    $("#loading-ajax").fadeOut('400');
                   
                    $('div#'+id_modal+' button[type="submit"]').on('click', function(event) {
                        event.preventDefault();
                        modalViewAddListenerFormAjax(reload,id_modal,$('div#'+id_modal+' .modal-body form'),close_modal);
                    });
                    
                    datapickerui(); 
                    timePickerDef();
                    wyEditorSummer();
                    getModalView();
                    hiddenModal();
                    jsSwitchActive();
                    requestConfirm();
                    loadDatatables();
                    popoverTooltip();
                    loadSelect2();
                    
                    if (typeof changeStatusItem === "function")
                         changeStatusItem();
                   
                }
            });
        });
    });
}

 /**
 * WEBCOMPONENT = REQUEST_CONFIRM
 * DESCRIPCIÓN: Confirma una petición
 */
function requestConfirm(){

    $("request-confirm").each(function (i) {
        var $this = $(this);

        if ($this.hasClass('initilized')) 
                return;

        var n = Math.floor((Math.random() * 100000) + 1);   
        var url = $(this).attr("url-request");
        var token = $(this).attr("token");
        var title = $(this).attr("title");
        var message = $(this).attr("message");
        var btn_text = $(this).attr("button-text");
        var reload = ($(this).attr("reload") == "true");
        var custom_class = $(this).attr("custom-class");
        var json = ($(this).attr("data-json").length == 0) ? null : $.parseJSON(($(this).attr("data-json").replace(/'/g, "\"")));


        $(this).after("<button type='button' data-token='"+token+"'  data-action='" + url + "' data-method='"+(json != null && '_method' in json? json['_method'] : 'POST' )+"'  id='btn-request-confirm-" + n + "' title='" + title + "' class='btn " + ((custom_class == undefined) ? "btn-default" : custom_class) + "'>" + ((btn_text == undefined) ? "#" : btn_text) + "</button>" );

        $this.addClass('initilized');

        $("button#btn-request-confirm-" + n).click(function () {
            var $this = $(this);
            //Establece las propiedades del mensaje modal
            alertify.defaults.glossary.title = title;

            alertify.confirm(message, function (e) {
                requestConfirmAddListenerFormAjax(reload,$this);
            });
        });
    });
}


function requestConfirmAddListenerFormAjax(reload,button){

    var formData = new FormData();

    formData.append("_method", button.attr("data-method"));
    formData.append("_token", button.attr('data-token')); 
    
    $.ajax({ 
        method: 'POST',
        type: 'POST',
        url: button.attr("data-action"),
        dataType : 'json',  
        data:formData,
        contentType: false,       // The content type used when sending data to the server.
        processData:false,        // To send DOMDocument or non processed data file it is set to false
        beforeSend: function(){
            $("#loading-ajax").fadeIn('400');
        },
        success:function(json, statusText, xhr, $form){
            
            responseJson(json)
              
            if (reload) {
                setTimeout(function(){
                    location.reload();
                }, 200);
            }  
            
        },  // post-submit callback 
        complete:function(data){
            $("#loading-ajax").fadeOut('400');
            requestConfirm();
            loadDatatables();
            loadSelect2();
            datapickerui(); 
            timePickerDef();
            wyEditorSummer();
            getModalView();
            hiddenModal();
            jsSwitchActive();
            popoverTooltip();
        }

    });
}


function modalViewAddListenerFormAjax(reload,modal,form,close_modal) {
   
    var clearform = form.attr('data-clearform'); 
    
    $.ajax({ 
        method: 'POST',
        type: 'POST',
        url: form.attr("action"),
        dataType : 'json',  
        data: form.serializeAllFormData(),
        contentType: false,       // The content type used when sending data to the server.
        processData:false,        // To send DOMDocument or non processed data file it is set to false
        beforeSend: function(){
            $("#loading-ajax").fadeIn('400');
        },
        success:function(json, statusText, xhr, $form){
            
            responseJson(json);

            if (typeof clearform !== typeof undefined && clearform !== false) {
                form.clearForm();      
            }

            if (modal != null && close_modal)
                $("div#"+modal).modal("hide");
            
            if (reload) {
                setTimeout(function(){
                    location.reload();
                }, 200);
            }  
            
        },  // post-submit callback 
        complete:function(data){
            $("#loading-ajax").fadeOut('400');
            datapickerui(); 
            timePickerDef();
            wyEditorSummer();
            getModalView();
            hiddenModal();
            jsSwitchActive();
            requestConfirm();
            loadDatatables();
            popoverTooltip();
            loadSelect2();
        }

    });
}


function responseJson(json){

    if ("container-id" in json && $('#'+json["container-id"]).length > 0) {
                
        if ("datatables" in json){
            var dt = $('#'+json["container-id"]).parent('table');
            dt.dataTable().fnDestroy();
            $('#'+json["container-id"]).html(json["data-html"]);
            dt.dataTable().fnDraw();
        }else{
            $('#'+json["container-id"]).html(json["data-html"]);
        }
    }

    if (json["alert.type"] != undefined) {
        //mensaje de exito
        if (json["alert.type"] == "success") {
            alertify.success(json["alert.text"]);
        }

        //mensaje informativo
        if (json["alert.type"] == "info") {
            alertify.notify(json["alert.text"]);
        }

        //mensaje de error
        if (json["alert.type"] == "danger") {
            alertify.error(json["alert.text"]);
        }
    }


    if ("module" in json && "entity" in json) {
        if (json['module']=='Habilitation' && json['entity']=='HabilitationSelfEvaluationItem' && $('#table-habilitation-self-evaluation').length ) {
             $('#table-habilitation-self-evaluation').find('button[data-item-validate='+json['ref_id']+'][data-status='+json['status']+']').trigger('click');   
       
        }else if(json['module']=='Patientsafety' && json['entity']=='PatientSafetyItemEvaluation' && $('#table-patient-safety-numeral-evaluate').length){
            $('#table-patient-safety-numeral-evaluate').find('button[data-item-validate='+json['ref_id']+'][data-status='+json['status']+']').trigger('click');     
        
        }else if(json['module']=='Tasks' && json['entity']=='TaskTrace' && "task" in json && $('select[name=compliance_per]').length){
            $('select[name=compliance_per]').val(json.task.compliance_per).trigger('change');
            $('.progress-bar').attr('aria-valuenow', json.task.compliance_per).css('width', json.task.compliance_per+'%').html(json.task.compliance_per+'%');
        
            if (json.task.compliance_per < 50 ) {
                $('.progress-bar').removeClass('progress-bar-primary progress-bar-success').addClass('progress-bar-danger');
            }else if(json.task.compliance_per >=50 && json.task.compliance_per < 100 ){
                $('.progress-bar').removeClass('progress-bar-danger progress-bar-success').addClass('progress-bar-primary');
            }else if(json.task.compliance_per == 100 ){
                $('.progress-bar').removeClass('progress-bar-primary progress-bar-danger').addClass('progress-bar-success');
                $('select[name=status]').val(1).trigger('change');
            }
        }else if(json['module']=='Occupationalhealth' && json['entity']=='OccupationalhealthMinimumStandardsQualification'  ){
          
            var button_justification = $('tr[data-numeral='+json.item.numeral_id+']').find('button.btn-item-justification-'+json.item.numeral_id);
            var button_tasks = $('tr[data-numeral='+json.item.numeral_id+']').find('button.btn-item-tasks-'+json.item.numeral_id);
            if (json.item.status == 3 && json.item.justify == 1){
                button_justification.removeClass('disabled').removeAttr('disabled');
                
            }else{
                button_justification.addClass('disabled').attr('disabled',true);
                
            }

            button_tasks.removeClass('disabled').removeAttr('disabled');

            $('tr[data-numeral='+json.item.numeral_id+']').find('td.justification').html(json.item.justification);


            if ("tasks" in json) {
                var tasks_add = '';
                $.each(json.tasks, function(index, val) {
                    tasks_add += '<div class="well well-sm">'+json.tasks[index].name+'</div>';
                });

                $('tr[data-numeral='+json.item.numeral_id+']').find('td.tasks').html(tasks_add);
            }
        }
    }


}


getModalView();
requestConfirm();

