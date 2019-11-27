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

                echo strtoupper("Thana Road, Khardah, WB ");

            ?>

        </h3>

    </div>

    <br>
    
    <div>

        <h4 class="underline" style = "text-align: center">

            <?php echo $fee->fees_name.'  '; ?> Collection Report For : <?php   if($month == 0)
                                                                                    {echo $year ;}
                                                                                elseif($month == 1)
                                                                                    {echo 'Jan / '.$year ;} 
                                                                                elseif($month == 2)
                                                                                    {echo 'Feb / '.$year ;} 
                                                                                elseif($month == 3)
                                                                                    {echo 'Mar / '.$year ;}
                                                                                elseif($month == 4)
                                                                                    {echo 'Apr / '.$year ;}
                                                                                elseif($month == 5)
                                                                                    {echo 'May / '.$year ;}
                                                                                elseif($month == 6)
                                                                                    {echo 'Jun / '.$year ;}
                                                                                elseif($month == 7)
                                                                                    {echo 'Jul / '.$year ;}
                                                                                elseif($month == 8)
                                                                                    {echo 'Aug / '.$year ;}
                                                                                elseif($month == 9)
                                                                                    {echo 'Sep / '.$year ;}
                                                                                elseif($month == 10)
                                                                                    {echo 'Oct / '.$year ;}
                                                                                elseif($month == 11)
                                                                                    {echo 'Nov / '.$year ;}
                                                                                elseif($month == 12)
                                                                                    {echo 'Dec / '.$year ;}
                                                                                      
                                                                                ?>

        </h4>
        <br><br>

        <table class="table table-striped" style="width: 100%;">

            <thead style = "text-align: center">
                <tr>
                    <td><strong>Fees</strong></td>
                    <td><strong>Amount (Rs.)</strong></td>

                </tr>
            </thead>

            <tbody style = "text-align: center">
                <tr>

                    <td><?php echo $fee->fees_name ; ?></td>
                    <td><strong><?php echo($data->fees_amount); ?><strong></td>

                </tr>

            </tbody>

            <!-- <tfoot style = "text-align: center">

                <tr>
                    <td>
                        <strong><?php echo "TOTAL:  ". $tot_data1; ?></strong>
                    </td>
                    <td colspan="1" style="text-align: center;">
                        <strong><?php echo "Rs.  ".$tot_data1 * ($tot_data2->fees_amount); ?></strong>
                    </td>
                </tr>

            </tfoot> -->


        </table>

    </div>


</div>


<div class="modal-footer">

    <button class="btn btn-primary" type="button" onclick="location.href='<?php echo base_url('index.php/Report_collection_c/fwCollection_report');?>'">Back</button>

    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>

</div>
