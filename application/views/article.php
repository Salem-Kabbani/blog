<div class="container vertical-margin">
	<div class="col-lg-12 col-xs-12">

		<div class="article-img">
			<img  src="<?php echo base_url("assets/uploads/" . $article['img']);?>">
		</div>
		<h2 class="page-header" style="text-align: center;"> <?php echo $article['title'] ;?></h2>
		<div style="font-size: 18px; line-height: 28px;"> <?php echo $article['body'] ;?></div>​
		<div class="vertical-margin col-lg-2 col-lg-offset-10 col-md-2 col-md-offset-10 col-sm-3 col-sm-offset-9 col-xs-4 col-xs-offset-8">
			<center>
				<button id= "likeBtn" type="button" style="padding-right: 15px; padding-left: 15px;" class="btn btn-danger btn-lg">
					<?php if($is_liked) {?>
					<span class="glyphicon glyphicon-heart" aria-hidden="true"></span> Unlike
					<?php } else { ?>
					<span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span> Like
					<?php }?>
				</button>
				<div id="likesCount" class="vertical-margin">
					<?php echo $likes_count ?> Liked this
				</div>
			</center>

		</div>

		<hr class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border-top-color: #09d" />
		<!-- <hr style="margin-top: 80px; border-top-color: #09d" -->		

		<div class="row">
			<div class="col-lg-2 col-lg-offset-0 col-md-2 col-md-offset-0 col-sm-4 col-sm-offset-0 col-xs-4 col-xs-offset-4">
				<div class="article-user-img-wrap">
					<img src="<?php echo base_url("assets/uploads/".$user['img']);?>" class="img-responsive img-circle article-user-img"> 
				</div>
			</div>
			<div class="col-lg-10 col-md-10 col-sm-8 col-xs-12">
				<h4><?php echo $user['username']; ?></h4> 
				<h4><?php echo $user['email'] ;?></h4>
				<h4><?php echo $article['create_date'] ;?></h4>
			</div>
		</div>

		<hr style="border-top-color: #09d" />

		<div class="row">
			<div class="form-group" style="margin-left: 25px;margin-right:25px;">
				<textarea style="resize: none;" placeholder="Type a comment..." class="form-control" rows="3" id="commentArea"></textarea>
				<div class="vertical-margin col-lg-2 col-lg-offset-10 col-md-2 col-md-offset-10 col-sm-3 col-sm-offset-9 col-xs-4 col-xs-offset-8">
					<center>
						<button id="commentBtn" type="button" style="padding-right: 15px; padding-left: 15px;" class="btn btn-primary btn-md">Comment</button>
					</center>
				</div>

			</div>
		</div>

		<hr style="border-top-color: #09d" />

		<div id="comments">
			<?php foreach ($comments as $row) { ?>
			<div class="row comment-container">
				<div class="col-lg-12 col-xs-12" >
					<div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">
						<div class="article-user-img-wrap">
							<a href="<?php echo site_url("usercontroller/profile/" . $row->user_id);?>">
								<img src="<?php echo base_url("assets/uploads/".$row->img);?>" class="img-responsive img-circle article-user-img"> 
							</a>
						</div>
					</div>
					<div class="col-lg-11 col-md-11 col-sm-10 col-xs-10">
						<a href="<?php echo site_url("usercontroller/profile/" . $row->user_id);?>">
							<h4><?php echo $row->username; ?></h4> 
						</a>
						<h5><?php echo date ("d/m/Y h:i:sa",strtotime($row->create_date));?></h5>
						<h5><?php echo $row->text ;?></h5>
					</div>

				</div>
			</div>
			<?php } ?>
		</div>

	</div>
</div>


<script type="text/javascript">
	$('#likeBtn').click(function(){
		$.ajax({
			method: 'POST',
			dataType	:'json',	
			url: "<?php echo site_url("articlecontroller/like/");?>",
			data: {
				'u_id': <?php echo $this->session->userdata("id"); ?>, 
				'a_id': <?php echo $article["id"]; ?>
			},
			success: function(data) {
				var like =data.like;
				if(like == true) { 
					$('#likeBtn').html('<span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span> Like');
					<?php $is_liked = 0; $likes_count--; ?>			
				} else {
					$('#likeBtn').html('<span class="glyphicon glyphicon-heart" aria-hidden="true"></span> Unlike');
					<?php $is_liked = 1;  $likes_count++;?>		
				}
				$('#likesCount').html(data.count + " Liked this");	
			}
		})
	});

	$('#commentBtn').click(function(){
		// var u = $('#commentArea').val();
		// u = u.split('.').join('%2E');
		// u = u.split('-').join('%2D');
		$.ajax({
			method: 'POST',
			url: "<?php echo site_url("articlecontroller/comment/");?>",
			data: {
				'u_id': <?php echo $this->session->userdata("id"); ?>, 
				'a_id': <?php echo $article["id"]; ?>,
				'com': $('#commentArea').val()
			},
			success: function(data) {
				var a1 = '<div class="row comment-container"><div class="col-lg-12 col-xs-12" ><div class="col-lg-1 col-md-1 col-sm-2 col-xs-2"><div class="article-user-img-wrap">';
				var a2 = '<a href="<?php echo site_url("usercontroller/profile/");?>' + data.user.id + '">';
				var a3 = '<img src="<?php echo base_url("assets/uploads/");?>' + data.user.img + '" class="img-responsive img-circle article-user-img">';
				var a4 = '</a></div></div><div class="col-lg-11 col-md-11 col-sm-10 col-xs-10">';
				var a5 = '<a href="<?php echo site_url("usercontroller/profile/");?>' + data.user.id +'">';
				var a6 = '<h4>' + data.user.username + '</h4></a><h5>' + data.comment.create_date + '</h5><h5>' + data.comment.text + '</h5></div></div></div>';
				var f = a1+a2+a3+a4+a5+a6;
				$('#comments').append(f);
				$('#commentArea').val("");
			}
		})
	});



</script>

