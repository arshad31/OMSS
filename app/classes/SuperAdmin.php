<?php

namespace App\classes;

class SuperAdmin
{
    public function superAdminRegistration($data) {
        //print_r($data);
        $link = Database::dbConnection(); /* database connection*/

            $query = "INSERT INTO super_admin (super_admin_id, first_name, last_name, email, phone, organization, designation, password)
                  VALUES ('$data[id]', '$data[first_name]', '$data[last_name]', '$data[email]', '$data[phone]', '$data[organization]',
                  '$data[designation]', md5('$data[password]'))";
            if(mysqli_query($link, $query)){
                header("Location: index.php");
            }
            else{
                die("Query problem". mysqli_error($link));
            }
    }

    public function superAdminLogin($data){
        $link = Database::dbConnection(); /* database connection*/
        $email = $data["email"];
        $password = md5($data["password"]);
        $query = "SELECT * FROM super_admin WHERE email='$email' AND password='$password'";
        if (mysqli_query($link, $query)) {
            $queryResult = mysqli_query($link, $query); /* execute query */
            $superAdmin = mysqli_fetch_assoc($queryResult);

            if ($superAdmin) {
                /* store required info inside session for an active user */
                session_start();
                $_SESSION["super_admin_id"] = $superAdmin["super_admin_id"];
                $_SESSION["email"] = $superAdmin["email"];
                $_SESSION["first_name"] = $superAdmin["first_name"];
                $_SESSION["last_name"] = $superAdmin["last_name"];
                header("Location: dashboard.php");
            }
            else {
                return "Invalid login";
            }
        }
        else {
            die("Query problem: ". mysqli_error($link));
        }
    }

    public function getSuperAdminInfo() {
        $link = Database::dbConnection(); /* database connection*/

        $query = "SELECT first_name,last_name,email,phone,organization,designation,password FROM super_admin";
        if(mysqli_query($link, $query)){
            //header("Location: index.php");
            return mysqli_query($link, $query);
        }
        else{
            die("Query problem". mysqli_error($link));
        }
    }

    public function superAdminInfoUpdate($sAdmin) {
        //print_r($data);
        $link = Database::dbConnection(); /* database connection*/
        if($sAdmin['password']==NULL) {
            $query = "UPDATE super_admin SET first_name = '$sAdmin[first_name]',last_name = '$sAdmin[last_name]',email = '$sAdmin[email]',phone = '$sAdmin[phone]',organization = '$sAdmin[organization]',designation = '$sAdmin[designation]'";
        }
        else{
            $query = "UPDATE super_admin SET first_name = '$sAdmin[first_name]',last_name = '$sAdmin[last_name]',email = '$sAdmin[email]',phone = '$sAdmin[phone]',organization = '$sAdmin[organization]',designation = '$sAdmin[designation]', password = md5('$sAdmin[password]')";
        }

        if(mysqli_query($link, $query)){
            header("Location: super-admin-profile.php");
        }
        else{
            die("Query problem". mysqli_error($link));
        }
    }

    public function officeCreation($data) {
        //print_r($data);
        $link = Database::dbConnection(); /* database connection*/

        $query = "INSERT INTO office (office_id, office_name)
                  VALUES ('$data[office_id]', '$data[office_name]')";
        if(mysqli_query($link, $query)){
            return "Office added";
        }
        else{
            die("Query problem". mysqli_error($link));
        }
    }

    public function committeeCreation($data) {
        //print_r($data);
        $link = Database::dbConnection(); /* database connection*/

        $query = "INSERT INTO committees (committee_id, committee_name, committee_admin, email, phone, office)
                  VALUES ('$data[committee_id]', '$data[committee_name]', '$data[committee_admin]', '$data[email]', '$data[phone]', '$data[office]')";
        if(mysqli_query($link, $query)){
            //header("Location: create-committee.php");
            return "Committee Created";
        }
        else{
            die("Query problem". mysqli_error($link));
        }
    }

    public function getAllCommittees(){
        $link = Database::dbConnection(); /* database connection*/
        $query = "SELECT committees.committee_id, committees.committee_name, committees.email, committees.phone, committees.is_active, users.first_name, users.last_name, committees.office, committees.is_active
                  FROM committees INNER JOIN users ON committees.committee_admin = users.user_id WHERE users.is_active = '1' ";

        if(mysqli_query($link, $query)){
            $queryResult = mysqli_query($link, $query);
            return $queryResult;
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }

    public function committeeActionUpdate($committeeId){
        $link = Database::dbConnection(); /* database connection*/
        $query = "SELECT is_active FROM committees WHERE committee_id = '$committeeId'";
        $activeStatus = "";
        if(mysqli_query($link, $query)){
            $row =  mysqli_fetch_assoc(mysqli_query($link, $query));
            $activeStatus = $row['is_active'];
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
        if($activeStatus == 1){
            $query = "UPDATE committees SET is_active ='0' WHERE committee_id = '$committeeId'" ;
        }
        else{
            $query = "UPDATE committees SET is_active ='1' WHERE committee_id = '$committeeId'" ;
        }

        if(mysqli_query($link, $query)){
            header('location: manage-committee.php');
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

    public function updateCommitteeInfoByCommitteeID($data, $committeeId){
        $link = Database::dbConnection(); /* database connection*/
        $query = "UPDATE committees SET committee_name = '$data[committee_name]' , committee_admin = '$data[committee_admin]' , email = '$data[email]', phone = '$data[phone]', office = '$data[office]'  WHERE committee_id = '$committeeId'";

        if(mysqli_query($link, $query)){
            $queryResult = mysqli_query($link, $query);
            header('location: committees.php');
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }

    public function getActiveUsers(){
        $link = Database::dbConnection(); /* database connection*/
        $query = "SELECT * FROM users WHERE is_active = '1' or is_active = '2'";

        if(mysqli_query($link, $query)){
            $queryResult = mysqli_query($link, $query);
            return $queryResult;
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }
    public function userActionUpdate($userId){
        $link = Database::dbConnection(); /* database connection*/
        $query = "SELECT is_active FROM users WHERE user_id = '$userId'";
        $activeStatus = "";
        if(mysqli_query($link, $query)){
            $row =  mysqli_fetch_assoc(mysqli_query($link, $query));
            $activeStatus = $row['is_active'];
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
        if($activeStatus == 1){
            $query = "UPDATE users SET is_active ='2' WHERE user_id = '$userId'" ;
        }
        else{
            $query = "UPDATE users SET is_active ='1' WHERE user_id = '$userId'" ;
        }
        if(mysqli_query($link, $query)){
            header('location: manage-users.php');
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }
    public function usersRequest(){
        $link = Database::dbConnection(); /* database connection*/
        $query = "SELECT * FROM users WHERE is_active=0";

        if(mysqli_query($link, $query)){
            return mysqli_query($link, $query);//$queryResult;
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }
    public function acceptUserRequest($userId){
        $link = Database::dbConnection(); /* database connection*/
        $query = "UPDATE users SET is_active ='1' WHERE user_id = '$userId'" ;

        if(mysqli_query($link, $query)){
            header('location: manage-request.php');
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }

    public function declineUserRequest($userId){
        $link = Database::dbConnection(); /* database connection*/
        $query = "DELETE FROM users WHERE user_id = '$userId'" ;

        if(mysqli_query($link, $query)){
            header('location: manage-request.php');
        }
        else{
            die("Query problem: ". mysqli_error($link));
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

    public function getAllUsers(){
        $link = Database::dbConnection(); /* database connection*/
        $query = "SELECT * FROM users WHERE is_active = 1 ";

        if(mysqli_query($link, $query)){
            $queryResult = mysqli_query($link, $query);
            return $queryResult;
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }

    public function removeOffice($officeId){
        $link = Database::dbConnection(); /* database connection*/
        $query = "DELETE FROM office WHERE office_id='$officeId'";

        if(mysqli_query($link, $query)){
            header('location: create-office.php');
        }
        else{
            die("Query problem: ". mysqli_error($link));
        }
    }
}