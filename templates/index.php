
<!-- MultiStep Form -->

<script type="text/javascript">


</script>

<div class="row">
    <div class="form-class col-md-8 col-md-offset-2">
        <form id="msform" action="./" method="post">
          <fieldset>
            <div class="row">
              <br>

              <?php
                if($success==true){
              ?>
              <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Sucess!</strong> Data Saved Successfully!
              </div>
              <?php
                }
              ?>

              <h2 class="fs-title">Hi, <?php echo $user['name'];?></h2>
	            <!-- <h3 class="fs-subtitle">Please verify your personal details.</h3> -->
              <hr>
              <div class="add_donor col-md-6 col-md-offset-3">
                <a href="./add-comment.php">
                  <button type="button" class="add-button btn btn-default btn-lg">
                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> <br>Add Comment
                  </button>
                </a>
              </div>
            </div>

            <?php
              if(!($city_id==0 && $shelter_id==0 && empty($all_comments))){
            ?>
                <hr/>
                <div class="row" id="filterSearch">
                  <div class="col-md-6 col-md-offset-6">
                    <input class="search" id="filerVOC" type="text" placeholder="Search..">
                  </div>
                </div>
                <div class="row">
                  <?php
                    if($is_director){
                  ?>
                    <div class="col-md-4">
                      <p class="form-label">
                        Select City
                      </p>
                      <?php echo create_select($city_list,'city_id',$city_id,false,false);?>
                    </div>
                  <?php
                    }
                  ?>

                  <div class="col-md-4">
                    <p class="form-label">
                      Select Shelter
                    </p>
                    <?php echo create_select($shelter_list,'shelter_id',$shelter_id);?>
                  </div>

                  <div class="col-md-4">
                    <p class="form-label">
                      <!-- Select Shelter -->
                    </p>
                    <input type="submit" name="submit" class="action-button" value="Filter"/>
                  </div>

                  <!-- <div class="col-md-4">
                    <p class="form-label">
                      Select Question Type
                    </p>
                    <?php //echo create_select($question_type,'question_type_0');?>
                  </div> -->

                  <!-- <div class="col-md-3">
                    <p class="form-label">
                      Select Child
                    </p>
                    <?php //echo create_select($child_list,'child_id');?>
                  </div>

                  <div class="col-md-3">
                    <p class="form-label">
                      Select Actionable
                    </p>
                    <?php //echo create_select($actionable,'actionable');?>
                  </div> -->
                </div>
            <?php
              }

              if(!empty($all_comments)){
                echo '<hr/>';
            ?>

            <?php
              if(isset($count)){
            ?>

            <?php
              }

            ?>
              <div id="vocList">
                <ul class="voc_data list" id="contentVOC">
            <?php
                foreach ($all_comments as $comments) {
            ?>
                  <li>
                    <h3 class="student_name"><a href="./child.php?child_id=<?php echo $comments['student_id'];?>"><?php echo $comments['student_name'].' ('.$comments['count'].')'; ?></a></h3>
                    <p class="shelter_name"><?php echo $comments['center_name'].', '.$comments['city_name']; ?></p>
                    <p class="question"><strong><?php echo ucfirst($comments['question']); ?></strong></p>
                    <p class="answer"><?php echo ucfirst(substr($comments['answer'],0,100)).'...'; ?></p>
                  </li>

            <?php
                }
            ?>
                </ul>
                <div class="center"><ul class="pagination"></ul></div>
              </div>
            <?php
              }
            ?>

            </div>
          </fieldset>
        </form>
    </div>
</div>
