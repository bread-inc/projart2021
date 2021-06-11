<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Quiz;
use App\Models\Badge;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Traits\ScoreboardTrait;

class UserController extends Controller
{
    use ScoreboardTrait;

    /**
     * Set the user as administrator. 
     * @param $request
     * @return void
     */
    private function setAdmin($request) {
        if (!$request->has('isAdmin')) {
           $request->merge(['isAdmin'=>0]);
        }
    }

    /**
     * Generate the URL to the user's avatar image, hashing his email.
     * @param string $email the user's e-mail.
     * @return string the URL : gravatar.com/avatar/[hashed e-mail]?size=256&d=robohash
     */
    private function generateAvatar($email) {
        return "http://gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?size=256&d=robohash";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view("admin.users.index_users", compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\UserCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {   
        $this->setAdmin($request); // permet la gestion de la case à cocher (champ admin)
        $email = $request->email;
        $request->merge(['avatar' => $this->generateAvatar($email)]);
        $user = User::create($request->all());
        return redirect(route('user.index'))->withOk("L'utilisateur " . $user->pseudo . " a été créé.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $visitorId = auth()->id();

        // Calling the user badges and scores
        $user->badges;
        $user->scores;

        return view("admin.users.show_user", compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view("admin.users.edit_user", compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UserUpdateRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $this->setAdmin($request);
        User::findOrFail($id)->update($request->all());
        return redirect(route('user.index'))->withOk("L'utilisateur " . $request->input('pseudo') . " a été modifié");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back();
    }

    /**
     * Return if the selected user is an administrator
     *
     * @param int $id the user's id
     * @return bool
     */
    private function isAdmin($id) {
        return User::findOrFail($id)->isAdmin;
    }

    /**
     * Show the form for editing the badges of a user
     * 
     * @param int $user_id the user's id
     * @return \Illuminate\Http\Response
     */
    public function addBadges($user_id) {
        $user = User::findOrFail($user_id);
        $user->badges;
        $badges = Badge::all();

        return view('admin.users.add_badges', compact('user', 'badges'));

        //return redirect("admin/user/$user->id")->withOk("Le(s) badge(s) a été ajouté de l'utilisateur $user_id.");
    }

    /**
     * Save the selected badges for the user. The user's id is stored in a form's hidden input.
     * 
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response returns the user.index page
     */
    public function storeBadges(Request $request)
    {
        $badges = Badge::all();
        $user = User::find($request->user);
        $userOldBadges = $user->badges;
        
        // if $request is empty, directly clear all user's badges
        if(empty($request->badges)) {
            $user->badges()->detach();
        } else {
            // Checking in the new badges list the one to add to the user ;
            foreach ($badges as $badge) {
                if(in_array($badge->id, $request->badges) && empty($userOldBadges->find($badge->id))) {
                    $newBadge = Badge::find($badge->id);
                    $user->badges()->attach($newBadge);
                }
            }
            // Checking in the old badges list the one to remove from the user ;
            foreach ($userOldBadges as $old_badge) {
                if(!in_array($old_badge->id, $request->badges)) {
                    $user->badges()->detach($old_badge->id);
                }
            }
        }
        return redirect("admin/user/$user->id")->withOk("Le(s) badge(s) de l'utilisateur $user->pseudo ont été modifiés.");
    }

    /**
     * In development. Deletes a score a user achieved.
     * @param int $user_id
     * @param int $score_id
     * @return \Illuminate\Http\Response
     */
    public function deleteScore($user_id, $score_id) {
        // Sounds good, doesn't work (for now)
        $user = User::findOrFail($user_id);

        return redirect("admin/user/$user->id")->withOk("Le score $score_id a été retiré de l'utilisateur $user_id.");
    }

    /**
     * Display the user profile. The route is public.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function showUser($id)
    {
        $user = User::findOrFail($id);
        $scores = $this->scoreboard();
        $user_score = $this->getUserGlobalScore($id);

        return view("public.users.profile", compact('user', 'scores', 'user_score'));
    }

    /**
     * Edit the user profile (public). In development.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProfile($id)
    {
        $user = User::findOrFail($id);

        return view("public.users.profile_edit", compact('user'));
    }

    /**
     * Add a quiz to the user's favorites list
     * 
     * @param int $user_id
     * @param int $quiz_id
     * @return \Illuminate\Http\Response
     */
    public function addQuizToFavorite($quiz_id, $user_id) {
        $user = User::findOrFail($user_id);

        // If user has not the quiz alread in fav.
        if(empty($user->favorites->where('quiz_id', $quiz_id)->first())) {
            $quiz = Quiz::find($quiz_id);
            // Checking if the quiz exists
            if(!empty($quiz)) {
                $user->favorites()->create([
                    'user_id' => $user_id,
                    'quiz_id' => $quiz_id
                ]);
                return redirect(route('game.info', [$quiz_id]))->withOk("Le quiz $quiz_id a été ajouté à vos favoris.");
            } else {
                return redirect(route('game.info', [$quiz_id]))->withOk("Le quiz n'existe pas.");
            }
        } else {
            return redirect(route('game.info', [$quiz_id]))->withOk("Le quiz est déjà dans votre liste de favoris."); 
        } 
    }

    /**
     * Remove a quiz from the user's favorites list
     * 
     * @param int $user_id
     * @param int $quiz_id
     * @return \Illuminate\Http\Response
     */
    public function removeQuizFromFavorite($quiz_id, $user_id) {
        $user = User::findOrFail($user_id);

        // If user has not the quiz in fav.
        if(empty($user->favorites->where('quiz_id', $quiz_id)->first())) {
            return redirect(route('game.info', [$quiz_id]))->withOk("Le quiz sélectionné n'est pas dans vos favoris.");
        } else {
            $user->favorites->where('quiz_id', $quiz_id)->first()->delete();
            return redirect(route('game.info', [$quiz_id]))->withOk("Le quiz $quiz_id a été retiré de vos favoris.");
        }
    }
}
