<?php require_once('template-top.php'); ?>
        <div id="splash">
          <script type="text/javascript">
              $(document).ready(function() {
                  /* Show play icon */
          	      $('#splash').hover(
          	          function() {
          	              $('#play').css('display', 'block');
        	            },
        	            function() {
        	                $('#play').css('display', 'none');
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
          
          <img id="play" alt="" src="images/play.png" />
        </div>
        
        
<?php require_once('template-bottom.php'); ?>