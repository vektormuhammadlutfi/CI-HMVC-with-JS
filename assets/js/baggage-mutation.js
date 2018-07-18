var addBtn = $("#add-btn"),
    loadData = window.base_url + "baggage_mutation/load_data",
    tableID = $("#datatable_ajax"),
    grid = new Datatable,
    urlUpdateStatus = window.base_url + "baggage_mutation/delete",
    cancelConfirm = !0,
    Page = function() {
        return {
            init: function() {
                Page.main(), Helper.datePicker()
            },
            main: function() {
                Helper.tableAjax(grid, tableID, loadData, urlUpdateStatus, cancelConfirm), addBtn.click(function() {
                    Page.add()
                }),$(document).on("click", ".btn-mutation", function() {
                    var e = $(this).data("id");
                    Page.mutation(e)
                }),
                $(document).on("submit", "#form-mutasi", function() {
                    return Page.submitMutation($("#form-mutasi"), null, null), !1
                })
            },
            mutation: function(e) {
                var a = Helper.loadModal("lg"),
                    i = a.find(".modal-body"),
                    t = a.find(".modal-title");
                t.text("Mutation Baggage_mutation"), Helper.blockElement($(i)), Helper.ajax(Helper.baseUrl("baggage_mutation/load_mutation_form"), "get", "html", {
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
                    var t = Helper.baseUrl("baggage_mutation/mutation");
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
            }

           
        }
    }();