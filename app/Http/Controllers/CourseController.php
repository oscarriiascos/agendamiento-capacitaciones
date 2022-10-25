<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    
    public function index()
    {
        
        $courses = DB::table('course_schedule')
                    ->leftJoin('course_registrations', function($join){
                        $join->on('course_schedule.id', '=', 'course_registrations.course_id');
                        $join->where('course_registrations.user_id', '=', Auth::id());
                    })
                    ->whereDate('course_schedule.class_date', '>=', now()->toDateString())
                    ->select(
                        'course_schedule.*',
                        'course_registrations.status',
                    )
                    ->orderBy('course_schedule.class_date')
                    ->get();
                    

        return view('dashboard', [
            'courses' => $courses
        ]);
    }

    public function store(Request $request, Course $course)
    {
        $course->class_name = $request->course_name; 
        $course->avaliable_quotas = $request->avaliable_quotas; 
        $course->class_date = $request->schedule; 

        if ($course->save()) {
            return redirect()->route('dashboard');
        }
    }


    /**
     * Cambia el estado de suscripción a una clase
     */
    public function updateSubscriptionStatus(Request $request, Course $course)
    {
        
        
        $currentSubscription = $this->getCurrentSubscription($request->course_id);
        //Si no existe una suscripción, la creamos
        if (!$currentSubscription) {
            DB::table('course_registrations')->insert([
                                'course_id' => $request->course_id,
                                'user_id' => Auth::id()
                            ]);
        }

        //Continuamos con la actualización normalmente
        $hasUpdated = DB::table('course_registrations')
                            ->where('course_id', '=', $request->course_id)
                            ->where('user_id', '=', Auth::id())
                            ->update(['status' => DB::raw('NOT status') ]);


        if ($hasUpdated) {                                        
            $course = $course->find($request->course_id);
            $currentSubscriptionStatus = $this->getCurrentSubscription($request->course_id)->status;
           
            if ($currentSubscriptionStatus) {
                $course->increment('enrolled_students');
            }else{
                $course->decrement('enrolled_students');
            }

            $course->save();
        }
                        
        return response()->json($currentSubscriptionStatus);
    }


    public function getCurrentSubscription($course_id)
    {
        $currentSubscription = DB::table('course_registrations')
                                ->where('course_id', '=', $course_id)
                                ->where('user_id', '=', Auth::id())
                                ->first();

        return $currentSubscription;
    }
    
}
