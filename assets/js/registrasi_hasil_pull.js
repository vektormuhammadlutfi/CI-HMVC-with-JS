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
                    Page.handleTransaction();
                    Page.getpaket();
                    Page.hitunghrgpaket();

                    $(".total").click(function(){
                    
                        var tot_hrg_paket = $(".total-hrg-paket").autoNumeric("get"),
                            tot_byr_brg = $(".total-bayar").autoNumeric("get");

                        var r = parseFloat(tot_hrg_paket) + parseFloat(tot_byr_brg);
                        $(".total-hrg-paket").val(r), $(".total-hrg-paket").autoNumeric("set", r);
                    });

                    Helper.unblockElement($(modalBody));
                    
                });
            },
            edit: function(e) {
                var a = Helper.loadModal("lg"),
                    i = a.find(".modal-body"),
                    t = a.find(".modal-title");
                t.text("Edit Data Hotel"), Helper.blockElement($(i)), Helper.ajax(Helper.baseUrl("registrasi/load_edit_form"), "get", "html", {
                    id:e
                }).error(function(e) {
                    a.find(".close").click()
                }).done(function(e) {
                    i.html(e), Helper.selectField($(".jenis_travel"), "Pilih jenis travel");
                    Helper.selectField($(".jadwal"), "Pilih");
                    Helper.selectField($(".paket"), "Pilih paket");
                    Helper.selectField($(".pilihbanyak"), "Pilih");
                    Helper.selectField($(".cabang"), "Pilih");
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

                
            },
            // hitung total harga barang


            hitunghrgpaket: function(){
                $('.hotel_b4').change(function(){
                    $(".money").autoNumeric("init", {
                        aSep: ",",
                        aDec: ".",
                        aSign: "",
                        wEmpty: "zero",
                        mDec: "0"
                    });

                        var hrg_b4 = $(".hrg_up_hotel_b4").autoNumeric("get"),
                            hrg_b5 = $(".hrg_up_hotel_b5").autoNumeric("get"),
                            biayapaket = $(".biaya-paket").autoNumeric("get"),
                            biayamhr = $(".biaya-mahram").autoNumeric("get"),
                            biayaprog = $(".biaya-progresif").autoNumeric("get");

                        r = parseFloat(hrg_b4) + parseFloat(hrg_b5) + parseFloat(biayamhr) + parseFloat(biayaprog) + parseFloat(biayapaket);

                        $(".total-hrg-paket").val(r), $(".total-hrg-paket").autoNumeric("set", r)
                    });

                    $('.hotel_b5').change(function(){
                        $(".money").autoNumeric("init", {
                            aSep: ",",
                            aDec: ".",
                            aSign: "",
                            wEmpty: "zero",
                            mDec: "0"
                        });

                        var hrg_b4 = $(".hrg_up_hotel_b4").autoNumeric("get"),
                            hrg_b5 = $(".hrg_up_hotel_b5").autoNumeric("get"),
                            biayapaket = $(".biaya-paket").autoNumeric("get"),
                            biayamhr = $(".biaya-mahram").autoNumeric("get"),
                            biayaprog = $(".biaya-progresif").autoNumeric("get");
                        
                        r = parseFloat(hrg_b4) + parseFloat(hrg_b5) + parseFloat(biayamhr) + parseFloat(biayaprog) + parseFloat(biayapaket);

                        // document.getElementById('total_biaya').value = r;

                        $(".total-hrg-paket").val(r), $(".total-hrg-paket").autoNumeric("set", r)
                    });

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

                        var hrg_b4 = $(".hrg_up_hotel_b4").autoNumeric("get"), //klw ada . nya berarti dia cari Class
                            hrg_b5 = $(".hrg_up_hotel_b5").autoNumeric("get"),
                            biayapaket = $(".biaya-paket").autoNumeric("get"),
                            biayamhr = $(".biaya-mahram").autoNumeric("get"),
                            biayaprog = $(".biaya-progresif").autoNumeric("get");

                        var id=$(".paket").find(":selected").val();
                        if ($(this).val() == 'Double') { 
                            // alert("double");
                            document.getElementById("jns_kmr_hrg").name = 'biaya_upgrade_kamar';
                            // var double= $(this).find("#double").val(); //klw ada # nya berarti dia cari ID
                            $.ajax({
                                url : Helper.baseUrl("registrasi/get_hrg_paket"),
                                method : "POST",
                                data : {id: id},
                                async : false,
                                dataType : 'json',
                                success: function(data){

                                    var hrg = data.biaya_up_double;
                                    $(".jns_kmr_hrg").val(hrg), $(".jns_kmr_hrg").autoNumeric("set", hrg);
                                     
                                }
                            });
                            hrg_upgrade = $(".jns_kmr_hrg").autoNumeric("get");
                            r = parseFloat(hrg_b4) + parseFloat(hrg_b5) + parseFloat(hrg_upgrade) + parseFloat(biayamhr) + parseFloat(biayaprog) + parseFloat(biayapaket);
                            
                        } else if ($(this).val() == 'Triple'){
                            // alert("triple");
                            document.getElementById("jns_kmr_hrg").name = 'biaya_upgrade_kamar';
                            // var triple= $(this).find("#triple").val();
                            // triple = $("#triple").autoNumeric("get");
                            // r = parseFloat(hrg_b4) + parseFloat(hrg_b5) + parseFloat(triple) + parseFloat(biayamhr) + parseFloat(biayaprog) + parseFloat(biayapaket);
                            
                            $.ajax({
                                url : Helper.baseUrl("registrasi/get_hrg_paket"),
                                method : "POST",
                                data : {id: id},
                                async : false,
                                dataType : 'json',
                                success: function(data){

                                    var hrg = data.biaya_up_triple;
                                    $(".jns_kmr_hrg").val(hrg), $(".jns_kmr_hrg").autoNumeric("set", hrg);
                                     
                                }
                            });

                            hrg_upgrade = $(".jns_kmr_hrg").autoNumeric("get");
                            r = parseFloat(hrg_b4) + parseFloat(hrg_b5) + parseFloat(hrg_upgrade) + parseFloat(biayamhr) + parseFloat(biayaprog) + parseFloat(biayapaket);
                            
                        } else if ($(this).val() == 'Quad'){
                            // alert("quad");
                            document.getElementById("jns_kmr_hrg").name = 'biaya_upgrade_kamar';
                            // var quad= $(this).find("#quad").val();
                            // quad = $("#quad").autoNumeric("get");
                            // r = parseFloat(hrg_b4) + parseFloat(hrg_b5) + parseFloat(quad) + parseFloat(biayamhr) + parseFloat(biayaprog) + parseFloat(biayapaket);
                            
                            $.ajax({
                                url : Helper.baseUrl("registrasi/get_hrg_paket"),
                                method : "POST",
                                data : {id: id},
                                async : false,
                                dataType : 'json',
                                success: function(data){

                                    var hrg = data.biaya_up_quad;
                                    $(".jns_kmr_hrg").val(hrg), $(".jns_kmr_hrg").autoNumeric("set", hrg);
                                     
                                }
                            });

                            hrg_upgrade = $(".jns_kmr_hrg").autoNumeric("get");
                            r = parseFloat(hrg_b4) + parseFloat(hrg_b5) + parseFloat(hrg_upgrade) + parseFloat(biayamhr) + parseFloat(biayaprog) + parseFloat(biayapaket);
                            
                        } else if ($(this).val() == 'Quint'){
                            // alert("quint");
                            document.getElementById("jns_kmr_hrg").name = 'biaya_upgrade_kamar';
                            // var quint= $(this).find("#quint").val();
                            // quint = $("#quint").autoNumeric("get");
                            // r = parseFloat(hrg_b4) + parseFloat(hrg_b5) + parseFloat(quint) + parseFloat(biayamhr) + parseFloat(biayaprog) + parseFloat(biayapaket);
                            
                            $.ajax({
                                url : Helper.baseUrl("registrasi/get_hrg_paket"),
                                method : "POST",
                                data : {id: id},
                                async : false,
                                dataType : 'json',
                                success: function(data){

                                    var hrg = data.biaya_up_quint;
                                    $(".jns_kmr_hrg").val(hrg), $(".jns_kmr_hrg").autoNumeric("set", hrg);
                                     
                                }
                            });

                            hrg_upgrade = $(".jns_kmr_hrg").autoNumeric("get");
                            r = parseFloat(hrg_b4) + parseFloat(hrg_b5) + parseFloat(hrg_upgrade) + parseFloat(biayamhr) + parseFloat(biayaprog) + parseFloat(biayapaket);
                            
                        }

                        $(".total-hrg-paket").autoNumeric("init", {
                            aSep: ",",
                            aDec: ".",
                            aSign: "",
                            wEmpty: "zero",
                            mDec: "2"
                        });

                        $(".total-hrg-paket").val(r), $(".total-hrg-paket").autoNumeric("set", r);
                    });

                    $(document).on('keyup', '.biaya-mahram', function() {
                        $(".money").autoNumeric("init", {
                            aSep: ",",
                            aDec: ".",
                            aSign: "",
                            wEmpty: "zero",
                            mDec: "0"
                        });

                        var hrg_b4 = $(".hrg_up_hotel_b4").autoNumeric("get"),
                            hrg_b5 = $(".hrg_up_hotel_b5").autoNumeric("get"),
                            biayapaket = $(".biaya-paket").autoNumeric("get"),
                            biayamhr = $(".biaya-mahram").autoNumeric("get"),
                            biayaprog = $(".biaya-progresif").autoNumeric("get");
                        
                        r = parseFloat(hrg_b4) + parseFloat(hrg_b5) + parseFloat(biayamhr) + parseFloat(biayaprog) + parseFloat(biayapaket);
                        $(".total-hrg-paket").val(r), $(".total-hrg-paket").autoNumeric("set", r);
                    });

                    $(document).on('keyup', '.biaya-progresif', function() {
                        $(".money").autoNumeric("init", {
                            aSep: ",",
                            aDec: ".",
                            aSign: "",
                            wEmpty: "zero",
                            mDec: "0"
                        });

                        var hrg_b4 = $(".hrg_up_hotel_b4").autoNumeric("get"),
                            hrg_b5 = $(".hrg_up_hotel_b5").autoNumeric("get"),
                            biayapaket = $(".biaya-paket").autoNumeric("get"),
                            biayamhr = $(".biaya-mahram").autoNumeric("get"),
                            biayaprog = $(".biaya-progresif").autoNumeric("get");
                        
                        r = parseFloat(hrg_b4) + parseFloat(hrg_b5) + parseFloat(biayamhr) + parseFloat(biayaprog) + parseFloat(biayapaket);
                        $(".total-hrg-paket").val(r), $(".total-hrg-paket").autoNumeric("set", r);
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
                                html = '<option value="0"> -pilih- </option>';
                                for(i=0; i<data.length; i++){
                                    html += '<option value="'+data[i].id+'">'+data[i].nm_paket+'</option>';
                                }
                                $('.paket').html(html);

                                var hrg = null;
                                document.getElementById('hrg_up_hotel_b4').value = hrg;
                                var hrg1 = null;
                                document.getElementById('hrg_up_hotel_b5').value = hrg1;
                                var hrgtot = null;
                                document.getElementById('total-hrg-paket').value = hrgtot;

                                
                            }
                        });
                    });

                    $('#paket').change(function(){
                        var id=$(this).find(":selected").val();
                        $.ajax({
                            url : Helper.baseUrl("registrasi/get_hotel"),
                            method : "POST",
                            data : {id: id},
                            async : false,
                            dataType : 'json',
                            success: function(data){
                                var html = '';
                                var i;
                                html = '<option value="0"> -pilih- </option>';
                                for(i=0; i<data.length; i++){
                                    html += '<option value="'+data[i].id+'">'+data[i].nm_hotel+'</option>';
                                }
                                $('.hotel_b4').html(html);                              
                            }
                        });

                        $.ajax({
                            url : Helper.baseUrl("registrasi/get_hotel_b5"),
                            method : "POST",
                            data : {id: id},
                            async : false,
                            dataType : 'json',
                            success: function(data){
                                var html = '';
                                var i;
                                html = '<option value="0"> -pilih- </option>';
                                for(i=0; i<data.length; i++){
                                    html += '<option value="'+data[i].id+'">'+data[i].nm_hotel+'</option>';
                                }
                                $('.hotel_b5').html(html);                              
                            }
                        });


                        $.ajax({
                            url : Helper.baseUrl("registrasi/get_hrg_paket"),
                            method : "POST",
                            data : {id: id},
                            async : false,
                            dataType : 'json',
                            success: function(data){

                                // var hrg2 = data.biaya_up_double;
                                // document.getElementById('double').value = hrg2;

                                // var hrg3 = data.biaya_up_triple;
                                // document.getElementById('triple').value = hrg3;

                                // var hrg4 = data.biaya_up_quad;
                                // document.getElementById('quad').value = hrg4;

                                // var hrg5 = data.biaya_up_quint;
                                // document.getElementById('quint').value = hrg5;

                                var hrgpaket = data.hrg_paket;
                                document.getElementById('biaya-paket').value = hrgpaket;
                                 
                            }
                        });
                    });

                    $('.hotel_b4').change(function(){
                        var id=$('#paket').find(":selected").val();
                        $.ajax({
                            url : Helper.baseUrl("registrasi/get_hrg_paket"),
                            method : "POST",
                            data : {id: id},
                            async : false,
                            dataType : 'json',
                            success: function(data){
                                var hrg = data.biaya_up_hotel_b4;
                                document.getElementById('hrg_up_hotel_b4').value = hrg;
                                 
                            }
                        });
                    });

                    $('.hotel_b5').change(function(){
                        var id=$('#paket').find(":selected").val();
                        $.ajax({
                            url : Helper.baseUrl("registrasi/get_hrg_paket"),
                            method : "POST",
                            data : {id: id},
                            async : false,
                            dataType : 'json',
                            success: function(data){
                               

                                var hrg1 = data.biaya_up_hotel_b5;
                                document.getElementById('hrg_up_hotel_b5').value = hrg1;

                                 
                            }
                        });
                    });

                        $(".money").autoNumeric("init", {
                            aSep: ",",
                            aDec: ".",
                            aSign: "",
                            wEmpty: "zero",
                            mDec: "0"
                        });
            },

            // hitung total biaya
            hitungtotalbiaya: function(){
            var hrg_b4 = $(".hrg_up_hotel_b4").autoNumeric("get"),
                hrg_b5 = $(".hrg_up_hotel_b5").autoNumeric("get"),
                biayapaket = $(".biaya-paket").autoNumeric("get"),
                biayamhr = $(".biaya-mahram").autoNumeric("get"),
                biayaprog = $(".biaya-progresif").autoNumeric("get");   
                sub_total_barang = $(".total-bayar").autoNumeric("get"); 
                

                
            },
            // hitung total biaya
            
        }
    }();