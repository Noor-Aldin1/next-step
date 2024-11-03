<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\StudentTask;
use App\Models\Mentor;
use App\Models\Package;
use App\Models\Payment;
use App\Models\UserSubscription;
use App\Models\User;


use Illuminate\Support\Facades\DB;

class AdminDashController extends Controller
{


    public function dash()
    {
        // ---------nuber of each user -----
        $studenCount = User::where('role_id', 1)->count();
        $MentorsCount = User::where('role_id', 2)->count();
        $EmployerCount = User::where('role_id', 3)->count();
        $AdminCount = User::where('role_id', 4)->count();
        $newEmployerCount = User::where('role_id', 3)->where('created_at', '>=', now()->subDays(7))->count();
        $newstudenCount = User::where('role_id', 1)->where('created_at', '>=', now()->subDays(7))->count();

        // ---------------nums subscriptions --------------------------------=
        $count_BasicPlain = UserSubscription::where('package_id', 1)
            ->where('end_date', '>', now())
            ->count();

        $count_BasicPremium = UserSubscription::where('package_id', 2)
            ->where('end_date', '>', now())
            ->count();

        // ----------profit -----------
        $totalRevenue = Payment::where('payment_status', 'completed')
            ->sum('amount');

        $totalRevenueLastMonth = Payment::where('payment_status', 'completed')
            ->where('created_at', '>=', now()->subMonth())
            ->sum('amount');

        // --------------------Mentors Based on Status ------------
        $activeMentors = Mentor::where('status', 'active')->count();

        $inactiveMentors = Mentor::where('status', 'inactive')->count();

        // -------------------------chart top 5  -------------------------
        $topMentors = DB::table('user_mentor')
            ->join('mentors', 'mentors.id', '=', 'user_mentor.mentor_id')
            ->join('users', 'users.id', '=', 'mentors.user_id')
            ->select('users.username', DB::raw('COUNT(user_mentor.mentor_id) AS mention_count'))
            ->where('users.role_id', 2)
            ->groupBy('users.username')
            ->orderByDesc('mention_count')
            ->limit(5)
            ->get();


        // -----------top 2 Package ---------
        $monthlyRevenue = DB::table('packages as p')
            ->join('user_subscriptions as us', 'p.id', '=', 'us.package_id')
            ->join('payments as pay', 'us.id', '=', 'pay.subscription_id')
            ->select(
                DB::raw("DATE_FORMAT(pay.payment_date, '%Y-%m') as month"), // Format date as YYYY-MM
                'p.name as package_name',
                DB::raw('SUM(pay.amount) as total_revenue')
            )
            ->where('pay.payment_status', 'completed')
            ->groupBy('p.name', 'month')
            ->orderBy('month')
            ->get();




        $date = compact(
            'studenCount',
            'MentorsCount',
            'EmployerCount',
            'AdminCount',
            'count_BasicPlain',
            'count_BasicPremium',
            'newEmployerCount',
            'newstudenCount',
            'totalRevenue',
            'totalRevenueLastMonth',
            'activeMentors',
            'inactiveMentors',
            'topMentors',
            'monthlyRevenue'
        );


        return view('admin.pages.dash', $date);
    }
}
