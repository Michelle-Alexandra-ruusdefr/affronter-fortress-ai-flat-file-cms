<?php
/**
 * Simple Auth (file-based)
 */

declare(strict_types=1);

namespace Affronter\Core;

class Auth
{
    private FlatFileStorage $storage;
    private string $sessionKey = 'af_user_id';

    public function __construct(FlatFileStorage $storage)
    {
        $this->storage = $storage;
        session_start();
    }

    public function isLoggedIn(): bool
    {
        return isset($_SESSION[$this->sessionKey]);
    }

    public function login(string $username, string $password): bool
    {
        $users = $this->storage->get('users') ?: [];
        foreach ($users as $user) {
            if ($user['username'] === $username && password_verify($password, $user['hash'])) {
                $_SESSION[$this->sessionKey] = $user['id'];
                return true;
            }
        }
        return false;
    }

    public function logout(): void
    {
        unset($_SESSION[$this->sessionKey]);
    }
}

