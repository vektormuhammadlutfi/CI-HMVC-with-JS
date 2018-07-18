var addBtn = $("#add-btn"),
    loadData = window.base_url + "schedule_movement/load_data",
    tableID = $("#datatable_ajax"),
    grid = new Datatable,
    urlUpdateStatus = window.base_url + "schedule_movement/delete",
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
                }), $(document).on("click", ".btn-edit", function() {
                    var e = $(this).data("id");
                    Page.edit(e);
                }), $(document).on("submit", "#form-edit", function() {
                    var a = $(this).find(".submit").val();
                    return Page.submitForm($("#form-edit"), a), !1
                })
            },
            submitForm: function(e, a) {
                var i = e.find(".submit");
                if (Helper.validateForm(e, {
                    //id_jadwal,hari,tgl,lokasi
                        id_jadwal: {
                            required: !0
                        },
                        hari: {
                            required: !0
                        },
                        tgl: {
                            required: !0
                        },
                        lokasi: {
                            required: !0
                        }
                    }), e.valid()) {
                    var t = Helper.baseUrl("schedule_movement/add");
                    a && (t = Helper.baseUrl("schedule_movement/edit")), Helper.blockElement(e.parent()), i.attr("disabled", !0), Helper.ajax(t, "post", "json", Helper.serializeForm(e)).error(function(a) {
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

                i.text("Add Data schedule_movement"), Helper.blockElement($(a)), Helper.ajax(Helper.baseUrl("schedule_movement/load_add_form"), "get", "html").error(function(a) {
                    e.find(".close").click()
                }).done(function(e) {
                    a.html(e), Helper.selectField($(".select"), "Select Schedule");
                    var i = null;
                    Helper.datePicker(i), Helper.unblockElement($(a))
                })
            },
            edit: function(e) {
                // Helper.ajax(Helper.baseUrl("movement"), "get", "html", {
                //     id:e
                // });

                // Helper.baseUrl("movement");

                window.location.href = Helper.baseUrl("movement/schedule/") + e;

                // window.base_url + "movement" + e;
            }

            
        }
    }();