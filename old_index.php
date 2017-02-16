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
            $message_time_difference = $t - $message_time;
    
            
            //if($message_time_difference < $most_recent_message_time) {
            //    $most_recent_message_time = $message_time_difference;
            //    $most_recent_message_sid = $message->sid;
                //echo "<br/>\n";
                //echo "I am the SID of the most recent message: ".$most_recent_message_sid;
                //echo "<br/>\n";
            $driver_response = $message->body;
            $sender = $message->from;
            
            if($sender == $dawson->get_number()){
                $dawsons_messages[] = ($driver_response*60) + $message_time;
                echo current($dawsons_messages);
            }
            if($sender == $kayti->get_number()){
                $kaytis_messages[] = $driver_response;
            }
            if($sender == $vova->get_number()){
                $vovas_messages[] = $driver_response;
            }
                /*
                if($sender == $dawson->get_number())
                {
                    $time_of_return = ($driver_response * 60) + $message_time;
                    $time_to_return = $time_of_return - $t;
                    $dawson->set_return_time($time_to_return);
                }
                elseif($sender == $kayti->get_number())
                {
                    $time_of_return = ($driver_response * 60) + $message_time;
                    $time_to_return = $time_of_return - $t;
                    $kayti->set_return_time($time_to_return);
                }
                elseif($sender == $vova->get_number())
                {
                    $time_of_return = ($driver_response * 60) + $message_time;
                    $time_to_return = $time_of_return - $t;
                    $vova->set_return_time($time_to_return);
                }
                */
            //}
        }
        
        /*
        $messages = $client->account->messages->getIterator(0, 10, array()); 
        foreach ($messages as $message) { 
	        echo $message->body; 
        }
        */
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
        
    </head>
    
    <script type="text/javascript">
  
  /*
    function timeFromSecs(seconds)
    {
        return(
        Math.floor(((seconds/3600)%1)*60)+'m : '+
        Math.round(((seconds/60)%1)*60)+'s');
    }

    function timer(time,update) {
        var start = new Date().getTime();
        var interval = setInterval(function() {
        var now = time-(new Date().getTime()-start);
        
        if( now <= 0) {
                clearInterval(interval);
                interval = 0;
                start = 0;
        }
        else update(Math.floor(now/1000));
        },100); // the smaller this number, the more accurate the timer will be
    }
    
    timer(
        "<?php //echo $vova->get_return_time() * 1000; ?>", // milliseconds
        function(timeleft) { // called every step to update the visible countdown
        document.getElementById('vova').innerHTML = timeFromSecs(timeleft);
        }
    );
    */
</script>

    <!--onload=timer_function() -->
    <body class="grey darken-4">
       
        
        <div class="row">
            <div class="col s4  z-depth-1 grey darken-1">
                <div class="container">
                    <h3 style="text-align:center"><?php echo $vova->get_name();?></h3 style="text-align:center">
                    <div class="card-panel grey lighten-3">
                        <h4 style="text-align:center">Countdown:</h4>
                        <h5 style="text-align:center"><span id="vova"></span></h5>
                        <div data-countdown=""></div>
                    </div>
                </div>
            </div>
            <div class="col s4  z-depth-1 grey darken-1">
                <div class="container">
                    <h3 style="text-align:center"><?php echo $dawson->get_name();?></h3 style="text-align:center">
                    <div class="card-panel grey lighten-3">
                        <div data-countdown="2018/01/01"></div>
                        <h4 style="text-align:center">Countdown:</h4>
                        <h5 style="text-align:center"><span id="dawson"></span><?php echo current($dawsons_messages); ?></h5>
                    </div>
                </div>
            </div>
            <div class="col s4  z-depth-1 grey darken-1">
                <div class="container">
                    <h3 style="text-align:center"><?php echo $kayti->get_name();?></h3 style="text-align:center">
                    <div class="card-panel grey lighten-3">
                        <h4 style="text-align:center">Countdown:</h4>
                        <h5 style="text-align:center"><span id="kayti"></span></h5>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- SECOND ROW -->
        <div class="row">
            <div class="col s4  z-depth-1 grey darken-1">
                <div class="container">
                    <h3 style="text-align:center" class="grey-text text-lighten-5"><?php // Place to include another driver?></h3 style="text-align:center">
                    <div class="card-panel grey lighten-3">
                    </div>
                </div>
            </div>
            <div class="col s4  z-depth-1 grey darken-1">
                <div class="container">
                    <h3 style="text-align:center"><?php // Place to include another driver?></h3 style="text-align:center">
                    <div class="card-panel grey lighten-3">
                    </div>
                </div>
            </div>
            <div class="col s4  z-depth-1 grey darken-1">
                <div class="container">
                    <h3 style="text-align:center"><?php // Place to include another driver?></h3 style="text-align:center">
                    <div class="card-panel grey lighten-3">
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

