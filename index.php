<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
 
  <title>Import CSV File into MySQL using PHP</title>
 
  <style>
    .custom-file-input.selected:lang(en)::after {
      content: "" !important;
    }
 
    .custom-file {
      overflow: hidden;
    }
 
    .custom-file-input {
      white-space: nowrap;
    }
  </style>
</head>
 
<body>
 
  <div class="container">
    <form action="upload.php" method="post" enctype="multipart/form-data">
      <div class="input-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="customFileInput" aria-describedby="customFileInput" name="file">
          <label class="custom-file-label" for="customFileInput">Select file</label>
        </div>
        <div class="input-group-append">
           <input type="submit" name="submit" value="Upload" class="btn btn-primary">
        </div>
      </div>
  </form>
  </div>
 <div class="col-md-12 mt-5">
                 <table id='dataTable1' class="table table-striped table-dark" style="width:100%">
                      <thead>
                      <tr>
                        <th>ID</th>
                        <th>Wallet Address</th>
                        <th>Date</th>
                        <th>Ip Address hash</th>
                        <th>Twitter username</th>
                        <th>Twitter id</th>
                        <th>Twitter follower count</th>
                        <th>discord username</th>
                        <th>discord id</th>
                        <th>Eth balance at registration</th>
                        <th>disqualified</th>
                        <th>custom field</th>
                      </tr>
                      </thead>                
                  </table>
            </div>
            <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script> -->
<script type="text/javascript">
    $(document).ready(function () {
      var table = $('#dataTable1').DataTable({
        processing: true,
        serverSide: true,
         ajax: {
            "url": "ajaxfile.php",
            "dataType": "json",
            "type": "POST",
         },
         "columns": [
                { "data": "id" },
                { "data": "wallet_address",orderable: true},
                { "data": "trigger_date",orderable: true },
                { "data": "ip_address_hash",orderable: true },
                { "data": "twitter_username",orderable: true },
                { "data": "twitter_id",orderable: true },
                { "data": "twitter_follower_count",orderable: true },
                { "data": "discord_username",orderable: true },
                { "data": "discord_id",orderable: true },
                { "data": "eth_balance_at_registration",orderable: true },
                { "data": "disqualified",orderable: true },
                { "data": "custom_field",orderable: true },
         ]  
      });

      

   });
     
   // transction_deposit._fetch_data_dep();
</script>
</body>
 
</html>