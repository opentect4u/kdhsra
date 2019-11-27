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
    
    <div>

        <h4 class="underline" style = "text-align: center">

            Monthly Fee For : <?php foreach($data2 as $row2) { echo $row2->fees_month; ?>/<?php echo $row2->fees_year; }?> 

        </h4>
        <br><br>

        <table class="table table-striped" style="width: 75%; margin-left: 12%;">

            <thead >
                <?php foreach($data2 as $row2){ ?>
                <tr style = "text-align: left"> 
                    <td colspan="2"><strong>Name:</strong> <?php echo $row2->stu_name; ?></td>
                </tr>
                <tr style = "text-align: left">
                    <td colspan="2"><strong>Class:</strong> <?php echo $row2->stu_class; ?></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Section:</strong> <?php echo $row2->stu_sec; ?></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Roll No:</strong> <?php echo $row2->roll_no; ?></td>
                </tr>
                <?php } ?>
                <tr style = "text-align: center">
                    <td><strong>Fees</strong></td>
                    <td><strong>Amount</strong></td>
                </tr>
            </thead>

            <tbody style = "text-align: center">
            <?php foreach($data1 as $row1)
            {?>
                <tr>
                    <td><?php echo($row1->fees_name); ?></td> 
                    <td><?php echo($row1->fees_amount); ?></td>
                </tr>
            <?php
                }?>
            </tbody>

            <tfoot style = "text-align: center">
            <?php foreach($data2 as $row2){ ?>
                <tr>
                    <td>
                        <strong>TOTAL:</strong>
                    </td>
                    <td style="text-align: center;">
                        <strong><?php echo $row2->total; ?></strong>
                    </td>
                </tr>
            <?php } ?>
            </tfoot>

        </table>
        

        <br><br>
        <br><br>
        <br><br>
        
        <p style = "margin-left: 5%; display: inline-block;">
            Transaction Date : <?php echo $data3; ?>
        </p>

        <p style = "margin-left: 50%; display: inline-block;">
            Signature of Authority : _ _ _ _ _ _ _ _ _ _ 
        </p>

    </div>


</div>


<div class="modal-footer">

    <button class="btn btn-primary" type="button" onclick="location.href='<?php echo base_url('index.php/Report_collection_c/bill');?>'">Back</button>

    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>

</div>