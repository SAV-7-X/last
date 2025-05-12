<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $activeUsers;
    public $clickEvents;
    public $purchases;
    public $likes;
    
    public $usersGrowth;
    public $clicksGrowth;
    public $purchasesGrowth;
    public $likesGrowth;
    
    public $positiveReviews;
    public $neutralReviews;
    public $negativeReviews;
    
    public $projects;
    public $completedProjects;
    
    public $recentOrders;
    public $monthlySales;
    public $monthlyUsers;

    public function mount()
    {
        $this->loadStatistics();
        $this->loadReviews();
        $this->loadProjects();
        $this->loadRecentOrders();
        $this->loadChartData();
    }

    private function loadStatistics()
    {
        // Active users in the last 30 days
        $this->activeUsers = DB::table('users')
            ->whereDate('last_login_at', '>=', now()->subDays(30))
            ->count();
            
        $prevMonthActiveUsers = DB::table('users')
            ->whereDate('last_login_at', '>=', now()->subDays(60))
            ->whereDate('last_login_at', '<', now()->subDays(30))
            ->count();
            
        $this->usersGrowth = $prevMonthActiveUsers > 0 
            ? round((($this->activeUsers - $prevMonthActiveUsers) / $prevMonthActiveUsers) * 100) 
            : 100;
            
        // Click events in the last 30 days
        $this->clickEvents = DB::table('click_events')
            ->whereDate('created_at', '>=', now()->subDays(30))
            ->count();
            
        $prevMonthClicks = DB::table('click_events')
            ->whereDate('created_at', '>=', now()->subDays(60))
            ->whereDate('created_at', '<', now()->subDays(30))
            ->count();
            
        $this->clicksGrowth = $prevMonthClicks > 0 
            ? round((($this->clickEvents - $prevMonthClicks) / $prevMonthClicks) * 100)
            : 100;
            
        // Purchases in the last 30 days
        $this->purchases = DB::table('orders')
            ->whereDate('created_at', '>=', now()->subDays(30))
            ->count();
            
        $prevMonthPurchases = DB::table('orders')
            ->whereDate('created_at', '>=', now()->subDays(60))
            ->whereDate('created_at', '<', now()->subDays(30))
            ->count();
            
        $this->purchasesGrowth = $prevMonthPurchases > 0 
            ? round((($this->purchases - $prevMonthPurchases) / $prevMonthPurchases) * 100)
            : 100;
            
        // Likes in the last 30 days
        $this->likes = DB::table('likes')
            ->whereDate('created_at', '>=', now()->subDays(30))
            ->count();
            
        $prevMonthLikes = DB::table('likes')
            ->whereDate('created_at', '>=', now()->subDays(60))
            ->whereDate('created_at', '<', now()->subDays(30))
            ->count();
            
        $this->likesGrowth = $prevMonthLikes > 0 
            ? round((($this->likes - $prevMonthLikes) / $prevMonthLikes) * 100)
            : 100;
    }

    private function loadReviews()
    {
        // Get reviews distribution
        $totalReviews = DB::table('reviews')->count();
        
        if ($totalReviews > 0) {
            $positiveCount = DB::table('reviews')->where('rating', '>=', 4)->count();
            $neutralCount = DB::table('reviews')->whereBetween('rating', [2, 3])->count();
            $negativeCount = DB::table('reviews')->where('rating', '<', 2)->count();
            
            $this->positiveReviews = round(($positiveCount / $totalReviews) * 100);
            $this->neutralReviews = round(($neutralCount / $totalReviews) * 100);
            $this->negativeReviews = round(($negativeCount / $totalReviews) * 100);
        } else {
            $this->positiveReviews = 0;
            $this->neutralReviews = 0;
            $this->negativeReviews = 0;
        }
    }

    private function loadProjects()
    {
        // Get projects
        $currentMonth = now()->month;
        
        $this->projects = DB::table('projects')
            ->select('projects.*', 'teams.name as team_name', DB::raw('count(project_members.id) as member_count'))
            ->leftJoin('teams', 'projects.team_id', '=', 'teams.id')
            ->leftJoin('project_members', 'projects.id', '=', 'project_members.project_id')
            ->groupBy('projects.id')
            ->limit(6)
            ->orderBy('projects.created_at', 'desc')
            ->get();
            
        $this->completedProjects = DB::table('projects')
            ->where('status', 'completed')
            ->whereMonth('completed_at', $currentMonth)
            ->count();
    }

    private function loadRecentOrders()
    {
        // Get recent orders
        $orders = DB::table('orders')
            ->select('orders.id', 'orders.user_id', 'orders.price', 'orders.created_at', 'users.name as user_name')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->orderBy('orders.created_at', 'desc')
            ->limit(6)
            ->get();
            
        $this->recentOrders = $orders->map(function ($order) {
            return [
                'id' => $order->id,
                'type' => "COD",
                'total' => $order->price,
                'created_at' => Carbon::parse($order->created_at)->format('d M g:i A'),
                'description' => $this->getOrderDescription($order)
            ];
        });
    }
    
    private function getOrderDescription($order)
    {
        $descriptions = [
            'payment' => 'Payment received',
            'refund' => 'Refund issued',
            'subscription' => 'Subscription renewal',
            'purchase' => 'New purchase',
        ];
        
        return $descriptions["COD"] ?? 'Order #' . $order->id;
    }

    private function loadChartData()
    {
        // Get monthly sales data for chart (for the past 6 months)
        $startDate = now()->subMonths(6)->startOfMonth();
        $endDate = now()->endOfMonth();

        $monthlySales = DB::table('orders')
            ->select(
                DB::raw('sum(price) as revenue'),
                DB::raw("DATE_FORMAT(created_at, '%b') as month")
            )
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->groupBy('month')
            ->orderBy('created_at')
            ->get();
            
        $this->monthlySales = $monthlySales->pluck('revenue', 'month')->toJson();
        
        // Get monthly active users for chart
        $monthlyUsers = DB::table('users')
            ->select(
                DB::raw('count(*) as total'),
                DB::raw("DATE_FORMAT(last_login_at, '%b') as month")
            )
            ->where('last_login_at', '>=', $startDate)
            ->where('last_login_at', '<=', $endDate)
            ->groupBy('month')
            ->orderBy('last_login_at')
            ->get();
            
        $this->monthlyUsers = $monthlyUsers->pluck('total', 'month')->toJson();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
    public function logout()
    {
        Auth::logout(); // Logs out the user
        Session::flush(); // Clears session data

        return redirect('/login'); // Redirect to login page
    }
    // public function render()
    // {
    //     return view('livewire.dashboard');
    // }
}
