<?php
    require_once('episode-data.php');
    
    // Numerical episode variables
    $numberOfEpisodes = count($episodes);
    // Show latest episode if episode is not specified in URL
    if (!isset($_GET['episode'])) {
        $currentEpisode = $episodes[$numberOfEpisodes - 1]['number'];
    } else {
        $currentEpisode = $_GET['episode'];
    }
    // Find current episode index
    for ($i = 0; $i < $numberOfEpisodes; $i++) {
        if ($episodes[$i]['number'] == $currentEpisode) {
            $currentEpisodeIndex = $i;
            break;
        }
    }
    
    // Numerical clip variables
    if (!isset($_GET['episode'])) {
        $startingClipIndex = 0;
    } else {
        $startingClipIndex = $_GET['clip'] - 1;
    }
    
    // Specify YouTube video quality in URL
    $quality = $_GET['quality'];
    switch ($quality) {
        case '360p':
            $videoQuality = 'medium';
            break;
        case '480p':
            $videoQuality = 'large';
            break;
        case '720p':
            $videoQuality = 'hd720';
            break;
        case '1080p':
            $videoQuality = 'hd1080';
            break;
        default:
          $videoQuality = 'large';
    }
    
    require_once('template-top.php');
?>
        <div id="episode">          
          <!--<iframe id="player" src="http://www.youtube.com/embed/videoseries?list=<?php echo $episodes[$currentEpisodeIndex]['playlist']; ?>&amp;hl=en_US&amp;hd=1&amp;enablejsapi=1" frameborder="0" width="720" height="405"></iframe>-->
          <div id="player"></div>
          
          <script type="text/javascript">
              var currentEpisodePlaylistID =  "<?php echo $episodes[$currentEpisodeIndex]['playlist']; ?>";
              var startingClipIndex = "<?php echo $startingClipIndex; ?>";
              var videoQuality = "<?php echo $videoQuality; ?>"
              
              // YouTube API
              var tag = document.createElement('script');
              tag.src = "http://www.youtube.com/player_api";
              var firstScriptTag = document.getElementsByTagName('script')[0];
              firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
            
              var player;
              function onYouTubePlayerAPIReady() {
                  player = new YT.Player('player', {
                      width: 720,
                      height: 405,
                      events: {
                          'onReady': onPlayerReady,
                          // 'onStateChange': onPlayerStateChange
                      }
                  });
              }
            
              function onPlayerReady(event) {
                  // player.playVideo();
                  player.setPlaybackQuality(videoQuality);
                  player.loadPlaylist(currentEpisodePlaylistID, startingClipIndex);
              }
            
              // API quirk - with manual iframe embedding, quality isn't forced if called by onReady event
              function onPlayerStateChange(event) {
                  // player.setPlaybackQuality(videoQuality);
              }
          </script>
          
          <div id="summary">
            <h3><?php echo $episodes[$currentEpisodeIndex]['title']; ?></h3>
            
            <p><?php echo $episodes[$currentEpisodeIndex]['summary']; ?></p>
          </div>
          
          <div class="clear"></div>
        </div>
        
        <div id="gallery">
          <script type="text/javascript">
              var currentEpisodePosition = <?php echo $currentEpisodeIndex + 1; ?>;
              var selectedEpisodePosition = currentEpisodePosition;
              var numberOfEpisodes = <?php echo $numberOfEpisodes; ?>;
              var episodeNavigatorListTop;
              var episodeThumbnailsListTop;
              var episodeNavigatorRowHeight = 22;
              var episodeThumbnailsRowHeight = 96;
    
              function configureEpisodeNavigator() {
                  $('.episode-navigator-row.selected').removeClass('selected');
        
                  if (selectedEpisodePosition == 1) {
                      $('#episode-navigator-down').css('visibility', 'hidden');
                  } else {
                      $('#episode-navigator-down').css('visibility', 'visible');
                  }
        
                  if (selectedEpisodePosition == numberOfEpisodes) {
                      $('#episode-navigator-up').css('visibility', 'hidden');
                  } else {
                      $('#episode-navigator-up').css('visibility', 'visible');
                  }
        
                  $('.episode-navigator-row').eq(selectedEpisodePosition - 1).addClass('selected');
              }
    
              function navigateUp() {
                  if (selectedEpisodePosition < numberOfEpisodes) {
                      selectedEpisodePosition++;
        
                      episodeNavigatorListTop = episodeNavigatorListTop - episodeNavigatorRowHeight;
                      $('#episode-navigator-list').animate({top: episodeNavigatorListTop + 'px'}, 
                                                           500, 
                                                           function() { configureEpisodeNavigator(); });
                      episodeThumbnailsListTop = episodeThumbnailsListTop - episodeThumbnailsRowHeight;
                      $('#episode-thumbnails-list').animate({top: episodeThumbnailsListTop + 'px'}, 
                                                           500 );
                  }
              }
    
              function navigateDown() {
                  if (selectedEpisodePosition > 1) {
                      selectedEpisodePosition--;
        
                      episodeNavigatorListTop = episodeNavigatorListTop + episodeNavigatorRowHeight;
                      $('#episode-navigator-list').animate({top: episodeNavigatorListTop + 'px'}, 
                                                           500, 
                                                           function() { configureEpisodeNavigator(); });
                      episodeThumbnailsListTop = episodeThumbnailsListTop + episodeThumbnailsRowHeight;
                      $('#episode-thumbnails-list').animate({top: episodeThumbnailsListTop + 'px'}, 
                                                           500 );
                  }
              }
              
              $(document).ready(function() {
                  episodeNavigatorListTop = parseInt( $('#episode-navigator-list').css('top') );
                  episodeThumbnailsListTop = parseInt( $('#episode-thumbnails-list').css('top') );
                  configureEpisodeNavigator();
              });
          </script>
          
          <div id="episode-navigator">
            <div id="episode-navigator-up" onclick="navigateUp();"></div>
            
            <div id="episode-navigator-list-frame">
              <div id="episode-navigator-list" style="top: <?php echo 22 - ($currentEpisodeIndex) * 22; ?>px;">
                <?php
                    foreach ($episodes as $episode) {
                        echo '<div class="episode-navigator-row"><a title="" href="episodes.php?episode=' . $episode['number'] . '">Episode ' . $episode['number'] . ':</a></div>';
                    }
                ?>
              </div>
            </div>
            
            <div id="episode-navigator-down" onclick="navigateDown();"></div>
          </div>
          
          <div id="episode-thumbnails">
            <div id="episode-thumbnails-list" style="top: -<?php echo ($currentEpisodeIndex) * 96; ?>px;">
              <?php
                    foreach ($episodes as $episode) {
                        echo '<div class="episode-thumbnails-row">';
                        
                        foreach ($episode['thumbnails'] as $thumbnail) {
                                echo '<a title="" href="episodes.php?episode=' . $episode['number'] . '&clip=' . $thumbnail['clip'] . '"><img alt="" src="thumbnails/' . $thumbnail['image'] . '" /></a>';
                            }
                        
                        echo '</div>';
                    }
              ?>
            </div>
          </div>
        </div>
<?php require_once('template-bottom.php'); ?>