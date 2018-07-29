<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="assets/css/wallet.css" rel="stylesheet">
    <link href="assets/css/dashboard.css" rel="stylesheet">
    <link href="assets/css/address.css" rel="stylesheet">
    <link href="assets/css/sendcoins.css" rel="stylesheet">
    <link href="assets/css/settings.css" rel="stylesheet">

    <title><?=$fullname?> Wallet</title>

</head>
<body>

    <?php if (!defined("IN_WALLET")) { die("Auth Error!"); } ?>
    <div class="background-container">
        <div class="tabs">
            <button class="tablinks" onclick="switchTab(event, 'Dashboard')" id="defaultOpen">Dashboard</button>
            <button class="tablinks" onclick="switchTab(event, 'Addresses')">Addresses</button>
            <button class="tablinks" onclick="switchTab(event, 'SendCoins')">Send Coins</button>
            <button class="tablinks" onclick="switchTab(event, 'Settings')">Settings</button>
        </div>
        <div id="Dashboard" class="tabcontent">
            <div class="dashboard-status">
                <div class="status-error"><?php echo $lang['WALLET_ERROR']; ?></div>
                <?php if (!empty($error)) {
                    echo "<p style='margin-left: 15px; margin-top: 0px; font-family: Poppins; font-size: 16px; font-weight: 400; font-weight: bold; color: red;'>" . $error['message']; "</p>";
                } ?>
            </div>
            <div class="dashboard-overview">
                <div class="dashboard-user"><?php echo $lang['WALLET_HELLO']; ?></div>
                <div class="user-text"><strong><?php echo $user_session; ?></strong>  <?php if ($admin) {?><strong><font color="red">[Admin]</font><?php }?></strong></div>
                <div class="dashboard-balance"><?php echo $lang['WALLET_BALANCE']; ?></div>
                <div class="balance-text"><strong id="balance"><?php echo satoshitize($balance); ?></strong> <?=$short?></strong></div>
            </div>
            <div class="dashboard-transaction">
                <div class="transaction-text"><?php echo $lang['WALLET_LAST10']; ?></div>
                <div class="transaction-table">
                    <table class="dashboard-table-format" id="txlist">
                        <tbody>
                        <?php $bold_txxs = ""; foreach($transactionList as $transaction) {
                            if($transaction['category']=="send") { $tx_type = 'Sent'; } else { $tx_type = 'Received'; }
                                echo '<tr>
                                      <td>'.date('n/j/Y h:i a',$transaction['time']).'</td>
                                      <td>'.$transaction['address'].'</td>
                                      <td>'.$tx_type.'</td>
                                      <td>'.abs($transaction['amount']).'</td>
                                      <td>'.$transaction['fee'].'</td>
                                      <td>'.$transaction['confirmations'].'</td>
                                      <td><a href="' . $blockchain_tx_url,  $transaction['txid'] . '" target="_blank">Info</a></td>
                                      </tr>';
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="Addresses" class="tabcontent">
            <div class="address-new">
                <form action="index.php" method="POST" id="newaddressform">
                    <input type="hidden" name="action" value="new_address" />
                    <button type="submit" class="generate-address"><?php echo $lang['WALLET_NEWADDRESS']; ?></button>
                </form>
            </div>
            <div class="address-list">
              <div class="address-text"><?php echo $lang['WALLET_USERADDRESSES']; ?></div>
                <div class="address-table">
                    <table class="address-table-format" id="alist">
                        <tbody>
                            <?php foreach ($addressList as $address) {
                                echo "<tr><td style='font-weight: bold; font-family: Poppins; font-size: 18px; font-weight: 400; color: #34495f';>".$address."</t>";?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="SendCoins" class="tabcontent">
            <div class="sendcoins-container">
                <div class="sendcoins-text"><?php echo $lang['WALLET_SEND']; ?></div>
                <form action="index.php" method="POST" class="clearfix" id="withdrawform">
                    <input type="hidden" name="action" value="withdraw" />
                    <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                    <div class="sendcoins-input"><input type="text" class="form-control" name="address" placeholder="<?php echo $lang['WALLET_ADDRESS']; ?>"></div>
                    <div class="sendcoins-input"><input type="text" class="form-control" name="amount" placeholder="<?php echo $lang['WALLET_AMOUNT']; ?>"></div>
                    <button type="submit" class="create-transaction"><?php echo $lang['WALLET_SENDCONF']; ?></button>
                </form>
                <p id="withdrawmsg"></p>
            </div>
        </div>
        <div id="Settings" class="tabcontent">
            <div class="settings-container">
                <div class="settings-text"><?php echo $lang['WALLET_SETTINGS']; ?></div>
                <form action="index.php" method="POST">
                <?php if ($admin) { ?>
                <p><strong>Admin Links:</strong></p>
                <a href="?a=home">Admin Dashboard</a>
                <br />
                <br />
                <p><strong><?php echo $lang['WALLET_USERLINKS']; ?></strong></p>
                <?php } ?>
                <form>
                    <input type="hidden" name="action" value="logout" />
                    <button class="logout" type="submit"><?php echo $lang['WALLET_LOGOUT']; ?></button>
                </form>
                <form action="index.php" method="POST">
                    <input type="hidden" name="action" value="support" action="index.php"/>
                    <button class="support" type="submit"><?php echo $lang['WALLET_SUPPORT']; ?></button>
                </form>
            </div>
            <div class="twofa-container">
                <div class="twofa-text"><?php echo $lang['WALLET_SETTINGS']; ?></div>
                <form action="index.php" method="POST">
                <form>
                    <input type="hidden" name="action" value="authgen" />
                    <button class="twofa-on" type="submit"><?php echo $lang['WALLET_2FAON']; ?></button>
                </form><p>
                <form action="index.php" method="post">
                <form>
                    <input type="hidden" name="action" value="disauth" />
                    <button  class="twofa-off" type="submit"><?php echo $lang['WALLET_2FAOFF']; ?></button>
                </form>
            </div>
            <div class="password-update">
                <div class="password-text"><?php echo $lang['WALLET_PASSUPDATE']; ?></div>
                <form action="index.php" method="POST" class="clearfix" id="pwdform">
                    <input type="hidden" name="action" value="password" />
                    <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                    <div class="settings-input"><input type="password" class="form-control" name="oldpassword" placeholder="<?php echo $lang['WALLET_PASSUPDATEOLD']; ?>"></div>
                    <div class="settings-input"><input type="password" class="form-control" name="newpassword" placeholder="<?php echo $lang['WALLET_PASSUPDATENEW']; ?>"></div>
                    <div class="settings-input"><input type="password" class="form-control" name="confirmpassword" placeholder="<?php echo $lang['WALLET_PASSUPDATENEWCONF']; ?>"></div>
                    <div class="change-password"><button type="submit" class="btn btn-default"><?php echo $lang['WALLET_PASSUPDATECONF']; ?></button></div>
                </form>
                <p id="pwdmsg"></p>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        document.getElementById("defaultOpen").click();
        var blockchain_tx_url = "<?=$blockchain_tx_url?>";
        $("#withdrawform input[name='action']").first().attr("name", "jsaction");
        $("#newaddressform input[name='action']").first().attr("name", "jsaction");
        $("#pwdform input[name='action']").first().attr("name", "jsaction");

        $("#withdrawform").submit(function(e) {
            var postData = $(this).serializeArray();
            var formURL = $(this).attr("action");
            $.ajax({
                url : formURL,
                type: "POST",
                data : postData,
                success:function(data, textStatus, jqXHR){
                    var json = $.parseJSON(data);
                    if (json.success) {
                        $("#withdrawform input.form-control").val("");
                        $("#withdrawmsg").text(json.message);
                        $("#withdrawmsg").css("color", "green");
                        $("#withdrawmsg").show();
                        updateTables(json);
                    } else {
                        $("#withdrawmsg").text(json.message);
                        $("#withdrawmsg").css("color", "red");
                        $("#withdrawmsg").show();
                    } if (json.newtoken) {
                        $('input[name="token"]').val(json.newtoken);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    //ugh, gtfo
                }
            });
            e.preventDefault();
        });

        $("#newaddressform").submit(function(e) {
            var postData = $(this).serializeArray();
            var formURL = $(this).attr("action");
            $.ajax({
                url : formURL,
                type: "POST",
                data : postData,
                success:function(data, textStatus, jqXHR){
                    var json = $.parseJSON(data);
                    if (json.success){
                        $("#newaddressmsg").text(json.message);
                        $("#newaddressmsg").css("color", "green");
                        $("#newaddressmsg").show();
                        updateTables(json);
                    } else {
                        $("#newaddressmsg").text(json.message);
                        $("#newaddressmsg").css("color", "red");
                        $("#newaddressmsg").show();
                    } if (json.newtoken){
                        $('input[name="token"]').val(json.newtoken);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    //ugh, gtfo
                }
            });
            e.preventDefault();
        });

        $("#pwdform").submit(function(e) {
            var postData = $(this).serializeArray();
            var formURL = $(this).attr("action");
            $.ajax({
                url : formURL,
                type: "POST",
                data : postData,
                success:function(data, textStatus, jqXHR) {
                    var json = $.parseJSON(data);
                    if (json.success){
                        $("#pwdform input.form-control").val("");
                        $("#pwdmsg").text(json.message);
                        $("#pwdmsg").css("color", "green");
                        $("#pwdmsg").show();
                    } else {
                        $("#pwdmsg").text(json.message);
                        $("#pwdmsg").css("color", "red");
                        $("#pwdmsg").show();
                    } if (json.newtoken) {
                        $('input[name="token"]').val(json.newtoken);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    //ugh, gtfo
                }
            });
            e.preventDefault();
        });

        function updateTables(json) {
            $("#balance").text(json.balance.toFixed(8));
        	  $("#alist tbody tr").remove();
        	  for (var i = json.addressList.length - 1; i >= 0; i--) {
        	      $("#alist tbody").prepend("<tr><td>" + json.addressList[i] + "</td></tr>");
        	  }
        	  $("#txlist tbody tr").remove();
        	  for (var i = json.transactionList.length - 1; i >= 0; i--) {
        	      var tx_type = '<b style="color: #01DF01;">Received</b>';
        		    if(json.transactionList[i]['category']=="send") {
        			      tx_type = '<b style="color: #FF0000;">Sent</b>';
        		    }
        		    $("#txlist tbody").prepend('<tr> \
                       <td>' + moment(json.transactionList[i]['time'], "X").format('l hh:mm a') + '</td> \
                       <td>' + json.transactionList[i]['address'] + '</td> \
                       <td>' + tx_type + '</td> \
                       <td>' + Math.abs(json.transactionList[i]['amount']) + '</td> \
                       <td>' + (json.transactionList[i]['fee']?json.transactionList[i]['fee']:'') + '</td> \
                       <td>' + json.transactionList[i]['confirmations'] + '</td> \
                       <td><a href="' + blockchain_tx_url.replace("%s", json.transactionList[i]['txid']) + '" target="_blank">Info</a></td> \
                </tr>');
            }
        }

        function switchTab(evt, tab) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tab).style.display = "block";
            evt.currentTarget.className += " active";
        }

    </script>

</body>
</html>
