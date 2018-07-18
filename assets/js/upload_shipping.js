var addBtn = $("#add-btn"),
    loadData = window.base_url + "upload_shipping/get_data",
    tableID = $("#datatable_ajax"),
    grid = new Datatable,
    urlUpdateStatus = window.base_url + "upload_shipping/update_status",
    cancelConfirm = !0,
    Page = function() {
        return {
            init: function() {
                Page.main(), Helper.datePicker()
            },
            main: function() {
                Helper.tableAjax(grid, tableID, loadData, urlUpdateStatus, cancelConfirm), addBtn.click(function() {
                    Page.add()
                }), $(document).on("submit", "#form-import", function() {
                    return Page.submitImport($("#form-import"), null, null), !1
                }), $(document).on("click", ".btn-detail", function() {
                    var e = $(this).data("id");
                    Page.detail(e)
                }), $(document).on("click", ".btn-edit", function() {
                    var e = $(this).data("id");
                    Page.edit(e)
                }), $(document).on("submit", "#form-edit", function() {
                    var e = $(this).find(".submit").val();
                    return Page.submitForm($("#form-edit"), e), !1
                }), $(document).on("click", "#add-btn", function() {
                    Page.add()
                })
            },
            add: function() {
                var e = Helper.loadModal("lv"),
                    a = e.find(".modal-body"),
                    i = e.find(".modal-title");
                i.text("Upload Data Shipping"), Helper.blockElement($(a)), Helper.ajax(Helper.baseUrl("upload_shipping/load_add_form"), "get", "html").error(function(a) {
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
                        file: {
                            required: !0
                        }
                    }), e.valid()) {
                    var t = Helper.baseUrl("upload_shipping/import");
                    a && (t = Helper.baseUrl("upload_shipping/import")), 
                    Helper.blockElement(e.parent()), i.attr("disabled", !0), 
                    Helper.ajax(t, "post", "json", Helper.serializeForm(e)).error(function(a) {
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
            submitImport: function(e, a){
                var i = e.find(".submit");
                if (Helper.validateForm(e, {
                        file: {
                            required: !0
                        }
                    }), e.valid()) {
                    var t = Helper.baseUrl("upload_shipping/import");
                    $.ajax({
                        url:t,
                        method:"POST",
                        data:new FormData($('form')[0]),
                        contentType:false,
                        cache:false,
                        processData:false,
                    }).error(function(a){
                        Helper.unblockElement(e.parent()), i.attr("disabled", !1);
                        e.parent().parent().find(".close").click();
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