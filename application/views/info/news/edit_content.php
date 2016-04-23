
<script type="text/javascript" src="<?php echo base_url();?>static/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/ueditor/ueditor.all.js"></script>
<script type="text/javascript">UE.getEditor('container');
</script>    

<h1>News Content</h1>
<form action="" method="post"> 
	<script id="container" name="content" type="text/plain">Enter news</script>

    <button type="submit" class="btn btn-success">Submit</button> 
    <a class="btn btn-danger" href="<?php echo site_url('info/news/index'); ?>">Cancel</a> 
</form>

</body>
</html>
