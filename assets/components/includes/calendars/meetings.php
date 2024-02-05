<?php
require_once "../conn.php";
session_start();

$responses = array();

$query = "SELECT m.*, s.color_hex
FROM meetings m 
LEFT JOIN meetings_statuses s 
ON m.status_id = s.id";

$result = $conn->execute_query($query);

while ($row = $result->fetch_object()) {
    $response['id'] = $row->id;
    $response['title'] = $row->topic;
    $response['start'] = $row->date_scheduled . 'T' . $row->time_start;
    $response['end'] = $row->date_scheduled . 'T' . $row->time_end;
    $response['color'] = $row->color_hex;

    $response['extendedProps']['id'] = $row->id;
    $response['extendedProps']['meeting_number'] = $row->meeting_number;
    $response['extendedProps']['requested_by'] = $row->requested_by;
    $response['extendedProps']['topic'] = $row->topic;
    $response['extendedProps']['date_scheduled'] = $row->date_scheduled;
    $response['extendedProps']['time_start'] = $row->time_start;
    $response['extendedProps']['time_end'] = $row->time_end;
    $response['extendedProps']['host_id'] = $row->host_id;
    $response['extendedProps']['status_id'] = $row->status_id;
    $response['extendedProps']['meetingid'] = $row->meetingid;
    $response['extendedProps']['passcode'] = $row->passcode;
    $response['extendedProps']['join_link'] = $row->join_link;
    $response['extendedProps']['start_link'] = $row->start_link;
    $response['extendedProps']['remarks'] = $row->remarks;
    $response['extendedProps']['date_requested'] = $row->date_requested;
    $response['extendedProps']['generated_by'] = $row->generated_by;
    $response['extendedProps']['approved_by'] = $row->approved_by;
    $response['extendedProps']['created_at'] = $row->created_at;
    $response['extendedProps']['updated_at'] = $row->updated_at;


    $responses[] = $response;
}

$jsonEvents = json_encode($responses);

header('Content-Type: application/json');

echo $jsonEvents;
