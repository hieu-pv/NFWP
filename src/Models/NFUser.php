<?php

namespace NFWP\Models;

use Exception;

class NFUser
{
    public function __construct($user = null)
    {

    }

    /**
     * find user by meta data
     *
     * @param string $meta_key, string $meta_value
     * @return array
     */
    public static function findByMeta($meta_key, $meta_value)
    {
        $users = get_users(['meta_key' => $meta_key, 'meta_value' => $meta_value]);
        return $users;
    }

    /**
     * find user by id
     *
     * @param int $id
     * @return self object or false if no user is found
     */
    public static function find($id)
    {
        $user = get_user_by('id', $id);
        return $user;
    }

    /**
     * find user by id and throw error if no user is found
     *
     * @param int $id
     * @return WP_User object or throw error if no user is found
     */
    public static function findOrFail($id)
    {
        $user = get_user_by('id', $id);
        if ($user == false) {
            throw new Exception("can not find user", 0);
        } else {
            return $user;
        }
    }

    /**
     * get current user
     *
     * @return WP_User object where it can be retrieved using member variables.
     */
    public static function getCurrentUser()
    {
        $user = wp_get_current_user();
        if (isset($user) && $user != false) {
            return $user;
        } else {
            return false;
        }
    }

    /**
     * create new wordpress user and throw exception if an error is occur
     *
     * @param string $username, string $password, string $email
     * @return WP_User
     */
    public function create($username, $password, $email, $display_name = null)
    {
        $username = sanitize_user($username);
        if (isset($username) && username_exists($username)) {
            $i = 1;
            while (username_exists($username)) {
                $i++;
                $username = $username . '_' . $i;
            }
        }
        if (isset($email) && email_exists($email)) {
            $email = null;
        }
        $user_id = wp_create_user($username, $password, $email);
        if (is_wp_error($user_id)) {
            throw new Exception($user_id->get_error_message(), 0);
        } else {
            $user = self::find($user_id);
            if (!isset($display_name)) {
                $display_name = $username;
            }
            $user->__set('display_name', $display_name);
            wp_update_user($user);
            return $user;
        }
    }
}
