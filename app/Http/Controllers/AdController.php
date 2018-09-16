<?php
use willvincent\Rateable\Rateable;
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Ad;
use Carbon\Carbon;

class AdController extends Controller
{
    public function index()
    {
        return Ad::all();
    }


    public function show(Ad $article)
    {
        return $article;
    }


    public function store(Request $request)
    {
        $article = Ad::create($request->all());

        return response()->json($article);
    }


    public function update(Request $request, Ad $article)
    {
		$current_time = Carbon::now(); 		
		if ($current_time >= $article->expire_on ) return response()->json("Can't update expired ad",403);
		
        $article->update($request->all());
        return response()->json($article);
    }


    public function delete(Ad $article)
    {
		$current_time = Carbon::now(); 

		if ($current_time >= $article->expire_on ) return response()->json("Can't delete expired ad",403);

        $article->delete();

        return response()->json(null, 204);
    }


	public function extend(Request $request, Ad $article)
    {
	   $now  = Carbon::now();

		if (($now->diffInDays($article->expire_on) ) >= 3)
		{
			$article->expire_on = $now->addMonths(1); 
			$article->save();	
		}
    
		return response()->json($article);
    }
	

	public function rate(Request $request, Ad $ad)
    {
	   $user = $request->user();
		
        if(!$user->hasRole('producer')) 
		{
		  return response()->json('Auth error',401);		
		}

		$current_time = Carbon::now(); 
		
        if ($current_time >= $article->expire_on ) return response()->json("Can't extend expired ad",403);		

		$rating = new \willvincent\Rateable\Rating;
		$rating->rating = $request->input('rating');
		$rating->user_id = $request->user();
		$ad->ratings()->save($rating);

        return response()->json($rating);
    }

}



 

