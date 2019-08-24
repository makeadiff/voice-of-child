
<!-- MultiStep Form -->


<script type="text/javascript">
  var question_count = 1;
  var question_type = <?php echo json_encode($question_type); ?>;
  var actionable = <?php echo json_encode($actionable); ?>;
</script>

<div class="row">
    <div class="form-class col-md-8 col-md-offset-2">
        <form id="msform" action="insert-comment.php" method="POST" onsubmit="return submit_form()">
          <fieldset>
              <p class="form-label">

              </p>
              <p class="form-label">

              </p>
              <input type="hidden" name="question_count" id="question_count" value="1"/>
              <input type="hidden" name="added_by_user_id" value="<?php echo $user['id'] ?>" />
              <div class="row">
                <?php
                  if($is_director){
                ?>
                  <p class="form-label">
                    Select City
                  </p>
                  <?php echo create_select($city_list,'city_id',$user['city_id']);?>
                <?php
                  }
                ?>
                <p class="form-label">
                  Select Shelter
                </p>
                <?php echo create_select($shelter_list,'shelter_id');?>


                <p class="form-label">
                  Select Child
                </p>
                <?php echo create_select($child_list,'child_id',$child_id);?>
                <hr/>

                <p class="form-label">
                  Question 1
                </p>
                <input type="text" name="question_0" required placeholder="Eg. How does the child percieve ed support classes"/>
                <p class="form-label">
                  Answer 1
                </p>
                <textarea name="answer_0" required placeholder="Eg. The classes are really good and helpful. The volunteers come on time and cover the topics really well."></textarea>

                <p class="form-label">
                  Response 1 Type
                </p>
                <?php echo create_select($question_type,'question_type_0');?>
                <p class="form-label">
                  Tags
                </p>
                <input type="text" name="question_tag_0" id="tags" required placeholder="Eg. #EdSupport #Operations"/>
                <p class="form-label">
                  Actionable
                </p>
                <?php echo create_select($actionable,'actionable_0');?>


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
