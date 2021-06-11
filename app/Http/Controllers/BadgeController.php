<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBadgeRequest;
use App\Models\Badge;

class BadgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $badges = Badge::all();

        return view("admin.badges.index_badges", compact('badges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pictograms_list = Badge::PICTOGRAMS;
        return view('admin.badges.create_badge', compact('pictograms_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CreateBadgeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBadgeRequest $request)
    {
        $badge = Badge::create([
            'label' => $request->label,
            'description' => $request->description,
            'pictogram' => $request->pictogram,
            'color' => $request->color,
            'type' => $request->type,
            'criterium' => $request->criterium,
            'badgeable_type' => $request->type == "region" ? 'App\Models\Region' : 'App\Models\Quiz',
            'badgeable_id' => rand(1, 3) // !!!!! À MODIFIER PAR RAPPORT AU FRONT !!!!!!
        ]);
        return redirect(route('badge.index'))->withOk("Le badge " . $badge->label . " a été créé.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $badge = Badge::findOrFail($id);
        $pictograms_list = Badge::PICTOGRAMS;
        //$type = $badge->badgeable()->get();

        return view("admin.badges.show_badge", compact('badge', 'pictograms_list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $badge = Badge::findOrFail($id);
        $pictograms_list = Badge::PICTOGRAMS;
        return view('admin.badges.edit_badge', compact('badge','pictograms_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\CreateBadgeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateBadgeRequest $request, $id)
    {
        Badge::findOrFail($id)->update([
            'label' => $request->label,
            'description' => $request->description,
            'pictogram' => $request->pictogram,
            'color' => $request->color,
            'type' => $request->type,
            'criterium' => $request->criterium,
            'badgeable_type' => $request->type == "region" ? 'App\Models\Region' : 'App\Models\Quiz',
            'badgeable_id' => rand(1, 3) // !!!!! À MODIFIER PAR RAPPORT AU FRONT !!!!!!
        ]);
        return redirect(route('badge.index'))->withOk("Le badge " . $id . " a été modifié avec succès.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $badge = Badge::findOrFail($id);
        $badge->delete();

        return redirect(route('badge.index'))->withOk("Le badge $id a été supprimé avec succès.");
    }

    /**
     * Return the users who got the specified badge.
     * 
     * @param int $id the badge id
     * @return array the users list who got the badge
     */
    public function users($id)
    {
        $badge = Badge::findOrFail($id);
        $users = $badge->users()->get();

        return compact('badge', 'users');
    }
}
