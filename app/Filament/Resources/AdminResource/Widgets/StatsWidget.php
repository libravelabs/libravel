<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use App\Models\User as Member;
use App\Models\Book;
use App\Models\Visitor;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\TrendValue;
use Flowframe\Trend\Trend;

class StatsWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        return array_merge(
            $this->getMemberStats(),
            $this->getBookStats(),
            $this->getVisitorStats()
        );
    }

    private function getMemberStats(): array
    {
        $newMembersThisWeek = Member::where('created_at', '>=', now()->subDays(7))->count();
        $newMembersLastWeek = Member::whereBetween('created_at', [
            now()->subWeek()->startOfWeek(),
            now()->subWeek()->endOfWeek(),
        ])->count();

        $membersChange = $newMembersLastWeek > 0
            ? round((($newMembersThisWeek - $newMembersLastWeek) / $newMembersLastWeek) * 100, 2)
            : ($newMembersThisWeek > 0 ? 100 : 0);

        $membersChart = Trend::model(Member::class)
            ->between(
                start: now()->subWeeks(4),
                end: now()
            )
            ->perWeek()
            ->count()
            ->map(fn(TrendValue $value) => $value->aggregate)
            ->toArray();

        return [
            Stat::make(__('widget.stats.users_this_week'), $newMembersThisWeek)
                ->description($membersChange >= 0 ? __('widget.stats.active_grow') : __('widget.stats.no_grow'))
                ->descriptionIcon($membersChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->chart(
                    $membersChart
                )
                ->color($membersChange >= 0 ? 'success' : 'danger'),
        ];
    }

    private function getBookStats(): array
    {
        $newBooksThisWeek = Book::where('created_at', '>=', now()->subDays(7))->count();
        $newBooksLastWeek = Book::whereBetween('created_at', [
            now()->subWeek()->startOfWeek(),
            now()->subWeek()->endOfWeek(),
        ])->count();

        $booksChange = $newBooksLastWeek > 0
            ? round((($newBooksThisWeek - $newBooksLastWeek) / $newBooksLastWeek) * 100, 2)
            : ($newBooksThisWeek > 0 ? 100 : 0);

        $booksChart = Trend::model(Book::class)
            ->between(
                start: now()->subWeeks(4),
                end: now()
            )
            ->perWeek()
            ->count()
            ->map(fn(TrendValue $value) => $value->aggregate)
            ->toArray();

        return [
            Stat::make(__('widget.stats.books_this_week'), $newBooksThisWeek)
                ->description($booksChange >= 0 ? __('widget.stats.active_grow') : __('widget.stats.no_grow'))
                ->descriptionIcon($booksChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->chart($booksChart)
                ->color($booksChange >= 0 ? 'success' : 'danger'),
        ];
    }

    private function getVisitorStats(): array
    {
        return VisitorStats::getCards();
    }
}

class VisitorStats
{
    public static function getCards(): array
    {
        return [
            self::getTotalVisitsStat(),
            self::getTodayVisitsStat(),
        ];
    }

    private static function getTotalVisitsStat(): Stat // Metode statis
    {
        $totalVisits = Visitor::count();

        return Stat::make(__('widget.stats.visits.total_visits'), $totalVisits)
            ->description(__('widget.stats.visits.total_visits_desc'))
            ->descriptionIcon('heroicon-o-eye')
            ->color('primary');
    }

    private static function getTodayVisitsStat(): Stat // Metode statis
    {
        $todayVisits = Visitor::whereDate('visited_at', Carbon::today())->count();

        return Stat::make(__('widget.stats.visits.today_visits'), $todayVisits)
            ->description(__('widget.stats.visits.today_visits_desc'))
            ->descriptionIcon('heroicon-o-calendar')
            ->color('success');
    }
}
