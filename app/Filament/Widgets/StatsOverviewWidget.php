<?php

namespace App\Filament\Widgets;

use App\Models\CourseEnrollment;
use App\Models\Event;
use App\Models\Member;
use App\Models\Sermon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalMembers    = Member::count();
        $activeMembers   = Member::active()->count();
        $newThisMonth    = Member::where('created_at', '>=', now()->subDays(30))->count();
        $upcomingEvents  = Event::active()->upcoming()->count();
        $totalEvents     = Event::count();
        $pendingEnrolments = CourseEnrollment::where('status', 'pending')->count();
        $activeEnrolments  = CourseEnrollment::where('status', 'active')->count();
        $totalSermons    = Sermon::where('is_active', true)->count();
        $featuredSermons = Sermon::where('is_featured', true)->where('is_active', true)->count();

        $memberTrend = Member::selectRaw('COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(60))
            ->groupByRaw('DATE(created_at)')
            ->pluck('count')
            ->map(fn ($v) => (float) $v)
            ->values()
            ->all();

        $eventTrend = Event::selectRaw('COUNT(*) as count')
            ->where('event_at', '>=', now()->subMonths(6))
            ->groupByRaw("DATE_FORMAT(event_at, '%Y-%m')")
            ->pluck('count')
            ->map(fn ($v) => (float) $v)
            ->values()
            ->all();

        $enrolmentTrend = CourseEnrollment::selectRaw('COUNT(*) as count')
            ->where('enrolled_at', '>=', now()->subMonths(4))
            ->groupByRaw("DATE_FORMAT(enrolled_at, '%Y-%m')")
            ->pluck('count')
            ->map(fn ($v) => (float) $v)
            ->values()
            ->all();

        return [
            Stat::make('Total Members', $totalMembers)
                ->description($activeMembers . ' active · ' . $newThisMonth . ' new (30 days)')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success')
                ->chart(count($memberTrend) > 1 ? $memberTrend : [0, $totalMembers]),

            Stat::make('Upcoming Events', $upcomingEvents)
                ->description($totalEvents . ' events total')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('info')
                ->chart(count($eventTrend) > 1 ? $eventTrend : [0, $upcomingEvents]),

            Stat::make('Course Enrolments', $activeEnrolments + $pendingEnrolments)
                ->description($pendingEnrolments . ' pending · ' . $activeEnrolments . ' active')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color($pendingEnrolments > 0 ? 'warning' : 'success')
                ->chart(count($enrolmentTrend) > 1 ? $enrolmentTrend : [0, $activeEnrolments + $pendingEnrolments]),

            Stat::make('Sermons', $totalSermons)
                ->description($featuredSermons . ' featured')
                ->descriptionIcon('heroicon-m-microphone')
                ->color('primary'),
        ];
    }
}
