<!DOCTYPE html>
<html>
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="style.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</head>   
<body>

    <div class="container text-center">
        <div class="row">
            <h2>AI Chatbot</h2>
            <h4>.Find answers to the Questions</h4>
            <h4>.Quick to respond</h4>
            <br>
            <div class="1st">Enter Name to begin <input type="text" id="username"/><button class="1st" id="getusername">Login</button></div>
            <br>
            <div class="2nd round hollow text-center">
                <h2>Hi <span class="username"></span></h2>
            </div>
            <div class="2nd round hollow text-center">
                <a href="#" id="addClass"><span class="glyphicon glyphicon-comment"></span> Click here to chat </a>
            </div>
        </div>
    </div>

    <div class="popup-box chat-popup" id="qnimate">
        <div class="popup-head">
            <div class="popup-head-left pull-left">
                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png"> 
                <span class="username"></span>
            </div>
            <div class="popup-head-right pull-right">  
                <button data-widget="remove" id="removeClass" class="chat-header-button pull-right" type="button"><i class="glyphicon glyphicon-off"></i></button>
            </div>
        </div>
        <div class="popup-messages">
            <div class="direct-chat-messages">       
                <div class="chat-box-single-line">
                    <abbr class="timestamp"><?php echo date('F').' '.date('d').', '.date('Y') ?></abbr>
                </div>  
                <div class="direct-chat-msg doted-border">
                    <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-left">Bot</span>
                    </div>
                    <img alt="message user image" src="https://previews.123rf.com/images/nastyatrel/nastyatrel2006/nastyatrel200600035/149438272-flat-vector-illustration-chat-bot-icon-flat-line-style-vector-.jpg" class="direct-chat-img"><!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                        Hi <span class="username"></span>, hope you're doing good! I am an AI based chatbot. Ask me about any products and categories.
                    </div>
                    <div class="direct-chat-info clearfix">
                        <span class="start-time direct-chat-timestamp pull-right"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="popup-messages-footer">
            <textarea id="status_message" placeholder="Type a message..." rows="10" cols="40" name="message"></textarea>
            <div class="btn-footer">
                <button id="send" class="bg_none"><i class="glyphicon glyphicon-envelope"></i> </button>
            </div>
        </div>
    </div>				                            
</body>
</html>