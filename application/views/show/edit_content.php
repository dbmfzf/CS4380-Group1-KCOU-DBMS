
<script type="text/javascript" src="<?php echo base_url();?>static/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/ueditor/ueditor.all.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/ueditor/lang/en/en.js"></script>
<script type="text/javascript">
var editor = new UE.ui.Editor({initialFrameHeight:600});
editor.render("myEditor");
</script>    

<h1>News Content</h1>
<form action="" method="post">
	<textarea style="padding-bottom:10px"  name="content" id="myEditor" ><?php echo $shows_data['content'];?></textarea>

    <button type="submit" class="btn btn-success">Submit</button> 
    <a class="btn btn-danger" href="<?php echo site_url('show/showController/index'); ?>">Cancel</a> 
</form>

</body>
</html>
