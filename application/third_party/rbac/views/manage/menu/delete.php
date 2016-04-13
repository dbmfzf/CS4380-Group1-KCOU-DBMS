<style>
.table td:first-child{width:30%}
.table td:nth-child(2){width:40%}
</style>
<h1>Are you sure to delete this menu and its submenus (may or may not have)?</h1>

<?php 
foreach($menu as $mn){
	$nochild = "<span class='glyphicon glyphicon-align-left'></span> " ;
	$havechild = "<span class='glyphicon glyphicon-link'></span> " ;
	echo '<table class="table well">';
	echo '<tr>
		  	<td>'.($mn["self"]->node_id?$havechild:$nochild).$mn["self"]->title.'</td>
		  	<td>'.($mn["self"]->memo?$mn["self"]->memo:"No links").'</td>
		  	<td>'.$mn["self"]->sort.'</td>
		  	<td>'.($mn["self"]->status==1?"Shown":"Hidden").'</td>
		  </tr>';
	if(isset($mn["child"])){
		foreach($mn["child"] as $cmn){
			echo '<tr>
			  	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.($cmn["self"]->node_id?$havechild:$nochild).$cmn["self"]->title.'</td>
			  	<td>'.($cmn["self"]->memo?$cmn["self"]->memo:"No links").'</td>
			  	<td>'.$cmn["self"]->sort.'</td>
			  	<td>'.($cmn["self"]->status==1?"Shown":"Hidden").'</td>
			  </tr>';
			
			if(isset($cmn["child"])){
				foreach($cmn["child"] as $gcmn){
					echo '<tr>
						  	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  					'.($gcmn["self"]->node_id?$havechild:"").$gcmn["self"]->title.'</td>
						  	<td>'.($gcmn["self"]->memo?$gcmn["self"]->memo.$gcmn["self"]->dcf:"No links").'</td>
			  				<td>'.$gcmn["self"]->sort.'</td>
						  	<td>'.($gcmn["self"]->status==1?"Shown":"Hidden").'</td>
						  </tr>';
				}
			}
		}
	}
	echo '</table>';
}
?>
<form method="POST" action="">
	<input type="hidden" name="verfiy" value="1" >
	<input class="btn btn-success"  type="submit" value="OK">
	<a class="btn btn-danger" href="<?php echo site_url('manage/menu/index'); ?>">Cancel</a>
</form>
