<?php

namespace App\Http\Controllers;

use App\Volunteer;
use App\User;
use App\Provinsi;
use App\TypeCandidates;
use App\CandidatesPemilu;
use App\Caleg;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    private $caleg;

    public function __construct()
    {
        $this->caleg = new Caleg();
    }

    public function index()
    { 
        $province = Provinsi::latest()->get();
        $type_candidates = TypeCandidates::all();
        return view('volunteer.index',compact('province','type_candidates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function show(Volunteer $volunteer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function edit(Volunteer $volunteer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Volunteer $volunteer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Volunteer $volunteer)
    {
        //
    }

    public function admin()
    {
        $array = [];
        $data = User::where('level','relawan')->get();
        foreach ($data as $value) {
            $relawan = Volunteer::where('user_id',$value->id)->first();
            $value['nip'] = $relawan['nip'];
            $value['address'] = $relawan['address'];
            $value['date_of_birth'] = $relawan['date_of_birth'];

            array_push($array, $value);
        }

        return view('volunteer.admin',compact('array'));
    }

    public function caleg($pemilu_setting_id)
    {
        $new_caleg = [];
        $data = CandidatesPemilu::where('pemilu_setting_id',$pemilu_setting_id)->get();
        foreach ($data as $value) {
            array_push($new_caleg, $this->caleg->single_transform($value));
        }

        return view('volunteer.caleg',compact('new_caleg','pemilu_setting_id'));
    }


}
