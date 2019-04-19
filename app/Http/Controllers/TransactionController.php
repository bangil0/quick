<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\TypeCandidates;
use App\PemiluSetting;
use App\CandidatesPemilu;
use App\Caleg;
use Illuminate\Http\Request;
use Auth;
class TransactionController extends Controller
{
    private $caleg;

    public function __construct()
    {
        $this->caleg = new Caleg();
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function validate_form($request)
    {
        $this->validate($request,[
            'tps_id'=>'required',
            'pemilu_setting_id'=>'required',
            'number_of_votes'=>'required',
            'caleg_id'=>'required',
        ]);
    }

    public function store(Request $request)
    {
        $check = Transaction::where('tps_id',$request->tps_id)->where('pemilu_setting_id',$request->pemilu_setting_id[0])->count();

        if ($check > 0) {
            return back()->withMessage('TPS Ini telah melakukan Vote');
        }else{
            $jumlah = count($request->pemilu_setting_id);
            for ($i=0; $i < $jumlah ; $i++) { 
                Transaction::create([
                    'voluteer_id'=>Auth::user()->id,
                    'caleg_id'=>$request->caleg_id[$i],
                    'pemilu_setting_id'=>$request->pemilu_setting_id[$i],
                    'tps_id'=>$request->tps_id,
                    'number_of_votes'=>$request->number_of_votes[$i],
                ]);
            }
        }
        
        return back()->withMessage('Vote Berhasil Dikirim');
    }

    public function result()
    {
        $array = [];
        $pemilu = PemiluSetting::latest()->get();
        foreach ($pemilu as $value) {
            $type        = TypeCandidates::where('id',$value->type_candidates_id)->first();
            $candidates  = CandidatesPemilu::where('pemilu_setting_id',$value->id)->count();
            $transaction = Transaction::where('pemilu_setting_id',$value->id);
            array_push($array, [
                'id'=>$value->id,
                'pemilu_type'=>$type->type,
                'pemilu_name'=>$value->pemilu_name,
                'count_candidates'=>$candidates,
                'count_transaction'=>$transaction->sum('number_of_votes'),
            ]);
        }

        return view('pemilu.setting.result',compact('array'));
    }

    public function caleg($pemilu_setting_id)
    {
        $array    = [];
        $setting  = PemiluSetting::where('id',$pemilu_setting_id)->first();
        $candidates = CandidatesPemilu::where('pemilu_setting_id',$pemilu_setting_id)->get();
        foreach ($candidates as $value) {
            $caleg = $this->caleg->own_transform(Caleg::where('id',$value->caleg_id)->first());
            array_push($array, [
                'id'=>$value->id,
                'caleg_id'=>$value->caleg_id,
                'pemilu_setting_id'=>$value->pemilu_setting_id,
                'caleg'=>$caleg,
            ]);
        }

        return view('pemilu.setting.caleg_result',compact('array'));
    }

    public function getCalegVote($pemilu_setting_id)
    {
        $array    = [];
        $setting  = PemiluSetting::where('id',$pemilu_setting_id)->first();
        $candidates = CandidatesPemilu::where('pemilu_setting_id',$pemilu_setting_id)->get();
        foreach ($candidates as $value) {
            $caleg = $this->caleg->own_transform(Caleg::where('id',$value->caleg_id)->first());
            $vote  = Transaction::where('pemilu_setting_id',$pemilu_setting_id)->where('caleg_id',$value->caleg_id)->sum('number_of_votes');
            array_push($array, [
                'id'=>$value->id,
                'caleg_id'=>$value->caleg_id,
                'caleg_vote'=>$vote,
            ]);
        }

        return $array;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
