
<!-- MultiStep Form -->

<script type="text/javascript">


</script>

<div class="row">
    <div class="form-class col-md-8 col-md-offset-2">
        <form id="msform" action="preview.php" method="POST" onsubmit="submit_form()">
          <fieldset>
            <div class="row">
              <br>


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
              if(!empty($all_comments)){
            ?>
            
            <?php
              }
            ?>



            </div>
          </fieldset>
        </form>
    </div>
</div>
