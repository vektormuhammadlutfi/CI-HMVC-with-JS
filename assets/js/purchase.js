var addBtn = $("#add-btn"),
    loadData = window.base_url + "purchase/load_data",
    tableID = $("#datatable_ajax"),
    grid = new Datatable,
    urlUpdateStatus = window.base_url + "purchase/cancel_purchase",
    Page = function() {
        return {
            init: function() {
                Page.main(), Helper.datePicker()
            },
            main: function() {
                Helper.tableAjax(grid, tableID, loadData, urlUpdateStatus, null), 
                addBtn.click(function() {
                    Page.add();
                }), $(document).on("submit", "#form-create", function() {
                    return Page.submitForm($("#form-create"), null), !1
                }), $(document).on("submit", "#form-edit", function() {
                    var a = $(this).find(".submit").val();
                    return Page.submitForm($("#form-edit"), a), !1
                }),$(document).on("click", ".btn-edit", function() {
                    var e = $(this).data("id");
                    Page.edit(e);
                })
            },
            // Submit function
            submitForm: function(form, id) {
                if (confirm("Are you sure ?")) {
                    var submitButton = form.find('.submit');

                    // Validate the form with rules
                    Helper.validateForm(form, {
                         no_faktur: {
                                required: !0
                         },
                         nm_toko: {
                                required: !0
                         },
                         tgl_beli: {
                                required: !0
                         },
                         total_bayar: {
                                required: !0
                         },
                    });

                    // If form is valid run submit through ajax request
                    if (form.valid()) {
                        
                        var url = Helper.baseUrl('purchase/add');

                        if (id) {
                            url = Helper.baseUrl('purchase/edit');
                        }
                        
                        Helper.blockElement(form.parent());
                        submitButton.attr('disabled', true);

                        Helper.ajax(url, 'post', 'json', Helper.serializeForm(form))
                            
                        .error(function(err) {
                            Helper.unblockElement(form.parent());
                            submitButton.attr('disabled', false);
                        })

                        .done(function(data) {
                            if (data.status) {
                                form.parent().parent().find('.close').click();
                                swal(data.action, data.message, "success");
                                grid.getDataTable(tableID).ajax.reload();
                            } else {
                                submitButton.attr('disabled', false);
                                Helper.unblockElement(form.parent());
                                swal({title: data.action, text: data.message, type: "error", html: true});
                            }
                        });
                    }
                    else {
                    alert("You decided to not submit the form!");
                    }
                }
            },
            add: function() {
            
                var modal = Helper.loadModal('full');
                var modalBody = modal.find('.modal-body');
                var modalTitle = modal.find('.modal-title');

                modalTitle.text('Add Data Purchase Baggage');
                Helper.blockElement($(modalBody));
                Helper.ajax(Helper.baseUrl('purchase/load_add_form'), 'get', 'html')
                
                .error(function(err) {
                    modal.find('.close').click();
                })

                .done(function(data) {
                    modalBody.html(data);
                    Helper.datePicker();
                    Page.handleTransaction();
                    Helper.unblockElement($(modalBody));
                    
                });
            },
            edit: function(e) {
                var a = Helper.loadModal("full"),
                    i = a.find(".modal-body"),
                    t = a.find(".modal-title");
                t.text("Edit Data Purchase Baggage"), Helper.blockElement($(i)), Helper.ajax(Helper.baseUrl("purchase/load_edit_form"), "get", "html", {
                    id:e
                }).error(function(e) {
                    a.find(".close").click()
                }).done(function(e) {
                    i.html(e), 
                    Page.handleTransaction();

                    $(document).on('keyup', '.jml-edit', function() {
                        $(".money").autoNumeric("init", {
                            aSep: ",",
                            aDec: ".",
                            aSign: "",
                            wEmpty: "zero",
                            mDec: "0"
                        });
                        
                        var qty = $(this).autoNumeric('get');   
                        var sub_total = $(this).closest('tr').find('.sub_harga').autoNumeric('get');
                        var harga = $(this).closest('tr').find('.harga_beli').autoNumeric('get');                     

                        var jumlah = parseFloat(harga)*parseFloat(qty);
                        $(this).closest('tr').find('.sub_harga').val(jumlah);
                        $(this).closest('tr').find('.sub_harga').autoNumeric('set', jumlah);

                        Page.hitungTotal(); 
                    });

                    Helper.datePicker(), Helper.unblockElement($(i));
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
                        <td align="center"><input id="harga_beli'+count+'" class="form-control harga_beli money" name="harga_beli[]" type="text"></td>\
                        <td align="center"><input id="harga_jual'+count+'" class="form-control harga_jual money" name="harga_jual[]" type="text"></td>\
                        <td align="center"><input id="jml'+count+'" name="jml[]" class="form-control jml money" type="text" placeholder="0"></td>\
                        <input id="cekstok'+count+'" name="cekstok[]" class="form-control cekstok money" type="hidden">\
                        <td align="center"><input id="sub_harga'+count+'" class="form-control sub_harga money" name="sub_harga[]" type="text" value="0" readonly></td>\
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
                                var hrg_beli = data.harga_beli;
                                document.getElementById('harga_beli'+count).value = hrg_beli;
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
                        var harga = $(this).closest('tr').find('.harga_beli').autoNumeric('get');                     

                        var jumlah = parseFloat(harga)*parseFloat(qty);
                        $(this).closest('tr').find('.sub_harga').val(jumlah);
                        $(this).closest('tr').find('.sub_harga').autoNumeric('set', jumlah);

                        Page.hitungTotal(); 
                    });


                });



                $(document).on('click', '#hapus', function() {

                    $(this).parents(".baris").remove();
                    Page.hitungTotal();
                    $('#btn-submit-add-form').prop('disabled',false);

                });

            },

            hitungTotal: function()
            {
                var njumlah=0;  
            
                $(".sub_harga").each(function(){
                    njumlah += parseFloat($(this).autoNumeric('get'), 10) || 0;    
                });

                $("#total-bayar").autoNumeric('set',njumlah); 

            }
            

            

        }
    }();


