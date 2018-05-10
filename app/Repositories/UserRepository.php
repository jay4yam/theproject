<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 09/05/2018
 * Time: 11:46
 */

namespace App\Repositories;

use App\Models\Compagnie;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var Profile
     */
    protected $profile;

    /**
     * UserRepository constructor.
     * @param User $user
     * @param Profile $profile
     */
    public function __construct(User $user, Profile $profile)
    {
        $this->user = $user;
        $this->profile = $profile;
    }

    /**
     * Retourne un utilisateur via son id
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function getById($id)
    {
        return $this->user->findOrFail($id);
    }

    /**
     * Retourne la liste de tous les utilisateurs
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll()
    {
        return $this->user->with('profile')->paginate(10);
    }

    /**
     * Gère l'enregistrement d'un nouvel utilisateur
     * @param $request
     */
    public function store($request)
    {
        $user = new User();

        $this->save($user, $request);
    }

    /**
     * Gère la sauvegarde du nouveau model user
     * @param User $user
     * @param $request
     */
    private function save(User $user, $request)
    {
        //On utilise une transaction afin que si la requete compagnie echoue, on rollback la création de l'utilisateur
        \DB::transaction(function () use ($user, $request) {

            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role = $request->role;

            //on sauv. le model
            $user->save();

            //enfin si la requête contient une compagnie
            if($request->compagnie){
                //on associe l'utilisateur et sa compagnie avec la méthode attach.
                $user->compagnie()->attach($request->compagnie);
            }

        });
    }

    /**
     * Met à jour les infos de l'utilisateur et crée un profil si il n'existe pas
     * @param $id
     * @param $request
     */
    public function update($id, $request)
    {
        //recup l'utilisateur à updater
        $user = $this->getById($id);

        //met à jours la table users
        $user->update(['email' => $request->email, 'role' => $request->role]);

        if(count($user->compagnie)){
            //Recupére l'id associée à la table compagnies_users
            $oldCompagny = $user->compagnie()->first()->pivot->compagny_id;

            //Supprimer le lien avec l'ancienne compagnie
            $user->compagnie()->detach($oldCompagny);

            //Attache l'utilisateur et la compagnie dans la table "compagnies_users"
            $user->compagnie()->attach($request->compagnie);
        }

        //Test si le model user et profile sont liés
        if( $user->profile()->count() == 0)

            //si le model n'est pas lié à un profil
            //On insère les informations en base
            $user->profile()->create([
                'firstName' => $request->firstName,
                'fullName' => $request->fullName,
                'birthDate' => $request->birthDate,
                'phoneNumber' => $request->phoneNumber,
                'address' => $request->address,
                'postalCode' => $request->postalCode,
                'city' => $request->city,
                'country' => $request->country
            ]);
        else{

            //si le model 'user' est déjà lié à un model 'profile'
            //On met à jour les informations en base
            $user->profile()->update([
                'firstName' => $request->firstName,
                'fullName' => $request->fullName,
                'birthDate' => $request->birthDate,
                'phoneNumber' => $request->phoneNumber,
                'address' => $request->address,
                'postalCode' => $request->postalCode,
                'city' => $request->city,
                'country' => $request->country
            ]);
        }
    }
}