<?php
// include mysql database configuration file
error_reporting(0);
include_once 'db.php';
 

if (isset($_POST['submit']))
{
 
    // Allowed mime types
    $fileMimes = array(
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
        'text/plain'
    );
 
    // Validate whether selected file is a CSV file
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes))
    {
 
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
 
            // Skip the first line
            fgetcsv($csvFile);
 
            // Parse data from CSV file line by line
             // Parse data from CSV file line by line
            while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
            {
                // echo "<pre>";
                // print_r($getData);
                // exit;
                // Get row data
                $wallet_address = $getData[0];
                $date = $getData[1];
                $ip_address = $getData[2];
                $twitter_username = $getData[3];
                $twitter_id = $getData[4];
                $twitter_follower_count = $getData[5];
                $twitter_account_created = $getData[6];
                $discord_username = $getData[7];
                $discord_id = $getData[8];
                $eth_balance_at_registration = $getData[9];
                $collab = $getData[10];
                $winner = $getData[11];
                $waitlist = $getData[12];
                $disqualified = $getData[13];
               
                if(filter_var($getData[14], FILTER_VALIDATE_EMAIL)) {
                     $custom_field = $getData[14];
                    if(mysqli_query($conn, "INSERT INTO users(wallet_address, trigger_date, ip_address_hash, twitter_username, twitter_id, twitter_follower_count, twitter_account_created, discord_username, discord_id, eth_balance_at_registration, collab, winner, waitlist, disqualified, custom_field) VALUES ('" . $wallet_address . "', '" . $date . "', '" . $ip_address . "', '" . $twitter_username . "','" . $twitter_id . "','" . $twitter_follower_count . "','" . $twitter_account_created . "','" . $discord_username . "','" . $discord_id . "','" . $eth_balance_at_registration . "','" . $collab . "','" . $winner . "','" . $waitlist . "','" . $disqualified . "','" . $custom_field . "')")){
                       echo "New record created successfully";
                    } 
                    else {
                     // echo "Error: ". "<br>" . mysqli_error($conn);
                    }
                    //Valid email!
                }
                else{
                    $custom_field = $getData[14];
                     mysqli_query($conn, "INSERT INTO users(wallet_address, trigger_date, ip_address_hash, twitter_username, twitter_id, twitter_follower_count, twitter_account_created, discord_username, discord_id, eth_balance_at_registration, collab, winner, waitlist, disqualified,not_valid_email) VALUES ('" . $wallet_address . "', '" . $date . "', '" . $ip_address . "', '" . $twitter_username . "','" . $twitter_id . "','" . $twitter_follower_count . "','" . $twitter_account_created . "','" . $discord_username . "','" . $discord_id . "','" . $eth_balance_at_registration . "','" . $collab . "','" . $winner . "','" . $waitlist . "','" . $disqualified . "','" . $custom_field . "')");
               
                }
 
                // If user already exists in the database with the same email
                // $query = "SELECT id FROM users WHERE email = '" . $getData[1] . "'";
 
                // $check = mysqli_query($conn, $query);
 
                // if ($check->num_rows > 0)
                // {
                //     mysqli_query($conn, "UPDATE users SET name = '" . $name . "', phone = '" . $phone . "', status = '" . $status . "', created_at = NOW() WHERE email = '" . $email . "'");
                // }
                // else
                // {
                     
 
            //     }
             }
 
            // Close opened CSV file
            fclose($csvFile);
 
            header("Location: index.php");
         
    }
    else
    {
        echo "Please select valid file";
    }
}