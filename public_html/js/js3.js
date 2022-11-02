

window.onload = function () {
    if (window.jQuery) {
        $(".select2").select2({
        });


        $("body").on("click", ".remove_order",function(){
            let el=$(this)
            el.closest('.par').remove()
            $('.count').each(function(i, obj) {
                let el1=$(this)
                el1.text(i+1)
            });
        });

        $('.add_order').on('click', function (e) {
            let brand=$('#brand').find(":selected").val()
            let product=$('#product').find(":selected").val();
            let quantity=$('#quantity').val()

            if(brand==''){
                Swal.fire('Please select Brand')
                return
            }
            if(product==''){
                Swal.fire('Please select Product')
                return
            }
            if(quantity==''){
                Swal.fire('Please enter Quantity')
                return
            }
           let p_name= $('#product').find(":selected").text();
           let b_name= $('#brand').find(":selected").text();
            $('#order_tbody').append(
                `
                <tr class="par">
                <td class="count"></td>
                <td>${b_name}  <input type="text" name="brands[]" value="${brand}" hidden> </td>
                <td>${p_name}  <input type="text" name="products[]" value="${product}" hidden></td>
                <td>${quantity}  <input type="text" name="quantities[]" value="${quantity}" hidden></td>
                <td>
                <span class="remove_order btn btn-danger">remove</span>
                </td>
                   </tr>
                `
            )
            $('.count').each(function(i, obj) {
                let el=$(this)
                el.text(i+1)
            });


              });
        $('.add_product').on('click', function (e) {

            var ele=$(this)
            let product=$('#product').val()
            let branch=ele.data('branch')
            console.log(product)
            console.log(branch)
            if(product == ''){
                Swal.fire('Please select a product')
                return
            }
            $.ajax('/admin/add_product/'+branch, {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                },
                type: 'post',
                data:{product: product},
                datatype: 'json',
                success: function (data) {
                    console.log(data)
                    switch(data.status){
                        case 0:
                            Swal.fire('Product not found ')
                            break
                        case 1:
                            $('#tbody_p').prepend(data.html);
                            break
                        case 2:
                            Swal.fire('The product has already been added')
                            break
                    }

                },
                error: function (request, status, error) {
                    console.log(request);
                }
            })
        });
            $("body").on("click", ".remove_product",function(){

            var ele=$(this)
            let product=ele.data('product')
            let branch=ele.data('branch')
                Swal.fire({
                    title: 'Do you want to remove the product?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Remove',
                    denyButtonText: `Cancel`,
                  }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax('/admin/remove_product/'+branch, {
                            headers: {
                                'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                            },
                            type: 'post',
                            data:{product: product},
                            datatype: 'json',
                            success: function (data) {
                                console.log(data)
                                ele.closest(".par").hide(400)
                                $('.product').html(data.body)
                            },
                            error: function (request, status, error) {
                                console.log(request);
                            }
                        })
                    } else if (result.isDenied) {
                    }
                  })

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
