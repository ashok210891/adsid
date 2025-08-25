<?php
$curpage = $this->uri->uri_string;
$editpage = explode('/',$curpage);
if(count($editpage) == 1)
{
	$curpage = $editpage[0];
}
elseif(count($editpage) == 2 || count($editpage) == 3)
{
	$curpage = $editpage[0].'/'.$editpage[1];
}
?>
<!-- START Template Sidebar (Left) -->
<aside class="sidebar sidebar-left sidebar-menu">
	<!-- START Sidebar Content -->
	<section class="content slimscroll">
		<!--<h5 class="heading">Main Menu</h5>-->
		<!-- START Template Navigation/Menu -->
		<ul class="topmenu topmenu-responsive" data-toggle="menu">
			<?php
			if($curpage == "")
			{
				echo '<li class="active">';
				}
				else
				{
					echo '<li>';
					}
					?>
					<a href="<?php echo base_url(); ?>">
						<span class="figure"><i class="ico-home2"></i></span>
						<span class="text">Dashboard</span>
					</a>
					<?php
				echo '</li>';
				?>
				<?php
				if($curpage == "uploadfile")
				{
					echo '<li class="active">';
					}
					else
					{
						echo '<li>';
						}
						?>
						<a href="<?php echo base_url(); ?>uploadfile">
							<span class="figure"><i class="ico-file-excel"></i></span>
							<span class="text">Upload File
							</a>
							<?php
						echo '</li>';
						?>
					</ul>
					<!--/ END Template Navigation/Menu -->
				</section>
				<!--/ END Sidebar Container -->
			</aside>
			<!--/ END Template Sidebar (Left) -->