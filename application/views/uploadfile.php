<section id="main" role="main">
	<style>
	#uploadcsv{ display: none; }
	#syncbtn{ display: none; }
	</style>
	<div class="container-fluid">
		<div class="page-header page-header-block">
			<div class="page-header-section">
				<h4 class="title semibold">
				Update File
				</h4>
			</div>
			<div class="page-header-section">
				<div class="toolbar">
					<ol class="breadcrumb breadcrumb-transparent nm">
						<li><a href="<?php echo base_url(); ?>">Dashboard</a></li>
						<li class="active">Upload File</li>
					</ol>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
					<div class="form-group" id="upload-div">
						<label class="col-sm-3 control-label">Upload your csv</label>
						<div class="col-sm-9">
							<div class="input-group">
								<input type="text" class="form-control" readonly>
								<span class="input-group-btn">
									<div class="btn btn-primary btn-file">
										<span class="icon iconmoon-file-3"></span> Browse <input id="csvfile" type="file" name="csvfile">
									</div>
								</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12 text-center">
							<input type="hidden" id="sync" name="sync" value="" >
							<input type="hidden" id="isupload" name="isupload" value="<?php echo $uploaded; ?>" >
							<button type="submit" class="btn btn-primary" id="uploadcsv">Upload CSV</button>
							<button type="submit" class="btn btn-danger" id="syncbtn">Sync</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php
				if(isset($iserror)){
					if ($iserror) {
				?>
				<div class="alert alert-danger"><?php echo $message; ?></div>
				<?php
					} else {
				?>
				<div class="alert alert-success"><?php echo $message; ?></div>
				<?php
				}
				}
				?>
			</div>
		</div>
	</div>
</section>
<script>
	$(document).ready(function(){
		if($("#isupload").val() == "yes"){
			$("#upload-div").css("display","none");
			$("#syncbtn").css("display","inline-block");
		}
	});
	$(".btn-file").click(function(){
		$("#uploadcsv").css("display","inline-block");
	});
	$("#syncbtn").click(function(){
		$("#sync").val(1);
	});
	$("#uploadcsv").click(function(){
		$("#sync").val(0);
	});
</script>