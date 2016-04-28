
<script type="text/javascript" src="<?php echo base_url();?>static/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/ueditor/ueditor.all.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/ueditor/lang/en/en.js"></script>
<script type="text/javascript">
var editor = new baidu.editor.ui.Editor();
editor.render("myEditor");
</script>    

<h1>News Content</h1>
<form action="" method="post">
	<textarea height="600px"  name="content" id="myEditor" ><?php echo $news_data['content'];?></textarea>

    <button type="submit" class="btn btn-success">Submit</button> 
    <a class="btn btn-danger" href="<?php echo site_url('info/news/index'); ?>">Cancel</a> 
</form>

</body>
</html>
