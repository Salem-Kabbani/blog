<div class="container">
	<?php foreach($articles as $row) { ?>
		<a href="<?php echo site_url("articlecontroller/article/" . $row->id);?>">
	<div class="col-lg-4 col-lg-offset-0 col-md-4 col-md-offset-0 col-sm-6 col-sm-offset-0 col-xs-10 col-xs-offset-1">
			<div class="col-lg-12 col-xs-12 blog-item vertical-margin">
				<img class="blog-img" src="<?php echo base_url("assets/uploads/" . $row->img);?>">
				<h3 class="blog-title"> <?php echo $row->title ;?></h3>
				<div class="blog-body"> <?php echo $row->body ;?></div>​
			</div>
	</div>
		</a>
	<?php } ?>
</div>
