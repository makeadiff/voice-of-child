<?php
// include_once('includes/application.php'); //Find the configuratio files in db/config.php


$time =  date('Y-m-d H:i:s');

// if($time > '2018-03-26 00:00:00')
//   $form_status = false;
// else
//   $form_status = true;

  $form_status = true;
?>




<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <form id="msform" action="insert_network_info.php" method="POST" onsubmit="submit_form()">
          <!-- progressbar -->
          <?php if($form_status){ ?>


          <!-- Verify your details -->
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

                <h2 class="fs-title">Add Potential Donor</h2>
		            <!-- <h3 class="fs-subtitle">Please verify your personal details.</h3> -->
                <hr>
                <p class="form-label">

                </p>

                <p class="required-text">*Required</p>
                <hr>
                <input type='text' name="user_id" class="hidden" value= "<?php echo $user['id'] ?>"/>

                <p class="form-label">Donor Full Name <span class="required">*</span></p>
                <input type="text" name="donor_name" onchange="req(this);" required=""/>

                <p class="form-label">Donor Phone <span class="required">*</span></p>
                <input type="text" name="donor_phone" onchange="{req(this); validphone(this);}" placeholder="Eg. 81XXXXXX03 or +1-8XX-XXX-XX03" required=""/>

                <p class="form-label">Donor Email</p>
                <input type="email" name="donor_email" onchange="req(this);" placeholder="roxxxx@xxxx.com" />

                <p class="form-label">Relationship <span class="required">*</span></p>
                <?php echo create_radio($relationship, 'relationship') ?>

                <hr>

                <div class="hidden_div">
                  <p class="form-label">Age Bracket </p>
                  <?php echo create_select($age_bracket, 'age_bracket') ?>

                  <p class="form-label">Monthly Giving Potential </p>
                  <?php echo create_radio($nach_potential, 'nach_potential') ?>

                  <p class="form-label">Onetime Donation Potential </p>
                  <?php echo create_select($otd_potential, 'otd_potential') ?>

                  <p class="form-label">Giving Likelihood </p>
                  <input type="text" name="donor_address" placeholder="Enter Your Address"  /><br>
                  <!-- <input type="text" name="user_address" placeholder="Reason"  /><br> -->

                  <p class="form-label">Giving Likelihood </p>
                  <input type="text" name="giving_address" placeholder="Enter Your Address"  /><br>
                  <!-- <input type="text" name="user_address" placeholder="Reason"  /><br> -->

                  <!-- <p class="form-label">Giving Likelihood </p> -->
                  <!-- <input type="text" name="donor_address" placeholder="Enter Your Address"  /><br> -->
                  <!-- <input type="text" name="user_address" placeholder="Reason"  /><br> -->
                </div>

                <p class="more_details">+ Add More Details</p>


                <!-- </select><br><br><hr> -->
                <div class="center">
                  <input type="submit" name="submit" class="action-button" value="Save"/>
                  <input type="submit" name="submit" class="action-button" value="Save & Add New"/>
                </div>
            </fieldset>





          <?php } ?>
        </form>
    </div>
</div>

        <!-- /.MultiStep Form -->
