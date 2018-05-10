<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\CreateCompanyStep2Request;
use App\Http\Requests\CreateUserStep1Request;
use App\Http\Requests\CreateUserStep2Request;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $allUsers = $this->userRepository->getAll();
        }catch (\Exception $exception){

            flash()->error($exception->getMessage());

            return back();
        }

        return view('back.user.index', compact('allUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserStep1Request $request)
    {
        //On essaye de créer et enregistrer un nouvel utilisateur
        try{

            $this->userRepository->store($request);

        }catch (\Exception $exception){

            //Si il y a une exception on redirige vers la page précédente avec un message d'erreur
            flash()->error($exception->getMessage());

            //redirection
            return back()->withInput();
        }

        //Si l'enregistrement est OK, on affiche un message de succès
        flash()->success('Utilisateur crée avec succès');

        //on redirige vers la route listing des users
        return redirect()->route('users.edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //on essaye de recuperer l'utilisateur par son id
        try{
            $user = $this->userRepository->getById($id);

        }catch (\Exception $exception){
            //si il y une exception on renvois un message d'erreur
            flash()->error($exception->getMessage());

            //on redirige ensuite l'utilisateur vers la route user.index
            return redirect()->route('users.index');
        }

        return view('back.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateUserStep2Request $request, $id)
    {
        try{
            $this->userRepository->update($id, $request);
        }catch (\Exception $exception){
            //si il y a une exception on affiche un message d'erreur
            flash()->error($exception->getMessage());

            //on redirige vers la page précedente avec les inputs
            return back()->withInput();
        }

        //si tout est Ok, on affiche un message d'info
        flash()->success('Utilisateur mise à jour avec succès');

        //on redirige l'utilisateur vers la page "users.index".
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
