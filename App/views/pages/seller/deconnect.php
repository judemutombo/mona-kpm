<?php

use App\DbAuth\DbAuth;

DbAuth::getAuth(App::getInstance()->get_Db())->deconnexion();

header("Location: ../account");