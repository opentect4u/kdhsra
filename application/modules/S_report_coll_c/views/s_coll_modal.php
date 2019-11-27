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
   
    <div>

        <h1 class="center" style= "font-family: Arial, Helvetica, sans-serif">

            RAHARA SOCIETY

        </h1>

        <h3 class="center" style= "font-family: sans-serif"> 

            <?php

                echo strtoupper("Rahara, Hoogly, WB ");

            ?>

        </h3>

    </div>

    <br>
    
    <div>

        <h4 class="underline" style = "text-align: center">

            Member Collection Report From: <?php echo(date("d/m/Y", strtotime($data[0]))); ?> To <?php echo(date("d/m/Y", strtotime($data[1]))); ?> 

        </h4>
        <br><br>


        <table align="center">

            <thead style = "text-align: center">
                <tr>
                    <td>Date</td>
                    <td>Member Id</td>
                    <td>Member Name</td>
                    <td>Collections</td>
                    <td>Amount</td>

                </tr>
            </thead>

            <tbody style = "text-align: center">
            <?php foreach($data1 as $row1)
            {?>

                <tr>

                    <td><?php echo(date("d/m/Y", strtotime($row1->trans_dt))); ?></td> 
                    <td><?php echo($row1->mem_id); ?></td>
                    <td><?php echo($row1->mem_name); ?></td>
                    <td><?php echo($row1->collections); ?></td>
                    <td><?php echo($row1->collection_amount); ?></td>

                </tr>

            <?php
                }?>
            </tbody>

            <tfoot style = "text-align: center">
                <tr>
                    <td>
                        <strong>TOTAL:</strong>
                    </td>
                    <td colspan="6">
                        <?php echo $data2->total; ?>
                    </td>
                </tr>
            </tfoot>

        </table>


       <!-- <br style="line-height: 15px;">
        <br><br>
        <div>

            TOTAL: <?php //echo $data2->total; ?>

        </div> -->
        <br><br>

    </div>


</div>

<div class="modal-footer">

    <button class="btn btn-secondary" type="button" onclick="location.href='<?php echo base_url();?>index.php/S_report_coll_c/main'">Cancel</button>

    <button class="btn btn-secondary" type="button" onclick="printDiv();">Print</button>

</div>

