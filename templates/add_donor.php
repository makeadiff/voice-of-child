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
    <div class="form-class col-md-6 col-md-offset-3">
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

                <?php
                  if(isset($donor_id)){
                ?>
                  <input type="hidden" name="insert_id" value="<?php echo $donor_id; ?>" />
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
                <input type="text" name="donor_name" onchange="req(this);" required="" value="<?php echo form_value($network_info,'name');?>"/>

                <p class="form-label">Donor Phone <span class="required">*</span></p>
                <input type="text" name="donor_phone" onchange="{req(this); validphone(this);}" placeholder="Eg. 81XXXXXX03 or +1-8XX-XXX-XX03" required="" value="<?php echo form_value($network_info,'phone');?>"/>

                <p class="form-label">Donor Email</p>
                <input type="email" name="donor_email" onchange="req(this);" placeholder="roxxxx@xxxx.com" value="<?php echo form_value($network_info,'email');?>"/>

                <p class="form-label">Relationship <span class="required">*</span></p>
                <?php echo create_radio($relationship, 'relationship',form_value($network_info,'relationship')) ?>

                <hr class="light">

                <div class="hidden_div" <?php if($addition_details) echo 'style="display:block;"' ?>>
                  <p class="form-label">Age Bracket </p>
                  <?php echo create_select($age_bracket, 'age_bracket',form_value($network_info,'age_bracket')) ?>

                  <p class="form-label">Monthly Giving Potential </p>
                  <?php echo create_radio($nach_potential, 'nach_potential',form_value($network_info,'nach_potential')) ?>

                  <p class="form-label">Onetime Donation Potential </p>
                  <?php echo create_select($otd_potential, 'otd_potential',form_value($network_info,'otd_potential')) ?>

                  <hr class="light"/>

                  <p class="form-label">Giving Likelihood & Reason</p>
                  <p class="note">Ex: High - Because they're wealthy, likes to help people and always supports whatever I want to do.</p>
                  <?php echo create_radio($giving_likelihood, 'giving_likelihood', form_value($network_info,'giving_likelihood')) ?>
                  <input type="text" name="giving_likelihood_reason" placeholder="Reason"  value="<?php echo form_value($network_info,'giving_likelihood_reason')?>" />

                  <hr class="light"/>

                  <p class="form-label">NACH Likelihood & Reason</p>
                  <p class="note">Ex. High - I'm sure they'll consider it if we can make it easy | Medium - Should be able to understand the need and value | Low - Nervous about sharing bank account details</p>
                  <?php echo create_radio($giving_likelihood, 'nach_likelihood',form_value($network_info,'nach_likelihood')) ?>
                  <input type="text" name="nach_likelihood_reason" placeholder="Reason" value="<?php echo form_value($network_info,'nach_likelihood_reason')?>" /><br>

                  <hr class="light"/>

                  <p class="form-label">Online Payment Likelihood & Reason</p>
                  <p class="note">Example: High - Does everything on their mobile | Low - Isn't tech savvy</p>
                  <?php echo create_radio($giving_likelihood, 'online_likelihood',form_value($network_info,'online_likelihood')) ?>
                  <input type="text" name="nach_likelihood_reason" placeholder="Reason" value="<?php echo form_value($network_info,'online_likelihood_reason')?>" /><br>

                </div>

                <?php
                  if($addition_details){
                ?>
                  <p class="more_details">- Hide Details</p>
                <?php
                  }
                  else{
                ?>
                  <p class="more_details">- Add More Details</p>
                <?php
                  }
                ?>

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
