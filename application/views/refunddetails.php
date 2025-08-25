<section id="main" role="main">
	<!-- START Template Container -->
	<div class="container-fluid">
		<!-- Page Header -->
		<div class="page-header page-header-block">
			<div class="page-header-section">
				<h4 class="title semibold">
					Refund Details
				</h4>
			</div>
			<div class="page-header-section">
				<!-- Toolbar -->
				<div class="toolbar">
					<ol class="breadcrumb breadcrumb-transparent nm">
						<li><a href="<?php echo base_url(); ?>web">Dashboard</a></li>
						<li class="active">Refund Details</li>
					</ol>
				</div>
				<!--/ Toolbar -->
			</div>
		</div>
		<!-- START row -->
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<form class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-4 control-label">Select date range</label>
						<div class="col-sm-8">
							<div class="row">
								<div class="col-md-6"><input type="text" class="form-control" id="datepicker-from" placeholder="From" /></div>
								<div class="col-md-6"><input type="text" class="form-control" id="datepicker-to" placeholder="to" /></div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- <div class="row" id="listDetails">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Refund Details</h3>
					</div>
					<table class="table table-striped" id="datatable">
						<thead>
							<tr>
								<th>Merchant Legal Name</th>
								<th>Date</th>
								<th>Refunds</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if(count($RefundDtls) > 0)
							{
								foreach($RefundDtls as $row)
								{
								?>
								<tr>
									<td><?php echo $row->merchant_legal_name; ?></td>
									<td><?php echo $row->merchantdate; ?></td>
									<td><?php echo "$".$row->refund;?></td>
								</tr>
								<?php
								}
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div> -->
		<div class="row" id="minDetails">
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Refund Details</h3>
					</div>
					<table class="table table-striped" id="nametable">
						<thead>
							<tr>
								<th>Merchant Legal Name</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-md-4" id="refunddiv">
				<div class="panel panel-default">
					<table class="table table-striped" id="minfundtable">
						<thead>
							<tr>
								<th>Merchant Date</th>
								<th>Refund Amount</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!--/ END row -->
	</div>
</section>

<script>
	
	$(document).ready(function()
	{
		$('#minDetails').hide();
		$('#refunddiv').hide();
		$('#listDetails').hide();
		$('#datatable').dataTable();
		$('#datepicker-to').datepicker({
            numberOfMonths: 1,
            dateFormat: 'dd-mm-yy',
            onClose: function (selectedDate) {
                $('#datepicker-from').datepicker('option', 'maxDate', selectedDate);
                if($("#datepicker-to").val() != "" && $("#datepicker-from").val() != "")
                {
                	getdatabydatewise($("#datepicker-from").val(),$("#datepicker-to").val())
                }
            }
        });
        $('#datepicker-from').datepicker({
            numberOfMonths: 1,
            dateFormat: 'dd-mm-yy',
            onClose: function (selectedDate) {
                $('#datepicker-to').datepicker('option', 'minDate', selectedDate);
                if($("#datepicker-to").val() != "" && $("#datepicker-from").val() != "")
                {
                	getdatabydatewise($("#datepicker-from").val(),$("#datepicker-to").val())
                }
            }
        });
	});
	
	function getdatabydatewise(datefrom,dateto)
    {
        var req = new Request();
        req.data =
        {
            "datefrom" : datefrom,
            "dateto" : dateto
        };
        req.url = "getrefunddatewise";
        RequestHandler(req, showResponse);
    }

    function showResponse(data)
    {
    	data = JSON.parse(data);
        var str = '';
        for(var i=0;i<data.length;i++)
        {
        	str += '<tr>';
			str += '<td class="merchant_name"><a href="javascript:" dba="'+data[i].dba+'" merchantname="'+data[i].merchant_legal_name+'">'+data[i].merchant_legal_name+' - '+data[i].dba+'</a></td>';
			str += '</tr>';	
        }
        $('#listDetails').hide();
        $('#refunddiv').hide();
        $('#minDetails').show();
        $("#nametable tbody").html(str);
        $('#nametable').dataTable();
    }

    $(document).on("click",".merchant_name a",function(){
    	var datefrom = $("#datepicker-from").val();
    	var dateto = $("#datepicker-to").val();
    	var req = new Request();
        req.data =
        {
            "merchantname" : $(this).attr('merchantname'),
            "dba" : $(this).attr('dba'),
            "datefrom" : datefrom,
            "dateto" : dateto
        };
        req.url = "getrefunddatewise";
        RequestHandler(req, showResponse1);
    });


    function showResponse1(data)
    {
    	$('#refunddiv').show();
    	data = JSON.parse(data);
        var str = '';
        for(var i=0;i<data.length;i++)
        {
        	str += '<tr>';
			str += '<td>'+data[i].mymerchantdate+'</td>';
			str += '<td>$ '+data[i].thismon_refund+'</td>';
			str += '</tr>';	
        }
        $("#minfundtable tbody").html(str);
    }

	
</script>