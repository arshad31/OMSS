<?php
namespace App\classes;

class User{
    private function isAdmin($userId){
        $link = Database::dbConnection();
        $query = "SELECT * FROM committees WHERE committee_admin = '$userId'";
        if(mysqli_query($link, $query)){
            $queryResult = mysqli_query($link, $query);
            $admin = mysqli_fetch_assoc($queryResult);
            if($admin){
                return True;
            }else{
                return FALSE;
            }
        }else{
            die("Query problem");
        }
    }

    function userLogin($data){
        $link = Database::dbConnection();
        $email = $data["email"];
        $password = md5($data["password"]);
        $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        if (mysqli_query($link, $query)) {
            $queryResult = mysqli_query($link, $query);
            $user = mysqli_fetch_assoc($queryResult);

            if ($user) {
                if($user['is_active'] == 1) {
                    session_start();
                    $_SESSION["user_id"] = $user["user_id"];
                    $_SESSION["email"] = $user["email"];
                    $_SESSION["first_name"] = $user["first_name"];
                    $_SESSION["last_name"] = $user["last_name"];
                    if(User::isAdmin($user["user_id"])) {
                        /* If active user is an admin */
                        $_SESSION["is_admin"] = true;
                        header("Location:user-dashboard.php");
                    }else{
                        /* if active user is a normal user */
                        $_SESSION["is_admin"] = false;
                        header("Location: user-dashboard.php");
                    }
                }
                else{
                    $message = "Not an active user! 
                    <br/>
                        <small>Please wait for confirmation or contact with
                            <strong class='text-warning'>super.admin@omss.com</strong>
                        </small>";
                    return $message;
                }
            }
            else {
                $message = "Invalid login";
                return $message;
            }
        }
        else {
            die("Query problem: " . $link);
        }
    }

    public function getUserInfoByUserID($userId){
        $link = Database::dbConnection(); /* database connection*/
        $query = "SELECT * FROM users WHERE user_id = '$userId'";
        if(mysqli_query($link, $query)){
            $queryResult = mysqli_query($link, $query);
            return $queryResult;
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }

    public function userInfoUpdateByID($userInfo,$userId){
        $link = Database::dbConnection(); /* database connection*/
        if($userInfo['password']==NULL){
            $query = "UPDATE users SET first_name = '$userInfo[first_name]',last_name = '$userInfo[last_name]',email = '$userInfo[email]',phone = '$userInfo[phone]',office = '$userInfo[office]',designation = '$userInfo[designation]' WHERE user_id = '$userId'";
        }
        else{
            $query = "UPDATE users SET first_name = '$userInfo[first_name]',last_name = '$userInfo[last_name]',email = '$userInfo[email]',phone = '$userInfo[phone]',office = '$userInfo[office]',designation = '$userInfo[designation]', password = md5('$userInfo[password]') WHERE user_id = '$userId'";
        }
        if(mysqli_query($link, $query)){
            header("Location: user-profile.php");
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }

    function userRegistration($data) {
        $link = Database::dbConnection(); /* database connection*/
        $query = "INSERT INTO users (user_id, first_name, last_name, email, phone, office, designation, password)
                  VALUES ('$data[user_id]', '$data[first_name]', '$data[last_name]', '$data[email]', '$data[phone]', '$data[office]',
                  '$data[designation]', md5('$data[password]'))";
        if(mysqli_query($link, $query)){
            header("Location: index.php");
        }
        else{
            die("Query problem". $link);
        }
    }

    public function getAllOffice(){
        $link = Database::dbConnection(); /* database connection*/
        $query = "SELECT * FROM office";
        if(mysqli_query($link, $query)){
            $queryResult = mysqli_query($link, $query);
            return $queryResult;
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }

    public function getUpcomingMeetingsByUserID($userID){
        $link = Database::dbConnection(); /* database connection*/
        date_default_timezone_set('Asia/Dhaka');
        $d = date("Y-m-d");
        $query = "SELECT meetings.meeting_id, meetings.meeting_date, meetings.meeting_time_start, 
                  meetings.meeting_time_end, meetings.description, meetings.m_action, committees.committee_name
                  FROM meetings INNER JOIN committees ON meetings.committee_id = committees.committee_id INNER JOIN 
                  committee_users ON meetings.committee_id = committee_users.committee_id WHERE c_user_id = '$userID' 
                  AND (m_action = '1' OR m_action = '4') AND meeting_date >= '$d'";

        if(mysqli_query($link, $query)){
            $queryResult = mysqli_query($link, $query);
            return $queryResult;
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }

    public function getPreviousMeetingsByUserID($userID){ //sandbox two
        $link = Database::dbConnection(); /* database connection*/
        date_default_timezone_set('Asia/Dhaka');
        $d = date("Y-m-d");
        $query = "SELECT meetings.meeting_id, meetings.meeting_date, meetings.meeting_time_start, 
                  meetings.meeting_time_end, meetings.description, meetings.m_action, committees.committee_name
                  FROM meetings INNER JOIN committees ON meetings.committee_id = committees.committee_id INNER JOIN 
                  committee_users ON meetings.committee_id = committee_users.committee_id WHERE c_user_id = '$userID' 
                  AND (m_action = '1' OR m_action = '2' OR m_action = '4') AND meeting_date < '$d'";

        if(mysqli_query($link, $query)){
            $queryResult = mysqli_query($link, $query);
            return $queryResult;
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }

    public function getMeetingData($MeetingID){
        $link = Database::dbConnection(); /* database connection*/
        $query = "SELECT meetings.meeting_id, meetings.office, meetings.meeting_date, meetings.meeting_time_start, meetings.meeting_time_end, meetings.description, meetings.m_action, committees.committee_name  FROM meetings INNER JOIN committees ON meetings.committee_id = committees.committee_id WHERE meeting_id = '$MeetingID'";

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
        $query = "SELECT agenda FROM meeting_agenda WHERE  meeting_id = '$MeetingID'";

        if(mysqli_query($link, $query)){
            $queryResult = mysqli_query($link, $query);
            return $queryResult;
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }

    public function getAgendaDecision($MeetingID){
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

}