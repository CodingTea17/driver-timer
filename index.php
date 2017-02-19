<!-- PHP HEADER: Contains references to other files and the required tokens to connect with Twilio -->
<?php
    header("Content-Type: text/html");
    
    // Includes the driver class file
    include("class_driver.php"); 
    
    // Includes the server time file
    include("servertime.php");
    
    //include("get_driver_return_times.php");
    
    // Required if your environment does not handle autoloading
    require __DIR__ . '/vendor/autoload.php';

    // Use the REST API Client to make requests to the Twilio REST API
    use Twilio\Rest\Client;

    // Your Account SID and Auth Token from twilio.com/console
    $sid = '***REMOVED***';
    $token = '***REMOVED***';
    $client = new Client($sid, $token);
?>

<?php
    // Sets variables for later use
    $message_time;
    $most_recent_message_time  = $t;
    $most_recent_message_sid;
    $message_time_difference;
    $dawsons_messages = array(); 
    
        foreach ($client->messages->read() as $message) {
            $message_time = $message->dateSent->getTimestamp();
            $driver_response = $message->body;
            $sender = $message->from;
            
            if($sender == $dawson->get_number()){
                $dawson->add_message((($driver_response*60) + $message_time)*1000);
            }
            if($sender == $cienna->get_number()){
                $kaytis_messages[] = ((($driver_response*60) + $message_time)*1000);
            }
            if($sender == $vova->get_number()){
                $vovas_messages[] = ((($driver_response*60) + $message_time)*1000);
            }
        }
?>
<html style="height:100%">
    <head>
        <!-- Import Google Icon Font -->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
        <!--Import jQuery before materialize.js-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">

        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
        
        <!-- Custome Stylesheet -->
        <link href="custom_styling.css" rel="stylesheet" type="text/css">
        
        <script src="/bower_components/jquery.countdown/dist/jquery.countdown.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> 
        
        <title>Pizza Guys Driver Timer</title>
    </head>
    <meta http-equiv="refresh" content="10" > 
    <body class="grey darken-4">
        <audio id="timer-beep">
          <source src="beep.mp3"/>
        </audio>
        <div class="row">
            <div class="col s4  z-depth-1 grey darken-1">
                <h4 style="text-align:center" class="white-text"><?php echo $vova->get_name();?></h4>
                <div class="container">
                    <div class="card-panel grey lighten-3">
                        <h5 style="text-align:center"> Countdown:</h5>
                        <h1 style="text-align:center"><div data-countdown="<?php echo current($vovas_messages); ?>"></div></h1>
                    </div>
                </div>
            </div>
            <div class="col s4  z-depth-1 grey darken-1">
                <h4 style="text-align:center" class="white-text"><?php echo $dawson->get_name();?></h4>
                <div class="container">
                    <div class="card-panel grey lighten-3">
                        <h5 style="text-align:center">Countdown: </h5>
                        <h1 style="text-align:center"><div data-countdown="<?php echo $dawson->get_newest_message(); ?>"></div></h1>
                    </div>
                </div>
            </div>
            <div class="col s4  z-depth-1 grey darken-1">
                <div class="container">
                    <h4 style="text-align:center" class="white-text"><?php echo $cienna->get_name();?></h4>
                    <div class="card-panel grey lighten-3">
                        <h5 style="text-align:center">Countdown:</h5>
                        <h1 style="text-align:center"><div data-countdown="<?php echo current($kaytis_messages); ?>"></div></h1>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- SECOND ROW -->
        <div class="row">
            <div class="col s4  z-depth-1 grey darken-1 valign-wrapper">
                <div class="container">
                    <h3 style="text-align:center" class="grey-text text-lighten-5"><?php // Place to include another driver?></h3 style="text-align:center">
                    <div class="card-panel grey lighten-3">
                        <img class="center-block" src="Pizza-Guys-Footer-Logo.png"></img>
                    </div>
                </div>
            </div>
            <div class="col s4  z-depth-1 grey darken-1 valign-wrapper">
                <div class="container">
                    <h3 style="text-align:center"><?php // Place to include another driver?></h3 style="text-align:center">
                    <div class="card-panel grey lighten-3">
                        <img class="center-block" src="Pizza-Guys-Footer-Logo.png"></img>
                    </div>
                </div>
            </div>
            <div class="col s4  z-depth-1 grey darken-1 valign-wrapper">
                <div class="container">
                    <h3 style="text-align:center"><?php // Place to include another driver?></h3 style="text-align:center">
                    <div class="card-panel grey lighten-3 valign">
                        <img class="center-block" src="Pizza-Guys-Footer-Logo.png"></img>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<head>
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script src="/bower_components/jquery.countdown/dist/jquery.countdown.js"></script>
</head>

<script type="text/javascript">
    var dc1 = false;
    var dc2 = false;
    var dc3 = false;
  $('[data-countdown]').each(function() {
    var $this = $(this), finalDate = new Date($(this).data('countdown'));
    $this.countdown(finalDate, function(event) {
        $this.html(event.strftime('%M:%S'));
        var now = new Date();
        if((event.finalDate >= now.setSeconds(now.getSeconds() - 5)) && (event.finalDate <= now.setSeconds(now.getSeconds() + 5))){
            document.getElementById( 'timer-beep' ).play();
        }
  });
});
</script>