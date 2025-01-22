<?php
    session_start();
    require_once('../../model/adminModel.php');
    require_once('../Email/sendFeedbackEmail.php');

    if (isset($_REQUEST['submit'])) {
        $helpRequestId = trim($_REQUEST['helpRequestId']);
        $feedbackerId = trim($_REQUEST['feedbackerId']);
        $email = trim($_REQUEST['email']);
        $feedback = trim($_REQUEST['feedback']);

        if (empty($feedback)) {
            $_SESSION['feedback_error'] = "Feedback is required!";
        } elseif (str_word_count($feedback) < 5) {
            $_SESSION['feedback_error'] = "Feedback must contain at least 5 words!";
        }

        if (!isset($_SESSION['feedback_error'])) {
            $updateSuccess = updateFeedbackInDatabase($helpRequestId, $feedbackerId, $feedback);

            if ($updateSuccess) {
                if (sendFeedbackEmail($email, $feedback)) {
                    $_SESSION['feedback_success'] = "Feedback submitted and email sent successfully.";
                    header('location: ../../view/admin/viewHelpRequest.php');
                    exit();
                } else {
                    $_SESSION['feedback_error'] = "Feedback submitted, but email could not be sent.";
                    header('location: ../../view/admin/viewHelpRequest.php');
                    exit();
                }
            } else {
                $_SESSION['feedback_error'] = "Failed to update feedback. Please try again!";
                header('location: ../../view/admin/feedBackHelpRequest.php?helpRequestId=' . $helpRequestId);
                exit();
            }
        }else{
            header('location: ../../view/admin/feedBackHelpRequest.php?helpRequestId=' . $helpRequestId);
            exit();
        }
    } else {
        header('location: ../../view/admin/feedBackHelpRequest.php?helpRequestId=' . $helpRequestId);
        exit();
    }
?>
