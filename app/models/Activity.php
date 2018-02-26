<?php

namespace DroplineMVC\Models;

use DroplineMVC\Core\Model;
use PDO;

class Activity extends Model
{
    public function getActivities()
    {
        $stmt = $this->db->prepare('CALL Drops_GetTotalNumOfDrops()');
        $statusAll[] = $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $row ? $rows[key($row)] = $row[key($row)] : $rows['error'] = true;

        $stmt = $this->db->prepare('CALL Users_GetTotalNumOfUsers()');
        $statusAll[] = $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $row ? $rows[key($row)] = $row[key($row)] : $rows['error'] = true;

        $stmt = $this->db->prepare('CALL Drops_GetAvgDropsPostedPerDay()');
        $statusAll[] = $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $row ? $rows[key($row)] = $row[key($row)] : $rows['error'] = true;

        $stmt = $this->db->prepare('CALL Drops_GetLatestDrop()');
        $statusAll[] = $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
        $rows['Drops_GetLatestDrop'] = $row;

        } else {
            $rows['error'] = true;
        }

        $stmt = $this->db->prepare('CALL Drops_GetDropAvgLength()');
        $statusAll[] = $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $row ? $rows[key($row)] = $row[key($row)] : $rows['error'] = true;

        $stmt = $this->db->prepare('CALL User_GetUserWithMostNumOfDrops()');
        $statusAll[] = $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $rows['User_GetUserWithMostNumOfDrops'] = $row;

        } else {
            $rows['error'] = true;
        }

//        // Debug
//        foreach ($row as $key => $value) {
//            echo "Key:" . $key . " &nbsp;&nbsp;&nbsp; Value:" . $value ."<br/>";
//        }

        if (in_array(false, $statusAll)) {
            $statusAll = false;
        }

        if (array_key_exists('error', $rows)) {
            $rows = false;
        }

        if ($statusAll and $rows) {
            // Statement execution status - success
            return array(\ModelReturnStatus::SUCCESS, $rows);
        } else {
            // Statement execution status - failure
            return array(\ModelReturnStatus::FAILURE_GENERAL, null);
        }


        /////// Testing - Return all the data as output parameters with one stored procedure call
        /*
        $stmt = $this->db->prepare('CALL Activity_UsersDrops(
        @Drops_TotalNumOfDrops, @Users_TotalNumOfUsers, @Drops_PostedPerDayAvg, @Drops_LastPostedDrop, @Drops_LastPostedUser,
        @Drops_AvgLength,@Users_MostDropsName,@Users_MostDropsNum)');
        $status1 = $stmt->execute();

        $stmt = $this->db->prepare('SELECT
        @Drops_TotalNumOfDrops, @Users_TotalNumOfUsers, @Drops_PostedPerDayAvg, @Drops_LastPostedDrop, @Drops_LastPostedUser,
        @Drops_AvgLength,@Users_MostDropsName,@Users_MostDropsNum');
        $status2 = $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

//        // Debug
//        foreach ($row as $key => $value) {
//            echo "Key:" . $key . " &nbsp;&nbsp;&nbsp; Value:" . $value ."<br/>";
//        }

        if ($status1 and $status2 and $row) {
            // Statement execution status - success
            return array(\ModelReturnStatus::SUCCESS, $row);
        } else {
            // Statement execution status - failure
            return array(\ModelReturnStatus::FAILURE_GENERAL, null);
        }
        */
    }
}