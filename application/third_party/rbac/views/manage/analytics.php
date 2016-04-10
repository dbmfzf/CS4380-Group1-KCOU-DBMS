<style>
.table td:first-child{width:10%}
.table td:nth-child(2){width:20%}
</style>
<table class="table  table-bordered well">
	<thead>
          <tr>
            <th>ID</th>
            <th>姓名</th>
            <th>Email</th>
            <th>角色</th>
            <th>状态</th>
            <th>操作</th>
          </tr>
        </thead>
   <tbody>
	<?php 
	foreach($data as $mb){
		printf('<tr>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>
						<div class="btn-group  btn-group-xs">
						  <a class="btn btn-default btn-xs" href="%s">编辑</a>
						  <a class="btn btn-danger" href="%s">删除</a>
						</div>
					</td>
				</tr>',$mb->uid,$mb->fullname,$mb->email,($mb->name?$mb->name:"暂无角色"),($mb->status==1?"正常":"停用"),site_url("manage/member/edit/".$mb->uid),site_url("manage/member/delete/".$mb->uid));
	}
	?>
  </tbody>
</table>
<hr/>

<?php echo '<a class="btn btn-success pull-right" href="'.site_url("manage/member/add").'">新增用户</a>'; ?>
<?php echo $this->pagination->create_links(); ?>
