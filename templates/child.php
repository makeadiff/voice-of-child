
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
                if($child_data==false){
              ?>
              <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Error:</strong> No child selected!
              </div>
              <?php
                }
              ?>


            </div>


            <?php
              // dump($child_info);
              if(!empty($all_comments_child)){
            ?>
              <h2 class="fs-title left"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $child_info['name']; ?></h2>
              <h2 class="fs-subtitle left"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> <?php echo $child_info['center'].', '.$child_info['city']; ?></h2>
              <hr/>
              <!-- <div class="row" id="filterSearch">
                <div class="col-md-6 col-md-offset-6">
                  <input class="formInput" id="filerVOC" type="text" placeholder="Search..">
                </div>
              </div> -->
              <ul class="voc_data" id="contentVOC">
            <?php
                // dump($all_comments_child);
                foreach ($all_comments_child as $comments) {
                  $tags = explode(',',$comments['tags']);
                  if($comments['question']!=''){
            ?>
                <li class="<?php echo $comments['actionable']; ?>">

                  <a href=""><h3 class="question"><?php echo ucfirst($comments['question']); ?></h3></a>
                  <p><span class="added_on">Added On: <?php echo date('F j, Y, g:i a',strtotime($comments['added_on'])); ?><span></p>
                  <p class="answer"><?php echo ucfirst($comments['answer']); ?></p>
                  <p class="tags">
                    <span class="glyphicon glyphicon-tags" aria-hidden="true"></span>
                    <?php
                      if(count($tags)!=0){
                        foreach ($tags as $tag) {
                    ?>
                      <span class="tag"><?php echo ucwords(str_replace('#','',$tag)); ?></span>
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
              </ul>
              <hr>
              <div class="add_donor col-md-6 col-md-offset-3">
                <a href="./add-comment.php?child_id=<?php echo $child_info['id']; ?>">
                  <button type="button" class="add-button btn btn-default btn-lg">
                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> <br>Add Comment
                  </button>
                </a>
              </div>
            </div>

          </fieldset>
        </form>
    </div>
</div>
