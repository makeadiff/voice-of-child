
<!-- MultiStep Form -->
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <form id="msform" action="preview.php" method="POST" onsubmit="submit_form()">
          <fieldset>
              <br>

              <h2 class="fs-title">Hi, <?php echo $user['name'];?></h2>
	            <!-- <h3 class="fs-subtitle">Please verify your personal details.</h3> -->
              <hr>
              <p class="form-label">

              </p>
              <p class="form-label">

              </p>
              <p class="form-label">What do you want to do?</p>

              <div class="row">
                <div class="add_donor col-md-4 col-md-offset-4">
                  <a href="./add_donor.php">
                    <div class="click-box">
                      <p class="center">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Donors
                      </p>
                    </div>
                  </a>
                </div>
              </div>

              <div class="row">
                <ul class="nav nav-tabs">
                  <li role="presentation" class="active"><a href="#tab1default" data-toggle="tab">Home</a></li>
                  <li role="presentation"><a data-toggle="tab" href="#tab2default">Profile</a></li>
                  <li role="presentation"><a data-toggle="tab" href="#tab3default">Messages</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab1default">
                      <?php
                        foreach ($network_data as $key => $value) {
                      ?>
                        <div class="row donor_info">
                          <div class="name-list col-md-6 col-xs-6">
                            <p class="name"><?php echo $value['name'] ?></p>
                            <p class="phone"><a href="tel:<?php echo $value['phone'] ?>"><?php echo $value['phone'] ?></a></p>
                          </div>

                          <div class="name-list col-md-2 col-xs-2">
                            <p class=""><a href="tel:<?php echo $value['phone']?>">Call</a></p>
                          </div>

                          <div class="name-list col-md-2 col-xs-2">
                            <p class=""><a href="<?php echo $config['site_home']?>pledge.php?network_id=<?php echo $value['id'] ?>">Pledge</a></p>
                          </div>

                          <div class="name-list col-md-2 col-xs-2">
                            <!-- <p class="name"><?php echo $value['name'] ?></p> -->
                          </div>

                        </div>
                      <?php
                        }
                      ?>
                    </div>
                    <div class="tab-pane fade" id="tab2default">Default 2</div>
                    <div class="tab-pane fade" id="tab3default">Default 3</div>
                </div>
              </div>


          </fieldset>
        </form>
    </div>
</div>
