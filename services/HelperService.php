<?php
/**
 * Created by PhpStorm.
 * User: ipallares
 * Date: 18.11.17
 * Time: 22:35
 */

namespace services;


use constants\Constants;
use model\User;

class HelperService extends Service
{
    /**
     * For testing purposes
     *
     * @param $msg
     *
     */
    public function echoTestDescription($msg) {
        echo "<h2>$msg</h2>";
    }

    /**
     * For testing purposes
     *
     * @param $msg
     *
     */
    public function echoTestFail($msg) {
        echo "<div style='background-color:red;color:white;'>$msg</div>";
    }

    /**
     * For testing purposes
     *
     * @param $msg
     *
     */
    public function echoTestSuccess($msg) {
        echo "<div style='background-color:green;color:white;'>$msg</div>";
    }

    /**
     * Cleans session info from the user logged.
     */
    public function logOut() {
        unset($_SESSION['loggedin']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_survey_done']);
        unset($_SESSION['user_lang_id']);
        unset($_SESSION['user_id']);
    }

    /**
     * Checks whether the recieved userId is the same as the one for the user in session.
     *
     * @param $userId
     * @return bool
     */
    public function isUserLoggedByUserId( $userId ) {
        return isset($_SESSION) && isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['user_id'] == $userId;
    }

    /**
     * Checks whether the recieved email is the same as the one for the user in session.
     *
     * @param $userEmail
     * @return bool
     */
    public function isUserLoggedByEmail( $userEmail ) {
        return isset($_SESSION) && isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['user_email'] == $userEmail;
    }

    /**
     * Checks whether there is a user logged in session.
     *
     * @return bool
     */
    public function isUserLogged() {
        return
            isset($_SESSION['loggedin']) && !empty($_SESSION['loggedin']) &&
            isset($_SESSION['user_email']) && !empty($_SESSION['user_email']) &&
            isset($_SESSION['user_survey_done']) &&
            isset($_SESSION['user_lang_id']) && !empty($_SESSION['user_lang_id']) &&
            isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
    }

    /**
     * Generates a User object (Model) from the info in session
     *
     * @param $email
     * @return User|null
     */
    public function getUserObjFromSession($email) {
        $userObj = null;
        if ($this->isUserLogged() && $this->isUserLoggedByEmail($email)) {
            $userObj = new User($_SESSION['user_id'], $_SESSION['user_email'], $_SESSION['user_survey_done'], $_SESSION['user_lang_id']);
        }
        return $userObj;
    }

    /**
     * Convenience method to check permissions and handle the error if unauthorized.
     */
    public function checkAuthorizedRequest() {
        if (!$this->isUserLogged()) {
            http_response_code(401);
            header('Content-Type: application/json');
            echo json_encode(['error_msg' => "Unauthorized"]);
            die;
        }
    }

    /**
     * Convenience method to handle control errors. Handles two messages, one with technical details and information potentially confidential
     * which will be output to the error log and a public message to inform the user about the problem.
     *
     * @param $logErrorMsg
     * @param string $pubicErrorMsg
     */
    public function respondServerError( $logErrorMsg, $pubicErrorMsg = "Internal error server, please contact the administrator") {
        error_log($logErrorMsg);
        http_response_code(500);
        header('Content-Type: application/json');
        echo json_encode(['error_msg' => $pubicErrorMsg]);
        die;
    }

}