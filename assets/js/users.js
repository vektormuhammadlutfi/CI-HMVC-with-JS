var addBtn = $("#add-btn"),
    loadData = window.base_url + "users/load_data",
    tableID = $("#datatable_ajax"),
    urlUpdateStatus = window.base_url + "users/update_status",
    cancelConfirm = true,
    grid = new Datatable,
    Users = function() {
        return {
            init: function() {
                Users.main(), Helper.datePicker()
            },
            main: function() {
                addBtn.click(function() {
                    Users.add()
                }), Helper.tableAjax(grid, tableID, loadData, urlUpdateStatus, cancelConfirm), 
                $(document).on("submit", "#add-user-form", function() {
                    return Users.submitForm($("#add-user-form"), null), !1
                }), $(document).on("click", ".btn-edit", function() {
                    var e = $(this).data("id");
                    Users.edit(e)
                }), $(document).on("submit", "#edit-user-form", function(e) {
                    var t = $(this).find(".submit").val();
                    return Users.submitForm($("#edit-user-form"), t), !1
                })
            },
            submitForm: function(e, t) {
                var r = e.find(".submit");
                if (Helper.validateForm(e, {
                        first_name: {
                            required: !0
                        },
                        phone: {
                            required: !0
                        },
                        username: {
                            required: !0,
                            minlength: 2
                        },
                        email: {
                            required: !0,
                            email: !0
                        },
                        password: {
                            required: !0,
                            minlength: 2
                        },
                        password_confirm: {
                            required: !0,
                            equalTo: "#password"
                        },
                        level: {
                            required: !0
                        },
                        kode_cabang: {
                            required: !0
                        }
                    }), e.valid()) {
                    var l = Helper.baseUrl("users/insert");
                    t && (l = Helper.baseUrl("users/update")), Helper.blockElement(e.parent()), r.attr("disabled", !0), Helper.ajax(l, "post", "json", Helper.serializeForm(e)).error(function(t) {
                        Helper.unblockElement(e.parent()), r.attr("disabled", !1)
                    }).done(function(t) {
                        t.status ? (e.parent().parent().find(".close").click(), swal(t.action, t.message, "success"), grid.getDataTable(tableID).ajax.reload()) : (r.attr("disabled", !1), Helper.unblockElement(e.parent()), swal({
                            title: t.action,
                            text: t.message,
                            type: "error",
                            html: !0
                        }))
                    })
                }
            },
            add: function() {
                var e = Helper.loadModal("lg"),
                    t = e.find(".modal-body"),
                    r = e.find(".modal-title");
                r.text("Add User"), Helper.blockElement($(t)), Helper.ajax(Helper.baseUrl("users/loadAddForm"), "get", "html").error(function(t) {
                    e.find(".close").click()
                }).done(function(e) {
                    t.html(e), Helper.selectField($("select")), Helper.unblockElement($(t))
                })
            },
            edit: function(e) {
                var t = Helper.loadModal("lg"),
                    r = t.find(".modal-body"),
                    l = t.find(".modal-title");
                l.text("Edit User"), Helper.blockElement($(r)), Helper.ajax(Helper.baseUrl("users/loadEditForm"), "get", "html", {
                    id: e
                }).error(function(e) {
                    t.find(".close").click()
                }).done(function(e) {
                    r.html(e), Helper.selectField($("select")), Helper.unblockElement($(r))
                })
            },
            delete: function(e) {
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover the data!",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Yes, delete it!",
                    confirmButtonColor: "#DD6B55",
                    closeOnConfirm: !1
                }, function() {
                    Helper.ajax(Helper.baseUrl("users/delete"), "post", "json", {
                        id: e
                    }).done(function(e) {
                        e.status ? (Users.reloadGrid(), swal(e.action, e.message, "success")) : swal(e.action, e.message, "error")
                    })
                })
            }
        }
    }();