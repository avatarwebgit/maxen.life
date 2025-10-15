<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteVisit extends Model
{
    use HasFactory;

    protected $table = "site_visit";
    protected $fillable = [
        'ip', 'date'
    ];

    public static function track(string $ip): void
    {
        self::firstOrCreate([
            'ip' => $ip,
            'date' => today()
        ]);
    }

    public static function today(): int
    {
        return self::whereDate('date', today())->count();
    }

    public static function yesterday(): int
    {
        return self::whereDate('date', today()->subDay(1))->count();
    }

    public static function thisMonth(): int
    {
        return self::whereYear('date', now()->year)
            ->whereMonth('date', now()->month)
            ->count();
    }

    public static function total(): int
    {
        return self::count();
    }

    public static function chartData(int $days = 30): array
    {
        $startDate = today()->subDays($days);

        $visits = self::selectRaw('date, COUNT(DISTINCT ip) as count')
            ->where('date', '>=', $startDate)
            ->groupBy('date')
            ->pluck('count', 'date');

        $dates = [];
        $values = [];

        for ($i = $days; $i >= 0; $i--) {
            $date = today()->subDays($i);
            $dates[] = verta($date)->format('Y/m/d');
            $values[] = $visits[$date->format('Y-m-d')] ?? 0;
        }

        return compact('dates', 'values');
    }
}
