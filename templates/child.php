
<!-- MultiStep Form -->

<script type="text/javascript">


</script>

<div class="row">
    <div class="form-class col-md-8 col-md-offset-2">
        <form id="msform" action="preview.php" method="POST" onsubmit="submit_form()">
          <fieldset>
            <div class="row">
              <br>

              <?php
                if($data==false){
              ?>
              <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Error:</strong> No child selected!
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
              // dump($child_info);
              if(!empty($all_comments_child)){
                echo '<hr/>';
            ?>
              <h2>Child/ Name: <?php echo $child_info['name']; ?></h2>
              <h2>Shelter Name: <?php echo $child_info['center'].', '.$child_info['city']; ?></h2>

              <div class="row" id="filterSearch">
                <div class="col-md-6 col-md-offset-6">
                  <input class="formInput" id="filerVOC" type="text" placeholder="Search..">
                </div>
              </div>
              <ul class="voc_data" id="contentVOC">
            <?php
                foreach ($all_comments_child as $comments) {
                  $tags = explode(',',$comments['tags']);
                  if($comments['question']!=''){
            ?>
                <li>
                  <a href=""><h3 class="question"><?php echo ucfirst($comments['question']); ?></h3></a>
                  <p><span class="added_on">Added On: <?php echo date('F j, Y, g:i a',strtotime($comments['added_on'])); ?><span></p>
                  <p class="answer"><?php echo ucfirst($comments['answer']); ?></p>
                  <p class="tags">
                    <?php
                      if(count($tags)!=0){
                        foreach ($tags as $tag) {
                    ?>
                      <span class="tag"><?php echo $tag; ?></span>
                    <?php
                        }
                      }
                    ?>
                  </p>
                </li>
            <?php
                  }
                }
              }
            ?>



            </div>
          </fieldset>
        </form>
    </div>
</div>
