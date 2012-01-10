<?php require_once('template-top.php'); ?>
        <div id="splash">
          <script type="text/javascript">
              $(document).ready(function() {
                  /* Show play icon */
          	      $('#splash').hover(
          	          function() {
          	              $('#play-icon').css('display', 'block');
        	            },
        	            function() {
        	                $('#play-icon').css('display', 'none');
      	              }
        	        );
        	        
        	        $('#play-ribbon').hover(
          	          function() {
          	              $(this).animate({top: '0px'}, 200);
        	            },
        	            function() {
        	                $(this).animate({top: '-48px'}, 200);
      	              }
        	        );
  	        
        	        /* Play latest episode */
        	        $('#splash').click(function() {
        	            window.location = 'episodes.php';
      	          });
              });
              // End $(document).ready()
          </script>
          
          <div id="about-us">Local Brew is Seattle's online comedy show. 
          Tapping everything from our people to our events, Local Brew 
          explores just how awesome this city is.</div>
          
          <img id="play-ribbon" alt="" src="images/play-ribbon.png" />
          
          <img id="play-icon" alt="" src="images/play-icon.png" />
        </div>
        
        
<?php require_once('template-bottom.php'); ?>