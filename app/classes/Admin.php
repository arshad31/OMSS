<?php

namespace App\classes;

use Dompdf\Dompdf;
use http\Params;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class Admin
{
    public function getAllCommitteesByAdminID($adminID){
        $link = Database::dbConnection(); /* database connection*/
        $query = "SELECT c.*, a.first_name, a.last_name FROM committees as c JOIN (SELECT * FROM users WHERE user_id = '$adminID') as a ON c.committee_admin = '$adminID'";
        if(mysqli_query($link, $query)){
            $queryResult = mysqli_query($link, $query);
            return $queryResult;
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }
    public function getCommitteeInfoByCommitteeID($committeeId){
        $link = Database::dbConnection(); /* database connection*/
        $query = "SELECT * FROM committees WHERE committee_id = '$committeeId'";

        if(mysqli_query($link, $query)){
            $queryResult = mysqli_query($link, $query);
            return $queryResult;
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }

    public function getCommitteeMemberInfoByCommitteeID($committeeId){
        $link = Database::dbConnection(); /* database connection*/
        $query = "SELECT * FROM users WHERE user_id IN (SELECT c_user_id FROM committee_users WHERE committee_id = '$committeeId')";

        if(mysqli_query($link, $query)){
            $queryResult = mysqli_query($link, $query);
            return $queryResult;
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }

    public function getActiveUsers(){
        $link = Database::dbConnection(); /* database connection*/
        $query = "SELECT * FROM users WHERE is_active = '1'";

        if(mysqli_query($link, $query)){
            $queryResult = mysqli_query($link, $query);
            return $queryResult;
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }

    public function setCommitteeMembers($committeeId, $membersData){
        $link = Database::dbConnection(); /* database connection*/
        $committeeMembersId = array_keys($membersData);
        foreach($committeeMembersId as $committeeMemberId) {
            $uID=mysqli_fetch_assoc(mysqli_query($link, "SELECT c_user_id FROM committee_users WHERE committee_id = '$committeeId' AND c_user_id='$committeeMemberId'"));
            if($uID["c_user_id"]!=NULL){
                continue;
            }else{
                $query = "INSERT INTO committee_users (c_user_id, committee_id, is_active) VALUES ('$committeeMemberId', '$committeeId', '1')";
                if (mysqli_query($link, $query)) {
                    continue;
                } else {
                    die("Query problem: " . mysqli_error($link));
                }
            }
        }
        header("Location: committees-details.php?committee_id=$committeeId");
    }

    public function removeCommitteeMemberByCommitteeID($userAndCommitteeId){
        $link = Database::dbConnection(); /* database connection*/
        $uID= $userAndCommitteeId['user_id'];
        $cID= $userAndCommitteeId['committee_id'];
        $query = "DELETE FROM committee_users WHERE c_user_id = '$uID' AND committee_id = '$cID' ";
        if(mysqli_query($link, $query)){
            header("Location: committees-details.php?committee_id=$cID");
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }

    public function setAgendas($meetingId, $agendas){
        $link = Database::dbConnection(); /* database connection*/
        mysqli_query($link, "DELETE FROM meeting_agenda WHERE meeting_id = '$meetingId'");
        foreach ($agendas as $agenda){
            $query = "INSERT INTO meeting_agenda (meeting_id, agenda) VALUES ('$meetingId', '$agenda')";
            if (mysqli_query($link, $query)) {
                continue;
            } else {
                die("Query problem: " . mysqli_error($link));
            }
        }
        return "Meeting has been successfully Created";
    }

    public function setMeetingData($meetingData, $adminID, $committeeId){
        $link = Database::dbConnection(); /* database connection*/
        $query = "INSERT INTO meetings (meeting_id, committee_id, office, meeting_date, meeting_time_start, meeting_time_end, description, meeting_admin_id) VALUES ('$meetingData[meeting_id]', '$committeeId', '$meetingData[office]', '$meetingData[date]', '$meetingData[time_from]', '$meetingData[time_to]', '$meetingData[description]', '$adminID')";
        if (mysqli_query($link, $query)) {
            return "Ok";
        } else {
            die("Query problem: " . mysqli_error($link));
        }
    }

    public function setAgendasDecision($meetingId, $agendaDecision){
        $link = Database::dbConnection(); /* database connection*/
        mysqli_query($link, "DELETE FROM meeting_decision WHERE meeting_id = '$meetingId'");
        for($i = 1; $i <= (sizeof($agendaDecision)/2); $i++){
            $x='agendaId'.$i;
            $y='decision'.$i;
            $query = "INSERT INTO meeting_decision (agenda_id, meeting_id, decision) VALUES ('$agendaDecision[$x]', '$meetingId', '$agendaDecision[$y]')";
            if (mysqli_query($link, $query)) {
                continue;
            }
            else {
                die("Query problem: " . mysqli_error($link));
            }
        }
        $query = "UPDATE meetings SET m_action ='2' WHERE meeting_id = '$meetingId'";
        if (mysqli_query($link, $query)) {
            return "Decision has been updated successfully";
        } else {
            die("Query problem: " . mysqli_error($link));
        }
    }

    public function userAttendance($meetingId, $ua){
        $link = Database::dbConnection(); /* database connection*/
        $key = [];
        $key = array_keys($ua);
        $val = [];
        $val = array_values($ua);
        for($i=0;$i<sizeof($ua);$i++){
            $a=$key[$i];
            $query = "INSERT INTO attendance (meeting_id,user_id, attendance_status) VALUES ('$meetingId', '$a', '$val[$i]')";
            if (mysqli_query($link, $query)) {
                continue;
            }
            else {
                die("Query problem: " . mysqli_error($link));
            }
        }
    }

    public function guestAttendance($meetingId, $ga){
        $link = Database::dbConnection(); /* database connection*/
        $key = [];
        $key = array_keys($ga);
        $val = [];
        $val = array_values($ga);
        for($i=0;$i<sizeof($ga);$i++){
            $a=$key[$i];
            $query = "INSERT INTO attendance (meeting_id,guest_id, attendance_status) VALUES ('$meetingId', '$a', '$val[$i]')";
            if (mysqli_query($link, $query)) {
                continue;
            }
            else {
                die("Query problem: " . mysqli_error($link));
            }
        }
    }

    public function getAllMeetingsByAdminID($adminID){
        $link = Database::dbConnection(); /* database connection*/
        date_default_timezone_set('Asia/Dhaka');
        $d = date("Y-m-d");
        $query = "SELECT meetings.meeting_id, meetings.meeting_date, meetings.meeting_time_start, meetings.meeting_time_end, meetings.description, meetings.m_action, committees.committee_name  FROM meetings INNER JOIN committees ON meetings.committee_id = committees.committee_id WHERE meeting_admin_id = '$adminID' AND  (m_action = '1' OR m_action = '4') AND meeting_date >= '$d'";

        if(mysqli_query($link, $query)){
            $queryResult = mysqli_query($link, $query);
            return $queryResult;
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }

    public function getUpcomingMeetingsByAdminID($adminID){
        $link = Database::dbConnection(); /* database connection*/
        date_default_timezone_set('Asia/Dhaka');
        $d = date("Y-m-d");
        $query = "SELECT meetings.meeting_id, meetings.meeting_date, meetings.meeting_time_start, meetings.meeting_time_end, meetings.description, meetings.m_action, committees.committee_name  FROM meetings INNER JOIN committees ON meetings.committee_id = committees.committee_id WHERE meeting_admin_id = '$adminID' AND  (m_action = '1' OR m_action = '4') AND meeting_date >= '$d' ";

        if(mysqli_query($link, $query)){
            $queryResult = mysqli_query($link, $query);
            return $queryResult;
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }

    public function getPreviousMeetingsByAdminID($adminID){
        $link = Database::dbConnection(); /* database connection*/
        date_default_timezone_set('Asia/Dhaka');
        $d = date("Y-m-d");
        $query = "SELECT meetings.meeting_id, meetings.meeting_date, meetings.meeting_time_start, meetings.meeting_time_end, meetings.description, meetings.m_action, committees.committee_name FROM meetings INNER JOIN committees ON meetings.committee_id = committees.committee_id WHERE meeting_admin_id = '$adminID' AND (m_action = '1' OR m_action = '2' OR m_action = '4') AND meeting_date < '$d' ";

        if(mysqli_query($link, $query)){
            $queryResult = mysqli_query($link, $query);
            return $queryResult;
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }

    public function getMeetingData($MeetingID, $adminID){
        $link = Database::dbConnection(); /* database connection*/
        $query = "SELECT meetings.meeting_id, meetings.office, meetings.meeting_date, meetings.meeting_time_start, meetings.meeting_time_end, meetings.description, meetings.committee_id, meetings.m_action, committees.committee_name  FROM meetings INNER JOIN committees ON meetings.committee_id = committees.committee_id WHERE meeting_id = '$MeetingID' AND meeting_admin_id = '$adminID'";

        if(mysqli_query($link, $query)){
            $queryResult = mysqli_query($link, $query);
            return $queryResult;
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }

    public function getMeetingAgenda($MeetingID){
        $link = Database::dbConnection(); /* database connection*/
        $query = "SELECT agenda_id,agenda FROM meeting_agenda WHERE  meeting_id = '$MeetingID'";

        if(mysqli_query($link, $query)){
            $queryResult = mysqli_query($link, $query);
            return $queryResult;
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }

    public function getAgendaDecisionByMeetingID($MeetingID){
        $link = Database::dbConnection(); /* database connection*/
        $query = "SELECT decision FROM meeting_decision WHERE meeting_id = '$MeetingID' ";

        if(mysqli_query($link, $query)){
            $queryResult = mysqli_query($link, $query);
            return $queryResult;
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }

    public function getCommitteeUserDataByCommitteeID($committeeID){
        $link = Database::dbConnection(); /* database connection*/
        $query = "SELECT committee_users.c_user_id,users.first_name,users.last_name,users.designation FROM users INNER JOIN committee_users ON users.user_id = committee_users.c_user_id WHERE committee_id = '$committeeID'";

        if(mysqli_query($link, $query)){
            $queryResult = mysqli_query($link, $query);
            return $queryResult;
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }

    public function getGuestDataByMeetingID($MeetingID){
        $link = Database::dbConnection(); /* database connection*/
        $query = "SELECT guest_id,guest_name,designation FROM guest  WHERE meeting_id = '$MeetingID';";

        if(mysqli_query($link, $query)){
            $queryResult = mysqli_query($link, $query);
            return $queryResult;
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }

    public function getUserAttendanceByMeetingID($MeetingID){
        $link = Database::dbConnection(); /* database connection*/
        $query = "SELECT users.first_name, users.last_name, users.office, users.designation, attendance.attendance_status FROM users INNER JOIN attendance ON users.user_id = attendance.user_id WHERE meeting_id = '$MeetingID'";

        if(mysqli_query($link, $query)){
            $queryResult = mysqli_query($link, $query);
            return $queryResult;
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }

    public function getGuestAttendanceByMeetingID($MeetingID){
        $link = Database::dbConnection(); /* database connection*/
        $query = "SELECT guest.guest_name,guest.office,guest.designation, attendance.attendance_status FROM guest INNER JOIN attendance ON guest.guest_id = attendance.guest_id WHERE attendance.meeting_id = '$MeetingID' ";

        if(mysqli_query($link, $query)){
            $queryResult = mysqli_query($link, $query);
            return $queryResult;
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }

    public function UpdateMeetingData($meetingData, $MeetingID){
        $link = Database::dbConnection(); /* database connection*/
        $query = "UPDATE meetings SET meeting_date = '$meetingData[meeting_date]', meeting_time_start = '$meetingData[meeting_time_start]', meeting_time_end = '$meetingData[meeting_time_end]', description = '$meetingData[description]' WHERE meeting_id = '$MeetingID'";
        if (mysqli_query($link, $query)) {
            return "Meeting has been updated successfully";
        } else {
            die("Query problem: " . mysqli_error($link));
        }
    }

    public function setGuestData($guestData){
        $link = Database::dbConnection(); /* database connection*/
        $query = "INSERT INTO guest (meeting_id, guest_name, email, office, designation) VALUES ('$guestData[meetingId]',  '$guestData[guest_name]', '$guestData[email]', '$guestData[office]', '$guestData[designation]')";
        if (mysqli_query($link, $query)) {
            return "Ok";
        } else {
            die("Query problem: " . mysqli_error($link));
        }
    }

    public function meetingActionUpdate($meetingID){
        $link = Database::dbConnection(); /* database connection*/
        $query = "SELECT m_action FROM meetings WHERE meeting_id = '$meetingID'";
        $activeStatus = "";
        if(mysqli_query($link, $query)){
            $row =  mysqli_fetch_assoc(mysqli_query($link, $query));
            $actionStatus = $row['m_action'];
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
        if($actionStatus == 1){
            $query = "UPDATE meetings SET m_action ='4' WHERE meeting_id = '$meetingID'" ;
        }
        else{
            $query = "UPDATE meetings SET m_action ='1' WHERE meeting_id = '$meetingID'" ;
        }
        if(mysqli_query($link, $query)){
            header('location: manage-meetings.php');
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }

    public function getCommitteeUserEmailByCommitteeID($committeeID){
        $link = Database::dbConnection(); /* database connection*/
        $query = "SELECT users.email FROM users INNER JOIN committee_users ON users.user_id = committee_users.c_user_id WHERE committee_id = '$committeeID' ";

        if(mysqli_query($link, $query)){
            $queryResult = mysqli_query($link, $query);
            return $queryResult;
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }

    public function getGustEmailByMeetingID($meetingID){
        $link = Database::dbConnection(); /* database connection*/
        $query = "SELECT email FROM guest  WHERE meeting_id = '$meetingID' ";

        if(mysqli_query($link, $query)){
            $queryResult = mysqli_query($link, $query);
            return $queryResult;
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }

    public function sendMail($mailData,$committeeUsersEmail,$adminName,$pdfPath){
        $mail = new PHPMailer();

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'xxxxxx@xxx.xxx'; //give your email here
            $mail->Password   = 'xxxxxxx'; //give your email password here
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 25;
            $mail->SMTPSecure = 'tls';
            $mail->setFrom('xxxxxx@xxx.xxx', $adminName); //give your email here that you have given into 390 no line
            foreach ($committeeUsersEmail as $cUEmail){
                $mail->addAddress($cUEmail);
            }
            $mail->addAttachment($pdfPath);
            $mail->isHTML(true);
            $mail->Subject = $mailData["subject"];
            $mail->Body    = $mailData["body-one"].'<br><br>'.$mailData["body-two"].'<br><br>'.$mailData["body-three"];
            $mail->send();
            return 'Message has been sent!';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function generatePdf($pdf){

        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setIsHtml5ParserEnabled(true);
        $dompdf->loadHtml($pdf);
        $dompdf->render();
        $dompdf->stream();
    }

}
