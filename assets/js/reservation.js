var addBtn = $("#add-btn"),
    loadData = window.base_url + "reservation/load_data/" + id_group,
    tableID = $("#datatable_ajax"),
    grid = new Datatable,
    urlUpdateStatus = window.base_url + "reservation/delete",
    Page = function() {
        return {
            init: function() {
                Page.main(), Helper.datePicker()
            },
            main: function() {
                Helper.tableAjax(grid, tableID, loadData, urlUpdateStatus, null), 
                addBtn.click(function() {
                    Page.add()
                }), $(document).on("submit", "#form-create", function() {
                    return Page.submitForm($("#form-create"), null, null), !1
                }), $(document).on("click", ".btn-edit", function() {
                    var e = $(this).data("id");
                    Page.edit(e)
                }), $(document).on("submit", "#form-edit", function() {
                    var a = $(this).find(".submit").val();
                    return Page.submitForm($("#form-edit"), a), !1
                })
            },
            submitForm: function(e, a) {
                var i = e.find(".submit");
                if (Helper.validateForm(e, {

                        id_hotel: {
                            required: !0
                        },
                        check_in: {
                            required: !0
                        },
                        check_out: {
                            required: !0
                        },
                        night: {
                            required: !0,
                            number: !0
                        },
                        double: {
                            required: !0,
                            number: !0
                        },
                        triple: {
                            required: !0,
                            number: !0
                        },
                        quad: {
                            required: !0,
                            number: !0
                        },
                        quint: {
                            required: !0,
                            number: !0
                        },
                        meals_plan: {
                            required: !0
                        },
                        remarks: {
                            required: !0
                        },
                        
                    }), e.valid()) {
                    var t = Helper.baseUrl("reservation/add");
                    a && (t = Helper.baseUrl("reservation/edit")), Helper.blockElement(e.parent()), i.attr("disabled", !0), Helper.ajax(t, "post", "json", Helper.serializeForm(e)).error(function(a) {
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

                i.text("Add Data Reservation"), Helper.blockElement($(a)), Helper.ajax(Helper.baseUrl("reservation/load_add_form/"+id_group), "get", "html").error(function(a) {
                    e.find(".close").click()
                }).done(function(e) {
                    a.html(e), Helper.handleDatetimePicker($(".pilih"), "Pilih");
                    Helper.selectField($(".pilihbanyak"), "Pilih");
                    var i = null;
                    Helper.unblockElement($(a))
                })
            },
            edit: function(e) {
                var a = Helper.loadModal("lg"),
                    i = a.find(".modal-body"),
                    t = a.find(".modal-title");
                t.text("Edit Data Reservation"), Helper.blockElement($(i)), Helper.ajax(Helper.baseUrl("reservation/load_edit_form"), "get", "html", {
                    id:e
                }).error(function(e) {
                    a.find(".close").click()
                }).done(function(e) {
                    i.html(e), Helper.handleDatetimePicker($(".pilih"), "Pilih");
                    Helper.selectField($(".pilihbanyak"), "Pilih");
                    var a = null;
                    Helper.unblockElement($(i))
                })
            }
            
        }
    }();