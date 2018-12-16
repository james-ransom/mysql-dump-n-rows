# mysql-dump-n-rows
This tool dumps the first n rows of all the tables in your database.  This is useful for populating test data sets. 

# How to run it 

Open creds.php file, and set these variables

  $servername = "127.0.0.1";
  $username = "[YOUR_DB_USERNAME]"; 
  $password = "[YOUR_PASSWORD]";
  $dbname = "[YOUR_DB_NAME";
  $max_rows_per_table = 1000; 

To use: 

    ruby run.rb > all-tables-with-n-rows.sql 
    
