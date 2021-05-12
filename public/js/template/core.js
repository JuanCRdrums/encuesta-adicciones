(function ($) {
    // This function is used to get error message for all ajax calls
    function getErrorMessage(jqXHR, exception) {
      var msg = '';
      if (jqXHR.status === 0) {
          msg = 'Not connect.\n Verify Network.';
      } else if (jqXHR.status == 404) {
          msg = 'Requested page not found. [404]';
      } else if (jqXHR.status == 500) {
          msg = 'Internal Server Error [500].';
      } else if (exception === 'parsererror') {
          msg = 'Requested JSON parse failed.';
      } else if (exception === 'timeout') {
          msg = 'Time out error.';
      } else if (exception === 'abort') {
          msg = 'Ajax request aborted.';
      } else {
          msg = 'Uncaught Error.\n' + jqXHR.responseText;
      }
      console.log(msg);
    }

    if ($.fn.datepicker) {

     $.datepicker._updateDatepicker_original = $.datepicker._updateDatepicker;
      $.datepicker._updateDatepicker = function (inst) {
          $.datepicker._updateDatepicker_original(inst);
          var afterShow = this._get(inst, 'afterShow');
          if (afterShow)
              afterShow.apply((inst.input ? inst.input[0] : null));  // trigger custom callback

      }

      $.datepicker.setDefaults({
          dateFormat: 'yy-mm-dd',
          dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sabado'],
          dayNamesMin: ['D', 'L', 'M', 'X', 'J', 'V', 'S'],
          dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
          changeMonth: true,
          changeYear: true,
          yearRange: '-115:+5',
          monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
          monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
          firstDay: 1
      });
    };

    $.fn.selectRange = function (start, end) {
      if (!end)
          end = start;
      return this.each(function () {
          if (this.setSelectionRange) {
              this.focus();
              this.setSelectionRange(start, end);
          } else if (this.createTextRange) {
              var range = this.createTextRange();
              range.collapse(true);
              range.moveEnd('character', end);
              range.moveStart('character', start);
              range.select();
          }
      });
    };

    //CONFIGURACIONES POR DEFECTO PETICIONES AJAX
    $.ajaxSetup({
        headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
        error: function (jqXhr, json, errorThrown) {
            if (jqXhr.status === 422) {
                //process validation errors here.
                var errors = jqXhr.responseText; //this will get the errors response data.
                //show them somewhere in the markup
                if (errors.length > 0) {
                    errorsHtml = '<ul>';

                    $.each(JSON.parse(errors), function (key, value) {
                        errorsHtml += '<li>' + value + '</li>'; //showing only the first error.
                    });

                    errorsHtml += '</ul>';

                    alertify.error(errorsHtml) //appending to a <div id="form-errors"></div> inside form
                }

            } else if (jqXhr.status === 403) {
                alertify.error('Sorry you do not have permission to perform this action');

            } else if (jqXhr.status === 500) {
                alertify.error('An error occurred on the server please contact the administrator');
            }


            getErrorMessage(jqXhr, json);
        }
    });

    //FUNCION PARA LIMPIAR FORMULARIOS
    $.fn.clearForm = function () {
        return this.each(function () {
            var $this = this;
            $('input,select,textarea', $this).each(function () {
                var type = this.type, tag = this.tagName.toLowerCase();
                if (type == 'text' || type == 'password' || type == 'number' || type == 'date')
                {    
                  this.value = '';
                }
                else if(tag == 'textarea'){
                   this.value = '';
                   if ($(this).hasClass('sum_wyeditor')) {
                     $(this).summernote('code', '');
                   }
                   
                }
                else if (type == 'checkbox' || type == 'radio')
                {    
                  this.checked = false;
                }
                else if (tag == 'select')
                {
                   $(this).val('').trigger('change');
                }
            });
        });
    };

    //FUNCION PARA SERIALIZAR FORMULARIOS
    $.fn.serializeAllFormData = function () {
        var form = $(this);
        var data = new FormData();
        
        $('input[type=text],input[type=hidden],select,textarea,input[type=email],input[type=date],input[type=number],input[type=month]', form).each(function () {
            data.append(this.name, $(this).val());
        });

        $('input[type=radio],input[type=checkbox]', form).each(function () {
            if ($(this).is(':checked')) {
                data.append(this.name, $(this).val());
            }
        });

        if (form.hasClass('form_tabla')) {
            $('input', form.find('.formtable').dataTable().fnGetNodes()).each(function () {
                if ($(this).is(':checked')) {
                    data.append($(this).attr('name'), $(this).val());
                }
            });
        }

        $('input[type=file]', form).each(function (i, input) {
            if (input.value) data.append(input.name, input.files[0]);
        });

        $(':disabled', form).each(function () {
          data.append(this.name, $(this).val());
        });

        return data;
    }


    $.fn.serializeAllArray = function () {
        var data =new Array();

        $('input[type=text],input[type=hidden],select,textarea,input[type=email],input[type=date],input[type=number],input[type=month]',this).each(function () { 
            if ($(this).hasClass('text-editor')) {
                 data.push({ name: this.name, value: tinymce.get($(this)[0].id).getContent() });
            }else{
                data.push({ name: this.name, value: $(this).val() });
            }
        });

        $('input[type=radio],input[type=checkbox]',this).each(function () { 
            if($(this).is(':checked')){
             data.push({ name: this.name, value: $(this).val() });
            }
        });

        if ($(this).hasClass('form_tabla')) {
            $('input', $(this).find('.formtable').dataTable().fnGetNodes()).each(function() {
                if($(this).is(':checked')){
                    data.push({ name: $(this).attr('name'), value: $(this).val() });
                }
            }); 
        }

        $(':disabled[name]', this).each(function () { 
            data.push({ name: this.name, value: $(this).val() });
        });

        return $.param(data);
      }


      
       //FUNCION PARA SERIALIZAR FORMULARIOS
        $.fn.serializeAll = function () {
            var data = new Array();

            $('input,select,textarea', this).each(function () {
                var type = this.type, tag = this.tagName.toLowerCase();
                if (type == 'checkbox' || type == 'radio'){
                  if ($(this).is(':checked')) {
                      data.push({name: this.name, value: $(this).val()});
                  }
                }else{
                  data.push({name: this.name, value: $(this).val()});
                } 
            });

            return data;
        }


        $.fn.toImage = function() {
          $(this).each(function() {
              var svg$ = $(this);
              var width = svg$.width();
              var height = svg$.height();

              // Create a blob from the SVG data
              var svgData = new XMLSerializer().serializeToString(this);
              var blob = new Blob([svgData], { type: "image/svg+xml;charset=utf-8" });

              // Get the blob's URL
              var domUrl = self.URL || self.webkitURL || self;
              var blobUrl = domUrl.createObjectURL(blob);

              // Load the blob into a temporary image
              $('<img />')
                  .width(width)
                  .height(height)
                  .on('load', function() {
                      try {
                          var canvas = document.createElement('canvas');
                          canvas.width = width;
                          canvas.height = height;
                          var ctx = canvas.getContext('2d');

                          // Start with white background (optional; transparent otherwise)
                          ctx.fillStyle = '#fff';
                          ctx.fillRect(0, 0, width, height);

                          // Draw SVG image on canvas
                          ctx.drawImage(this, 0, 0);

                          // Replace SVG tag with the canvas' image
                          svg$.replaceWith($('<img />').attr({
                              src: canvas.toDataURL(),
                              width: width,
                              height: height
                          }));
                      } finally {
                          domUrl.revokeObjectURL(blobUrl);
                      }
                  })
                  .attr('src', blobUrl); 
          });
      };


}(jQuery));


$(document).ready(function () {
    /**
     * ESTABLECE UNA FUNCIONALIDAD QUE PERMITE QUE CUANDO SE PULSE UN BOTÓN
     * DE ENVIO DE FORMULARIO SE INDIQUE QUE SE ESTA EJECUTANDO UN PROCESO
     */

    $('button[type="submit"]:not(.no-animate),a.btn:not(.field-actions a,.no-animate)').on('click', function (e) {
        var $this = $(this);

        if ($this.find('span').length > 0) {
          var icon = $this.find('span');
        }else if($this.find('i').length > 0){
          var icon = $this.find('i');
        }

        var $class = icon.attr('class');
        var textButton = ($this.html()).replace(/<[^>]*>?/g, '');
        $this.html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span>" + textButton);
        $this.attr("disabled", "disabled");
        if ($this.parents('form:first').length > 0){
          $this.parents('form:first').submit();
        }else{
          setTimeout(function(){ 
             $this.removeAttr("disabled");
             $this.html("<span class='"+$class+"'></span>" + textButton);
             clearTimeout();
          }, 3000);
        }
    });


    //USO DE SELECT2
    $.fn.select2.defaults.set('language', 'es');



/**
 * [generateMainMenu description]
 * @return {[type]} [description]
 */
function generateMainMenu() {
    //MENU
    var route_view = $('body').attr('data-route-view');
    var module = $('body').attr('data-module');
    var entity = $('body').attr('data-entity');
    var route = route_view.split("-");
    var menu_active = '';

    if (module.length > 0)
        $('.sidebar-menu').find('li.treeview[data-module=' + module+']').addClass('active');


    if ($('.sidebar-menu').find('li[data-route=' + route_view+']').length > 0) {
      menu_active = $('.sidebar-menu').find('li[data-route=' + route_view+']');
    }else if(module.length > 0 && entity.length > 0){
      menu_active = $('.sidebar-menu').find('ul.treeview-menu[data-module=' + module+']').find('li[data-entity='+entity+']'); 
    }

  
    if (menu_active.length > 0) {
      //remover todos los activos
      $('.sidebar-menu li').each(function (index, el) {
          if ($(this).hasClass('active')) {
              $(this).removeClass('active');
              if ($(this).hasClass('menu-open')) {
                  $(this).removeClass('menu-open');
              };
          };
      });

      menu_active.addClass('active');
      if (menu_active.hasClass('treeview')) {
          menu_active.addClass('menu-open');
      };

      if (menu_active.parent().hasClass('treeview-menu')) {
              menu_active.parent().parent('li').addClass('active menu-open');
      };
    };

};
generateMainMenu();
   
});
//FUNCIONES ADICIONALES

/**
 * [loadSelect2 description]
 * @return {[type]} [description]
 */
function loadSelect2(){
   if ($("select.select2-basic").length > 0) {
      $("select.select2-basic").select2({
        destroy: true,
        allowClear: true,
      });
    };

    if ($("select.select2-multiple").length > 0) {
      $("select.select2-multiple").select2({
          templateResult: function (data) {
            var $res = $('<span></span>');
            var $check = $('<input type="checkbox" />');
            
            $res.text(data.text);
            
            if (data.element) {
              $res.prepend($check);
              $check.prop('checked', data.element.selected);
            }

            return $res;
          }
        });
    };

    if ($("select.select2-ajax").length > 0) {
      $("select.select2-ajax").select2({
        ajax: {
          dataType: 'json',
          delay: 250,
          data: function (params) {
            var data = {
                term: params.term, // search term
                page: params.page
            };

            var attrs = this.attr('data-attrs');

            if (typeof attrs !== typeof undefined && attrs !== false) {
                $.each( $.parseJSON(attrs), function(index, val) {
                     data[index] =val; 
                });
            }

            return data;
          },
          processResults: function (data, params) {
            params.page = params.page || 1;
            return {
              results: data.items,
              pagination: {
                more: (params.page * 30) < data.total_count
              }
            };
          },
          cache: true
        },
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 1,
      });
  }

}
loadSelect2();

function datapickerui() {
    if ($('.datepickerui').length > 0) {
        $.each($('.datepickerui'), function(index, val) {
           var $this = $(this);
           $this.datepicker({dateFormat: 'yy-mm-dd'});

            var minDate = $this.attr('data-minDate');

            if (typeof $this !== typeof undefined && $this !== false)
              $this.datepicker( "option", "minDate", new Date(minDate) );

        });
        
    };

    if ($(".datepickerui_ym").length > 0) {
        $(".datepickerui_ym").datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            //currentText: "Este mes",
            closeText: ui_btn_accept,
            dateFormat: 'yy-mm',
            onClose: function (dateText, inst) {
                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                $(this).datepicker('setDate', new Date(year, month, 1));
                setTimeout(function () {
                    $('#ui-datepicker-div').removeClass('month_only')
                }, 250);
            },
            beforeShow: function (input, inst) {
                if ((datestr = $(this).val()).length > 0) {
                    actDate = datestr.split('-');
                    year = actDate[0];
                    month = actDate[1] - 1;
                    $(this).datepicker('option', 'defaultDate', new Date(year, month));
                    $(this).datepicker('setDate', new Date(year, month));
                }
                $('#ui-datepicker-div').addClass('month_only');
            }
        });
    };
}
datapickerui();

  //USO DE DATATABLES JQUERY

function loadDatatables(){
  if ($('table.datatables_basic').length > 0) {
      $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
      });   

      $('table.datatables_basic').each(function(index, el) {
          var oTable = $(this).dataTable({
              stateSave: true,
              destroy: true,
              responsive: true,
              autoWidth: false,
              info: true,
              drawCallback: function(oSettings) {
                this.api().columns.adjust().responsive.recalc();
              },
              "language": {
                  "url": "/plugins/datatables/datatables.lang_es_ES.json"
              },
          });

          var aData = oTable.fnGetData( this );

          var attr = oTable.attr('data-order');
          if (typeof attr !== typeof undefined && attr !== false) {
              oTable.fnSort(JSON.parse(attr));
          }else{
              oTable.fnSort( [ [0,'desc'] ] );
          } 
      });
  };

  if ($('.datatables_tools').length > 0) {
        $('.datatables_tools').each(function(index, el) {
          var oTable = $(this).dataTable({
                dom: 'Bfrtip',
                stateSave: true,
                destroy: true,
                responsive: true,
                info: true,
                autoWidth: false,
                buttons: [
                {
                      extend: 'excelHtml5',
                      exportOptions: {
                          columns: ':visible:not(.not-print)'
                      }
                  },
                  {
                      extend: 'csv',
                      fieldSeparator: ',',
                      fieldBoundary: '',
                      extension: '.txt',
                      text: "TXT",
                      header:false,
                      exportOptions: {
                          columns: ':visible:not(.not-print)'
                      }
                  },
                  {
                      extend: 'colvis',
                      text : 'Columnas visibles'
                  }
                  
              ],
                "language": {
                    "url": "/plugins/datatables/datatables.lang_es_ES.json"
                },
            });

             var aData = oTable.fnGetData( this );
            var attr = oTable.attr('data-order');

            if (typeof attr !== typeof undefined && attr !== false) {
                oTable.fnSort(JSON.parse(attr));
            }else{
                oTable.fnSort( [ [0,'desc'] ] );
            } 
        });
    }
}

loadDatatables();


function  timePickerDef() {
    if ($('.timepickerui').length > 0) {
        $('.timepickerui').timepicker({
            minuteStep: 5,
            showMeridian: false,
            defaultTime: false,
            showSeconds:true,
        });
    }
    ;
}
timePickerDef();

/**
 * Funcion para cargar vista de documentos
 */
function loadDocumentAjaxView(documentviewer,urlfile,text)
{
  var id_viewer = documentviewer;
  var documentviewer = $('#'+documentviewer);
  var extension = documentviewer.attr('data-extension');
  var office_docs = ["docx", "doc", "xls", "xlsx", "ppt", "pptx"];
  var image_types = ["jpg", "jpeg", "png", "gif"];

  $.getScript( BASEURL+"/plugins/PDFObject/pdfobject.min.js", function( data, textStatus, jqxhr ) {
    if (extension == 'pdf') {
      var options = {
         width: "100%",
         height: "800px"
      };
      PDFObject.embed(urlfile+"#toolbar=0&navpanes=0&scrollbar=0", "#"+id_viewer, options);
    }else if(office_docs.indexOf(extension) > -1){
      //var iframe = '<iframe style="width:100%;height:800px" src="'+BASEURL+'/ViewerJS/#..'+urlfile.replace(new RegExp(BASEURL, "gi"), "")+'" frameborder="0"></iframe>';
      $('.view-document-container').find('.mask-viewer').remove();
      var button = '<div class="text-center well well-sm col-md-4 col-md-offset-4"><i class="fa fa-file-text-o fa-7x text-blue"></i> <hr><a href="'+urlfile+'" class="btn btn-primary btn-lg btn-block "><h4><i class="fa fa-download"></i> DESCARGAR</h4></a></div>';
      documentviewer.html(button);
    }else if(image_types.indexOf(extension) > -1){
      var image = '<img src="'+urlfile+'" class="img-responsive img-center" />';
      documentviewer.html(image);
    }else{
      var no_preview = '<div class="no_preview_container"><div class="no_preview">'+text+'</div></div>';
      documentviewer.html(no_preview);
    }
  });
}



/**
 * [wyEditorSummer description]
 * @return {[type]} [description]
 */
function wyEditorSummer() {
    if ($('.sum_wyeditor').length > 0) {
          var autoSave;

 //AGREGAR BOTON PARA RECONOCIMIENTO DE VOZ
        
        if (('webkitSpeechRecognition' in window)) {
            var recognizing = false;
            var recognition = new webkitSpeechRecognition();
            recognition.continuous = true;
            recognition.interimResults = true;
            recognition.lang = "es-CO";

            recognition.onstart = function() { 
                recognizing = true;
                alertify.success("Empezando a escuchar"); 
            };
            
            recognition.onend = function() {  
                recognizing = false;
                alertify.error("Terminó de escuchar");
            };
        } 

        $('.sum_wyeditor').each(function(index, el) {
            var editor_summernote = $(this);

            var rows = editor_summernote.attr('rows') || 2;

            editor_summernote.summernote({
                lang: 'es-ES', 
                height : rows * 100,                
                focus: true,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['color', ['color']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['para', ['ul', 'ol','paragraph']],
                    ['height', ['height']],
                    ['insert', ['table','hr']],
                    ['view', ['fullscreen','codeview']],
                  ],
               callbacks: {
                     onFocus: function() {
                        var editor = $(this);

                        if (editor.hasClass('auto-save')) {

                          autoSave = setInterval(function(){ 
                              
                              var module = editor.attr('data-module');
                              var entity = editor.attr('data-entity');
                              var attribute = editor.attr('name'); 
                              var value = editor.summernote("code");
                              var id = editor.attr('data-id'); 
                              if (entity.length && value.length && id.length) {
                                  $.ajax({
                                    url: BASEURL+'/app/autosave/ajax',
                                    type: 'PUT',
                                    dataType: 'json',
                                    data: {module: module, entity : entity, attribute: attribute , value : value,id:id},
                                    success: function(json){
                                        if (json["alert.type"] != undefined) {
                                            //mensaje de exito
                                            if (json["alert.type"] == "success") {
                                                alertify.notify(json["alert.text"])
                                            }else if (json["alert.type"] == "danger") {
                                                alertify.error(json["alert.text"]);
                                            }
                                        }
                                    }
                                  });
                              }
                          }, 20000);
                          
                        }
                        
                     },
                     onBlur : function(){
                      clearInterval(autoSave);
                    },
                     onInit: function () {

                        var editor = $(this);

                        var speechRecognition = '<button  data-toggle="tooltip" data-placement="bottom" type="button" class="summ-speech-recongnition btn btn-default btn-sm btn-small" title="Reconocimiento de voz" data-event="something" tabindex="-1"><i class="fa fa-microphone-slash"></i></button>';            
                        var fileGroup = '<div class="note-recognition btn-group">' + speechRecognition + '</div>';
                        $(fileGroup).appendTo(editor.next('.note-editor').find('.note-toolbar'));

                        $('.summ-speech-recongnition').off('click').on('click',  function(event) {
                            event.preventDefault();
                            
                            var btn  = $(this);

                            if (!('webkitSpeechRecognition' in window)) {
                              alertify.error("¡API no soportada en este navegador!");
                              return false;
                            } 

                            recognition.onresult = function(event) {
                                for (var i = event.resultIndex; i < event.results.length; i++) {
                                    if(event.results[i].isFinal){
                                        btn.parent().parent().parent().prev().summernote('insertText',event.results[i][0].transcript);
                                    }
                                }
                            };

                            if (recognizing == true) {
                              recognition.stop();
                              btn.find('i').removeClass('fa-microphone').addClass('fa-microphone-slash');
                            } else {
                              recognition.start();
                              btn.find('i').removeClass('fa-microphone-slash').addClass('fa-microphone');
                            }

                        });
                        //BTN RECONOCIMIENTO DE VOZ

                    }
               }
            });
        });
    };
}

wyEditorSummer();
//  REMOVE MODAL
function  hiddenModal() {
    $('.modal').on('hidden.bs.modal', function (e) {
       var modal = $(this);
        
        if (!$(modal).hasClass('modal-no-ajax'))
                modal.remove();

        if($('.modal').hasClass('in'))
            $('body').addClass('modal-open');
    });
}
hiddenModal();


function allChkSwechery(){
    if ($('.allcheck').length > 0) {
        $('.allcheck').on('change', function(event) {
            event.preventDefault();
            var check = $(this);
            var class_chk = check.attr('data-class') || 'js-switch' ;
            var checked= false;
            if ($(check).is(':checked'))
                checked = true;

            var switcheries = Array.prototype.slice.call(document.querySelectorAll('.'+class_chk+':not(.noallcheck)'));
            switcheries.forEach(function(checkbox) {
                if (checkbox.checked != checked) {
                    $(checkbox).trigger('click');
                } 
            });
        });
    };
}

allChkSwechery();

function jsSwitchActive(){
  var elems = Array.prototype.slice.call(document.querySelectorAll('input[type=checkbox]:not([data-switchery=true])'));
  elems.forEach(function (html) {
      var switchery = new Switchery(html, {size: 'small',jackSecondaryColor: '#ffe9e9'});
      var node = switchery.switcher;
      var span_lb_n = document.createElement('span');
      var span_lb_y = document.createElement('span');
      span_lb_n.append('NO ');
      span_lb_y.append(' SI');
      span_lb_n.className = 'switchery-lb-no switchery-lb';
      span_lb_y.className = 'switchery-lb-yes switchery-lb';
      node.before(span_lb_n);
      node.after(span_lb_y);
  });
}

jsSwitchActive();


function onClickTD(obj) {
    var active = $(obj).attr("data-active");
    if (active == "true")
        return;
    $(obj).attr("data-active", "true");
    var id = $(obj).attr("data-id");
    var attr = $(obj).attr("data-attr");
    var val = $(obj).html();
    $(obj).html("<input type='text' class='form-control' value='" + val + "'/>");
    //Establece el foco en el campo de texto creado y lo posiciona en la ultima posicion
    $(obj).children("input").focus();
    $(obj).children("input").selectRange($(obj).children("input").val().length);


    var td = $(obj);

    //Evento Enter en el input, actualiza la información
    $(obj).children("input").keypress(function (event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            updateDataInput(td, $(this), id, attr);
        }
    });


    $(obj).children("input").focusout(function () {
        updateDataInput(td, $(this), id, attr);
    });
}


function updateDataInput(td, input, id, attr) {
    td.html(input.val());
    td.attr("data-active", "false");

    $.ajax({
        url: route_ajax_update,
        type: 'PUT',
        dataType: 'json',
        data: {"id": id, "attr": attr, "value": input.val()},
        success: function (data) {
            alertify.success(data['alert.text']);
        },
        error: function () {
            alertify.error("¡Ocurrio un error al tratar de actualizar la información!");
        }
    });
}

$("td.input-data").click(function () {
    onClickTD(this);
});



function btnAddOptionSelectAjax(){
    $('button.btn-add-option-select').on('click', function (event) {
        event.preventDefault();
        var btn = $(this);
        var field = $(this).attr('data-field');
        var entity = $(this).attr('data-entity');
        var key = $(this).attr('data-key');

        if (btn.hasClass('btn-default')) {
            btn.removeClass('btn-default');
            btn.addClass('btn-success');
            btn.html('<i class="fa fa-check"></i>');
            $('#select_'+field).hide();
            $('#select_'+field).after('<input type="text" name="input_'+field+'" class="form-control">');

        }else{
            btn.removeClass('btn-success'); 
            btn.addClass('btn-default');
            btn.html('<i class="fa fa-plus"></i>');
            $('#select_'+field).show();
            var option  =$('input[name=input_'+field+']').val();
            $('input[name=input_'+field+']').remove();
                
            if (option.length > 0) {
                $.ajax({
                    url: BASEURL + "/app/add/option/select",
                    type: 'POST',
                    dataType: 'json',
                    data: {option: option, key: key, entity : entity},
                    success: function(data){

                        var options = '<option value="" >--Seleccionar--</option>';
                        $.each(data, function(id, desc) {
                               options +=  '<option value="'+id+'" >'+desc+'</option>';
                        });

                        $('#select_'+field).html(options);
                    },
                    beforeSend: function(){
                        $("#loading-ajax").fadeIn('400');
                    },
                    complete: function(data){
                        $("#loading-ajax").fadeOut('400');
                    }
                });
                
            };

        }
    });
}

btnAddOptionSelectAjax();

function btnGetUrlChartImg(){
   $('button.btn_save_image').on('click', function(event) {
      event.preventDefault();
      var btn = $(this);
      var containerId = btn.attr('data-container');
      var image = $('#'+containerId).find('svg').toImage();
   });
}

btnGetUrlChartImg();


 function hex2rgb(hex, opacity) {
        var h=hex.replace('#', '');
        h =  h.match(new RegExp('(.{'+h.length/3+'})', 'g'));

        for(var i=0; i<h.length; i++)
            h[i] = parseInt(h[i].length==1? h[i]+h[i]:h[i], 16);

        if (typeof opacity != 'undefined')  h.push(opacity);

        return 'rgba('+h.join(',')+')';
}

function getRandomColor() {
    var letters = 'A012F34BC789D56E'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

function getArrayColors($number){
  var colors = [];
  for (var i = 0; i < $number; i++) {
    colors.push(hex2rgb(getRandomColor(), '0.7'));
  }
  return colors;
}

function popoverTooltip() {
    if ($('[data-toggle="popover"]').length > 0)
      $('[data-toggle="popover"]').popover();
}
popoverTooltip();