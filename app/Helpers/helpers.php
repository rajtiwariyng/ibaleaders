<?php
use App\Models\Connection;
use App\Models\Eventapply;
use App\Models\Notifications;


if (!function_exists('greet_user')) {
    function greet_user($name) {
        return "Hello, $name!";
    }
}
if (!function_exists('checkUserConnectionStatus')) {
    function checkUserConnectionStatus($userid) {
        // return $userid.' '.auth()->id();
        $connection = Connection::where('sender_id', $userid)
        ->where('receiver_id', auth()->id())
        // ->where("status","approved")
        ->first();
        return $connection;
    }
}
if (!function_exists('checkEventApplyStatus')) {
    function checkEventApplyStatus($eventid) {
        $eventapply = Eventapply::where('event_id', $eventid)
        ->where('user_id', auth()->id())->where('status', 'active')->first();
        return $eventapply;
    }
}
if (!function_exists('countEventApplyUser')) {
    function countEventApplyUser($eventid) {
        $eventapply = Eventapply::where('event_id', $eventid)->where('status', 'active')->get();
        return $eventapply;
    }
}
if (!function_exists('createNotificationsData')) {
    function createNotificationsData($data) {
        Notifications::create($data);
        
        return response()->json(['success' => true, 'message' => 'Notification Added Successfully!']);
    }
}