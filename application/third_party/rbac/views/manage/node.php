<style>
.table td:first-child{width:25%}
.table td:nth-child(2){width:40%}
</style>
<?php 
//print_r($node);
foreach($node as $key=>$mn){
	echo '<table class="table well">';
	echo '<tr>
		  	<td><span class="glyphicon glyphicon-folder-open"></span> <b>'.$key.'</b></td>
		  	<td></td>
			<td></td>
		  	<td><div class="btn-group  btn-group-xs pull-right">
				  <a class="btn btn-success" href="'.site_url("manage/node/add/".$key).'">Add cotroller</a>
		  		  <a class="btn btn-danger" href="'.site_url("manage/node/delete/".$key).'">Delete directory</a>
				</div>
			</td>
		  </tr>';
	foreach($mn as $mn_key=>$cmn){
		echo '<tr>
			  	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-list-alt"></span> <b>'.$mn_key.'</b></td>
			  	<td></td>
			  	<td></td>
			  	<td><div class="btn-group  btn-group-xs pull-right">
					  <a class="btn btn-success" href="'.site_url("manage/node/add/".$key."/".$mn_key).'">Add methods</a>
			  		  <a class="btn btn-danger" href="'.site_url("manage/node/delete/".$key."/".$mn_key).'">Delete controller</a>
					</div>
				</td>
			  </tr>';
		foreach($cmn as $cmn_key=>$gcmn){
			echo '<tr>
				  	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-minus"></span> <b>'.$cmn_key.'</b></td>
				  	<td>'.$gcmn->memo.'</td>
				  	<td>'.($gcmn->status==1?"Enable":"Disable").'</td>
				  	<td><div class="btn-group  btn-group-xs pull-right">
				  		  <a class="btn btn-success" href="'.site_url("manage/node/edit/".$gcmn->node_id).'">Edit</a>
						  <a class="btn btn-danger" href="'.site_url("manage/node/delete/".$key."/".$mn_key."/".$cmn_key).'">Delete</a>
					</div>
			  	</td>
			  	</tr>';
		}
	}
	echo '</table>';
}
?>
<hr/>
<?php echo '<a class="btn btn-success pull-right" href="'.site_url("manage/node/add").'">Add new directory</a>'; ?>
