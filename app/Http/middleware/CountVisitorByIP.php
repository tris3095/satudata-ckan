<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CountVisitorByIP
{
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();
        $userAgent = $request->header('User-Agent');
        $today = Carbon::today();

        $alreadyVisited = Visitor::where('ip_address', $ip)
            ->where('user_agent', $userAgent)
            ->whereDate('visited_at', $today)
            ->exists();

        if (!$alreadyVisited) {
            Visitor::create([
                'ip_address' => $ip,
                'user_agent' => $userAgent,
                'visited_at' => $today,
            ]);
        }

        return $next($request);
    }
}
