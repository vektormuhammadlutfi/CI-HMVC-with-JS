var addBtn = $("#add-btn"),
    loadData = window.base_url + "payment/load_data",
    tableID = $("#datatable_ajax"),
    grid = new Datatable,
    urlUpdateStatus = window.base_url + "payment/delete",
    Page = function() {
        return {
            init: function() {
                Page.main(), Helper.datePicker()
            },
            main: function() {
                Helper.tableAjax(grid, tableID, loadData, urlUpdateStatus, null), addBtn.click(function() {
                    Page.add()
                }), $(document).on("submit", "#form-create", function() {
                    return Page.submitForm($("#form-create"), null, null), !1

                }), $(document).on("click", ".btn-payment", function() {
                    var e = $(this).data("id");
                    Page.payment(e)

                }), $(document).on("submit", "#form-edit", function() {
                    var a = $(this).find(".submit").val();
                    return Page.submitForm($("#form-edit"), a), !1

                }),$(document).on("click", ".btn-edit", function() {
                    var e = $(this).data("id");
                    Page.edit(e)

                }),$(document).on("click", ".btn-print", function() {
                    var e = $(this).data("id");
                    Page.print(e)
                }),$(document).on("click", ".btn-export", function() {
                    Page.export()
                })
            },
            submitForm: function(e, a) {
                if (confirm("Are you sure ?")) {
                    var i = e.find(".submit");
                    var file_data = $('#path_bukti_bayar').prop('files')[0];
                    var form = $('form')[0];
                    var form_data = new FormData(form);
                    form_data.append('file', file_data);

                    if (Helper.validateForm(e, {
                            jml_bayar: {
                                required: !0,
                                number: !0
                            },
                            tgl_bayar: {
                                required: !0
                            },
                            catatan: {
                                required: !0
                            },
                            path_bukti_bayar: {
                                required: !0
                            },
                        }), e.valid()) {
                        var t = Helper.baseUrl("payment/add");
                        a && (t = Helper.baseUrl("payment/edit")), 
                        Helper.blockElement(e.parent()), i.attr("disabled", !0); 

                        $.ajax({
                            url: t, // point to server-side PHP script
                            dataType: 'json',  // what to expect back from the PHP script, if anything
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: form_data,
                            type: 'POST',
                            error: function(t) {
                                swal(a.status.toString(), a.statusText, "error")
                            }
                        })

                        .error(function(a){Helper.unblockElement(e.parent()), i.attr("disabled", !1)}).done(function(a) 
                        {
                            a.status ? (e.parent().parent().find(".close").click(), 
                                swal(a.action, a.message, "success"), 
                                grid.getDataTable(tableID).ajax.reload()) : (i.attr("disabled", !1), 
                                Helper.unblockElement(e.parent()), swal({
                                title: a.action,
                                text: a.message,
                                type: "error",
                                html: !0
                            }))
                        })
                    } else {
                    alert("Process Failed");
                    }
                }
            },
            add: function(e) {
                var e = Helper.loadModal("lg"),
                    a = e.find(".modal-body"),
                    i = e.find(".modal-title");

                i.text("Add Data payment"), Helper.blockElement($(a)), Helper.ajax(Helper.baseUrl("payment/load_payment_form"), "get", "html").error(function(a) {
                    e.find(".close").click()
                }).done(function(e) {
                    a.html(e), Helper.selectField($(".jadwal"), "Pilih"), Helper.selectField($(".pilihbanyak"), "Pilih"), Helper.selectField($(".cabang"), "Pilih");
                    var i = null;
                    Helper.datePicker(i), Helper.unblockElement($(a));
                })
            },
            edit: function(e) {
                window.location.href = Helper.baseUrl("payment_detail/pendaftaran/") + e;
            },
            detail: function(e) {
                var a = Helper.loadModal("lg"),
                    t = a.find(".modal-body"),
                    i = a.find(".modal-title");
                i.text("Detail"), Helper.blockElement($(t)), Helper.ajax(Helper.baseUrl("registrasi/load_detail"), "get", "html", {
                    id: e
                }).error(function(e) {
                    a.find(".close").click()
                }).done(function(e) {
                    t.html(e), Helper.unblockElement($(t))
                })
            },

            payment: function(e) {
                var a = Helper.loadModal("lg"),
                    i = a.find(".modal-body"),
                    t = a.find(".modal-title");
                t.text("Payment"), Helper.blockElement($(i)), Helper.ajax(Helper.baseUrl("payment/load_payment_form"), "get", "html", {
                    id:e
                }).error(function(e) {
                    a.find(".close").click()
                }).done(function(e) {
                    i.html(e), Helper.selectField($("select")), Helper.unblockElement($(i))
                    var a = null;
                    Helper.datePicker(a), Helper.unblockElement($(i)),Helper.multiselect()
                })
            },
            export: function() {
            
                var modal = Helper.loadModal('small');
                var modalBody = modal.find('.modal-body');
                var modalTitle = modal.find('.modal-title');

                modalTitle.text('Export Based On Schedule');
                Helper.blockElement($(modalBody));
                Helper.ajax(Helper.baseUrl('payment/load_export'), 'get', 'html')
                
                .error(function(err) {
                    modal.find('.close').click();
                })

                .done(function(data) {
                    modalBody.html(data);
                    Helper.datePicker();
                    Helper.selectField($(".jadwal"), "Select Schedule");
                    Page.handleTransaction();
                    Helper.unblockElement($(modalBody));
                    
                });
            },

            // print: function(e) {
            //     window.location.href = Helper.baseUrl("payment/cetak/") + e;
            // }
            
        }
    }();