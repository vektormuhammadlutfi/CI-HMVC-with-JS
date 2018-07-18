var addBtn = $("#add-btn"),
    loadData = window.base_url + "registrasi/load_data",
    tableID = $("#datatable_ajax"),
    grid = new Datatable,
    urlUpdateStatus = window.base_url + "registrasi/delete",
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
                        jenis_travel: {
                            required: !0
                        },
                        tgl_pendaftaran: {
                            required: !0
                        },
                        jenis_kamar: {
                            required: !0
                        },
                        id_paket: {
                            required: !0
                        }
                    }), e.valid()) {
                    var t = Helper.baseUrl("registrasi/add");
                    a && (t = Helper.baseUrl("registrasi/edit")), Helper.blockElement(e.parent()), i.attr("disabled", !0), Helper.ajax(t, "post", "json", Helper.serializeForm(e)).error(function(a) {
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

                var modal = Helper.loadModal('lg');
                var modalBody = modal.find('.modal-body');
                var modalTitle = modal.find('.modal-title');

                modalTitle.text('Add Data Registrasi');
                Helper.blockElement($(modalBody));
                Helper.ajax(Helper.baseUrl('registrasi/load_add_form'), 'get', 'html')
                
                .error(function(err) {
                    modal.find('.close').click();
                })

                .done(function(data) {
                    modalBody.html(data);
                    var i = null;
                    Helper.datePicker(i);
                    Helper.selectField($(".jenis_travel"), "Pilih jenis travel");
                    Helper.selectField($(".jadwal"), "Pilih");
                    Helper.selectField($(".paket"), "Pilih paket");
                    Helper.selectField($(".pilihbanyak"), "Pilih");
                    Helper.selectField($(".cabang"), "Pilih");
                    Helper.selectField($(".pilih"), "Pilih");
                    Page.handleTransaction();
                    Page.getpaket();
                    Page.hitunghrgpaket();

                    Helper.unblockElement($(modalBody));
                    
                });
            },
            edit: function(e) {
                var a = Helper.loadModal("lg"),
                    i = a.find(".modal-body"),
                    t = a.find(".modal-title");
                t.text("Edit Data Registrasi"), Helper.blockElement($(i)), Helper.ajax(Helper.baseUrl("registrasi/load_edit_form"), "get", "html", {
                    id:e
                }).error(function(e) {
                    a.find(".close").click()
                }).done(function(e) {
                    i.html(e), Helper.selectField($(".jenis_travel"), "Pilih jenis travel");
                    Helper.selectField($(".jadwal"), "Pilih");
                    Helper.selectField($(".paket"), "Pilih paket");
                    Helper.selectField($(".pilihbanyak"), "Pilih");
                    Helper.selectField($(".cabang"), "Pilih");
                    Helper.selectField($(".pilih"), "Pilih");
                    Page.handleTransaction();
                    Page.getpaket();
                    Page.hitunghrgpaket();
                    var a = null;
                    Helper.datePicker(a), Helper.unblockElement($(i));
                })
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
                        <td align="center"><input id="harga_jual'+count+'" class="form-control harga_jual money" name="harga_jual[]" type="text"></td>\
                        <td align="center"><input id="jml'+count+'" name="jml[]" class="form-control jml money" type="text" placeholder="0"></td>\
                        <td align="center"><input type="checkbox" id="free'+count+'" class="free" /></td>\
                        <td align="center"><input id="sub_harga'+count+'" class="form-control sub_harga money" name="sub_harga[]" type="text" value="0" readonly></td>\
                        <input id="cekstok'+count+'" name="cekstok[]" class="form-control cekstok money" type="hidden">\
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
                          url: Helper.baseUrl("purchase/load_barang"),
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
                            url : Helper.baseUrl("purchase/get_select_barang"),
                            method : "POST",
                            data : {id: id},
                            async : true,
                            dataType : 'json',
                            success: function(data){
                                var hrg_jual = data.harga_jual;
                                document.getElementById('harga_jual'+count).value = hrg_jual;
                                var cekstok = data.stok;
                                document.getElementById('cekstok'+count).value = cekstok;
                                $('#jml'+count).focus();
                                 
                            }
                        });
                    });




                    
                    $(document).on('keyup', '.jml', function() {
                        $(".money").autoNumeric("init", {
                            aSep: ",",
                            aDec: ".",
                            aSign: "",
                            wEmpty: "zero",
                            mDec: "0"
                        });

                        var qty = $(this).autoNumeric('get');   
                        var sub_total = $(this).closest('tr').find('.sub_harga').autoNumeric('get');
                        var harga = $(this).closest('tr').find('.harga_jual').autoNumeric('get');                     
                        var jumlah = parseFloat(harga)*parseFloat(qty);
                        $(this).closest('tr').find('.sub_harga').val(jumlah);
                        $(this).closest('tr').find('.sub_harga').autoNumeric('set', jumlah);
                        
                        Page.hitungsubtotal();
                         
                    });
                    
                });
                
                $(document).on("click", ".free", function() {

                    if ($(this).prop('checked') == true) {
                        jmlh = 0;
                        $(this).closest('tr').find('.sub_harga').val(jmlh);
                        $(this).closest('tr').find('.sub_harga').autoNumeric('set', jmlh);
                        Page.hitungsubtotal();

                    }else { 
                        var qty = $(this).closest('tr').find('.jml').autoNumeric('get');   
                        var harga = $(this).closest('tr').find('.harga_jual').autoNumeric('get');                    
                        var jmlh = parseFloat(harga)*parseFloat(qty);
                        $(this).closest('tr').find('.sub_harga').val(jmlh);
                        $(this).closest('tr').find('.sub_harga').autoNumeric('set', jmlh);
                        Page.hitungsubtotal();
                    }


                    
                   
                });

                $(document).on('click', '#hapus', function() {
                    $(this).parents(".baris").remove();
                    Page.hitungsubtotal();
                    $('#btn-submit-add-form').prop('disabled',false);
                });

            },

            // hitung total harga barang
            hitungsubtotal: function(){
                var njumlah=0;  
            
                $(".sub_harga").each(function(){
                    njumlah += parseFloat($(this).autoNumeric('get'), 10) || 0;    
                });

                $("#total-bayar").autoNumeric('set',njumlah);

                Page.hitungtotalbiaya();
            },
            // hitung total harga barang


            hitunghrgpaket: function(){

                    $('input:radio[name="jenis_kamar"]').change(function() {
                        // var a = $(this).val();
                        // alert(a);
                        $(".money").autoNumeric("init", {
                            aSep: ",",
                            aDec: ".",
                            aSign: "",
                            wEmpty: "zero",
                            mDec: "0"
                        });


                        var id=$(".paket").find(":selected").val(),
                            dollar = '14000',
                            lama_hari = $(".lama_hari").val();
                        if ($(this).val() == 'Double') { 

                            document.getElementById("jns_kmr_hrg_makkah").name = 'biaya_upgrade_kamar_makkah';

                            $.ajax({
                                url : Helper.baseUrl("registrasi/get_hrg_paket"),
                                method : "POST",
                                data : {id: id},
                                async : false,
                                dataType : 'json',
                                success: function(data){
                                var hrg = 0;
                                    if(document.getElementById('hotel_request_makkah_d').checked) {
                                      if (lama_hari == 9) {
                                        hrg = dollar*200; 
                                      } else if (lama_hari == 11) {
                                        hrg = dollar*200; 
                                      } else if (lama_hari == 12) {
                                        hrg = dollar*250;
                                      }
                                    }else if(document.getElementById('hotel_request_makkah_4').checked) {
                                      if (lama_hari == 9) {
                                        hrg = dollar*300; 
                                      } else if (lama_hari == 11) {
                                        hrg = dollar*300; 
                                      } else if (lama_hari == 12) {
                                        hrg = dollar*350;
                                      }
                                    }else if(document.getElementById('hotel_request_makkah_5').checked) {
                                      if (lama_hari == 9) {
                                        hrg = dollar*400; 
                                      } else if (lama_hari == 11) {
                                        hrg = dollar*400; 
                                      } else if (lama_hari == 12) {
                                        hrg = dollar*450;
                                      }
                                    }

                                    


                                    // var hrg = data.biaya_up_double;
                                    $(".jns_kmr_hrg_makkah").val(hrg), $(".jns_kmr_hrg_makkah").autoNumeric("set", hrg);
                                    $(".status_jenis_kamar").val('0');                                  
                                     
                                }
                            });
                            
                        } else if ($(this).val() == 'Triple'){
                            document.getElementById("jns_kmr_hrg_makkah").name = 'biaya_upgrade_kamar_makkah';
                            
                            $.ajax({
                                url : Helper.baseUrl("registrasi/get_hrg_paket"),
                                method : "POST",
                                data : {id: id},
                                async : false,
                                dataType : 'json',
                                success: function(data){
                                var hrg = 0;
                                    if(document.getElementById('hotel_request_makkah_d').checked) {
                                      if (lama_hari == 9) {
                                        hrg = dollar*100; 
                                      } else if (lama_hari == 11) {
                                        hrg = dollar*100; 
                                      } else if (lama_hari == 12) {
                                        hrg = dollar*125;
                                      }
                                    }else if(document.getElementById('hotel_request_makkah_4').checked) {
                                      if (lama_hari == 9) {
                                        hrg = dollar*150; 
                                      } else if (lama_hari == 11) {
                                        hrg = dollar*150; 
                                      } else if (lama_hari == 12) {
                                        hrg = dollar*175;
                                      }
                                    }else if(document.getElementById('hotel_request_makkah_5').checked) {
                                      if (lama_hari == 9) {
                                        hrg = dollar*200; 
                                      } else if (lama_hari == 11) {
                                        hrg = dollar*200; 
                                      } else if (lama_hari == 12) {
                                        hrg = dollar*225;
                                      }
                                    }

                                    
                                    // var hrg = data.biaya_up_double;
                                    $(".jns_kmr_hrg_makkah").val(hrg), $(".jns_kmr_hrg_makkah").autoNumeric("set", hrg);
                                    $(".status_jenis_kamar").val('0');                                  

                                }
                            });

                            
                            
                        } else if ($(this).val() == 'Quad'){
                            document.getElementById("jns_kmr_hrg_makkah").name = 'biaya_upgrade_kamar_makkah';

                            
                            $.ajax({
                                url : Helper.baseUrl("registrasi/get_hrg_paket"),
                                method : "POST",
                                data : {id: id},
                                async : false,
                                dataType : 'json',
                                success: function(data){

                                    var hrg = '0';
                                    $(".jns_kmr_hrg_makkah").val(hrg), $(".jns_kmr_hrg_makkah").autoNumeric("set", hrg);
                                    $(".status_jenis_kamar").val('1');

                                }
                            });

                            
                            
                        } else if ($(this).val() == 'Quint'){
                            document.getElementById("jns_kmr_hrg_makkah").name = 'biaya_upgrade_kamar_makkah';
                            
                            $.ajax({
                                url : Helper.baseUrl("registrasi/get_hrg_paket"),
                                method : "POST",
                                data : {id: id},
                                async : false,
                                dataType : 'json',
                                success: function(data){

                                    var hrg = '0';
                                    $(".jns_kmr_hrg_makkah").val(hrg), $(".jns_kmr_hrg_makkah").autoNumeric("set", hrg);
                                    $(".status_jenis_kamar").val('1'); 
                                     
                                }
                            });

                            
                            
                        }

                        // Page.hitungtotalbiaya();
                    });

                    // jenis kamar madinah
                    $('input:radio[name="jenis_kamar_madinah"]').change(function() {
                        // var a = $(this).val();
                        // alert(a);
                        $(".money").autoNumeric("init", {
                            aSep: ",",
                            aDec: ".",
                            aSign: "",
                            wEmpty: "zero",
                            mDec: "0"
                        });


                        var id=$(".paket").find(":selected").val(),
                            dollar = '14000',
                            lama_hari = $(".lama_hari").val();
                        if ($(this).val() == 'Double') { 

                            document.getElementById("jns_kmr_hrg_madinah").name = 'biaya_upgrade_kamar_madinah';

                            $.ajax({
                                url : Helper.baseUrl("registrasi/get_hrg_paket"),
                                method : "POST",
                                data : {id: id},
                                async : false,
                                dataType : 'json',
                                success: function(data){
                                var hrg_madinah = 0;
                                    

                                    if(document.getElementById('hotel_request_madinah_d').checked) {
                                      if (lama_hari == 9) {
                                        hrg_madinah = dollar*200; 
                                      } else if (lama_hari == 11) {
                                        hrg_madinah = dollar*200; 
                                      } else if (lama_hari == 12) {
                                        hrg_madinah = dollar*250;
                                      }
                                    }else if(document.getElementById('hotel_request_madinah_4').checked) {
                                      if (lama_hari == 9) {
                                        hrg_madinah = dollar*300; 
                                      } else if (lama_hari == 11) {
                                        hrg_madinah = dollar*300; 
                                      } else if (lama_hari == 12) {
                                        hrg_madinah = dollar*350;
                                      }
                                    }else if(document.getElementById('hotel_request_madinah_5').checked) {
                                      if (lama_hari == 9) {
                                        hrg_madinah = dollar*400; 
                                      } else if (lama_hari == 11) {
                                        hrg_madinah = dollar*400; 
                                      } else if (lama_hari == 12) {
                                        hrg_madinah = dollar*450;
                                      }
                                    }


                                    $(".jns_kmr_hrg_madinah").val(hrg_madinah), $(".jns_kmr_hrg_madinah").autoNumeric("set", hrg_madinah);                                 
                                    $(".status_jenis_kamar_madinah").val('0');                                  
                                     
                                }
                            });
                            
                        } else if ($(this).val() == 'Triple'){
                            document.getElementById("jns_kmr_hrg_madinah").name = 'biaya_upgrade_kamar_madinah';                            
                            
                            $.ajax({
                                url : Helper.baseUrl("registrasi/get_hrg_paket"),
                                method : "POST",
                                data : {id: id},
                                async : false,
                                dataType : 'json',
                                success: function(data){
                                var hrg_madinah = 0;
                                    

                                    if(document.getElementById('hotel_request_madinah_d').checked) {
                                        if (lama_hari == 9) {
                                        hrg_madinah = dollar*100; 
                                      } else if (lama_hari == 11) {
                                        hrg_madinah = dollar*100; 
                                      } else if (lama_hari == 12) {
                                        hrg_madinah = dollar*125;
                                      }
                                    }else if(document.getElementById('hotel_request_madinah_4').checked) {
                                       if (lama_hari == 9) {
                                        hrg_madinah = dollar*150; 
                                      } else if (lama_hari == 11) {
                                        hrg_madinah = dollar*150; 
                                      } else if (lama_hari == 12) {
                                        hrg_madinah = dollar*175;
                                      }
                                    }else if(document.getElementById('hotel_request_madinah_5').checked) {
                                      if (lama_hari == 9) {
                                        hrg_madinah = dollar*200; 
                                      } else if (lama_hari == 11) {
                                        hrg_madinah = dollar*200; 
                                      } else if (lama_hari == 12) {
                                        hrg_madinah = dollar*225;
                                      }
                                    }
                                    // var hrg = data.biaya_up_double;
                                    $(".jns_kmr_hrg_madinah").val(hrg_madinah), $(".jns_kmr_hrg_madinah").autoNumeric("set", hrg_madinah);
                                    $(".status_jenis_kamar_madinah").val('0');                                  

                                }
                            });

                            
                            
                        } else if ($(this).val() == 'Quad'){
                            document.getElementById("jns_kmr_hrg_madinah").name = 'biaya_upgrade_kamar_madinah';                            

                            
                            $.ajax({
                                url : Helper.baseUrl("registrasi/get_hrg_paket"),
                                method : "POST",
                                data : {id: id},
                                async : false,
                                dataType : 'json',
                                success: function(data){

                                    var hrg_madinah = '0';
                                    $(".jns_kmr_hrg_madinah").val(hrg_madinah), $(".jns_kmr_hrg_madinah").autoNumeric("set", hrg_madinah);
                                    $(".status_jenis_kamar_madinah").val('1');                                  

                                }
                            });

                            
                            
                        } else if ($(this).val() == 'Quint'){
                            document.getElementById("jns_kmr_hrg_madinah").name = 'biaya_upgrade_kamar_madinah';                            
                            
                            $.ajax({
                                url : Helper.baseUrl("registrasi/get_hrg_paket"),
                                method : "POST",
                                data : {id: id},
                                async : false,
                                dataType : 'json',
                                success: function(data){

                                    var hrg_madinah = '0';
                                    $(".jns_kmr_hrg_madinah").val(hrg_madinah), $(".jns_kmr_hrg_madinah").autoNumeric("set", hrg_madinah);
                                    $(".status_jenis_kamar_madinah").val('1');                                  
                                     
                                }
                            });

                        }
                    });
                    // N jenis kamar madinah

                    $('input:radio[name="hotel_request_makkah"]').change(function() {
                        // var a = $(this).val();
                        // alert(a);
                        $(".money").autoNumeric("init", {
                            aSep: ",",
                            aDec: ".",
                            aSign: "",
                            wEmpty: "zero",
                            mDec: "0"
                        });


                        var id=$(".paket").find(":selected").val();
                        if ($(this).val() == 'Default') { 

                            document.getElementById("biaya_request_makkah").name = 'biaya_request_makkah';

                            $.ajax({
                                url : Helper.baseUrl("registrasi/get_hrg_paket"),
                                method : "POST",
                                data : {id: id},
                                async : false,
                                dataType : 'json',
                                success: function(data){

                                    var hrg = 0;
                                    $(".biaya_request_makkah").val(hrg), $(".biaya_request_makkah").autoNumeric("set", hrg);
                                    $(".status_request_makkah").val('1');
                                     
                                }
                            });
                            
                        } else if ($(this).val() == '*4'){
                            document.getElementById("biaya_request_makkah").name = 'biaya_request_makkah';

                            
                            $.ajax({
                                url : Helper.baseUrl("registrasi/get_hrg_paket"),
                                method : "POST",
                                data : {id: id},
                                async : false,
                                dataType : 'json',
                                success: function(data){

                                    var hrg = data.biaya_up_hotel_b4;
                                    $(".biaya_request_makkah").val(hrg), $(".biaya_request_makkah").autoNumeric("set", hrg);
                                    $(".status_request_makkah").val('0'); 
                                }
                            });

                            
                            
                        } else if ($(this).val() == '*5'){
                            document.getElementById("biaya_request_makkah").name = 'biaya_request_makkah';

                            
                            $.ajax({
                                url : Helper.baseUrl("registrasi/get_hrg_paket"),
                                method : "POST",
                                data : {id: id},
                                async : false,
                                dataType : 'json',
                                success: function(data){

                                    var hrg = data.biaya_up_hotel_b5;
                                    $(".biaya_request_makkah").val(hrg), $(".biaya_request_makkah").autoNumeric("set", hrg);
                                    $(".status_request_makkah").val('0'); 
                                     
                                }
                            });
    
                        }

                        // Page.hitungtotalbiaya();
                    });

                    $('input:radio[name="hotel_request_madinah"]').change(function() {
                        // var a = $(this).val();
                        // alert(a);
                        $(".money").autoNumeric("init", {
                            aSep: ",",
                            aDec: ".",
                            aSign: "",
                            wEmpty: "zero",
                            mDec: "0"
                        });


                        var id=$(".paket").find(":selected").val();
                        if ($(this).val() == 'Default') { 

                            document.getElementById("biaya_request_makkah").name = 'biaya_request_makkah';

                            $.ajax({
                                url : Helper.baseUrl("registrasi/get_hrg_paket"),
                                method : "POST",
                                data : {id: id},
                                async : false,
                                dataType : 'json',
                                success: function(data){

                                    var hrg = 0;
                                    $(".biaya_request_madinah").val(hrg), $(".biaya_request_madinah").autoNumeric("set", hrg);
                                    $(".status_request_madinah").val('1'); 
                                     
                                }
                            });
                            
                        } else if ($(this).val() == '*4'){
                            document.getElementById("biaya_request_madinah").name = 'biaya_request_madinah';

                            
                            $.ajax({
                                url : Helper.baseUrl("registrasi/get_hrg_paket"),
                                method : "POST",
                                data : {id: id},
                                async : false,
                                dataType : 'json',
                                success: function(data){

                                    var hrg = data.biaya_up_hotel_b4_madinah;
                                    $(".biaya_request_madinah").val(hrg), $(".biaya_request_madinah").autoNumeric("set", hrg);
                                    $(".status_request_madinah").val('0'); 
                                     
                                }
                            });

                            
                            
                        } else if ($(this).val() == '*5'){
                            document.getElementById("biaya_request_madinah").name = 'biaya_request_madinah';

                            
                            $.ajax({
                                url : Helper.baseUrl("registrasi/get_hrg_paket"),
                                method : "POST",
                                data : {id: id},
                                async : false,
                                dataType : 'json',
                                success: function(data){

                                    var hrg = data.biaya_up_hotel_b5_madinah;
                                    $(".biaya_request_madinah").val(hrg), $(".biaya_request_madinah").autoNumeric("set", hrg);
                                    $(".status_request_madinah").val('0'); 
                                     
                                }
                            });
    
                        }

                        // Page.hitungtotalbiaya();
                    });
                    

                    $(document).on('keyup', '.biaya-mahram', function() {
                        $(".money").autoNumeric("init", {
                            aSep: ",",
                            aDec: ".",
                            aSign: "",
                            wEmpty: "zero",
                            mDec: "0"
                        });

                        var 
                            biayapaket = $(".biaya-paket").autoNumeric("get"),
                            biayamhr = $(".biaya-mahram").autoNumeric("get"),
                            biayaprog = $(".biaya-progresif").autoNumeric("get");
                        
                        // r = parseFloat(hrg_b4) + parseFloat(hrg_b5) + parseFloat(biayamhr) + parseFloat(biayaprog) + parseFloat(biayapaket);
                        // $(".total-hrg-paket").val(r), $(".total-hrg-paket").autoNumeric("set", r);
                        Page.hitungtotalbiaya();
                    });

                    $(document).on('keyup', '.biaya-progresif', function() {
                        $(".money").autoNumeric("init", {
                            aSep: ",",
                            aDec: ".",
                            aSign: "",
                            wEmpty: "zero",
                            mDec: "0"
                        });

                        var 
                            biayapaket = $(".biaya-paket").autoNumeric("get"),
                            biayamhr = $(".biaya-mahram").autoNumeric("get"),
                            biayaprog = $(".biaya-progresif").autoNumeric("get");

                        Page.hitungtotalbiaya();
                    });

                    $(document).on("click", ".mahram", function() {
                        var ischecked= $(this).is(':checked'),
                            bya = '350,000';
                        if(ischecked) {                            
                            $(".biaya-mahram").val(bya);
                       
                        } else {
                            $(".biaya-mahram").val(0);
                        
                        }
                        Page.hitungtotalbiaya();
                    }); 

                    $(document).on("click", ".progresif", function() {
                        var ischecked= $(this).is(':checked'),
                            bya = '7,500,000';
                        if(ischecked) {                            
                            $(".biaya-progresif").val(bya);
                         
                        } else {
                            $(".biaya-progresif").val(0);
                         
                        }
                        Page.hitungtotalbiaya();
                    }); 

                    $(document).on('keyup', '.add_on', function() {
                        $(".money").autoNumeric("init", {
                            aSep: ",",
                            aDec: ".",
                            aSign: "",
                            wEmpty: "zero",
                            mDec: "0"
                        });
                        Page.hitungtotalbiaya();
                    });
            },

            getpaket: function() {

                    $('#jenis_travel').change(function(){
                        var id=$('#jenis_travel').val();
                        $.ajax({
                            url : Helper.baseUrl("registrasi/get_nm_packet"),
                            method : "POST",
                            data : {id: id},
                            async : false,
                            dataType : 'json',
                            success: function(data){
                                var html = '';
                                var i;
                                html = '<option value="0"> Pilih </option>';
                                for(i=0; i<data.length; i++){
                                    html += '<option value="'+data[i].id+'">'+data[i].nm_paket+' | '+data[i].nm_jadwal+'</option>';
                                }
                                $('.paket').html(html);

                                var hrgtot = null;
                                document.getElementById('total-hrg-paket').value = hrgtot;

                                
                            }
                        });
                    });

                    $('#paket').change(function(){
                        var id=$(this).find(":selected").val();
                        
                       

                        $.ajax({
                            url : Helper.baseUrl("registrasi/get_hrg_paket"),
                            method : "POST",
                            data : {id: id},
                            async : false,
                            dataType : 'json',
                            success: function(data){
                                 $(".money").autoNumeric("init", {
                                    aSep: ",",
                                    aDec: ".",
                                    aSign: "",
                                    wEmpty: "zero",
                                    mDec: "0"
                                });


                               
                                    

                                var hrgpaket = data.hrg_paket;
                                var lama_hari = data.lama_hari;
                                // var default_mdnh = data.id_hotel_makkah;
                                // var default_mkkh = data.id_hotel_madinah;
                                //document.getElementById('biaya-paket').value = hrgpaket;
                                $(".biaya-paket").val(hrgpaket), $(".biaya-paket").autoNumeric("set", hrgpaket);
                                $(".lama_hari").val(hrgpaket), $(".lama_hari").autoNumeric("set", lama_hari);
                                // document.getElementById('default-makkah').value = default_mdnh;
                                // document.getElementById('default-madinah').value = default_mkkh;

                                 
                            }
                        });
                        Page.hitungtotalbiaya();

                    });

                    
            },

            // hitung total biaya
            hitungtotalbiaya: function(){
            var 
                biayapaket = $(".biaya-paket").autoNumeric("get"),
                biayamhr = $(".biaya-mahram").autoNumeric("get"),
                biayaprog = $(".biaya-progresif").autoNumeric("get");   
                sub_total_barang = $(".total-bayar").autoNumeric("get"); 
                // harga_kamar = $(".jns_kmr_hrg_makkah").autoNumeric("get"); + parseFloat(harga_kamar)
                add_on = $(".add_on").autoNumeric("get"); 
                //parseFloat(hrg_b4) + parseFloat(hrg_b5) + 
                r = parseFloat(biayapaket) + parseFloat(biayamhr) + parseFloat(biayaprog) + parseFloat(sub_total_barang) + parseFloat(add_on);
                $(".total-hrg-paket").val(r), $(".total-hrg-paket").autoNumeric("set", r);

            //Page.hitungtotalbiaya();    
            },
            // hitung total biaya
            
        }
    }();