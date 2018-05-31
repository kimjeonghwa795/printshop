<html>
<head>
<title>Download item:<?php echo $item_id ;?> of order #<?php echo $order_id ;?></title>
</head>
<body style="text-align:center;width:100vw;">
<p>
FILE GENERATION TAKE LONGER THAN EXPECTED
</p>    
<p>
download link for your requested file will be available shortly
</p>

<p class="link">
 click here to download
</p>
<script>
document.addEventListener("DOMContentLoaded", function(event) { 
    var d = 10;
    var i = setInterval(function(){
        if (d) {
            document.querySelector('p.link').innerHTML = ( 'your download file will ready in ' + d + ' seconds.');
            d--;
        }else{
            clearInterval(i);
            document.querySelector('p.link').innerHTML = ('<a href="<?php echo $link;?>">click here to download</a>');
        };
    },1000);
    
});
</script>
</body>
</html>
