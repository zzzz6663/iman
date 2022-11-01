

window.onload = function () {
    if (window.jQuery) {
        $(".select2").select2({
        });

        $('.brand').on('change', function (e) {
            var ele=$(this)
            let brand=ele.val()
            console.log(brand)
            $.ajax('/admin/get_product/'+brand, {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                },
                type: 'post',
                datatype: 'json',
                success: function (data) {
                    console.log(data)
                    $('.product').html(data.body)
                },
                error: function (request, status, error) {
                    console.log(request);
                }
            })


        });


        $('.check_code').change(function () {
            let el=$(this)
            let p=el.data('p')
            let u=el.data('u')
            console.log(p)
            console.log(u)
            $.ajax('/admin/pass_products/'+u, {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                },
                data:{product:p},
                type: 'post',
                datatype: 'json',
                success: function (data) {
                    console.log(data)
                    if(data.show==1){
                        el.closest('.par').find('.word').text('Added')
                    }else{
                        el.closest('.par').find('.word').text('Ready To Add')
                    }
                },
                error: function (request, status, error) {
                    console.log(request);
                }
            })
        })












    }

}
