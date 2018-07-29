<?php

namespace services;

use exceptions\UnauthorizedAccessException;
use PDO;

class DbService extends Service
{

    /** @var  $configService ConfigService */
    private $configService;

    /** @var  $helperService HelperService */
    private $helperService;

    /**
     * DbService constructor.
     */
    public function __construct($configService, $helperService){
        $this->configService = $configService;
        $this->helperService = $helperService;
    }

    public function getConnection(){
        $dbName = $this->configService->get('db_name');
        $dbHost = $this->configService->get('db_host');
        $dbUsr = $this->configService->get('db_usr');
        $dbPwd = $this->configService->get('db_pwd');
        $dbPort = $this->configService->get('db_port');

        return new PDO("mysql:dbname=$dbName;host=$dbHost;port=$dbPort", $dbUsr, $dbPwd);
    }

    /**
     * @param $email
     * @param $pwd
     * @return mixed
     */
    public function findUserByMailAndPassword($email, $pwd) {
        $pdo = $this->getConnection();
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

    /* IPT: TODO: A MODO DE EJEMPLO */

    /**
     * Stores the answers for the given user.
     *
     * @param $userId - int
     * @return mixed
     */
    public function insertAnswers($userId, $answers) {
        if (!$this->helperService->isUserLoggedByUserId($userId)) {
            // Server error, because this unauthorized can only happen because some error in the code.
            throw new UnauthorizedAccessException("Unauthorized access", 500);
        }
        $pdo = $this->getConnection();
        $sql = 'insert into Answers (answer_text, option_fk, user_fk) values (:answer_text, :option_fk, :user_fk)';
        $stmt = $pdo->prepare($sql);
        foreach($answers as $answer) {
            $optionFk = $answer['optionId'];
            $answerText = isset($answer['answerText']) ? $answer['answerText']: '';
            $stmt->bindParam(':answer_text', $answerText, PDO::PARAM_STR);
            $stmt->bindParam(':option_fk', $optionFk, PDO::PARAM_INT);
            $stmt->bindParam(':user_fk', $userId, PDO::PARAM_INT);
            $stmt->execute();
        }

        $pdo = null;

    }

}