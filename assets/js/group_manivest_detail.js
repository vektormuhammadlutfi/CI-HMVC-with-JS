var addBtn = $("#add-btn"),
    loadData = window.base_url + "group_manivest_detail/load_data/" + id_group,
    tableID = $("#datatable_ajax"),
    grid = new Datatable,
    urlUpdateStatus = window.base_url + "group_manivest_detail/delete",
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

                        id_movement: {
                            required: !0
                        },
                        jam: {
                            required: !0
                        },
                        agenda: {
                            required: !0
                        }
                    }), e.valid()) {
                    var t = Helper.baseUrl("group_manivest_detail/add");
                    a && (t = Helper.baseUrl("group_manivest_detail/edit")), Helper.blockElement(e.parent()), i.attr("disabled", !0), Helper.ajax(t, "post", "json", Helper.serializeForm(e)).error(function(a) {
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

                i.text("Add Data movedet"), Helper.blockElement($(a)), Helper.ajax(Helper.baseUrl("group_manivest_detail/load_add_form/"+idmovement), "get", "html").error(function(a) {
                    e.find(".close").click()
                }).done(function(e) {
                    a.html(e), Helper.selectField($(".movedet"), "Pilih Schedule");
                    var i = null;
                    Helper.datePicker(i),Helper.clockfaceTimePicker(), Helper.unblockElement($(a))
                })
            },
            edit: function(e) {
                var a = Helper.loadModal("lg"),
                    i = a.find(".modal-body"),
                    t = a.find(".modal-title");
                t.text("Edit Data group_manivest_detail"), Helper.blockElement($(i)), Helper.ajax(Helper.baseUrl("group_manivest_detail/load_edit_form"), "get", "html", {
                    id:e
                }).error(function(e) {
                    a.find(".close").click()
                }).done(function(e) {
                    i.html(e), Helper.selectField($("select")), Helper.unblockElement($(i))
                    var a = null;
                    Helper.datePicker(a), Helper.clockfaceTimePicker(), Helper.unblockElement($(i))
                })
            }
            
        }
    }();