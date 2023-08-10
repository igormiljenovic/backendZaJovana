<?php
include 'inc/header.php';

Session::CheckSession();

$logMsg = Session::get('logMsg');
if (isset($logMsg)) {
  echo $logMsg;
}
$msg = Session::get('msg');
if (isset($msg)) {
  echo $msg;
}
Session::set("msg", NULL);
Session::set("logMsg", NULL);
?>
<?php

if (isset($_GET['remove'])) {
  $remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove']);
  $removeUser = $users->deleteUserById($remove);
}

if (isset($removeUser)) {
  echo $removeUser;
}
if (isset($_GET['deactive'])) {
  $deactive = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['deactive']);
  $deactiveId = $users->userDeactiveByAdmin($deactive);
}

if (isset($deactiveId)) {
  echo $deactiveId;
}
if (isset($_GET['active'])) {
  $active = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['active']);
  $activeId = $users->userActiveByAdmin($active);
}

if (isset($activeId)) {
  echo $activeId;
}


 ?>

<style type="text/css">
.search-container {
    position: relative;
    width: 400px;
}

.search-bar {
    width: 100%;
    padding: 10px 40px 10px 10px;
    border: none;
    background-color: #fff;
    color: #222;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    background-image: url('assets/icons/search-icon.png');
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 20px 20px;
}

.search-bar:focus {
    outline: none;
    animation: glowing 1s infinite;
}

@keyframes glowing {
    0% {
        box-shadow: 0 0 5px #9ecaed;
    }

    50% {
        box-shadow: 0 0 20px #9ecaed;
    }

    100% {
        box-shadow: 0 0 5px #9ecaed;
    }
}
</style>

<div class="card d-flex flex-column align-items-center">
    <div class="card-header d-flex flex-row justify-content-between" style="height:200px;width:100%">
        <div><?php $username=Session::get('username');

if (isset($username)) {
    echo $username;
}

?></div>
        <div class="float-right">UPDATE: </div>
    </div><?php if (Session::get('roleid')=='3') {
    ?><div class="d-flex flex-column justify-content-center align-items-center my-5" style="width:30%">
        <h1 class="mb-5">Kontrolni panel</h1>
        <div class="mt-5 mb-5 search-container">
            <input type="text" class="search-bar" placeholder="Pretraži...">
        </div>

    </div>
    <div class="d-flex flex-row justify-content-around align-items-stretch align-content-stretch mt-5"
        style="width:70%">
        <div class="d-flex flex-row" style="width:25%">
            <div class="text-center mr-3"><img src="assets/icons/policy.svg" class="img-fluid mx-auto" width="50"></div>
            <div class="d-flex flex-column">
                <h3 class="text-left">Polisa</h3>
                <p class="text-justify">Pregled polisa, prebaci polisu</p>
            </div>
        </div>
        <div class="d-flex flex-row" style="width:25%">
            <div class="text-center mr-3"><img src="assets/icons/project-management.svg" class="img-fluid mx-auto"
                    width="50"></div>
            <div class="d-flex flex-column">
                <h3 class="text-left">Plan Premije</h3>
                <p class="text-justify"></p>
            </div>
        </div>
        <div class="d-flex flex-row" style="width:25%">
            <div class="text-center mr-3"><img src="assets/icons/accounting.svg" class="img-fluid mx-auto" width="50">
            </div>
            <div class="d-flex flex-column">
                <h3 class="text-left">Avans</h3>
                <p class="text-justify">Unos avansa, stanje avansa, prebaci avans</p>
            </div>
        </div>
        <div class="d-flex flex-row" style="width:25%">
            <div class="text-center mr-3"><img src="assets/icons/businessman.svg" class="img-fluid mx-auto" width="50">
            </div>
            <div class="d-flex flex-column">
                <h3 class="text-left">Zastupnik</h3>
                <p class="text-justify">Unos zastupnika, unos master zastupnika</p>
            </div>
        </div>
    </div>
    <div class="d-flex flex-row justify-content-around align-items-stretch align-content-stretch mt-5"
        style="width:70%">
        <div class="d-flex flex-row" style="width:25%">
            <div class="text-center mr-3"><img src="assets/icons/payment-method.svg" class="img-fluid mx-auto"
                    width="50"></div>
            <div class="d-flex flex-column">
                <h3 class="text-left">Troškovi</h3>
                <p class="text-justify">Unos i pregled troškova, prebaci trošak</p>
            </div>
        </div>
        <div class="d-flex flex-row" style="width:25%">
            <div class="text-center mr-3"><img src="assets/icons/discount.svg" class="img-fluid mx-auto" width="50">
            </div>
            <div class="d-flex flex-column">
                <h3 class="text-left">Popusti</h3>
                <p class="text-justify">Pregled popusta</p>
            </div>
        </div>
        <div class="d-flex flex-row" style="width:25%">
            <div class="text-center mr-3"><img src="assets/icons/import.svg" class="img-fluid mx-auto" width="50"></div>
            <div class="d-flex flex-column">
                <h3 class="text-left">Import</h3>
                <p class="text-justify">Import polisa iz Insurance, import Pujp polisa, import korekcija, import
                    troškova zastupnika, import avansa</p>
            </div>
        </div>
        <div class="d-flex flex-row" style="width:25%">
            <div class="text-center mr-3"><img src="assets/icons/logout.svg" class="img-fluid mx-auto" width="40"></div>
            <div class="d-flex flex-column">
                <h3 class="text-left">Odjavi se</h3>
                <p class="text-justify">opisssssssssss s s s s s s s </p>
            </div>
        </div>
    </div><?php
}

;

?><?php if (Session::get('roleid')=='1') {
    ?><div class="card-body pr-2 pl-2">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">SL</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Username</th>
                    <th class="text-center">Email address</th>
                    <th class="text-center">Mobile</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Created</th>
                    <th width='25%' class="text-center">Action</th>
                </tr>
            </thead>
            <tbody><?php $allUser=$users->selectAllUserData();

    if ($allUser) {
        $i=0;

        foreach ($allUser as $value) {
            $i++;

            ?><tr class="text-center" <?php if (Session::get("id")==$value->id) {
                echo "style='background:#d9edf7' ";
            }

            ?>>
                    <td><?php echo $i;
            ?></td>
                    <td><?php echo $value->name;
            ?></td>
                    <td><?php echo $value->username;

            ?><br><?php if ($value->roleid=='1') {
                echo "<span class='badge badge-lg badge-info text-white'>Admin</span>";
            }

            elseif ($value->roleid=='2') {
                echo "<span class='badge badge-lg badge-dark text-white'>Editor</span>";
            }

            elseif ($value->roleid=='3') {
                echo "<span class='badge badge-lg badge-dark text-white'>User Only</span>";
            }

            ?></td>
                    <td><?php echo $value->email;
            ?></td>
                    <td><span class="badge badge-lg badge-secondary text-white"><?php echo $value->mobile;

            ?></span></td>
                    <td><?php if ($value->isActive=='0') {
                ?><span class="badge badge-lg badge-info text-white">Active</span><?php
            }

            else {
                ?><span class="badge badge-lg badge-danger text-white">Deactive</span><?php
            }

            ?></td>
                    <td><span class="badge badge-lg badge-secondary text-white"><?php echo $users->formatDate($value->created_at);

            ?></span></td>
                    <td><?php if (Session::get("roleid")=='1') {
                ?><a class="btn btn-success btn-sm
" href="profile.php?id=<?php echo $value->id;

                ?>">View</a>
                        <a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id;?>">Edit</a><a
                            onclick="return confirm('Are you sure To Delete ?')" class="btn btn-danger
<?php if (Session::get("id")==$value->id) {
                    echo "disabled";
                }

                ?>btn-sm " href="?remove=<?php echo $value->id;
                ?>">Remove</a>


                        <?php if ($value->isActive=='0') {
                    ?><a onclick="return confirm('Are you sure To Deactive ?')" class="btn btn-warning
<?php if (Session::get("id")==$value->id) {
                        echo "disabled";
                    }

                    ?>btn-sm " href="?deactive=<?php echo $value->id;
                    ?>">Disable</a>
                        <?php
                }

                elseif($value->isActive=='1') {
                    ?><a onclick="return confirm('Are you sure To Active ?')" class="btn btn-secondary
<?php if (Session::get("id")==$value->id) {
                        echo "disabled";
                    }

                    ?>btn-sm " href="?active=<?php echo $value->id;
                    ?>">Active</a>
                        <?php
                }

                ?><?php
            }

            elseif(Session::get("id")==$value->id && Session::get("roleid")=='2') {
                ?><a class="btn btn-success btn-sm " href="profile.php?id=<?php echo $value->id;?>">View</a><a
                            class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id;?>">Edit</a><?php
            }

            elseif(Session::get("roleid")=='2') {
                ?><a class="btn btn-success btn-sm
<?php if ($value->roleid=='1') {
                    echo "disabled";
                }

                ?>" href="profile.php?id=<?php echo $value->id;

                ?>">View</a>
                        <a class="btn btn-info btn-sm
<?php if ($value->roleid=='1') {
                    echo "disabled";
                }

                ?>" href="profile.php?id=<?php echo $value->id;
                ?>">Edit</a>
                        <?php
            }

            elseif(Session::get("id")==$value->id && Session::get("roleid")=='3') {
                ?><a class="btn btn-success btn-sm " href="profile.php?id=<?php echo $value->id;?>">View</a><a
                            class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id;?>">Edit</a><?php
            }

            else {
                ?><a class="btn btn-success btn-sm
<?php if ($value->roleid=='1') {
                    echo "disabled";
                }

                ?>" href="profile.php?id=<?php echo $value->id;
                ?>">View</a>

                        <?php
            }

            ?>
                    </td>
                </tr><?php
        }
    }

    else {
        ?><tr class="text-center">
                    <td>No user availabe now !</td>
                </tr><?php
    }

    ?></tbody>
        </table>
    </div>
</div><?php
}

else {
    ?><?php
}

;
?>
<?php include 'inc/footer.php';

?>