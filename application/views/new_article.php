
<div class="container vertical-margin" >
	<div class="row"> 
		<div class="col-xs-12 col-lg-12" style="margin-left: 25px;margin-right:25px;">
			<form class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8" action="<?php echo site_url("usercontroller/post_new_article");?>" >
				<div class="row">
					<center>
						<div class="vertical-margin" style="height: 75;">
							<label for="fileUpload" class="btn btn-primary vertical-margin" style="height:50%;">
								<span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span> Upload image
								<input name="fileUpload" id="fileUpload" type="file"/>
							</label>
							<div id="fileName" style="height: 50%;"></div>
						</div>
					</center>
				</div>
				<div class="row">
				<input id="blogTitle" name="blogTitle" placeholder="Title..." class="form-control vertical-marginmargin" type="text"/>
				<textarea placeholder="Type a blog..." class="form-control vertical-margin" rows="10" id="blogBody" name="blogBody"></textarea>
				</div>

				<div class="row vertical-margin">
					<center>
						<button type="submit" class="btn btn-success">Post</button>
					</center>
				</div>
			</form>
		</div>

	</div>
</div>

<style type="text/css">
	input[type="file"] {
		display: none;
	}
</style>

<script type="text/javascript">
	$(document).ready(function(){
		$('#fileUpload').change(function(){
			var filename = this.value.replace(/^.*[\\\/]/, '');
			// alert(filename);
			$('#fileName').html(filename);
		});
	});
</script>