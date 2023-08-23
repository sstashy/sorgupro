<?php

namespace jesuzweq;

class ZFunctions extends System{

    public static function getUserViaSession() {
        $user = self::table('users')->where('userAuthKey', $_SESSION['authKey'])->first();

        $array = [
            'userName' => $user->userName,
            'userVerified' => $user->userVerified,
            'userModerator' => $user->userModerator,
            'userOS' => $user->userOS,
            'userBrowser' => $user->userBrowser,
            'userTime' => $user->userTime,
            'userRole' => $user->userRole,
            'userLog' => $user->userLog
        ];

        return $array;
    }

    public static function convertUserRole() {
        $user = self::table('users')->where('userAuthKey', $_SESSION['authKey'])->first();
        $userRoleInt = $user->userRole;

        $roleName = "";

        if ($userRoleInt == 1) {
            $roleName = "Admin";
        }
        if ($userRoleInt == 2) {
            $roleName = "Haftalık";
        } 
        if ($userRoleInt == 3) {
            $roleName = "Aylık";
        } 
        if ($userRoleInt == 4) {
            $roleName = "Yıllık";
        }

        return $roleName;
    }

    public static function convertUserRoleViaId($id) {
        $idd = self::filter($id);
        $user = self::table('users')->where('id', $idd)->first();
        $userRoleInt = $user->userRole;

        $roleName = "";

        if ($userRoleInt == 1) {
            $roleName = "Admin";
        }
        if ($userRoleInt == 2) {
            $roleName = "Haftalık";
        }
        if ($userRoleInt == 3) {
            $roleName = "Aylık";
        } 
        if ($userRoleInt == 4) {
            $roleName = "Yıllık";
        }

        return $roleName;
    }

    public static function converRoleViaInt($x)
    {
        $x = self::filter($x);
        if ($x == 1) {
            $roleName = "Admin";
        }
        if ($x == 2) {
            $roleName = "Haftalık";
        }
        if ($x == 3) {
            $roleName = "Aylık";
        }
        if ($x == 4) {
            $roleName = "Yıllık";
        }

        return $roleName;
    }
    
    public static function updateUser() {
        $name = self::filter($_POST['userNameM']);
        $anahtar = self::filter($_POST['anahtarKey']);
        $id = self::filter($_POST['saveBtn']);
        $yetki = self::filter($_POST['membership']);
        $hesapDurumu = self::filter($_POST['status']);
        $endTime = self::filter($_POST['endTime']);
        $resetIp = self::filter(@$_POST['resetIp']);
        $multiCheck = self::filter(@$_POST['multisecureCheck']);

        $today = date('Y-m-d');

        switch ($yetki) {
            case 2:
                $endTime = date('Y-m-d', strtotime($today . ' + 1 weeks'));
                break;
            case 3:
                $endTime = date('Y-m-d', strtotime($today . ' + 1 months'));
                break;
            case 4:
                $endTime = date('Y-m-d', strtotime($today . ' + 1 years'));
                break;
        }

        if($resetIp) {
            self::table('users')->where('id', $id)->update([
                'userLog' => null,
                'userAuthKey' => $anahtar,
                'userName' => $name,
                'userVerified' => true,
                'userTime' => $endTime,
                'userRole' => $yetki,
                'multiCheck' => $multiCheck
            ]);
            return "başarılı";
        }

        self::table('users')->where('id', $id)->update([
            'userAuthKey' => $anahtar,
            'userName' => $name,
            'userVerified' => $hesapDurumu,
            'userTime' => $endTime,
            'userRole' => $yetki,
            'multiCheck' => $multiCheck
        ]);
        return "Başarılı";
    }
    
    public static function deleteUser($id) {
        $id = self::filter($id);
        self::table('users')->where('id', $id)->delete();
        return "Başarılı";
    }

    public static function createuser() {
        $kullaniciAdi = self::filter($_POST['userName']);
        $uyelikTipi = self::filter($_POST['uyelikTipi']);
        $moderator = self::filter($_POST['userModerator']);
        $authAnahtar = bin2hex(random_bytes(20));
        $endTime = "";

        $today = date('Y-m-d');

        switch ($uyelikTipi) {
            case 2:
                $endTime = date('Y-m-d', strtotime($today . ' + 1 weeks'));
                break;
            case 3:
                $endTime = date('Y-m-d', strtotime($today . ' + 1 months'));
                break;
            case 4:
                $endTime = date('Y-m-d', strtotime($today . ' + 1 years'));
                break;
        }

        $createUser = self::table('users')->create([
            'userName' => $kullaniciAdi,
            'userRole' => $uyelikTipi,
            'userModerator' => $moderator,
            'userAuthKey' => $authAnahtar,
            'userTime' => $endTime,
            'userVerified' => 1
        ]);
    }

    public static function adminControl() {
        $User = self::filter(@$_SESSION['authKey']);
        $userInfo = self::table('users')->where('userAuthKey', $User)->first();
        if($userInfo->userRole != 1) {
            header("Location: /panel");
            exit();
        }
    }

    public static function roleControl() {
        $User = self::filter(@$_SESSION['authKey']);
        $userInfo = self::table('users')->where('userAuthKey', $User)->first();
        if($userInfo->userRole == 0){
            header("Location: /login");
            session_destroy();
            @ob_clean();
            exit();
        }
    }

    public static function authControl() {
        $User = self::filter(@$_SESSION['authKey']);
        if($User) {
            return true;
        } else {
            header("Location: /login");
            session_destroy();
            @ob_clean();
            exit();
        }
        $userInfo = self::table('users')->where('userAuthKey', $User)->first();
        if(!$userInfo) {
            header("Location: /login");
            session_destroy();
            @ob_clean();
            exit();
        }
    }

    public static function apiControl() {
        session_start();
        $User = self::filter(@$_SESSION['authKey']);
        if($User) {
            return true;
        } else {
            return false;
        }
    }

    public static function logOut() {
        session_destroy();
        @ob_clean();
        header("Location: /login");
        exit();
    }

    public static function isAllowed($ip) {
        $whitelist = array('20.199.82.120');

        // If the ip is matched, return true
        if(in_array($ip, $whitelist)) {
            return true;
        }

        foreach($whitelist as $i){
            $wildcardPos = strpos($i, "*");

            // Check if the ip has a wildcard
            if($wildcardPos !== false && substr($ip, 0, $wildcardPos) . "*" == $i) {
                return true;
            }
        }

        return false;
    }

    public static function getIp() {
        $ip = "";
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }
}