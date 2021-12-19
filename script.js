$(function(){
    $(".2nd").hide();
    $('#qnimate').hide();

    $("#addClass").click(function () {
        $('#qnimate').addClass('popup-box-on');
    });
          
    $("#removeClass").click(function () {
        $('#qnimate').removeClass('popup-box-on');
    });

    $("#getusername").click(function () {
        if($("#username").val().length > 0){
            $(".username").text($("#username").val());
            $(".1st").hide();
            $(".2nd").show();
            $(".start-time").text(formatAMPM(new Date));
        }
    });

    $("#send").click(function () {
        if($("#status_message").val().length > 0){
            $.ajax({url: "parser.php?data="+$("#status_message").val(), success: function(result){
                $('.direct-chat-messages').append('<div class="direct-chat-msg doted-border"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left">'+$("#username").val()+'</span></div><img alt="message user image" src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="direct-chat-img"><div class="direct-chat-text">'+$("#status_message").val()+'</div><div class="direct-chat-info clearfix"><span class="direct-chat-timestamp pull-right">'+formatAMPM(new Date)+'</span></div></div>');
                $("#status_message").val('');
                var qheight = $('.popup-messages')[0].scrollHeight;
                $('.popup-messages').scrollTop(qheight);
                var results = result.split('||SEP||');
                if(results[1] == 1){
                    $.ajax({url: results[0], success: function(result){
                        if(result.results.bindings.length>0){
                            if(results[3] == 1){
                                $('.direct-chat-messages').append('<div class="direct-chat-msg doted-border"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left">Bot</span></div><img alt="message user image" src="https://previews.123rf.com/images/nastyatrel/nastyatrel2006/nastyatrel200600035/149438272-flat-vector-illustration-chat-bot-icon-flat-line-style-vector-.jpg" class="direct-chat-img"><div class="direct-chat-text"><img width="200" height="200" src="'+result.results.bindings[0].thumbnail.value+'" /></div><div class="direct-chat-info clearfix"><span class="direct-chat-timestamp pull-right">'+formatAMPM(new Date)+'</span></div></div>');
                                $('.popup-messages').scrollTop(qheight+10);
                            } else{
                                $('.direct-chat-messages').append('<div class="direct-chat-msg doted-border"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left">Bot</span></div><img alt="message user image" src="https://previews.123rf.com/images/nastyatrel/nastyatrel2006/nastyatrel200600035/149438272-flat-vector-illustration-chat-bot-icon-flat-line-style-vector-.jpg" class="direct-chat-img"><div class="direct-chat-text">'+result.results.bindings[0].abstract.value+'</div><div class="direct-chat-info clearfix"><span class="direct-chat-timestamp pull-right">'+formatAMPM(new Date)+'</span></div></div>');
                                $('.popup-messages').scrollTop(qheight+10);
                            }  
                        } else {
                            $('.direct-chat-messages').append('<div class="direct-chat-msg doted-border"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left">Bot</span></div><img alt="message user image" src="https://previews.123rf.com/images/nastyatrel/nastyatrel2006/nastyatrel200600035/149438272-flat-vector-illustration-chat-bot-icon-flat-line-style-vector-.jpg" class="direct-chat-img"><div class="direct-chat-text">Sorry! Nothing found. Please try again.</div><div class="direct-chat-info clearfix"><span class="direct-chat-timestamp pull-right">'+formatAMPM(new Date)+'</span></div></div>');
                            $('.popup-messages').scrollTop($('.popup-messages')[0].scrollHeight);
                        }
                    }});
                } else{
                    if(results[0] == 0){
                        $('.direct-chat-messages').append('<div class="direct-chat-msg doted-border"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left">Bot</span></div><img alt="message user image" src="https://previews.123rf.com/images/nastyatrel/nastyatrel2006/nastyatrel200600035/149438272-flat-vector-illustration-chat-bot-icon-flat-line-style-vector-.jpg" class="direct-chat-img"><div class="direct-chat-text">Sorry! Nothing found. Please try again.</div><div class="direct-chat-info clearfix"><span class="direct-chat-timestamp pull-right">'+formatAMPM(new Date)+'</span></div></div>');
                        $('.popup-messages').scrollTop($('.popup-messages')[0].scrollHeight);
                    } else{
                        if(results[2] == 1){
                            $('.direct-chat-messages').append('<div class="direct-chat-msg doted-border"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left">Bot</span></div><img alt="message user image" src="https://previews.123rf.com/images/nastyatrel/nastyatrel2006/nastyatrel200600035/149438272-flat-vector-illustration-chat-bot-icon-flat-line-style-vector-.jpg" class="direct-chat-img"><div class="direct-chat-text">Found: <a href="'+results[0]+'">Click Here</a></div><div class="direct-chat-info clearfix"><span class="direct-chat-timestamp pull-right">'+formatAMPM(new Date)+'</span></div></div>');
                            $('.popup-messages').scrollTop(qheight+10);
                        } else {
                            $('.direct-chat-messages').append('<div class="direct-chat-msg doted-border"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left">Bot</span></div><img alt="message user image" src="https://previews.123rf.com/images/nastyatrel/nastyatrel2006/nastyatrel200600035/149438272-flat-vector-illustration-chat-bot-icon-flat-line-style-vector-.jpg" class="direct-chat-img"><div class="direct-chat-text">'+results[0]+'</div><div class="direct-chat-info clearfix"><span class="direct-chat-timestamp pull-right">'+formatAMPM(new Date)+'</span></div></div>');
                            $('.popup-messages').scrollTop(qheight+10);
                        } 
                    }  
                }
            }});
        }
    });
});

function formatAMPM(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0'+minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;
    return strTime;
  }