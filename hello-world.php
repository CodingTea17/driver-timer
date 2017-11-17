<?php
// Required if your environment does not handle autoloading
require __DIR__ . '/vendor/autoload.php';

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
    $sid = getenv('SID');
    $token = getenv('TOKEN');
$client = new Client($sid, $token);


//SEND A TEXT MESSAGE
/*
// Use the client to do fun stuff like send text messages!
$client->messages->create(
    // the number you'd like to send the message to
    '+55555555',
    array(
        // A Twilio phone number you purchased at twilio.com/console
        'from' => '+15034058703',
        // the body of the text message you'd like to send
        'body' => 'Look at me! I am sending a sms!'
    )
);
*/

//LOOP OVER TEXT MESSAGES
/*
// Loop over the list of messages and echo a property for each one
foreach ($client->messages->read() as $message) {
    echo $message->body;
}
*/

//CREATE NAMES FOR NUMBER
/*
    $people = array(
        "+14158675309"=>"Curious George",
        "+14158675310"=>"Boots",
        "+14158675311"=>"Virgil",
    );

    // if the sender is known, then greet them by name
    // otherwise, consider them just another monkey
    if(!$name = $people[$_REQUEST['From']]) {
        $name = "Monkey";
    }

    // now greet the sender
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
*/

//GETS CURRENT TIME AND ASSIGNS THE VALUE TO "$t"
$t=time();

$message_time;
$most_recent_message_time  = $t;
$most_recent_message_sid;
$message_time_difference;

echo "EPOCH TIMESTAMP: ".($t . "<br>");
//echo "HUMAN READABLE: ".(date("d F Y H:i:s",$t));
echo "<br/>\n"."<br/>\n";

foreach ($client->messages->read() as $message) {
    $message_time = $message->dateSent->getTimestamp();
    $message_time_difference = $t - $message_time;
    
    if($message_time_difference < $most_recent_message_time) {
        $most_recent_message_time = $message_time_difference;
        $most_recent_message_sid = $message->sid;
        //echo "<br/>\n";
        echo "I am the SID of the most recent message: ".$most_recent_message_sid;
        echo "<br/>\n";
        $driver_response = $message->body;
        $time_of_return = ($driver_response * 60) + $message_time;

        $time_to_return = $time_of_return - $t;
        
        echo $time_of_return."<br/>\n".$time_to_return;
    }
    $time_of_return = ($driver_response * 60) + $message_time;
        echo $time_of_return;
}

?>

<script type="text/javascript">
    function timer(time,update,complete) {
    var start = new Date().getTime();
    var interval = setInterval(function() {
        var now = time-(new Date().getTime()-start);
        if( now <= 0) {
            clearInterval(interval);
            complete();
        }
        else update(Math.floor(now/1000));
    },100); // the smaller this number, the more accurate the timer will be
    }
    
    timer(
    "<?php echo $time_to_return * 1000 ?>", // milliseconds
    function(timeleft) { // called every step to update the visible countdown
        document.getElementById('timer').innerHTML = timeleft+" second(s)";
    },
    function() { // what to do after
        alert("Timer complete!");
    }
    );
    

</script>

<html>
    <h1>countdown</h1>
    <span id="timer"></span>
</html>