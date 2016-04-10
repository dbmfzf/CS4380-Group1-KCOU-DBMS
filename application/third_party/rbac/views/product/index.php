<p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
          <div class="jumbotron">
            <h1>KCOU</h1>
            <p>this is a kcou management system.</p>
          </div>
          <div class="row">
            <div class="col-6 col-sm-6 col-lg-4">
              <h2>Profile</h2>
              <p>User ID: <?php echo rbac_conf(array('INFO','uid'));?> </p>
              <p>Fullname: <?php echo $data['fullname'];?> </p>
              <p>Gender: <?php echo $data['gender'];?> </p>
              <p>Role: <?php echo $data['role'];?> </p>
              <p>Department: <?php echo $data['dept'];?> </p>
              <p>Last login time: <?php echo $data['last_login_time'];?> </p>
              <p>Last login ip: <?php echo $data['last_login_ip'];?> </p>
              <p><a class="btn btn-default" href="product/index/edit" role="button">View/Edit &raquo;</a></p>
            </div><!--/span-->
            <div class="col-6 col-sm-6 col-lg-4">
              <h2>Music</h2>
              <form role="form" action="" method="post">
                 <input name = "search_song" type = "text" class="form-control" placeholder="Please input song title here">
                 <button type="submit" class="btn btn-success">GO!</button>
                 <p>Most recently searched song: <a target="_blank" href="<?php echo $data['most_rencently_path'] ?>"><?php echo $data['most_rencently_title'];?></a></p>
                 <p>Most searched song: <a target="_blank" href="<?php echo $data['most_path'] ?>"><?php echo $data['most_title'];?></a>?> </p>
              </form>
              <p><a class="btn btn-default" href="#" role="button">More &raquo;</a></p>
            </div><!--/span-->
            <div class="col-6 col-sm-6 col-lg-4">
              <h2>Message</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn btn-default" href="#" role="button">View all &raquo;</a></p>
            </div><!--/span-->
          </div><!--/row-->
