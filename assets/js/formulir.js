var addBtn = $("#add-btn"),
    loadData = window.base_url + "formulir/load_data",
    tableID = $("#datatable_ajax"),
    grid = new Datatable,
    urlUpdateStatus = window.base_url + "formulir/delete",
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
                }),$(document).on("click", ".btn-detail", function() {
                    var e = $(this).data("id");
                    Page.detail(e)
                })
            },
            submitForm: function(e, a) {
                var i = e.find(".submit");
                var file_data = $('#path_foto').prop('files')[0];
                var form = $('form')[0];
                var form_data = new FormData(form);
                form_data.append('file', file_data);

                if (Helper.validateForm(e, {
                        no_ktp: {
                            required: !0,
                            number: !0,
                            minlength: 16
                        },
                        nm_lengkap: {
                            required: !0
                        },
                        tgl_lahir: {
                            required: !0
                        },
                        jk: {
                            required: !0
                        },
                        alamat: {
                            required: !0,
                        },
                        id_kota: {
                            required: !0,
                        },
                        id_prov: {
                            required: !0,
                        },
                        hp: {
                            required: !0,
                            number: !0
                        },
                        telp_rumah: {
                            required: !0,
                            number: !0
                        },
                        id_marketing: {
                            required: !0,
                        }
                    }), e.valid()) {
                    var t = Helper.baseUrl("formulir/add");
                        a && (t = Helper.baseUrl("formulir/edit")), 
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
                }
            },
            add: function() {
                var e = Helper.loadModal("lg"),
                    a = e.find(".modal-body"),
                    i = e.find(".modal-title");

                i.text("Add Data Form"), Helper.blockElement($(a)), 
                Helper.ajax(Helper.baseUrl("formulir/load_add_form"), "get", "html").error(function(a) {
                    e.find(".close").click()
                }).done(function(e) {
                    a.html(e), Helper.selectField($(".marketing"), "Pilih marketing"), Helper.selectField($(".jeniskelamin"), "Pilih Jenis Kelamin"), Helper.selectField($(".provinsi"), "Pilih provinsi"), Helper.selectField($(".kota"), "Pilih Kota");
                   
                    Helper.datePicker(), Helper.unblockElement($(a));
                    // $("#kota").chained("#prov"); // disini kita hubungkan kota dengan provinsi

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
            }, 
            edit: function(e) {
                var a = Helper.loadModal("lg"),
                    i = a.find(".modal-body"),
                    t = a.find(".modal-title");

                t.text("Edit Data Form"), Helper.blockElement($(i)), 
                Helper.ajax(Helper.baseUrl("formulir/load_edit_form"), "get", "html", {id:e}).error(function(e) {
                    a.find(".close").click()
                }).done(function(e) {
                    i.html(e), Helper.selectField($(".marketing"), "Pilih marketing"), Helper.selectField($(".jeniskelamin"), "Pilih Jenis Kelamin"), Helper.selectField($(".provinsi"), "Pilih provinsi"), Helper.selectField($(".kota"), "Pilih Kota");
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

            },
            detail: function(e) {
                var a = Helper.loadModal("lg"),
                    t = a.find(".modal-body"),
                    i = a.find(".modal-title");
                i.text("Detail"), Helper.blockElement($(t)), Helper.ajax(Helper.baseUrl("formulir/detail"), "get", "html", {
                    id: e
                }).error(function(e) {
                    a.find(".close").click()
                }).done(function(e) {
                    t.html(e), Helper.unblockElement($(t))
                })
            },
            
        }
    }();
