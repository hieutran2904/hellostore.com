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