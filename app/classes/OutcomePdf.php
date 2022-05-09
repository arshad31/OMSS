<?php

namespace App\classes;

class OutcomePdf {

    private $meetingInfo, $agenda,$decision,$ua,$ga;

    public function __construct($data){
        $this->meetingInfo = $data['meetingData'];
        $this->agenda = $data['agenda'];
        $this->decision = $data['decision'];
        $this->ua = $data['uAttendance'];
        $this->ga = $data['gAttendance'];
    }

    public function getPdfData(){

        $str = '<p style="text-align: center;"><span style="font-size:36px"><strong>Meeting Details</strong></span></p>
                <hr />
                        <table border="10" cellpadding="10" cellspacing="1"  style="border-color: #96D4D4;"">
                            <tbody>
                                <tr>
                                    <td><strong>Meeting ID</strong></td>
                                    <td>'.$this->meetingInfo["meeting_id"].'</td>
                                </tr>
                                <tr>
                                    <td><strong>Committee Name</strong></td>
                                    <td>'.$this->meetingInfo["committee_name"].'</td>
                                </tr>
                                <tr>
                                    <td><strong>Office</strong></td>
                                    <td>'. $this->meetingInfo["office"].'</td>
                                </tr>
                                <tr>
                                    <td><strong>Agenda</strong></td>
                                    <td>
                                        <div>
                                            <p>';
                                            $sNum = 1;
                                            while ($row = mysqli_fetch_assoc($this->agenda)){
                                                $rw = mysqli_fetch_assoc($this->decision);
                                                $str .='<p></p>
                                    <div style="border: 1px solid green"><p >&nbsp;&nbsp;'. $sNum++.".&nbsp;&nbsp;".$row['agenda'].'</p>
                                          <p><em><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Decision: </strong>'." ".$rw['decision'].'</em></p></div>';
                                         }
                                $str .=	'</div></td>
                                </tr>      
                                <tr>
                                    <td><strong>Date:</strong></td>
                                    <td>'.strtoupper(date_format(date_create($this->meetingInfo["meeting_date"]),"d/m/Y")).'</td>
                                </tr>
                                <tr>
                                    <td><strong>Time:</strong></td>
                                    <td>'.date('h:i A', strtotime($this->meetingInfo["meeting_time_start"])).'  to  '.date('h:i A', strtotime($this->meetingInfo["meeting_time_start"])).'</td>
                                </tr>
                                <tr>
                                    <td><strong>Description:</strong></td>
                                    <td>
                                    <div>'.$this->meetingInfo["description"].'</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>';
                        $str .='<p style="text-align: center;"><span style="font-size:26px"><strong>Attendance</strong></span></p>
                        <table align="center" border="1" cellpadding="1" cellspacing="1" style="border-color: #96D4D4;">
                            <tbody>
                                <tr>
                                    <td style="text-align: center;"><strong>Name</strong></td>
                                    <td style="text-align: center;"><strong>Office</strong></td>
                                    <td style="text-align: center;"><strong>Designation</strong></td>
                                    <td style="text-align: center;"><strong>Attendance</strong></td>
                                </tr>';
                                while ($row = mysqli_fetch_assoc($this->ua)) {
                                    $str .= '<tr>    
                                    <td style="text-align: center;">' . $row["first_name"] . " " . $row["last_name"] . '</td>
                                    <td style="text-align: center;">' . $row["office"] . '</td>
                                    <td style="text-align: center;">' . $row["designation"] . '</td>';
                                    if ($row["attendance_status"] != 0) {
                                        $str .= '<td style="text-align: center;">Present</td>';
                                    } else {
                                        $str .= '<td style="text-align: center;">Absent</td>';
                                    }
                                    $str .= '</tr >';
                                    }
                                while ($r = mysqli_fetch_assoc($this->ga)) {
                                    $str .= '<tr>    
                        
                                    <td style="text-align: center;">' . $r["guest_name"] . '</td>
                                    <td style="text-align: center;">' . $r["office"] . '</td>
                                    <td style="text-align: center;">' . $r["designation"] . '</td>';
                                    if ($r["attendance_status"] != 0) {
                                        $str .= '<td style="text-align: center;">Present</td>';
                                    } else {
                                        $str .= '<td style="text-align: center;">Absent</td>';
                                    }
                                    $str .= '</tr >';
                                }
                            $str .='</tbody>
                        </table>';
        return html_entity_decode($str);
    }
}