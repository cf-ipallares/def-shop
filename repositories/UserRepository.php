<?php

namespace repositories;

use model\User;
use services\DbService;
use services\HelperService;
use services\Service;
use PDO;

class UserRepository extends Service
{
    /** @var  $dbService DbService */
    private $dbService;

    /** @var  $helperService HelperService */
    private $helperService;

    /**
     * UserRepository constructor.
     *
     * @param $dbService
     * @param $helperService
     */
    public function __construct($dbService, $helperService)
    {
        $this->dbService = $dbService;
        $this->helperService = $helperService;
    }

    /**
     * Checks whether there is a user logged with received email.
     * If not checks in the database whether there is a macth with given emaill and password.
     * If there is a user in session or DB returns User object with its info.
     * If not, returns null.
     *
     * @param $email
     * @param $pwd
     * @return bool|mixed
     */
    public function loginUser($email, $pwd) {
        $userObj = $this->helperService->getUserObjFromSession($email);
        if ($userObj == null) {
            if ( $user =  $this->dbService->findUserByMailAndPassword($email, $pwd) ) {
                $_SESSION['loggedin'] = true;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_id'] = $user->CID;
                $_SESSION['user_survey_done'] = $user->is_survey_done;
                $_SESSION['user_lang_id'] = $user->lang_fk;
                /** @var $userObj User */
                $userObj = $this->helperService->getUserObjFromSession($email);
            }
        }
        return $userObj;
    }

    /**
     * @param $email
     * @param $pwd
     * @return mixed
     */
    public function findUserByMailAndPassword($email, $pwd) {
        $pdo = $this->dbService->getConnection();
        $sql = "select * from UserDB where Email = :email and Password = :pwd";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $pwdMd5 = md5($pwd);
        $stmt->bindParam(':pwd', $pwdMd5, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_OBJ);
        $pdo = null;

        return $user;
    }

    /**
     * Inserts a user in the DB
     *
     * @param string $name
     * @param string $email
     * @param string $pwd
     * @return bool
     */
    public function createUser(string $name, string $email, string $pwd) {
        $pdo = $this->dbService->getConnection();
        $sql = "insert into Users(name, email, password) values (:name, :email, :password)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', md5($pwd), PDO::PARAM_STR);
        $user = $stmt->execute();

        $pdo = null;

        // NOTE: Here is necessary to do some error management with $stmt->errorInfo() and catching exceptions

        return $user;
    }
}