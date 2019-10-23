<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 14/05/2018
 * Time: 22:00
 */

namespace App\Repositories;


use App\Models\Comments;
use App\Models\User;
use App\Traits\uploadAvatar;
use Illuminate\Http\Request;

class CommentRepository
{
    use uploadAvatar;
    /**
     * @var Comments
     */
    protected $comments;

    /**
     * CommentRepository constructor.
     * @param Comments $comments
     */
    public function __construct(Comments $comments)
    {
        $this->comments = $comments;
    }

    /**
     * Retourne la liste des commentaires paginées
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll()
    {
        return $this->comments->with(['commentable', 'user'])->orderBy('created_at', 'desc')->paginate(10);
    }

    /**
     * Gère linsertion d'un nouvezu commentaire
     * @param Request $request
     */
    public function store(Request $request)
    {
        $comment = new Comments();

        $this->save($comment, $request);
    }

    /**
     * Gère la sauv. du model
     * @param Comments $comment
     * @param Request $request
     */
    private function save(Comments $comment, Request $request)
    {
        $comment->content = $request->contentComment;
        $comment->commentable_id = $request->commentable_id;
        $comment->commentable_type = 'blog';
        $comment->user_id = $request->user_id;

        if($request->has('reply_to'))
        {
            $comment->reply_to = $request->reply_to;
        }

        $comment->save();

    }

    /**
     * Gère l'enregistrement d'un témoignage sur un vol
     * @param Request $request
     */
    public function storeTestimonials(Request $request)
    {
        $testimonial = new Comments();

        $this->saveTestimonials($testimonial, $request);
    }

    /**
     * @param  Comments  $testimonial
     * @param  Request  $request
     * @throws \Exception
     */
    private function saveTestimonials(Comments $testimonial, Request $request){
        //sauv. les attributs du model en provenance du form
        $testimonial->content = $request->testimonials;
        $testimonial->commentable_id = $request->voyage_id;
        $testimonial->commentable_type = 'voyage';
        $testimonial->user_id = $request->userid;
        $testimonial->user_name_for_comment = $request->fullname;

        //test si le genre à été sélectionné
        if($request->genre == 'male'){
            $testimonial->genre_avatar = '/users/male.jpg';
        }elseif ($request->genre == 'female'){
            $testimonial->genre_avatar = '/users/female.jpg';
        }

        //si il y a un fichier
        if($request->hasFile('avatar') ){

            //recupere l'utilisateur
            $user = User::findOrFail($request->userid)->first();

            //defini le nom de l'avatar en l'ayant uploadé avec la methode du trait
            $avatar = $this->uploadMainImage($request, $user);

            //sauv. l'attribut avatar du model user
            $user->avatar = $avatar;
            //sauv. le model user
            $user->save();

            //sauv. l'attribut genre  avatar du model
            $testimonial->genre_avatar = $avatar;
        }
        //sauv. le temoignage du voyageur
        $testimonial->save();
    }

}