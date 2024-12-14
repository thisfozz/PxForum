<?php

class UserEntity {
    private string $user_id;
    private string $login;
    private string $email;
    private string $password_hash;
    private string $display_name;
    private string $role_id;
    private DateTimeImmutable $created_at;
    private DateTimeImmutable $updated_at;
    private bool $is_deleted;

    private static function generateUUID(): string {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }


    public function __construct(
        string $login,
        string $email,
        string $password
    ) {
        $this->user_id = self::generateUUID();
        $this->login = $login;
        $this->email = $email;
        $this->password_hash = $password;
        $this->display_name = $login;
        $this->created_at = new DateTimeImmutable();
        $this->updated_at = new DateTimeImmutable();
        $this->is_deleted = false;
    }

    function GetId():string{
        return $this->user_id;
    }

    function GetLogin():string {
        return $this->login;
    }

    function GetEmail():string{
        return $this->email;
    }

    function GetPasswordHash():string{
        return $this->password_hash;
    }

    function GetDisplayName():string{
        return $this->display_name;
    }

    function GetRoleId():string{
        return $this->role_id;
    }

    function GetCreatedAt():DateTimeImmutable{
        return $this->created_at;
    }

    function GetUpdatedAt():DateTimeImmutable{
        return $this->updated_at;
    }

    function IsDeleted():bool{
        return $this->is_deleted;
    }
}

?>