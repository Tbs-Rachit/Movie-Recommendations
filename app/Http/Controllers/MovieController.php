<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use Carbon\Carbon;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('movie');
    }

    public function search(MovieRequest $request)
    {
        $data = $request->all();
        $genre = $data['genre'];
        $time = $data['time'];
        $time = strtotime($time);
        $searchTime = date("H:i", strtotime('+30 minutes', $time));
        $searchTime = strtotime(Carbon::parse($searchTime));


        $rowData = json_decode(file_get_contents('https://pastebin.com/raw/cVyp3McN'));
        $finalData = array();

        foreach ($rowData as $row){
            $genreArray = $row->genres;
            if(in_array(ucwords($genre),$genreArray)){
                $times = $row->showings;
                foreach ($times as $val){
                    $showtime = strtotime(Carbon::parse($val));
                    if($searchTime <= $showtime){
                        $showArray = [
                            'name'=>$row->name,
                            'time'=>Carbon::parse($val)->format('g:i A')
                        ];
                        $finalData[$row->rating] = $showArray;
                        break;
                    }
                }
            }
        }
        krsort($finalData,1);
        $str = 'No movie recommendations';
        if(!empty($finalData)) {
            $str = '';
            foreach ($finalData as $text) {
                $str .= '<li>'.$text['name'].', showing at '.$text['time'].'</li>';
            }
        }

        echo $str;
    }
}
