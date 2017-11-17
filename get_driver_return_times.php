<?php
    // Includes the server time file
    include("servertime.php");
    
    // Required if your environment does not handle autoloading
    require __DIR__ . '/vendor/autoload.php';

    // Use the REST API Client to make requests to the Twilio REST API
    use Twilio\Rest\Client;

    // Your Account SID and Auth Token from twilio.com/console
    $sid = getenv('SID');
    $token = getenv('TOKEN');
    $client = new Client($sid, $token);
    
    // Sets variables for later use
    $message_time;
    $most_recent_message_time = $t;
    $most_recent_message_sid;
    $message_time_difference;
    $driver_response;
?>
<?php
        foreach ($client->messages->read() as $message) {
            $message_time = $message->dateSent->getTimestamp();
            $message_time_difference = $t - $message_time;
    
            if($message_time_difference < $most_recent_message_time) {
                $most_recent_message_time = $message_time_difference;
                $most_recent_message_sid = $message->sid;
                //echo "<br/>\n";
                //echo "I am the SID of the most recent message: ".$most_recent_message_sid;
                //echo "<br/>\n";
                $driver_response = $message->body;
                $sender = $message->from;
                $time_of_return = ($driver_response * 60) + $message_time;

                $time_to_return = $time_of_return - $t;
            }
        }
        
        /*
        $messages = $client->account->messages->getIterator(0, 10, array()); 
        foreach ($messages as $message) { 
	        echo $message->body; 
        }
        */
?>