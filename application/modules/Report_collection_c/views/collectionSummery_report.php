<script>

    function printDiv() {
        var divToPrint=document.getElementById('divToPrint');

        var WindowObject=window.open('','Print-Window');
        WindowObject.document.open();
        WindowObject.document.writeln('<!DOCTYPE html>');
        WindowObject.document.writeln('<html><head><title></title><style type="text/css">');


        WindowObject.document.writeln('@media print { .center { text-align: center;}' +
            '                                         .inline { display: inline; }' +
            '                                         .underline { text-decoration: underline; }' +
            '                                         .left { margin-left: 315px;} ' +
            '                                         .right { margin-right: 375px; display: inline; }' +
            '                                          table, th, td { border: 1px solid black; border-collapse: collapse; }' +
            '                                           th, td { padding: 5px; }' +
            '                                         .border { border: 1px solid black; } ' +
            '                                         .bottom { bottom: 5px; width: 100%; position: fixed; ' +
            '                                       ' +
            '                                   } } </style>');
        // WindowObject.document.writeln('<style type="text/css">@media print{p { color: blue; }}');
        WindowObject.document.writeln('</head><body onload="window.print()">');
        WindowObject.document.writeln(divToPrint.innerHTML);
        WindowObject.document.writeln('</body></html>');
        WindowObject.document.close();
        setTimeout(function(){ WindowObject.close();},10);

    }

</script>


<div id="divToPrint">
   
    <div class="panel-heading">

        <h1 class="center" style= "font-family: Arial, Helvetica, sans-serif; text-align: center;">

            RAMAKRISHANA SARADA VIDYAPEETH

        </h1>

        <h5 class="center" style= "font-family: Arial, Helvetica, sans-serif; text-align: center;">

            Estd: 1992

        </h5>

        <h3 class="center" style= "font-family: sans-serif; text-align: center;"> 

            <?php
                echo strtoupper("Thana Road, Khardah, WB ");
            ?>

        </h3>

    </div>

    <br>

    <div>

        <h4 class="underline" style = "text-align: center">

            Monthly Collection Summery From: <?php echo(date("d/m/Y", strtotime($start_dt))); ?> To <?php echo(date("d/m/Y", strtotime($end_dt))) ; ?> 

        </h4>
        <br><br>

        <table class="table table-striped" style="width: 100%;">

            <thead style = "text-align: center">
                <tr>
                    <td><strong>Class</strong></td>
                    <td><strong>Section</strong></td>
                    <td><strong>Collection(Rs.)</strong></td>
                </tr>
            </thead>

            <tbody style = "text-align: center">
                <?php foreach($data1 as $key1){ ?>
                <tr>

                    <td><?php echo($key1->stu_class); ?></td> 
                    <td><?php echo($key1->stu_sec); ?></td> 
                    <td><?php echo($key1->total); ?></td>
                   
                </tr>
                <?php } ?>
            </tbody>

            <tfoot style = "text-align: center">
                <tr>
                    <td colspan="2" style="text-align: left;">
                        <strong>TOTAL:</strong>
                    </td>
                    <td colspan="1" style="text-align: center;">
                        <strong><?php echo $data2->total; ?><strong>
                    </td>
                </tr>
            </tfoot>

        </table>

        <br><br>

    </div>

</div>



<div class="modal-footer">

    <button class="btn btn-primary" type="button" onclick="location.href='<?php echo base_url();?>index.php/Report_collection_c/Collection_summery'">Back</button>

    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>

</div>