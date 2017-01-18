<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3 col-md-2 sidebar" >
			<img src="<?php echo base_url("assets/uploads/" . $img);?>" class="img-responsive img-circle"> 
			<?php if($your_profile) { ?>
			<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12" > 
				<a href="<?php echo site_url("usercontroller/edit_profile");?>">
					<button type="button" style="width: 100%;" class="btn btn-primary vertical-margin" >
						<span class="glyphicon glyphicon-edit"></span> Edit
					</button>
				</a>
			</div>
			<?php } ?>
			<h4 class="col-lg-12 col-xs-12" style="text-align: center;" class="vertical-margin"> 
				<?php echo $username; ?>
			</h4>
			<h4 class="col-lg-12 col-xs-12" style="text-align: center;" class="vertical-margin"> 
				<?php echo $email; ?>
			</h4>

			<?php if($your_profile) { ?>
			<div class="logout-btn col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12" > 
				<a href="<?php echo site_url("usercontroller/log_out");?>">
					<button type="button" style="width: 100%;" class="btn btn-danger vertical-margin" >
						<span class="glyphicon glyphicon-log-out"></span> Log out
					</button>
				</a>
			</div>
			<?php } ?>
		</div>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<div class="col-lg-12 col-xs-12 margin-8">
				<h1 class="col-lg-10 col-md-10 col-sm-9 col-xs-12" style="margin-top: 5px; margin-bottom: 5px;">
					<?php 
					if($your_profile) 
						echo "Your blogs";
					else
						echo $username . " blogs";
					?>
				</h1>
				<div class="col-lg-2 col-lg-offset-0 col-md-2 col-md-offset-0 col-sm-3 col-sm-offset-0 col-xs-6 col-xs-offset-3">
					<a href="<?php echo site_url("usercontroller/new_article");?>">
						<button type="button" style="width: 100%;" class="btn btn-success vertical-margin" >
							<span class="glyphicon glyphicon-pencil"></span> New
						</button>
					</a>
				</div>
			</div>

			<hr class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border-top-color: #09d" />

			<?php foreach($articles as $row) { ?>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<a href="<?php echo site_url("articlecontroller/article/" . $row->id);?>">
					<div class="col-lg-12 col-xs-12 blog-item vertical-margin">
						<img class="blog-img" src="<?php echo base_url("assets/uploads/" . $row->img);?>">
						<h3 class="blog-title"> <?php echo $row->title ;?></h3>
						<div class="blog-body"> <?php echo $row->body ;?></div>​
					</div>
				</a>
			</div>
			<?php } ?>

		</div>
	</div>
</div>