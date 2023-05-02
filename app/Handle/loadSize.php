<?php
session_start();
include '../Models/Eloquent.php';
include '../../config/database.php';
include '../../config/site.php';
$eloquent = new Eloquent();

$productSizeList = $eloquent->selectData(['product_size'], 'products_sc', ['product_id' => $_POST['product_id'], 'product_color' => $_POST['color']]);
foreach ($productSizeList as $eachSize) {
    echo '<li class="mr-5"><a class="choice-size" data-size="' . $eachSize['product_size'] . '">' . $eachSize['product_size'] . '</a></li>';
}
?>
<script>
    // $('.choice-size').click(function() {
    //     console.log('click');
    //     const parentElement = this.parentElement;
    //     console.log(parentElement.className);
    //     parentElement.classList.add('active');
    //     console.log(parentElement.className);
    //     if (parentElement.classList.contains("active")) {
    //         console.log(parentElement.className);
    //         parentElement.classList.remove('active');
    //         // $.ajax({
    //         //     url: 'app/Handle/loadQuantity.php',
    //         //     type: 'POST',
    //         //     data: {
    //         //         size: size,
    //         //         product_id: <?= $_SESSION['SSCF_product_product_id']; ?>
    //         //     },
    //         //     success: function(data) {
    //         //         $('.load-size').html(data);
    //         //     }
    //         // });
    //     } else {
    //         parentElement.classList.add('active');
    //     }
    // });
    let choiceSizes = document.querySelectorAll('.choice-size');
    choiceSizes.forEach(choiceSize => {
        choiceSize.addEventListener('click', function(e) {
            e.preventDefault();
            const size = this.getAttribute('data-size');
            console.log(size);
            const parentElement = choiceSize.parentElement;
            parentElement.classList.add('active');
            console.log(parentElement.className);
            if (parentElement.classList.contains("active") == true) {
                parentElement.classList.remove('active');
                console.log(parentElement.className);
                // $.ajax({
                //     url: 'app/Handle/loadQuantity.php',
                //     type: 'POST',
                //     data: {
                //         size: size,
                //         product_id: <?= $_SESSION['SSCF_product_product_id']; ?>
                //     },
                //     success: function(data) {
                //         $('.load-size').html(data);
                //     }
                // });
            } else {
                parentElement.classList.add('active');
            }
        });
    });
</script>