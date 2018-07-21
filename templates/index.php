
<!-- MultiStep Form -->
<div class="row">
    <div class="form-class col-md-6 col-md-offset-3">
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
                      <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> <br>Add Donor
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
                      <table width=100%>
                        <thead>
                          <tr class="table_header">
                            <td width="60%">Name</td>
                            <td width="20%">Pledge Status</td>
                            <td width="20%">Actions</td>
                          </tr>
                        </thead>
                        <?php
                          foreach ($network_data as $key => $value) {
                        ?>
                          <tr class="network_entries <?php echo $value['donor_status']; ?>">
                            <td>
                              <p class="name">
                                <a href="tel:<?php echo $value['phone']?>">
                                  <img src="<?php echo $config['site_home'] ?>img/call.png" height="25px"/>
                                </a>
                                <a href="<?php echo $config['site_home']?>/add_donor.php?network_id=<?php echo $value['id'];?>"><?php echo $value['name'] ?></a></p>
                            </td>
                            <td>
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
                            </td>
                            <td>
                              <p class="image-icon"><a href="<?php $config['site_home']?>delete_donor.php?network_id=<?php echo $value['id'] ?>">
                                <img src="<?php echo $config['site_home'] ?>img/delete.png" height="15px"/>
                              </a></p>
                            </td>
                          </tr>
                        <?php
                          }
                        ?>
                      </table>
                    </div>
                    <!-- Pending Collection -->
                    <div class="tab-pane fade" id="pledged">
                      <table width=100%>
                        <thead>
                          <tr class="table_header">
                            <td width="60%">Name</td>
                            <td width="20%">Pledge Status</td>
                            <td width="20%">Actions</td>
                          </tr>
                        </thead>
                        <?php
                          foreach ($network_data as $key => $value) {
                            if($value['donor_status']=='pledged'){
                        ?>
                          <tr class="network_entries <?php echo $value['donor_status']; ?>">
                            <td>
                              <p class="name">
                                <a href="tel:<?php echo $value['phone']?>">
                                  <img src="<?php echo $config['site_home'] ?>img/call.png" height="25px"/>
                                </a>
                                <a href="<?php echo $config['site_home']?>/add_donor.php?network_id=<?php echo $value['id'];?>"><?php echo $value['name'] ?></a></p>
                            </td>
                            <td>
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
                            </td>
                            <td>
                              <p class="image-icon"><a href="<?php $config['site_home']?>delete_donor.php?network_id=<?php echo $value['id'] ?>">
                                <img src="<?php echo $config['site_home'] ?>img/delete.png" height="15px"/>
                              </a></p>
                            </td>
                          </tr>
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
