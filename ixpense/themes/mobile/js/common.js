// -----------------------------------------------------------------------------

// Calculating relative time
function relativeTime(time) {
  var values = time.split(' ');
  time = values[1] + ' ' + values[2] + ', ' + values[5] + ' ' + values[3];
  var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
  var diff = parseInt((relative_to.getTime() - Date.parse(time)) / 1000) + (relative_to.getTimezoneOffset() * 60);
  return relativeDiff(diff);
}

//-----------------------------------------------------------------------------

// Twitter callback
function twitterCallback(tweets) {
  for (var i in tweets) {
    var screen_name = tweets[i].user.screen_name;
    var text = tweets[i].text.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
      return '<a href="'+url+'">'+url+'</a>';
    }).replace(/\B@([_a-z0-9]+)/ig, function(reply) {
      return reply.charAt(0)+'<a href="http://twitter.com/'+reply.substring(1)+'/">'+reply.substring(1)+'</a>';
    });
    jQuery('#twitter').append(
      '<div class="tweet">'+
        '<div class="date">'+
          '<a href="http://twitter.com/'+screen_name+'/statuses/'+tweets[i].id+'">'+
            relativeTime(tweets[i].created_at)+
          '</a>'+
        '</div>'+
        '<p>'+text+'</p>'+
      '</div>'
    );
  }
}

// -----------------------------------------------------------------------------

jQuery(document).ready(function() {
  
  // Binding Navigate button action
  if (menu_collapse) {
    jQuery('#menu li > ul').hide();
    jQuery('#menu li:has(ul) > a')
      .attr('href', 'javascript:;')
      .append('&hellip;')
      .click(function() {
        jQuery(this).parent().find('> ul').slideToggle(menu_speed);
      });
  }
  jQuery('#navigate').click(function() {
    if ( ! jQuery('#menu').is(':animated'))
      jQuery('#menu').slideToggle(menu_speed, function() {
        if ( menu_collapse && ( ! jQuery(this).is(':visible')))
          jQuery('#menu li > ul').hide();
      });
  });
    
  // Configuring search edit
  jQuery('#s').focus(function(){
    if (jQuery(this).val() == search_string) {
      jQuery(this).val('');
    }
  });
  jQuery('#s').blur(function() {
    if (jQuery(this).val() == '') {
      jQuery(this).val(search_string);
    }
  });
  
  // Comments nickname length
  jQuery('#comments .comment .date span').each(function() {
    if (jQuery(this).width() > 80) {
      var s = jQuery(this).text();
      var output = jQuery(this).is(':has(a)') ? jQuery(this).find('a') : jQuery(this);
      do {
        output.text(jQuery.trim(jQuery(this).text().slice(0, -1)));
      } while (jQuery(this).width() > 70);
      output.attr('title', s).append('&hellip;');
    }
  });
  
  // Binding Submit Comment button action
  jQuery('#commentsubmit').click(function() {
    jQuery(this).parent().parent().submit();
  });
  
  // Centering .center class button
  jQuery('.button.center').each(function() {
    jQuery(this).css('width', jQuery(this).width()).css('float', 'none');
  });
  
});