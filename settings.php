<?php

$server_url = "/";  // ENTER WEBSITE URL ALONG WITH A TRAILING SLASH

$db_host = "localhost";
$db_user = "root";
$db_pass = "Ab89bLB4y";
$db_name = "wallet";

$rpc_host = "127.0.0.1";
$rpc_port = "46979";
$rpc_user = "stipendrpc";
$rpc_pass = "stipendcrypto";

$fullname = "Stipend"; //Website Title (Do Not include 'wallet')
$short = "SPD"; //Coin Short (BTC)
$blockchain_tx_url = "http://spd.overemo.com/tx/"; //Blockchain Url
$support = "nicksr987@gmail.com"; //Your support eMail
$hide_ids = array(1); //Hide account from admin dashboard
$donation_address = ""; //Donation Address

$reserve = "0.0001"; //This fee acts as a reserve. The users balance will display as the balance in the daemon minus the reserve. We don't reccomend setting this more than the Fee the daemon charges.

?>
