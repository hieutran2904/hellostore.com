<?php
include('app/Controllers/View.php');
$view = new View();
$view->loadContent("include", "session");
$view->loadContent('include', 'top');
$view->loadContent('content', 'product');
$view->loadContent('include', 'tail');

?>

<script>
    const priceList = document.getElementsByClassName("check_price_custom");
    var price = 0;
    for(let i = 0; i<priceList.length; i++){
        priceList[i].addEventListener("click", function(){
            for(let j = 0; j<priceList.length; j++){
                if(j!=i){
                    priceList[j].checked = false;
                }
            }
        })
    }

    const colorList = document.getElementsByClassName("check_color_custom");
    for(let i = 0; i<colorList.length; i++){
        colorList[i].addEventListener("click", function(){
            for(let j = 0; j<colorList.length; j++){
                if(j!=i){
                    colorList[j].checked = false;
                }
            }
        })
    }
</script>
