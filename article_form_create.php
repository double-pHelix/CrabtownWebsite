
<div id="content">

		<div id="article_form_box">
	
			
			<?php if($display_article){ ?>
			
				<h2 id="loginHeader"> Edit Article</h2>
				
			<?php } else { ?>
			
				<h2 id="loginHeader"> Create Article</h2>
				
			<?php } ?>
		

 			
 			<form name="articles_option" action="" method="POST">
 			
 				
                  <input type="hidden" name="article_num" value="<?php echo $edit_article->id; ?>">
                  
  
                  	<div>
						<label for="name">Title:</label>
                  		<input type="text" name="art_name_edit" id="name" value="<?php echo $edit_article->name; ?>"><br>
					</div>

                 	<div>
						<label for="description">Description:</label>
                    	<input type="text" name="art_description_edit" id="description" value="<?php echo $edit_article->description; ?>"><br>
                    </div>

					<div>
						<label for="timestamp">Timestamp:</label>
                  		<?php echo $edit_article->mod_date; ?>
					</div>
                    
         
                  	<h3>Text</h3>
                   	<textarea class="form-control" name="art_text_edit" rows=20><?php echo $edit_article->article_text; ?></textarea>


                  
                 	<?php if($display_article){ ?>
	                  	<input class="btn btn-xs btn-success" type="submit" name="set_edit_article" id="edit_profile_button" value="Confirm">
                   		<input class="btn btn-xs btn-danger" type="submit" name="delete_article" id="edit_profile_button" value="Delete">
	                <?php } else { ?>
	                  	<input class="btn btn-xs btn-success" type="submit" name="set_edit_article" id="edit_profile_button" value="Create">
                   		<input class="btn btn-xs btn-danger" type="submit" name="delete_article" id="edit_profile_button" value="Cancel">
	                <?php } ?>
	                  
	                  
           </form>
          
        </div>
     
  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>

</div>

  