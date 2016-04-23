<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>ueditor demo</title>
</head>
<body>
    
    <!-- ÅäÖÃÎÄ¼þ -->
    <script type="text/javascript" src="<?php echo base_url();?>ueditor.config.js"></script>
    <!-- ±à¼­Æ÷Ô´ÂëÎÄ¼þ -->
    <script type="text/javascript" src="<?php echo base_url();?>ueditor.all.js"></script>
    <!-- ÊµÀý»¯±à¼­Æ÷ -->
    <script type="text/javascript">UE.getEditor('container');
    </script>    
 <style>
.tableleft{font-weight:bold;background-color:#F5F5F5;}
</style>
<h1>News Content</h1>
<form action="" method="post"> 


    
        	<!-- ¼ÓÔØ±à¼­Æ÷µÄÈÝÆ÷ -->
    		<script id="container" name="content" type="text/plain">Enter news</script>
    		</script>

    <button type="submit" class="btn btn-success">Submit</button> 
     <a class="btn btn-danger" href="<?php echo site_url('info/news/index'); ?>">Cancel</a> 
</form>

</body>
</html>