<?php

namespace App\classes;

class Pdf {

    private $meetingInfo, $agenda,$s;

    public function __construct($data)
    {
        $this->meetingInfo = $data['meetingData'];
        $this->agenda = $data['agenda'];
    }
    public function getString(){
        $str = '<p style="text-align: center;"><span style="font-size:36px"><strong>Meeting Details</strong></span></p>
                <hr />
                <table border="10" cellpadding="10" cellspacing="1"  style="border-color: #96D4D4;"">
                    <tbody>
                        <tr>
                            <td><strong>Meeting ID:</strong></td>
                            <td>'.$this->meetingInfo["meeting_id"].'</td>
                        </tr>
                        <tr>
                            <td><strong>Committee Name:</strong></td>
                            <td>'.$this->meetingInfo["committee_name"].'</td>
                        </tr>
                        <tr>
                            <td><strong>Office:</strong></td>
                            <td>'. $this->meetingInfo["office"].'</td>
                        </tr>
                        <tr>
                            <td><strong>Agenda:</strong></td>
                            <td>';
                        $sNum = 1;
                        while($row=mysqli_fetch_assoc($this->agenda)){
                            $str .='<p>'.$sNum++."."." ".$row['agenda'].'</p>';
                        }
                        $str .= '</td>
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
        return html_entity_decode($str);
    }
}