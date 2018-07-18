var addBtn = $("#add-btn"),
    loadData = window.base_url + "workarea/load_data",
    tableID = $("#datatable_ajax"),
    grid = new Datatable,
    urlUpdateStatus = window.base_url + "workarea/delete",
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
                    Page.edit(e)
                }), $(document).on("submit", "#form-edit", function() {
                    var a = $(this).find(".submit").val();
                    return Page.submitForm($("#form-edit"), a), !1
                })
            },
            submitForm: function(e, a) {
                var i = e.find(".submit");
                if (Helper.validateForm(e, {
                        kd_cabang: {
                            required: !0
                        },
                        nm_cabang: {
                            required: !0
                        },
                        alamat: {
                            required: !0
                        },
                        pimpinan: {
                            required: !0
                        },
                        no_hp_pimpinan: { 
                            required: !0,
                            number: !0
                        },
                        biaya_pesawat_kepusat: { 
                            required: !0,
                            number: !0
                        }
                    }), e.valid()) {
                    var t = Helper.baseUrl("workarea/add");
                    a && (t = Helper.baseUrl("workarea/edit")), Helper.blockElement(e.parent()), i.attr("disabled", !0), Helper.ajax(t, "post", "json", Helper.serializeForm(e)).error(function(a) {
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

                i.text("Add Data Work Area"), Helper.blockElement($(a)), Helper.ajax(Helper.baseUrl("workarea/load_add_form"), "get", "html").error(function(a) {
                    e.find(".close").click()
                }).done(function(e) {
                    a.html(e), Helper.selectField($(".marketing"), "Pilih Marketing"), Helper.selectField($(".provinsi"), "Pilih provinsi"), Helper.selectField($(".kota"), "Pilih Kota");
                    var i = null;
                    Helper.datePicker(i), Helper.unblockElement($(a));

                    $('#prov').change(function(){
                        var id=$('#prov').val();
                        $.ajax({
                            url : Helper.baseUrl("formulir/get_kota"),
                            method : "POST",
                            data : {id: id},
                            async : false,
                            dataType : 'json',
                            success: function(data){
                                var html = '';
                                var i;
                                for(i=0; i<data.length; i++){
                                    html += '<option value="'+data[i].id_kota+'">'+data[i].name_regencies+'</option>';
                                }
                                $('.kota').html(html);
                                 
                            }
                        });
                    });

                })
            },
            edit: function(e) {
                var a = Helper.loadModal("lg"),
                    i = a.find(".modal-body"),
                    t = a.find(".modal-title");
                t.text("Edit Data Work Area"), Helper.blockElement($(i)), Helper.ajax(Helper.baseUrl("workarea/load_edit_form"), "get", "html", {
                    id:e
                }).error(function(e) {
                    a.find(".close").click()
                }).done(function(e) {
                    i.html(e), Helper.selectField($("select")), Helper.selectField($(".marketing"), "Pilih Marketing"), Helper.selectField($(".provinsi"), "Pilih provinsi"), Helper.selectField($(".kota"), "Pilih Kota");
                    Helper.datePicker(),Helper.unblockElement($(i));
                    var prov=$('.provinsi').val();
                        $.ajax({
                            url : Helper.baseUrl("formulir/get_kota"),
                            method : "POST",
                            data : {id: prov},
                            async : false,
                            dataType : 'json',
                            success: function(data){
                                var html = '';
                                var i;
                                for(i=0; i<data.length; i++){

                                    
                                    html += '<option value="'+data[i].id_kota+'">'+data[i].name_regencies+'</option>';
                                }
                                $('.kota').html(html);
                                $(".kota option[value='" + idkota + "']").attr("selected","selected");
                                 
                            }
                        });

                    $('#prov').change(function(){
                        var id=$('#prov').val();
                        $.ajax({
                            url : Helper.baseUrl("formulir/get_kota"),
                            method : "POST",
                            data : {id: id},
                            async : false,
                            dataType : 'json',
                            success: function(data){
                                var html = '';
                                var i;
                                for(i=0; i<data.length; i++){
                                    html += '<option value="'+data[i].id_kota+'">'+data[i].name_regencies+'</option>';
                                }
                                $('.kota').html(html);
                                 
                            }
                        });
                    });
                })
            }
            
        }
    }();