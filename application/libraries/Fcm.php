<?php

//Define Fcm class
class Fcm {
    //Define SendNotification function
    function sendNotification($dataArr) {   

        //print_r($dataArr);
    	$fcmApiKey = "AAAAtGIC49M:APA91bGswMfISZAMX7e3-rQSYGzXr47Tv0K6ht7FbPtf02ZVwMAYc9l-llULAu-59TU_gcH9Ad9DHAvMQyvYkXlQFbX5xL3LVwuvog2U2gplO_9xilhcBU8ECrChIRCkjoVVeOFOM5PZ" ; //App API Key

        $url = 'https://fcm.googleapis.com/fcm/send';//Google URL

        $registrationIds = $dataArr['token'];//Fcm Device ids array

        //print $registrationIds;
        $message = $dataArr['message'];//Message which you want to send
        $title = $dataArr['title'];
        $type = $dataArr['type'];;
        
        if(is_array($registrationIds)){
            $notificationdata = array('body' => $message,'title' => $title,'type' => $type);
            $fields = array('registration_ids' => $registrationIds ,'notification' => $notificationdata);
        }else{
            $fields = array('to' => $registrationIds ,'body' => $message,'title' => $title,'type' => $type);
        }
        //print_r($fields);
        $headers = array(
            'Authorization: key=' . $fcmApiKey,
            'Content-Type: application/json'
        );
    
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, $url );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch);
        // Execute post
        
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);  
        //print $result;
        return $result;
    }
}





?>
