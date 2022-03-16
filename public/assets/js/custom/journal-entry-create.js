 var selector = "body";
        if ($(selector + " .repeater").length) {
            // console.log('repeater');
            var $dragAndDrop = $("body .repeater tbody").sortable({
                handle: '.sort-handler'
            });
            var $repeater = $(selector + ' .repeater').repeater({
                initEmpty: false,
                defaultValues: {
                    'status': 1
                },
                show: function () {
                    $(this).slideDown();
                    var file_uploads = $(this).find('input.multi');
                    if (file_uploads.length) {
                        $(this).find('input.multi').MultiFile({
                            max: 3,
                            accept: 'png|jpg|jpeg',
                            max_size: 2048
                        });
                    }
                    $('.select2').select2();
                   // $(".select2").select2({
                   //    matcher: matchStart
                   //  });
                },
                hide: function (deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                        $(this).remove();

                        var inputs = $(".debit");
                        var totalDebit = 0;
                        for (var i = 0; i < inputs.length; i++) {
                            if (!isNaN($(inputs[i]).val()) && $(inputs[i]).val() != ''){
                                totalDebit = parseFloat(totalDebit) + parseFloat($(inputs[i]).val());
                            }
                        }
                        $('.totalDebit').html(totalDebit.toFixed(2));


                        var inputs = $(".credit");
                        var totalCredit = 0;
                        for (var i = 0; i < inputs.length; i++) {
                            if (!isNaN($(inputs[i]).val()) && $(inputs[i]).val() != ''){
                                totalCredit = parseFloat(totalCredit) + parseFloat($(inputs[i]).val());
                            }
                        }
                        $('.totalCredit').html(totalCredit.toFixed(2));


                    }
                },
                ready: function (setIndexes) {
                    $dragAndDrop.on('drop', setIndexes);
                },
                isFirstItemUndeletable: true
            });
            var value = $(selector + " .repeater").attr('data-value');
            if (typeof value != 'undefined' && value.length != 0) {
                value = JSON.parse(value);
                $repeater.setList(value);
            }

        }

        $(document).on('keyup', '.debit', function () {
            var el = $(this).parent().parent().parent().parent();
            var debit = $(this).val();
            var credit = 0;
            el.find('.credit').val(credit);
            el.find('.amount').html(debit);


            var inputs = $(".debit");
            var totalDebit = 0;
            for (var i = 0; i < inputs.length; i++) {
                if (!isNaN($(inputs[i]).val()) && $(inputs[i]).val() != ''){
                    totalDebit = parseFloat(totalDebit) + parseFloat($(inputs[i]).val());
                }
            }
            $('.totalDebit').html(totalDebit.toFixed(2));

            el.find('.credit').attr("disabled", true);
            el.find('.credit').addClass('d-none');
            if (debit == '') {
                el.find('.credit').attr("disabled", false);
                el.find('.credit').removeClass('d-none');
            }
            
        })
        
        $(document).on('change', '#vouchertype', function () {
            // alert('vouchertype');
            var prefix = $(".prefixjournal").data('prefix');
            // alert(prefix);
            var vouchertype = $(this).val();
            var journal = vouchertype+prefix;
            console.log(journal);
            $(".prefixjournal").val(journal);
            // BPV
            // CPV
            // BR
            // CR
        }) 
        
        $(document).on('keyup', '.credit', function () {
            var el = $(this).parent().parent().parent().parent();
            var credit = $(this).val();
            var debit = 0;
            el.find('.debit').val(debit);
            el.find('.amount').html(credit);

            var inputs = $(".credit");
            var totalCredit = 0;
            for (var i = 0; i < inputs.length; i++) {
                if (!isNaN($(inputs[i]).val()) && $(inputs[i]).val() != '') {
                    totalCredit = parseFloat(totalCredit) + parseFloat($(inputs[i]).val());
                }
            }
            
            $('.totalCredit').html(totalCredit.toFixed(2));

            el.find('.debit').attr("disabled", true);
            el.find('.debit').addClass('d-none');
            if (credit == '') {
                el.find('.debit').attr("disabled", false);
                el.find('.debit').removeClass('d-none');
            }
        })