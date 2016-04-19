</body>
</html>
<html>
    <head>
        <title>PHP点点通（http://www.phpddt.com）演示教程</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="./ueditor.config.js"></script>  
        <script type="text/javascript" src="./ueditor.all.min.js"></script>
    </head>
    <body>
    <style>
.tableleft{font-weight:bold;background-color:#F5F5F5;}
</style>
<h1>News Submission</h1>
<form action="" method="post"> 
    <table class="table table-bordered table-hover definewidth m10">
        <tr>
            <td width = "15%" class="tableleft">News ID</td>
            <td><input type="text" name="dname" value="<?php echo $data['dname'];?>"></td>
        </tr>
        <tr>
            <td width = "15%" class="tableleft">Title</td>
            <td><input type="text" name="dname" value="<?php echo $data['dname'];?>"></td>
        </tr>
        <tr>
            <td width = "15%" class="tableleft">Type</td>
            <td><input type="text" name="dname" value="<?php echo $data['dname'];?>"></td>
        </tr>
        <tr>
        	<script type="text/javascript">
            	UE.getEditor('myEditor')
        	</script>
        	<textarea name="content" id="myEditor"><?php echo $data['description'];?>这里写你的初始化内容</textarea></td>
        </tr>
    </table>
    <button type="submit" class="btn btn-success">Submit</button> 
     <a class="btn btn-danger" href="<?php echo site_url('info/news/index'); ?>">Cancel</a> 
</form>
</body>
</html>