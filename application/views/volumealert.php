<section id="main" role="main">
	<!-- START Template Container -->
	<div class="container-fluid">
		<!-- Page Header -->
		<div class="page-header page-header-block">
			<div class="page-header-section">
				<h4 class="title semibold">
					Volume Alert (%)
				</h4>
			</div>
			<div class="page-header-section">
				<!-- Toolbar -->
				<div class="toolbar">
					<ol class="breadcrumb breadcrumb-transparent nm">
						<li><a href="<?php echo base_url(); ?>web">Dashboard</a></li>
						<li class="active">Volume Alert (%)</li>
					</ol>
				</div>
				<!--/ Toolbar -->
			</div>
		</div>
		<!-- START row -->
		<div class="row" id="listDetails" <?php echo $displaynone; ?> >
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Volume Alert (%)</h3>
					</div>
					<table class="table table-striped table-bordered" id="datatable">
						<thead>
							<tr>
								<th>Merchant Legal Name</th>
								<th>DBA</th>
								<th style="text-align: right;">Volume Alert (%)</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if(count($RefundDtls) > 0)
							{
								foreach($RefundDtls as $row)
								{
								?>
								<tr class="nameclick">
									<td><a href="javascript:"><?php echo $row->merchant_legal_name; ?></a></td>
									<td><a href="javascript:"><?php echo $row->dba; ?></a></td>
									<td style="text-align: right;"><?php echo $row->volume_alert; ?></td>
								</tr>
								<?php
								}
							}
							?>
						</tbody>
					</table>
					<form method="post" id="graphform" action="<?php echo base_url(); ?>dashboardlive">
						<input type="hidden" name="merchantname" id="merchantname">
						<input type="hidden" name="dba" id="dba">
					</form>
				</div>
			</div>
		</div>
		<!--/ END row -->
	</div>
</section>

<script>
	
	$(document).ready(function()
	{
		$('#datatable').dataTable();
	});
	
	$(".nameclick td a").click(function(){
		var merchantname = $(this).parents(".nameclick").find("td:first-child a").html();
		var dba = $(this).parents(".nameclick").find("td:nth-child(2) a").html();
		$("#merchantname").val(merchantname);
		$("#dba").val(dba);
		$("#graphform").submit();
	});
</script>