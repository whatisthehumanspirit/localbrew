<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" 
      xmlns:og="http://ogp.me/ns#" 
      xmlns:fb="http://ogp.me/ns/fb#">
  <head>
  	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    <title>Local Brew: Seattle's Online Comedy Show</title>
    
    <meta property="fb:admins" content="2033090" />
    <meta property="og:site_name" content="Local Brew" />
    <meta property="og:url" content="<?php echo $ogUrl; ?>" />
    <meta property="og:image" content="<?php echo $ogImage; ?>" />
    <meta property="og:title" content="<?php echo $ogTitle; ?>" />
    <meta property="og:description" content="<?php echo $ogDescription; ?>" />
    <meta property="og:type" content="tv_show" />
    
    <link rel="stylesheet" type="text/css" media="screen" href="css/screen.css" />
    
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="http://localbrew.tumblr.com/api/read/json?num=9"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi?key=ABQIAAAAIfLUAa364zKppvVHrC0DThT2yXp_ZAY8_ufC3CFXhHIE1NvwkxTVqufuSvbaWI-_rclrn23w08l23Q"></script>
    <script type="text/javascript">
        $(document).ready(function() {        
      	    /* Tumblr blog
      	     * using Tumblr API v1
      	     * Switch to v2 because of problem with multi-media posts
      	     */
      	    $('<table cellspacing="0" cellpadding="0"></table>').appendTo('#tumblr')
      	    var j = 1;
      	    for (i=0; i<9; i++) {
      	        var image = tumblr_api_read['posts'][i]['photo-url-100'];
      	        var url = tumblr_api_read['posts'][i]['url'];
      	        var imageHTML = '<img alt="" src="' + image + '" />'
      	        var imageLinkHTML = '<a title="" href="' + url + '">' + imageHTML + '</a>';
      	        
      	        if (j == 1) {
      	          var postHTML = '<tr><td>' + imageLinkHTML + '</td></tr>';
      	          $(postHTML).appendTo('#tumblr table');
    	          } else {
    	            var postHTML = '<td>' + imageLinkHTML + '</td>';
    	            $(postHTML).appendTo($('#tumblr table tr').last());
  	            }
  	            
  	            if (j < 3) { j++; } else { j = 1; }
    	      }
        });
        // End $(document).ready()
        
        /* Community WordPress blog
         * using Google Feed API
         */
	      google.load("feeds", "1");
	      
	      function loadCommunityFeed() {
	          var feed = new google.feeds.Feed("http://206community411.wordpress.com/feed/");
	          feed.setNumEntries(1);
	          feed.setResultFormat(google.feeds.Feed.JSON_FORMAT);
	          feed.load(function(result) {
	                if (!result.error) {
	                    var postImage = result.feed['entries'][0]['mediaGroups'][0]['contents'][1]['url'];
	                    var postLink = result.feed['entries'][0]['link'];
	                    var postSnippet = result.feed['entries'][0]['contentSnippet'];
	                    var postTitle = result.feed['entries'][0]['title'];
	                    
	                    var postHTML = '<p><a title="" href="' + postLink +'"><img alt="" src="' + postImage + '" /> <span class="post-title">' + postTitle + '</span><br /><br />' + postSnippet + '</a></p>';
              	      $(postHTML).appendTo('#community');
              	      $('<div class="clear"></div>').appendTo('#community');
                  }
            });
	      }
	      
	      google.setOnLoadCallback(loadCommunityFeed);
    </script>
  </head>

  <body>
    <div id="fb-root"></div>
    <script>
      (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=280528758643105";
          fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
    
    <div id="main">
      <div id="navigation">
        <h2><a title="" href="index.php">Local Brew</a></h2>
        
        <div class="menu"><a title="" href="episodes.php">Laugh</a>
                          <a title="" href="http://localbrew.tumblr.com">Art</a>
                          <a title="" href="http://206community411.wordpress.com/">Community</a>
                          <a title="" href="mailto:justatip@localbrew.com">Contact</a>
        </div>
        
        <div id="social"><a title="" href="http://twitter.com/#!/groovechomp"><img alt="" src="images/social-twitter.png" /></a>
                         <a title="" href="http://www.facebook.com/localbrew206"><img alt="" src="images/social-facebook.png" /></a>
                         <a title="" href="http://www.youtube.com/localbrew206"><img alt="" src="images/social-youtube.png" /></a>
        </div>
      </div>
      
      <div id="content-main">
