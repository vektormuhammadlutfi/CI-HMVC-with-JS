var addBtn = $("#add-btn"),
    loadData = window.base_url + "driver/load_data",
    tableID = $("#datatable_ajax"),
    grid = new Datatable,
    urlUpdateStatus = window.base_url + "driver/update_status",
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
                }), $(document).on("click", ".btn-detail", function() {
                    var e = $(this).data("id");
                    Page.detail(e)
                }), $(document).on("click", ".btn-edit", function() {
                    var e = $(this).data("id");
                    Page.edit(e)
                }), $(document).on("submit", "#form-edit", function() {
                    var e = $(this).find(".submit").val();
                    return Page.submitForm($("#form-edit"), e), !1
                })
            },
            add: function() {
                var e = Helper.loadModal("lg"),
                    a = e.find(".modal-body"),
                    i = e.find(".modal-title");
                i.text("Add New Driver"), Helper.blockElement($(a)), Helper.ajax(Helper.baseUrl("driver/load_add_form"), "get", "html").error(function(a) {
                    e.find(".close").click()
                }).done(function(e) {
                    a.html(e), Helper.selectField($(".jenis-driver"), "Pilih Jenis Driver"),Helper.selectField($(".identitas"), "Pilih Identitas"), Helper.selectField($(".agama"), "Pilih Agama"), Helper.selectField($(".sim"), "Pilih Jenis SIM");
                    var i = null;
                    Helper.datePicker(i), Helper.unblockElement($(a))
                })
            },
            edit: function(e) {
                var a = Helper.loadModal("lg"),
                    i = a.find(".modal-body"),
                    t = a.find(".modal-title");
                t.text("Edit Data Driver"), Helper.blockElement($(i)), Helper.ajax(Helper.baseUrl("driver/load_edit_form"), "get", "html", {
                    id: e
                }).error(function(e) {
                    a.find(".close").click()
                }).done(function(e) {
                    i.html(e), Helper.selectField($(".identitas"), "Pilih Identitas"), Helper.selectField($(".agama"), "Pilih Agama"), Helper.selectField($(".sim"), "Pilih Jenis SIM");
                    var a = null;
                    Helper.datePicker(a), Helper.unblockElement($(i))
                })
            },
            detail: function(e) {
                var a = Helper.loadModal("lg"),
                    i = a.find(".modal-body"),
                    t = a.find(".modal-title");
                t.text("Detail Driver"), Helper.blockElement($(i)), Helper.ajax(Helper.baseUrl("driver/load_detail"), "get", "html", {
                    id: e
                }).error(function(e) {
                    a.find(".close").click()
                }).done(function(e) {
                    i.html(e), Helper.unblockElement($(i))
                })
            },
            submitForm: function(e, a) {
                var i = e.find(".submit");
                if (Helper.validateForm(e, {
                        identitas_id: {
                            required: !0
                        },
                        jenis_driver: {
                            required: !0
                        },
                        no_identitas: {
                            required: !0
                        },
                        nama: {
                            required: !0
                        },
                        tmp_lahir: {
                            required: !0
                        },
                        tgl_lahir: {
                            required: !0
                        },
                        alamat: {
                            required: !0
                        },
                        email: {
                            required: !0,
                            email: !0
                        },
                        agama_id: {
                            required: !0
                        },
                        sim_id: {
                            required: !0
                        },
                        no_sim: {
                            required: !0
                        },
                        tgl_exp_sim: {
                            required: !0
                        },
                        hp: {
                            required: !0
                        },
                        gapok: {
                            required: !0
                        },
                        no_rekening: {
                            required: !0
                        }
                    }), e.valid()) {
                    var t = Helper.baseUrl("driver/add");
                    a && (t = Helper.baseUrl("driver/edit")), Helper.blockElement(e.parent()), i.attr("disabled", !0), Helper.ajax(t, "post", "json", Helper.serializeForm(e)).error(function(a) {
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
            }
        }
    }();