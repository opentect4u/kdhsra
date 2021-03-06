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

<!--
<style>

    .line{
    width: 500px;
    height: 47px;
    border-bottom: 1px solid black;
    position: absolute;
    align: center;
    }

</style>
 -->


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

                echo strtoupper("Bose Para, Khardah, WB ");

            ?>

        </h3>

    </div>

    <br>
    
    <div>

        <h4 class="underline" style = "text-align: center">

            <?php echo $exam; ?> Fee Ledger For : <?php echo $class.' / '.$stu_sec; ?>  From :<strong> <?php echo date('d-m-Y',strtotime($from_dt)); ?></strong>  To : <strong><?php echo date('d-m-Y',strtotime($to_dt)) ; ?></strong>

        </h4>
        <br><br>


        <table class="table table-striped" style="width: 100%;">

            <thead style = "text-align: center">
                <tr>
                    <td>Sl.No.</td>
                    <td><strong>Roll No</strong></td>
                    <td><strong>Name</strong></td>
                    <td><strong>Actual Paid(Rs)</strong></td>
                    <td><strong>Receivable(Rs)</strong></td>
                    <td><strong>Due(Rs)</strong></td>

                </tr>
            </thead>

            <tbody style = "text-align: center">

            <?php $i=1; foreach($data as $row)
            {?>

                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo($row->roll_no); ?></td>
                    <td><?php echo($row->stu_name); ?></td>
                    <td><?php echo($row->rcvbl); ?></td>
                    <td><?php echo($row->payable); ?></td>
                    <td><?php echo(($row->payable)-($row->rcvbl)); ?></td>
                    
                </tr>

            <?php
                    $i++;
                }?>

            </tbody>

            <tfoot style = "text-align: center">

                <tr>
                    <?php foreach($footer as $row2){ ?>
                    <td>
                        <strong><?php echo "TOTAL:  "; ?></strong>
                    </td>
                    <td></td><td></td>
                    <td colspan="1" style="text-align: center;">
                        <strong><?php echo $row2->tot_rcvbl; ?></strong>
                    </td>
                    
                    <td colspan="1" style="text-align: center;">
                        <strong><?php echo $row2->tot_payable; ?></strong>
                    </td>

                    <td colspan="1" style="text-align: center;">
                        <strong><?php echo ($row2->tot_payable-$row2->tot_rcvbl); ?></strong>
                    </td>

                    <?php } ?>

                </tr>

            </tfoot>


        </table>

    </div>


</div>


<div class="modal-footer">

    <button class="btn btn-primary" type="button" onclick="location.href='<?php echo base_url('index.php/Report_collection_c/examFee_ledger');?>'">Back</button>

    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>

</div>
