<?php

namespace app\controllers\auth;

use app\middleware\AuthMiddleware;
use app\models\User;
use app\src\Application;
use app\src\Controller;
use app\src\Model;
use app\src\Request;
use app\src\session\FlashMessage;

class PasswordController extends Controller
{
    public function __construct()
    {
        $this->setMiddleware(new AuthMiddleware());
    }

    public function index(): bool|array|string
    {
        return $this->render('auth/edit_password');
    }

    public function update(Request $request)
    {
        $formData = $request->getBody();

        // Haal de huidige gebruiker op uit de database
        $user = (new User)->findByID(Application::$app->session->get('user'));

        // Als het huidige wachtwoord matched, dan kan het gewijzigd worden met het nieuwe wachtwoord
        if (password_verify($formData['currentPassword'], $user['password'])) {

            // Check of het nieuwe wachtwoord gelijk is aan het conformatie wachtwoord
            if ($formData['newPassword'] === $formData['confirmPassword']) {

                $data = [
                    'password' => password_hash($formData['newPassword'], PASSWORD_DEFAULT),
                ];

                // Bewaar nieuw wachtwoord
                (new User)->update($user['user_id'], $data);
            } else {
                FlashMessage::error('Nieuw wachtwoord komt niet overeen.');
            }
        } else {
            FlashMessage::error('Onjuist wachtwoord.');
        }
        Application::$app->response->redirect('/profile/change-password');
    }

}