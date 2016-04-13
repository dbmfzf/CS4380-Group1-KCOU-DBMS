<h1>Edit submenu</h1>
<form role="form" action="" method="post">
  <div class="form-group">
    <label>Title</label>
    <input name="title" type="text" class="form-control" placeholder="Please input title here" value="<?php echo $data['title']; ?>">
  </div>
  <div class="form-group">
    <label>Link a node</label>
    <select name="node"  class="form-control" >
    	<option value=''>No links</option>
    	<?php 
    		foreach($node as $vo){
				$select = $data["node_id"]==$vo->node_id?"selected":"";
    			echo "<option value='{$vo->node_id}' {$select} >{$vo->memo} [{$vo->directory}/{$vo->controller}/{$vo->func}]</option>";
    		}
    	?>
    	
    </select>
  </div>
  <div class="form-group">
    <label>Sort</label>
    <input name="sort" type="number" class="form-control" placeholder="Please input order number here" value="<?php echo $data['sort'];?>">
  </div>
  <div class="checkbox">
    <label>
      <input value="1" name="status" type="checkbox" <?php if($data["status"]){echo "checked";}?>> Shown?
    </label>
  </div>
  <div class="checkbox pull-right">
  	<label>
      	Tips:
    </label>
    <ul>
    	<li>We strongly suggest you do not link a node to a first-class navigation.</li>
    	<li>The second-class navigation cannot be seen if it have no submenus (third-class).</li>
  	<li>Please link a node to a third-class memu.</li>
  	</ul>
  </div>
  <input type="hidden" name="level" value="<?php echo $level;?>">
  <input type="hidden" name="id" value="<?php echo $data['id'];?>">
  <input type="hidden" name="pid" value="<?php echo $pid;?>">
  <button type="submit" class="btn btn-success">Save</button>
  <a class="btn btn-danger" href="<?php echo site_url('manage/menu/index'); ?>">Cancel</a>
</form>
