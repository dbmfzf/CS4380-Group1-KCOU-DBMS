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
              <p><b>User ID:</b> <?php echo rbac_conf(array('INFO','uid'));?> </p>
              <p><b>Fullname:</b> <?php echo $data['fullname'];?> </p>
              <p><b>Gender:</b> <?php echo $data['gender'];?> </p>
              <p><b>Role:</b> <?php echo $data['role'];?> </p>
              <p><b>Department:</b> <?php echo $data['dept'];?> </p>
              <p><b>Last login time:</b> <?php echo $data['last_login_time'];?> </p>
              <p><b>Last login ip:</b> <?php echo $data['last_login_ip'];?> </p>
              <p><a class="btn btn-default" href="product/index/edit" role="button">View/Edit &raquo;</a></p>
            </div><!--/span-->
            <div class="col-6 col-sm-6 col-lg-4">
              <h2>Music</h2>
              <form role="form" action="" method="post">
                 <p><input name = "search_song" type = "text" class="form-control" placeholder="Please input song title here"></p>
                 <p align = "right"><button type="submit" class="btn btn-success">GO!</button></p>
              </form>
              <p>
                Most recently searched song:
                <?php echo $data['most_rencently_title'];?>
              </p>
              <p>
                Most searched song:
                <?php echo $data['most_title'];?>
              </p>
              <p><a class="btn btn-default" href="#" role="button">More &raquo;</a></p>
            </div><!--/span-->
            <div class="col-6 col-sm-6 col-lg-4">
              <h2>Message</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn btn-default" href="#" role="button">View all &raquo;</a></p>
            </div><!--/span-->
          </div><!--/row-->
