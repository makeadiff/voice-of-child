
<!-- MultiStep Form -->
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <form id="msform" action="preview.php" method="POST" onsubmit="submit_form()">
          <fieldset>
              <br>

              <?php
                if(isset($added_donor)){
              ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong><?php echo $added_donor['name'] ?></strong> was successfully added to your network.
                </div>
              <?php
                }
              ?>

              <h2 class="fs-title">Hi, <?php echo $user['name'];?></h2>
	            <!-- <h3 class="fs-subtitle">Please verify your personal details.</h3> -->
              <hr>
              <p class="form-label">

              </p>
              <p class="form-label">

              </p>
              <!-- <p class="form-label">What do you want to do?</p> -->

              <div class="row">
                <div class="add_donor col-md-4 col-md-offset-4">
                  <a href="./add_donor.php">
                    <button type="button" class="add-button btn btn-default btn-lg">
                      <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Add Network
                    </button>
                  </a>
                </div>
              </div>
              <?php
                if(!empty($network_data)){
              ?>
              <div class="row">
                <ul class="nav nav-tabs">
                  <li role="presentation" class="active"><a href="#my_network" data-toggle="tab">My Network</a></li>
                  <li role="presentation"><a data-toggle="tab" href="#pledged">Pending Collection</a></li>
                  <!-- <li role="presentation"><a data-toggle="tab" href="#tab3default">Pending Collection</a></li>
                  <li role="presentation"><a data-toggle="tab" href="#tab3default">Pending Collection</a></li> -->
                </ul>

                <div class="tab-content">
                    <!-- My Network -->
                    <div class="tab-pane fade in active" id="my_network">
                      <?php
                        foreach ($network_data as $key => $value) {
                      ?>
                        <div class="row donor_info <?php echo $value['donor_status']?>">
                          <div class="name-list col-md-6 col-xs-6">
                            <p class="name"><?php echo $value['name'] ?></p>
                            <!-- <p class="phone"><a href="tel:<?php //echo $value['phone'] ?>"><?php //echo $value['phone'] ?></a></p> -->
                          </div>

                          <div class="name-list col-md-2 col-xs-2">
                            <p class=""><a href="tel:<?php echo $value['phone']?>">
                              <img src="<?php echo $config['site_home'] ?>img/call.png" width="30px"/>
                            </a></p>
                          </div>

                          <div class="name-list col-md-2 col-xs-2">
                            <p class="action"><a href="<?php echo $config['site_home']?>pledge.php?network_id=<?php echo $value['id'] ?>">
                              <?php
                                if($value['pledged_amount']!=''){
                                  echo '&#8377;'.$value['pledged_amount'];
                                }
                                else{
                              ?>
                              Pledge
                              <?php
                                }
                              ?>
                            </a></p>
                          </div>

                          <div class="name-list col-md-2 col-xs-2">
                            <!-- <p class="name"><?php echo $value['name'] ?></p> -->
                          </div>

                        </div>
                      <?php
                        }
                      ?>
                    </div>
                    <!-- Pending Collection -->
                    <div class="tab-pane fade" id="pledged">
                      <?php
                        foreach ($network_data as $key => $value) {
                          if($value['donor_status']=='pledged'){
                      ?>
                        <div class="row donor_info">
                          <div class="name-list col-md-6 col-xs-6">
                            <p class="name"><?php echo $value['name'] ?></p>
                          </div>

                          <div class="name-list col-md-2 col-xs-2">
                            <p class=""><a href="tel:<?php echo $value['phone']?>">
                              <img src="<?php echo $config['site_home'] ?>img/call.png" width="30px"/>
                            </a></p>
                          </div>

                          <div class="name-list col-md-2 col-xs-2">
                            <p class="action"><a href="<?php echo $config['site_home']?>pledge.php?network_id=<?php echo $value['id'] ?>">
                              <?php
                                if($value['pledged_amount']!=''){
                                  echo '&#8377;'.$value['pledged_amount'];
                                }
                                else{
                              ?>
                              Pledge
                              <?php
                                }
                              ?>
                            </a></p>
                          </div>

                          <div class="name-list col-md-2 col-xs-2">
                            <!-- <p class="name"><?php echo $value['name'] ?></p> -->
                          </div>

                        </div>
                      <?php
                          }
                        }
                      ?>
                    </div>
                    <div class="tab-pane fade" id="tab3default">Default 3</div>
                </div>
              </div>
              <?php
                }
              ?>


          </fieldset>
        </form>
    </div>
</div>
