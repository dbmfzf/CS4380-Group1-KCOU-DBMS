<p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
          <div class="jumbotron">
            <h1>KCOU</h1>
            <p>This is a kcou management system.</p>
          </div>
          <div class="row">
            <div class="col-6 col-sm-6 col-lg-4">
              <div style="background-color:#93DB70;border-radius:5px"><h2 align="center">Profile</h2></div>
              <div style="border:2px solid #93DB70;border-radius:5px;padding:8px">
              <p><b>User ID:</b> <?php echo rbac_conf(array('INFO','uid'));?> </p>
              <p><b>Fullname:</b> <?php echo $data['fullname'];?> </p>
              <p><b>Gender:</b> <?php echo $data['gender'];?> </p>
              <p><b>Role(Department):</br></b> <?php echo $data['role_dept'];?> </p>
              <p><b>Last login time:</br></b> <?php echo $data['last_login_time'];?> </p>
              <p><b>Last login ip:</br></b> <?php echo $data['last_login_ip'];?> </p>
              <p><a class="btn btn-default" href="<?php echo site_url('info/profile/index'); ?>" role="button">View/Edit &raquo;</a></p>
              </div>
            </div><!--/span-->
            <div class="col-6 col-sm-6 col-lg-4">
              <div style="background-color:#EAADEA;border-radius:5px"><h2 align="center">Music</h2></div>
              <div style="border:2px solid #EAADEA;border-radius:5px;padding:8px">
              <form role="form" action="<?php echo site_url('music/search_music/'); ?>" method="get">
                 <p><input name = "searchString" type = "text" class="form-control" placeholder="Please input song title here"></p>
                 <p align = "right"><button type="submit" class="btn btn-info">GO!</button></p>
              </form>
              <p>
                <b>Most recently searched song:</b>
                </br>
                <?php echo $data['most_rencently_title'];?>
              </p>
              <p>
                <b>Most searched song:</b>
                </br>
                <?php echo $data['most_title'];?>
              </p>
              <p><a class="btn btn-default" href=<?php echo site_url('music/search_music'); ?> role="button">More &raquo;</a></p>
              </div>
            </div><!--/span-->
            <div class="col-6 col-sm-6 col-lg-4">
              <div style="background-color:#EBC79E;border-radius:5px"><h2 align="center">Developers</h2></div>
              <div align = "center" style="border:2px solid #EBC79E;border-radius:5px;padding:8px">
              <img style="width:90%" src = "<?php echo base_url();?>static/img/developers.jpg" />
              <p></p>
              <p>If you have any questions, please contact dbmsgroup1@gmail.com</p>
              </div>
            </div><!--/span-->
          </div><!--/row-->
