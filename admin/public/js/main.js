$('.customerStatus').click(function(e) {
    e.preventDefault();
    const customerStatus = $(this).hasClass('btn-success') ? 'Inactive' : 'Active';
    const customerStatusId = $(this).data('itemid');
    $(this).toggleClass('btn-success btn-danger');
    $(this).html(customerStatus);

    console.log(customerStatusId);
    $.ajax({
        url: 'app/handle/changeStatusCustomer.php',
        data: { 
            id: customerStatusId,
            status: customerStatus
        },
        method: 'post',
        success: (response) => {
            $('.notification').html(response);
        }
    })
});

$('.reviewStatus').click(function(e) {
    e.preventDefault();
    const reviewStatus = $(this).hasClass('btn-success') ? 'Inactive' : 'Active';
    const reviewStatusId = $(this).data('itemid');
    $(this).toggleClass('btn-success btn-danger');
    $(this).html(reviewStatus);

    console.log(reviewStatusId);
    $.ajax({
        url: 'app/handle/changeStatusReview.php',
        data: { 
            id: reviewStatusId,
            status: reviewStatus
        },
        method: 'post',
        success: (response) => {
            $('.notification').html(response);
        }
    })
});

// add or edit category
$('#submit-category').click(function(e) {
    e.preventDefault();
    const categoryId = $('#val-category-id').val();
    const categoryName = $('#val-category-name').val();
    const categoryStatus = $('#val-category-status').val();
    $.ajax({
        url: 'app/handle/category.php',
        data: { 
            id: categoryId,
            name: categoryName,
            status: categoryStatus
        },
        method: 'post',
        success: (response) => {
            $('.notification').html(response);
        }
    })
});

//delete category
$('.sweet-confirm-custom').click(function(e) {
    e.preventDefault();
    var id = $(this).data('itemid');

    //check has class sweet-confirm-category
    let tableName = '';
    if($('.sweet-confirm-custom').hasClass('sweet-confirm-category')){
        console.log('has class sweet-confirm-category');
        tableName = 'categories';
    }

    swal(
        {
            title: "Are you sure to delete ?",
            text: "You will not be able to recover this imaginary file !!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it !!",
            closeOnConfirm: !1,
        },
        function () {
            console.log("cf" + id);
            $.ajax({
                url: 'app/handle/delete.php',
                data: {
                    id: id,
                    tableName: tableName
                },
                method: 'post',
                success: (response) => {
                    $('tbody').html(response);
                }
            })
            swal(
                "Deleted !!",
                "Hey, your imaginary file has been deleted !!",
                "success"
            );
        }
    );
});