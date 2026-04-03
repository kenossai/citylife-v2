<?php

namespace App\Filament\Widgets;

use App\Models\CourseEnrollment;
use App\Models\LessonAttendance;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class CourseLearningProgressWidget extends ChartWidget
{
    protected static ?int $sort = 3;

    protected ?string $heading = 'Course Learning Progress (Last 12 Months)';

    protected string $color = 'info';

    protected ?string $maxHeight = '280px';

    protected int | string | array $columnSpan = 'full';

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        $months = collect(range(11, 0))->map(fn (int $i) => now()->startOfMonth()->subMonths($i));

        $labels = $months->map(fn (Carbon $m) => $m->format('M y'))->all();

        $newEnrolments = $months->map(fn (Carbon $m) => CourseEnrollment::whereBetween(
            'enrolled_at', [$m->copy()->startOfMonth(), $m->copy()->endOfMonth()]
        )->count())->all();

        $completions = $months->map(fn (Carbon $m) => CourseEnrollment::where('status', 'completed')
            ->whereBetween('completed_at', [$m->copy()->startOfMonth(), $m->copy()->endOfMonth()])
            ->count())->all();

        $attendances = $months->map(fn (Carbon $m) => LessonAttendance::where('present', true)
            ->whereBetween('attended_at', [$m->copy()->startOfMonth(), $m->copy()->endOfMonth()])
            ->count())->all();

        $certificates = $months->map(fn (Carbon $m) => CourseEnrollment::where('certificate_issued', true)
            ->whereBetween('updated_at', [$m->copy()->startOfMonth(), $m->copy()->endOfMonth()])
            ->count())->all();

        return [
            'datasets' => [
                [
                    'label'           => 'New Enrolments',
                    'data'            => $newEnrolments,
                    'borderColor'     => 'rgb(99, 102, 241)',
                    'backgroundColor' => 'rgba(99, 102, 241, 0.08)',
                    'fill'            => true,
                    'tension'         => 0.4,
                    'pointRadius'     => 4,
                    'pointHoverRadius' => 6,
                ],
                [
                    'label'           => 'Completions',
                    'data'            => $completions,
                    'borderColor'     => 'rgb(34, 197, 94)',
                    'backgroundColor' => 'rgba(34, 197, 94, 0.08)',
                    'fill'            => true,
                    'tension'         => 0.4,
                    'pointRadius'     => 4,
                    'pointHoverRadius' => 6,
                ],
                [
                    'label'           => 'Lessons Attended',
                    'data'            => $attendances,
                    'borderColor'     => 'rgb(251, 146, 60)',
                    'backgroundColor' => 'rgba(251, 146, 60, 0.08)',
                    'fill'            => true,
                    'tension'         => 0.4,
                    'pointRadius'     => 4,
                    'pointHoverRadius' => 6,
                ],
                [
                    'label'           => 'Certificates Issued',
                    'data'            => $certificates,
                    'borderColor'     => 'rgb(232, 121, 249)',
                    'backgroundColor' => 'rgba(232, 121, 249, 0.08)',
                    'fill'            => true,
                    'tension'         => 0.4,
                    'pointRadius'     => 4,
                    'pointHoverRadius' => 6,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display'  => true,
                    'position' => 'top',
                    'labels'   => [
                        'usePointStyle' => false,
                        'boxWidth'      => 12,
                        'padding'       => 20,
                    ],
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks'       => ['precision' => 0],
                    'grid'        => ['color' => 'rgba(255,255,255,0.05)'],
                ],
                'x' => [
                    'grid' => ['display' => false],
                ],
            ],
        ];
    }
}
