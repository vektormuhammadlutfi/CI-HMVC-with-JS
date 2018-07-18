var addBtn = $("#add-btn"),
    loadData = window.base_url + "baggage/load_data",
    tableID = $("#datatable_ajax"),
    grid = new Datatable,
    urlUpdateStatus = window.base_url + "baggage/delete",
    cancelConfirm = !0,
    Page = function() {
        return {
            init: function() {
                Page.main(), Helper.datePicker()
            },
            main: function() {
                Helper.tableAjax(grid, tableID, loadData, urlUpdateStatus, cancelConfirm), addBtn.click(function() {
                    Page.add()
                }), $(document).on("submit", "#form-create", function() {
                    return Page.submitForm($("#form-create"), null, null), !1
                }), $(document).on("click", ".btn-edit", function() {
                    var e = $(this).data("id");
                    Page.edit(e)
                }),$(document).on("click", ".btn-mutation", function() {
                    var e = $(this).data("id");
                    Page.mutation(e)
                }),$(document).on("click", ".add-btn-mutation", function() {
                    Page.addMutation()
                }),$(document).on("submit", "#form-edit", function() {
                    var a = $(this).find(".submit").val();
                    return Page.submitForm($("#form-edit"), a), !1
                }),
                $(document).on("submit", "#form-mutation", function() {
                    var a = $(this).find(".submit").val();
                    return Page.submitMutation($("#form-mutation"), a), !1
                }),
                $(document).on("submit", "#form-mutasi", function() {
                    var a = $(this).find(".submit").val();
                    return Page.submitMutasi($("#form-mutasi"), a), !1
                })
            },
            submitForm: function(e, a) {
                var i = e.find(".submit");
                if (Helper.validateForm(e, {
                        nm_barang: {
                            required: !0
                        },
                        satuan: {
                            required: !0
                        },
                        untuk_jk: {
                            required: !0
                        },
                        stok: {
                            required: !0,
                            number: !0
                        },
                        harga_beli: {
                            required: !0,
                            number: !0
                        },
                        harga_jual: {
                            required: !0,
                            number: !0
                        }
                    }), e.valid()) {
                    var t = Helper.baseUrl("baggage/add");
                    a && (t = Helper.baseUrl("baggage/edit")), Helper.blockElement(e.parent()), i.attr("disabled", !0), Helper.ajax(t, "post", "json", Helper.serializeForm(e)).error(function(a) {
                        Helper.unblockElement(e.parent()), i.attr("disabled", !1)
                    }).done(function(a) {
                        a.status ? (e.parent().parent().find(".close").click(), swal(a.action, a.message, "success"), grid.getDataTable(tableID).ajax.reload()) : (i.attr("disabled", !1), Helper.unblockElement(e.parent()), swal({
                            title: a.action,
                            text: a.message,
                            type: "error",
                            html: !0
                        }))
                    })
                }
            },
            add: function() {
                var e = Helper.loadModal("lg"),
                    a = e.find(".modal-body"),
                    i = e.find(".modal-title");
                i.text("Tambah Data Baggage"), Helper.blockElement($(a)), Helper.ajax(Helper.baseUrl("baggage/load_add_form"), "get", "html").error(function(a) {
                    e.find(".close").click()
                }).done(function(e) {
                    a.html(e), Helper.selectField($(".identitas"), "Pilih Identitas"), Helper.selectField($(".agama"), "Pilih Agama"), Helper.selectField($(".sim"), "Pilih Jenis SIM");
                    var i = null;
                    Helper.datePicker(i), Helper.unblockElement($(a))
                })
            },
            edit: function(e) {
                var a = Helper.loadModal("lg"),
                    i = a.find(".modal-body"),
                    t = a.find(".modal-title");
                t.text("Edit Data Baggage"), Helper.blockElement($(i)), Helper.ajax(Helper.baseUrl("baggage/load_edit_form"), "get", "html", {
                    id:e
                }).error(function(e) {
                    a.find(".close").click()
                }).done(function(e) {
                    i.html(e), Helper.selectField($("select")), Helper.unblockElement($(i))
                    var a = null;
                    Helper.datePicker(a), Helper.unblockElement($(i))
                })
            },
            mutation: function(e) {
                var a = Helper.loadModal("lg"),
                    i = a.find(".modal-body"),
                    t = a.find(".modal-title");
                t.text("Mutation Baggage"), Helper.blockElement($(i)), Helper.ajax(Helper.baseUrl("baggage/load_mutation_form"), "get", "html", {
                    id:e
                }).error(function(e) {
                    a.find(".close").click()
                }).done(function(e) {
                    i.html(e), Helper.selectField($("select")), Helper.unblockElement($(i))
                    var a = null;
                    Helper.datePicker(a), Helper.unblockElement($(i))
                })
            },
            submitMutation: function(e, a) {
                var i = e.find(".submit");
                if (Helper.validateForm(e, {
                        stok    : {
                            required: !0
                        },
                        kd_office: {
                            required: !0
                        }
                    }), e.valid()) {
                    var t = Helper.baseUrl("baggage/mutation");
                    Helper.blockElement(e.parent()), i.attr("disabled", !0), Helper.ajax(t, "post", "json", Helper.serializeForm(e)).error(function(a) {
                        Helper.unblockElement(e.parent()), i.attr("disabled", !1)
                    }).done(function(a) {
                        a.status ? (e.parent().parent().find(".close").click(), swal(a.action, a.message, "success"), grid.getDataTable(tableID).ajax.reload()) : (i.attr("disabled", !1), Helper.unblockElement(e.parent()), swal({
                            title: a.action,
                            text: a.message,
                            type: "error",
                            html: !0
                        }))
                    })
                }
            },
            addMutation: function() {
            
                var modal = Helper.loadModal('lg');
                var modalBody = modal.find('.modal-body');
                var modalTitle = modal.find('.modal-title');

                modalTitle.text('Add Data Mutasi');
                Helper.blockElement($(modalBody));
                Helper.ajax(Helper.baseUrl('baggage/load_add_mutasi'), 'get', 'html')
                
                .error(function(err) {
                    modal.find('.close').click();
                })

                .done(function(data) {
                    modalBody.html(data);
                    Helper.selectField($("select"));
                    Helper.datePicker();
                    Page.handleTransaction();
                    Helper.unblockElement($(modalBody));
                    
                });
            },
            // service
            handleTransaction: function() {
                
                //DYNAMIC ROWS
                var count = 1;
                $("#add_row").click(function(){
                    count += 1;

                    $('#container').append('\
                        <tr class="baris form-create-barang" id="form-create-barang'+ count +'"">\
                        <td align="center">\
                        <select id="barang'+count+'" class="form-control barang" name="nm_barang[]" required></select>\
                        <td align="center"><input id="harga_beli'+count+'" class="form-control harga_beli money" name="harga_beli[]" type="text" readonly></td>\
                        <td align="center"><input id="harga_jual'+count+'" class="form-control harga_jual money" name="harga_jual[]" type="text" readonly></td>\
                        <td align="center"><input id="kd_office'+count+'" class="form-control kd_office" name="kd_asal[]" type="text" readonly></td>\
                        <td align="center"><input id="cekstok'+count+'" name="cekstok[]" class="form-control cekstok" type="text"></td>\
                        <input id="nama_barang'+count+'" name="nama_barang[]" class="form-control nama_barang" type="hidden">\
                        <td align="center"><input id="jml'+count+'" class="form-control jml money" name="jml[]" type="text" value="0"></td>\
                        <td>\
                            <button type="button" class="btn btn-circle btn-danger" id="hapus"><i class="icon-trash"></i></button>\
                            <input id="rows'+count+'" name="rows[]" value="'+count+'" type="hidden">\
                        </td>\
                        </tr>\
                        ');

                    // Helper.selectField('#barang'+count);
                    $('#barang'+count).select2({
                        placeholder: '--- Masukkan Nama Barang ---',
                        ajax: {
                          url: Helper.baseUrl("baggage/load_barang"),
                          dataType: 'json',
                          delay: 250,
                          processResults: function (data) {
                            return {
                              results: data
                            };
                          },
                          cache: true
                        }
                    });


                    $(document).on('change', '#barang'+count, function() {
                        var id= $(this).find(":selected").val();
                        $.ajax({
                            url : Helper.baseUrl("baggage/get_select_barang"),
                            method : "POST",
                            data : {id: id},
                            async : true,
                            dataType : 'json',
                            success: function(data){
                                var hrg_beli = data.harga_beli;
                                document.getElementById('harga_beli'+count).value = hrg_beli;
                                var hrg_jual = data.harga_jual;
                                document.getElementById('harga_jual'+count).value = hrg_jual;
                                var cekstok = data.stok;
                                document.getElementById('cekstok'+count).value = cekstok;
                                var kdoffice = data.kd_office;
                                document.getElementById('kd_office'+count).value = kdoffice;
                                var nmbrg = data.nm_barang;
                                document.getElementById('nama_barang'+count).value = nmbrg;
            
                            }
                        });
                    });

                });



                $(document).on('click', '#hapus', function() {

                    $(this).parents(".baris").remove();
                    $('#btn-submit-add-form').prop('disabled',false);

                });

            },
            submitMutasi: function(e, a) {
                var i = e.find(".submit");
                if (Helper.validateForm(e, {
                        kd_office: {
                            required: !0
                        }
                    }), e.valid()) {
                    var t = Helper.baseUrl("baggage/mutasi");
                    Helper.blockElement(e.parent()), i.attr("disabled", !0), Helper.ajax(t, "post", "json", Helper.serializeForm(e)).error(function(a) {
                        Helper.unblockElement(e.parent()), i.attr("disabled", !1)
                    }).done(function(a) {
                        a.status ? (e.parent().parent().find(".close").click(), swal(a.action, a.message, "success"), grid.getDataTable(tableID).ajax.reload()) : (i.attr("disabled", !1), Helper.unblockElement(e.parent()), swal({
                            title: a.action,
                            text: a.message,
                            type: "error",
                            html: !0
                        }))
                    })
                }
            },

           
        }
    }();