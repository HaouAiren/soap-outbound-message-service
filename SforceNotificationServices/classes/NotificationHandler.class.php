<?php
class NotificationHandler
{
    public function notifications($messagesData){
        //$rawPost  = "Input:\r\n";
        //$rawPost = file_get_contents('php://input');
        $organizationId = $messagesData->OrganizationId;
        $actionId = $messagesData->actionId;
        $sessionId = $messagesData->sessionId;
        $enterpriseUrl = $messagesData->enterpriseUrl;
        $partnerUrl = $messagesData->partnerUrl;

        if(is_array($messagesData->Notification)){
            $notifications = (array)$messagesData->Notification;

            $rawPost = "Multiple notifications:\r\n";
            for ($i = 0; $i < count($notifications); $i++){
                $rawPost .= "sObject".$i."\r\n";
                $sObject = $notifications[$i]->sObject;
                $rawPost .= $notifications[$i] ->Id;
                $rawPost .="\r\n";
                $rawPost .= $sObject ->Id;
                $rawPost .="\r\n";
                $rawPost .= $sObject ->LastModifiedDate;
                $rawPost .="\r\n";
                $rawPost .= $sObject ->LastName;
                $rawPost .="\r\n";
                $rawPost .= $sObject ->Status;
                $rawPost .="\r\n\r\n";
            }
        } else {
            $notification = $messagesData->Notification;

            $rawPost = "Single sObject:\r\n";
            $sObject = $notification->sObject;
            $rawPost .= $notification->Id;
            $rawPost .="\r\n";
            $rawPost .= $sObject->Id;
            $rawPost .= "\r\n";
            $rawPost .= $sObject->LastModifiedDate;
            $rawPost .= "\r\n";
            $rawPost .= $sObject->LastName;
            $rawPost .= "\r\n";
            $rawPost .= $sObject->Status;
            $rawPost .= "\r\n\r\n";
        }

        $rawPost .= "Serialized messagesData:\r\n";
        $rawPost .=serialize($messagesData);

        file_put_contents("log.txt",$rawPost);
        return array("Ack" => "true");
    }
}

