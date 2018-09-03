
<!-- MultiStep Form -->

<script type="text/javascript">
  var question_count = 1;
  // var question_type[];

  <?php
    foreach ($question_type as $key => $value) {
  ?>
    question_type['<?php echo $key; ?>'] = '<?php echo $value; ?>';
  <?php
    }
  ?>

</script>

<div class="row">
    <div class="form-class col-md-6 col-md-offset-3">
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

              <div class="row">
                <p class="form-label">
                  Select Shelter
                </p>
                <?php echo create_select($shelter_list,'shelter_id');?>

                <br>

                <p class="form-label">
                  Select Child
                </p>
                <?php echo create_select($child_list,'child_id');?>
                <hr/>

                <p class="form-label">
                  Question 1
                </p>
                <input type="text" name="question_0" placeholder="Eg. How does the child percieve ed support classes"/>
                <p class="form-label">
                  Answer 1
                </p>
                <textarea name="answer_0" placeholder="Eg. The classes are really good and helpful. The volunteers come on time and cover the topics really well."></textarea>

                <p class="form-label">
                  Question 1 Type
                </p>
                <?php echo create_select($question_type,'question_type');?>
                <p class="form-label">
                  Tags
                </p>
                <input type="text" name="question_tag_0" placeholder="Eg. #EdSupport #Operations"/>
                <p class="form-label">
                  Question 1 Type
                </p>

                

                <div id="additional_questions"></div>
              </div>

              <div class="center">

                <div class="row">
                  <button type="button" class="btn btn-default" id="add_questions" aria-label="Left Align">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    Add
                  </button>
                  <button type="button" class="hidden btn btn-default" id="remove_questions" aria-label="Left Align">
                    <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                    Remove
                  </button>
                </div>

                <input type="submit" name="submit" class="action-button" value="Save"/>
              </div>
          </fieldset>
        </form>
    </div>
</div>
