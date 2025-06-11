
    
    $(document).ready(function() {
    $('#myTable').DataTable();
} );// $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    // let postModal = new bootstrap.Modal(document.getElementById('postModal'));

    // $('#createNewPost').click(() => {
    //     $('#postForm')[0].reset();
    //     $('#post_id').val('');
    //     postModal.show();
    // });

    $("#add").click(function() {
     

        const name=$('#username').val();
        const email=$('#email').val();
        const mobile=$('#mobile').val();
        const address=$('#address').val();
        const gst=$('#gst').val();
        const url = '/customer';
        

        $.ajax({
            url:url, method:'post',
             headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }, data:JSON.stringify({
                name:name,
                email:email,
                mobile:mobile,
                address:address
            }),
            success: function (res) {
               $('#addForm')[0].reset();
            }
        });
    });
      $(document).on('click', '.update', function () {
        console.log('hi');
        
     
                //    id1= $('#id1').val();
                //    name1=  $('#name1').val();
                //    email1= $('#email1').val();
                //    mobile1= $('#mobile1').val();
                //    address1= $('#address1').val();
                //    gst1= $('#gst1').val();
                //    console.log(id1);
                //    console.log(name1);
                //    console.log(email1);
                //    console.log(mobile1);
                //    console.log(address1);
                //    console.log(gst1);

    //    $.ajax({
    //             url: `/customer/${customer}/edit`,
    //             type: 'POST',
    //             data:JSON.stringify({
    //             name:name1,
    //             email:email1,
    //             mobile:mobile1,
    //             address:address1
    //         }),
    //                 headers: {
    //             'Content-Type': 'application/json',
    //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    //         }, 
    //             success: function (data) {
                
                
                    
    //             }
    //         });

    });

     $(document).on('click', '#editmodal', function () {
        
       var customer = $(this).data('id');
        console.log(customer);
       $.ajax({
                url: `/customer/${customer}/edit`,
                type: 'GET',
                    headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }, 
                success: function (data) {
                   var val= JSON.stringify(data);
               
                   var val1=JSON.parse(val);
                   

                        $('#id1').val(val1.id);
                    $('#name1').val(val1.name);
                    $('#email1').val(val1.email);
                    $('#mobile1').val(val1.mobile);
                    $('#address1').val(val1.address);
                    $('#gst1').val(val1.gst);
                  $('.editModal').modal('show'); 
                
                    
                }
            });

    });

 $(document).on('click', '#deletePost', function () {
        var customer = $(this).data('id');
 
        if (confirm("Are you sure to delete this post?")) {
            $.ajax({
                url: `/customer/${customer}`,
                type: 'DELETE',
                    headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }, 
                success: function (data) {
                      if (data.success) {
        window.location.href = data.redirect;
    }
                    
                }
            });
        }
    });
