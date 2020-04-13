<?php

    $this->load->view('post_login/society/header');

?>

<style>

    .header-color
    {

        background: #833ab4;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #fcb045, #fd1d1d, #833ab4);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #fcb045, #fd1d1d, #833ab4); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
  
    }

    .home-img
    {
        height: 100;
        width: 150;
        padding-top: 5em; 
        position: center;
    }

</style>

<div class="row">
    
    <div class="col-lg-12 header-color">

        <h1 class="page-header">Khardaha Sri Ramakrishna Sarada Sevashram</h1>
      
    </div>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="text/html; charset=iso-8859-2" http-equiv="Content-Type">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <style>
        .mySlides {display:none;}
    </style>

    <div class="col-lg-12 home-img">

        <div class="w3-content w3-section" style="width:400px">
            <img class="mySlides" src="<?php echo base_url('./rahara_logo.jpg'); ?>" style="width:100%">
            <img class="mySlides" src="<?php echo base_url('./login_img.jpg'); ?>" style="width:100%">
            <img class="mySlides" src="<?php echo base_url('./swamiji.jpeg'); ?>" style="width:100%">
            <img class="mySlides" src="<?php echo base_url('./sarada.jpg'); ?>" style="width:100%">
        </div>

    </div>

    <script>

        var myIndex = 0;
        carousel();

        function carousel() {

            var i;
            var x = document.getElementsByClassName("mySlides");
            
            for (i = 0; i < x.length; i++) 
            {
                x[i].style.display = "none";  
            }
            myIndex++;

            if (myIndex > x.length)
            {myIndex = 1}    

            x[myIndex-1].style.display = "block";  
            setTimeout(carousel, 2000); // Change image every 2 seconds
        
        }

    </script>



    <!-- for clock -->
<!--
    <canvas id="canvas" width="120" height="120"
        style="background-color:white">
    </canvas> -->


  <!--  <script>
        var canvas = document.getElementById("canvas");
        var ctx = canvas.getContext("2d");
        var radius = canvas.height / 2;
        ctx.translate(radius, radius);
        radius = radius * 0.95
        setInterval(drawClock, 1000);

        function drawClock() {
        drawFace(ctx, radius);
        drawNumbers(ctx, radius);
        drawTime(ctx, radius);
        }

        function drawFace(ctx, radius) {

            var grad;
            ctx.beginPath();
            ctx.arc(0, 0, radius, 0, 2*Math.PI);
            ctx.fillStyle = 'white';
            ctx.fill();
            grad = ctx.createRadialGradient(0,0,radius*0.95, 0,0,radius*1.05);
            grad.addColorStop(0, '#333');
            grad.addColorStop(0.5, 'white');
            grad.addColorStop(1, '#333');
            ctx.strokeStyle = grad;
            ctx.lineWidth = radius*0.1;
            ctx.stroke();
            ctx.beginPath();
            ctx.arc(0, 0, radius*0.1, 0, 2*Math.PI);
            ctx.fillStyle = '#333';
            ctx.fill();
        }

        function drawNumbers(ctx, radius) {

            var ang;
            var num;
            ctx.font = radius*0.15 + "px arial";
            ctx.textBaseline="middle";
            ctx.textAlign="center";
            for(num = 1; num < 13; num++){

                ang = num * Math.PI / 6;
                ctx.rotate(ang);
                ctx.translate(0, -radius*0.85);
                ctx.rotate(-ang);
                ctx.fillText(num.toString(), 0, 0);
                ctx.rotate(ang);
                ctx.translate(0, radius*0.85);
                ctx.rotate(-ang);
            }
        }

        function drawTime(ctx, radius){
            var now = new Date();
            var hour = now.getHours();
            var minute = now.getMinutes();
            var second = now.getSeconds();
            //hour
            hour=hour%12;
            hour=(hour*Math.PI/6)+
            (minute*Math.PI/(6*60))+
            (second*Math.PI/(360*60));
            drawHand(ctx, hour, radius*0.5, radius*0.07);
            //minute
            minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
            drawHand(ctx, minute, radius*0.8, radius*0.07);
            // second
            second=(second*Math.PI/30);
            drawHand(ctx, second, radius*0.9, radius*0.02);
        }

        function drawHand(ctx, pos, length, width) {
            ctx.beginPath();
            ctx.lineWidth = width;
            ctx.lineCap = "round";
            ctx.moveTo(0,0);
            ctx.rotate(pos);
            ctx.lineTo(0, -length);
            ctx.stroke();
            ctx.rotate(-pos);
        }

    </script> --> 


</div>

<?php

    $this->load->view('post_login/academy/footer');

?>