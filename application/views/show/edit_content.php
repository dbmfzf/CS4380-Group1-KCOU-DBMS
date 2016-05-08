<h1>Show's description</h1>
<form action="" method="post">
	<textarea style="padding-bottom:10px" name="content" ><?php echo $shows_data['content'];?></textarea>

    <br/>
    <button type="submit" class="btn btn-success">Submit</button> 
    <a class="btn btn-danger" href="<?php echo site_url('show/showController/index'); ?>">Cancel</a> 
</form>

</body>
</html>
