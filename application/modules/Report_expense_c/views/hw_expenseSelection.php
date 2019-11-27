<!--/// jquery links for data range ///  dateRange picker //-->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />



<div class="row">

    <div class="col-lg-12">
        <h1 class="page-header">Head Wise Expenses</h1>
    </div>
    
</div>

<div class="panel panel-default">

    <div class="panel-heading">
        
        <p style="text-align: left; width:49%; display: inline-block;">Expense Report</p>
        <p style="text-align: right; width:50%;  display: inline-block;">Date: <?php echo date('d/m/y');?> </p>
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">

                <form role="form" method="POST" action= "<?php echo site_url('Report_expense_c/hw_expenseReport') ?>" >

                    <div class="form-group">
                        <label>Select Date Range<font color= "red">*</font></label>
                        <input type="text" class="form-control" name="datefilter" value="" />
                    </div>

                    <div class="form-group">
                        <label>Expense Type<font color= "red">*</font></label>
                        <select name="expense_type" id="expense_type" class= "form-control" required>
                            <option value= "">Select Expense</option>
                            <?php    
                                foreach($data_expense as $data)
                                { 
                                ?>
                                    <option value="<?php echo ($data->sl_no); ?>"><?php echo ($data->expenses); ?></option>
                            <?php   
                                } 
                                ?>
                        
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary" >GO<i class="fa fa-angle-double-right fa-fw "></i></button>

                </form>

            </div>
        </div>
    </div>

</div>



<!-- JS for dateRange picker calender -->

<script type="text/javascript">

    $(function() {

    $('input[name="datefilter"]').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });

    $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + '  ' + picker.endDate.format('YYYY-MM-DD'));
    });

    $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    });

    //var startDate =  picker.startDate.format('DD/MM/YYYY');
    //var endDate =  picker.endDate.format('DD/MM/YYYY');

    //console.log(startDate); 

</script>