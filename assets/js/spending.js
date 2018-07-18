var addBtn = $("#add-btn"),
    loadData = window.base_url + "spending/load_data",
    tableID = $("#datatable_ajax"),
    grid = new Datatable,
    urlUpdateStatus = window.base_url + "spending/delete",
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
                }),$(document).on("click", ".btn-export1", function() {
                    Page.export1()
                }),$(document).on("click", ".btn-export_date", function() {
                    Page.export_date()
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
                         tgl_faktur: {
                                required: !0
                         },
                         jenis: {
                                required: !0
                         },
                         diterima: {
                                required:  !0
                         },
                    });

                    // If form is valid run submit through ajax request
                    if (form.valid()) {
                        
                        var url = Helper.baseUrl('spending/add');

                        if (id) {
                            url = Helper.baseUrl('spending/edit');
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
                } 
            },  
            edit: function(e) {
                var a = Helper.loadModal("full"),
                    i = a.find(".modal-body"),
                    t = a.find(".modal-title");
                t.text("Edit Data Expenditure"), Helper.blockElement($(i)), Helper.ajax(Helper.baseUrl("spending/load_edit_form"), "get", "html", {
                    id:e
                }).error(function(e) {
                    a.find(".close").click()
                }).done(function(e) {
                    i.html(e), 
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
                        var harga = $(this).closest('tr').find('.harga').autoNumeric('get');                     

                        var jumlah = parseFloat(harga)*parseFloat(qty);
                        $(this).closest('tr').find('.sub_harga').val(jumlah);
                        $(this).closest('tr').find('.sub_harga').autoNumeric('set', jumlah);

                        Page.hitungTotal(); 
                    });
                    Helper.datePicker(), Helper.unblockElement($(i));
                })
            },      

            add: function() {
            
                var modal = Helper.loadModal('full');
                var modalBody = modal.find('.modal-body');
                var modalTitle = modal.find('.modal-title');

                modalTitle.text('Add Data Expenditure');
                Helper.blockElement($(modalBody));
                Helper.ajax(Helper.baseUrl('spending/load_add_form'), 'get', 'html')
                
                .error(function(err) {
                    modal.find('.close').click();
                })

                .done(function(data) {
                    modalBody.html(data);
                    Helper.datePicker();
                    Helper.selectField($(".jadwal"), "Pilih Jadwal");
                    Page.handleTransaction();
                    Helper.unblockElement($(modalBody));
                    
                });
            },
            export1: function() {
            
                var modal = Helper.loadModal('small');
                var modalBody = modal.find('.modal-body');
                var modalTitle = modal.find('.modal-title');

                modalTitle.text('Export Based On Schedule');
                Helper.blockElement($(modalBody));
                Helper.ajax(Helper.baseUrl('spending/load_export1'), 'post', 'html')
                
                .error(function(err) {
                    modal.find('.close').click();
                })

                .done(function(data) {
                    modalBody.html(data);
                    Helper.datePicker();
                    Helper.selectField($(".jadwal"), "Select Schedule");
                    Page.handleTransaction();
                    Helper.unblockElement($(modalBody));
                    
                });
            },
            export_date: function() {
            
                var modal = Helper.loadModal('small');
                var modalBody = modal.find('.modal-body');
                var modalTitle = modal.find('.modal-title');

                modalTitle.text('Export Based On Date');
                Helper.blockElement($(modalBody));
                Helper.ajax(Helper.baseUrl('spending/load_export_date'), 'get', 'html')
                
                .error(function(err) {
                    modal.find('.close').click();
                })

                .done(function(data) {
                    modalBody.html(data);
                    Helper.datePicker();
                    Helper.selectField($(".jadwal"), "Select Schedule");
                    Page.handleTransaction();
                    Helper.unblockElement($(modalBody));
                    
                });
            },
            // service
            handleTransaction: function() {
                
                //DYNAMIC ROWS
                var count = 1;
                $("#add_row").click(function(){
                    count += 1;

                    $('#container').append('\
                        <tr class="baris form-create-barang" id="form-create-barang'+ count +'"">\
                        <td align="center"><input id="item'+count+'" class="form-control item" name="item[]" type="text"></td>\
                        <td align="center"><input id="deskripsi'+count+'" class="form-control deskripsi" name="deskripsi[]" type="text"></td>\
                        <td align="center"><input id="harga'+count+'" class="form-control harga money" name="harga[]" type="text"></td>\
                        <td align="center"><input id="jml'+count+'" name="jml[]" class="form-control jml money" type="text" placeholder="0"></td>\
                        <td align="center"><input id="sub_harga'+count+'" class="form-control sub_harga money" name="sub_harga[]" type="text" value="0" readonly></td>\
                        <td>\
                            <button type="button" class="btn btn-circle btn-danger" id="hapus"><i class="icon-trash"></i></button>\
                            <input id="rows'+count+'" name="rows[]" value="'+count+'" type="hidden">\
                        </td>\
                        </tr>\
                        ');


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
                        var harga = $(this).closest('tr').find('.harga').autoNumeric('get');                     

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

                $("#total_biaya").autoNumeric('set',njumlah); 

            }
            

            

        }
    }();


