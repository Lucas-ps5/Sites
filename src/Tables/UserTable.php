<?php
namespace App\Tables;
use App\Model\User;
use PDO;

class UserTable {

    private $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function register(User $user) : ?string
    {   
        if(!$this->verify_unique($user->getEmail())){
            $query = $this->pdo->prepare("INSERT INTO user SET firstname = :firstname, lastname = :lastname, country = :country, password = :password, email = :email");
            $ok = $query->execute([
                'firstname' => $user->getFirstname(),
                'lastname' => $user->getLastname(),
                'country' => $user->getCountry(),
                'password' => password_hash($user->getPassword(), PASSWORD_BCRYPT),
                'email' =>$user->getEmail()
            ]);
            if($ok === false){
                return <<<HTML
                    <div class="register-error">
                        <p>Erreur ! Veuillez soumettre a nouveau.</p>
                    </div>
HTML;
            }
        }if($this->verify_unique($user->getEmail()) === true){
            return <<<HTML
                    <div class="register-error">
                        <p>Erreur ! Cette adresse email est deja utilisee !</p>
                    </div>
HTML;
        }
        return <<<HTML
        <div class="register-succes">
            <p>Inscription reussie.</p>
        </div>
HTML;
    }

    public function verify_unique(string $email) : bool
    {
        $items = $this->pdo->prepare("SELECT * FROM user WHERE email = ?");
        $items->execute([$email]);
        $result = $items->fetch();

        if($result === false){
            return false;
        }
        return true;
    }

    public function findByemail(string $email) : ?User
    {
        $item = $this->pdo->prepare("SELECT * FROM user WHERE email = ?");
        $item->execute([$email]);
        $item->setFetchMode(PDO::FETCH_CLASS, User::class);
        $result = $item->fetch() ?: null;

        return $result;
    }

    public function findByName(string $name) : ?User
    {
        $item = $this->pdo->prepare("SELECT * FROM user WHERE firstname = ?");
        $item->execute([$name]);
        $item->setFetchMode(PDO::FETCH_CLASS, User::class);
        $result = $item->fetch() ?: null;

        return $result;
    }


}