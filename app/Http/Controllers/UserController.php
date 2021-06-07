<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Badge;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Traits\ScoreboardTrait;

class UserController extends Controller
{
    use ScoreboardTrait;

    private function setAdmin($request) {
        if (!$request->has('isAdmin')) {
           $request->merge(['isAdmin'=>0]);
        }
    }

    private function generateAvatar($email) {
        return "http://gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?size=64&d=identicon";
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
     * @param  App\Http\Requests\UserCreateRequest  $request
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
     * @param  int  $id
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
     * @param  int  $id
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
     * @param  App\Http\Requests\UserUpdateRequest  $request
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
     * Set
     *
     * @param int $id
     * @return bool
     */
    private function isAdmin($id) {
        return User::findOrFail($id)->isAdmin;
    }

    public function addBadges($user_id) {
        $user = User::findOrFail($user_id);
        $user->badges;
        $badges = Badge::all();

        return view('admin.users.add_badges', compact('user', 'badges'));

        //return redirect("admin/user/$user->id")->withOk("Le(s) badge(s) a été ajouté de l'utilisateur $user_id.");
    }

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

    public function deleteScore($user_id, $score_id) {
        // Sounds good, doesn't work (for now)
        $user = User::findOrFail($user_id);

        return redirect("admin/user/$user->id")->withOk("Le score $score_id a été retiré de l'utilisateur $user_id.");
    }

    /**
     * Display the user profile. The route is public.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUser($id)
    {
        $user = User::findOrFail($id);
        $scores = $this->scoreboard();

        return view("public.users.profile", compact('user', 'scores'));
    }

    /**
     * Edit the user profile (public)
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProfile($id)
    {
        $user = User::findOrFail($id);
        $scores = $this->scoreboard();

        return view("public.users.profile_edit", compact('user'));
    }
}
