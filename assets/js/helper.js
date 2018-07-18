var Helper = function() {
    return {
        ajax: function(a, e, t, n) {
            return $.ajax({
                async: true,
                url: a,
                type: e,
                datatype: t,
                data: n,
                error: function(a) {
                    swal(a.status.toString(), a.statusText, "error")
                }
            })
        },
        ajaxFile: function(a, e, t, n) {
            return $.ajax({
                url: a,
                type: e,
                datatype: t,
                enctype: 'multipart/form-data',
                data: n,
                error: function(a) {
                    swal(a.status.toString(), a.statusText, 'error');
                },
                contentType: false,
                processData: false
            });
        },
        handleDatetimePicker : function () {
            if (!jQuery().datetimepicker) {
            return;
            }

            $(".form_datetime").datetimepicker({
                autoclose: true,
                isRTL: App.isRTL(),
                format: "dd MM yyyy - hh:ii",
                fontAwesome: true,
                pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left")
            });

            $(".form_advance_datetime").datetimepicker({
                isRTL: App.isRTL(),
                format: "dd MM yyyy - hh:ii",
                autoclose: true,
                todayBtn: true,
                fontAwesome: true,
                startDate: "2013-02-14 10:00",
                pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left"),
                minuteStep: 10
            });

            $(".form_meridian_datetime").datetimepicker({
                isRTL: App.isRTL(),
                format: "dd MM yyyy - HH:ii P",
                showMeridian: true,
                autoclose: true,
                fontAwesome: true,
                pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left"),
                todayBtn: true
            });

            // $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal

            // Workaround to fix datetimepicker position on window scroll
            $( document ).scroll(function(){
                $('#form_modal1 .form_datetime, #form_modal1 .form_advance_datetime, #form_modal1 .form_meridian_datetime').datetimepicker('place'); //#modal is the id of the modal
            });
        },
        serializeForm: function(a) {
            var e = a.serializeArray(),
                t = a.find(".submit"),
                n = t.attr("name"),
                o = t.val();
            return n && o && e.push({
                name: n,
                value: o
            }), e
        },
        baseUrl: function(a) {
            return window.base_url + a
        },
        loadModal: function(a) {
            var e = "modal-" + (new Date).getTime(),
                t = '<div id="' + e + '" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true" style="display: none;">\
                    <div class="modal-dialog modal-' + a + '">\
                        <div class="modal-content">\
                            <div class="modal-header">\
                                <button type="button" class="close" data-dismiss="modal">&times;</button>\
                                <h4 class="modal-title">Modal title</h4>\
                            </div>\
                                <div class="modal-body" style="min-height: 80px;">\
                                </div>\
                            </div>\
                        </div>\
                    </div>';
            return $("body").append(t), $("#" + e).modal("show").on("hidden.bs.modal", function(a) {
                $(this).remove()
            }), $("#" + e)
        },
        FormRepeater: function () {
            $('.mt-repeater').each(function(){
                $(this).repeater({
                    show: function () {
                        $(this).slideDown();
                        $('.date-picker').datepicker({
                            rtl: App.isRTL(),
                            orientation: "left",
                            autoclose: true
                        });
                    },

                    hide: function (deleteElement) {
                        if(confirm('Are you sure you want to delete this element?')) {
                            $(this).slideUp(deleteElement);
                        }
                    },

                    ready: function (setIndexes) {

                    }

                });
            });
        },
        blockElement: function(a) {
            App.blockUI({
                target: a,
                boxed: !0
            })
        },
        unblockElement: function(a) {
            App.unblockUI(a)
        },
        validateForm: function(a, e) {
            var t = $(".alert-danger", a),
                n = $(".alert-success", a);
            return $.extend($.validator.messages, {
                required: "Tidak boleh kosong.",
                remote: "Silahkan periksa kembali.",
                email: "Masukkan alamat email yang valid.",
                url: "Masukkan alamat url yang valid.",
                date: "Masukkan format tanggal yang valid.",
                dateISO: "Please enter a valid date (ISO).",
                number: "Masukkan nomor yang benar.",
                digits: "Please enter only digits.",
                creditcard: "Please enter a valid credit card number.",
                equalTo: "Masukkan kembali nilai yang sama.",
                accept: "Please enter a value with a valid extension.",
                maxlength: $.validator.format("Maksimal {0} karakter."),
                minlength: $.validator.format("Minimal {0} karakter."),
                rangelength: $.validator.format("Please enter a value between {0} and {1} characters long."),
                range: $.validator.format("Please enter a value between {0} and {1}."),
                max: $.validator.format("Tidak boleh lebih dari {0}."),
                min: $.validator.format("Tidak boleh kurang dari {0}.")
            }), a.validate({
                errorElement: "span",
                errorClass: "help-block help-block-error",
                focusInvalid: !0,
                ignore: "",
                rules: e,
                invalidHandler: function(a, e) {
                    n.hide(), t.show(), App.scrollTo(t, -200)
                },
                errorPlacement: function(a, e) {
                    e.is(":checkbox") ? a.insertAfter(e.closest(".md-checkbox-list, .md-checkbox-inline, .checkbox-list, .checkbox-inline")) : e.is(":radio") ? a.insertAfter(e.closest(".md-radio-list, .md-radio-inline, .radio-list, .radio-inline")) : a.insertAfter(e)
                },
                highlight: function(a) {
                    $(a).closest(".form-group").addClass("has-error")
                },
                unhighlight: function(a) {
                    $(a).closest(".form-group").removeClass("has-error")
                },
                success: function(a) {
                    a.closest(".form-group").removeClass("has-error")
                }
            })
        },
        bootGrid: function(a, e) {
            return a.bootgrid({
                columnSelection: !0,
                css: {
                    icon: "zmdi icon",
                    iconColumns: "zmdi-view-module",
                    iconDown: "zmdi-sort-amount-desc",
                    iconRefresh: "zmdi-refresh",
                    iconUp: "zmdi-sort-amount-asc"
                },
                formatters: e,
                ajaxSettings: {
                    method: "GET",
                    cache: !0
                }
            })
        },
        tableAjax: function (grid, tableID, url, urlUpdateStatus, cancelConfirm) {
            // grid = new Datatable();

            grid.init({
                src: tableID,
                onSuccess: function (grid, response) {
                    // grid:        grid object
                    // response:    json object of server side ajax response
                    // execute some code after table records loaded
                },
                onError: function (grid) {
                    // execute some code on network or other general error  
                },
                onDataLoad: function(grid) {
                    // execute some code on ajax data load
                },
                loadingMessage: 'Loading...',
                dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

                    // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                    // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                    // So when dropdowns used the scrollable div should be removed. 
                    //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                    
                    // save datatable state(pagination, sort, etc) in cookie.
                    "bStateSave": false, 

                    // save custom filters to the state
                    "fnStateSaveParams":    function ( oSettings, sValue ) {
                        console.log('work');
                        $("#datatable_ajax tr.filter .form-control").each(function() {
                            sValue[$(this).attr('name')] = $(this).val();
                        });
                    
                        return sValue;
                    },

                    // read the custom filters from saved state and populate the filter inputs
                    "fnStateLoadParams" : function ( oSettings, oData ) {

                        //Load custom filters
                        $("#datatable_ajax tr.filter .form-control").each(function() {
                            var element = $(this);
                            if (oData[element.attr('name')]) {
                                element.val( oData[element.attr('name')] );
                            }
                        });
                        
                        return true;
                    },
                    "serverSide": true,
                    "lengthMenu": [
                        [20, 50, 100, 150, -1],
                        [20, 50, 100, 150, "All"] // change per page values here
                    ],
                    "pageLength": 20, // default record count per page
                    "ajax": {
                        "url": url, // ajax source
                    },
                    "ordering": false,
                    "order": [
                        [0, "desc"]
                    ],// set first column as a default sort by asc,

                    drawCallback: function(e, row){
                        
                        $('.btn-update-status').confirmation( {
                            singleton: true,
                            popout: true,
                        });

                        $('.btn-update-status').on('confirmed.bs.confirmation', function () {
                            
                            var id = $(this).data('id');
                            var action = '1';
                            $.ajax({
                                url : urlUpdateStatus,
                                type: "POST",
                                dataType: "JSON",
                                data: { id: id, action: action },
                                success: function(data)
                                {
                                    if(data.status)
                                    {

                                        swal(data.action, data.message, "success");
                                        
                                    }else{

                                        swal(data.action, data.message, "error");
                                    }
                                    
                                    grid.getDataTable(tableID).ajax.reload();
                                    
                                }
                            });
                        });

                        if(cancelConfirm){
                            $('.btn-update-status').on('canceled.bs.confirmation', function () {
                                
                                var id = $(this).data('id');
                                var action = '0';
                                $.ajax({
                                    url : urlUpdateStatus,
                                    type: "POST",
                                    dataType: "JSON",
                                    data: { id: id, action: action },
                                    success: function(data)
                                    {
                                        if(data.status)
                                        {

                                            swal(data.action, data.message, "success");
                                            
                                        }else{

                                            swal(data.action, data.message, "error");
                                        }
                                        
                                        grid.getDataTable(tableID).ajax.reload();
                                        
                                    }
                                });
                            });
                        }
                    },
                }
            });

        },
        loadChosen: function(a) {
            $(a).chosen({
                width: "inherit"
            })
        },
        selectField: function(a, e) {
            $.fn.select2.defaults.set("theme", "bootstrap"), $(a).select2({
                placeholder: e,
                allowClear: !0,
                width: null
            })
        },
        datePicker: function(a) {
            $(".date-picker").datepicker({
                autoclose: !0,
                startDate: a
            })
        },
        timePicker: function() {
            $(".timepicker-default").timepicker({
                defaultTime: !1,
                autoclose: !0,
                showSeconds: !0,
                minuteStep: 1,
                showMeridian: !1
            })
        },
        clockfaceTimePicker : function () {

            if (!jQuery().clockface) {
                return;
            }

            $('.clockface_1').clockface();

            $('#clockface_2').clockface({
                format: 'HH:mm',
                trigger: 'manual'
            });

            $('#clockface_2_toggle').click(function (e) {
                e.stopPropagation();
                $('#clockface_2').clockface('toggle');
            });

            $('#clockface_2_modal').clockface({
                format: 'HH:mm',
                trigger: 'manual'
            });

            $('#clockface_2_modal_toggle').click(function (e) {
                e.stopPropagation();
                $('#clockface_2_modal').clockface('toggle');
            });

            $('.clockface_3').clockface({
                format: 'H:mm'
            }).clockface('show', '14:30');

            // Workaround to fix clockface position on window scroll
            $( document ).scroll(function(){
                $('#form_modal5 .clockface_1, #form_modal5 #clockface_2_modal').clockface('place'); //#modal is the id of the modal
            });
        },
        //main function to initiate the module
        formWizard: function () {
            $('.formwizard').bootstrapWizard();
        }

    }
}();