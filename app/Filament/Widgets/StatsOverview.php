<?php

namespace App\Filament\Widgets;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Social;
use App\Models\ContactMessage;
use App\Models\ContactMessageReplies;
use Filament\Support\Enums\IconPosition;
class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [

           Stat::make('Social', Social::count() )
            ->description('Social Media Accounts')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
        Stat::make('Contact Messages', ContactMessage::count())
            ->description(ContactMessage::where('is_read', true)->count() . ' Read and ' . ContactMessage::where('is_read', false)->count() . ' Unread')
            ->color('info'),
        Stat::make('Contact Messages Reply', ContactMessageReplies::count())
            ->description('3% increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
        Stat::make('Email', 'me@shiplujs.com')->icon('heroicon-m-envelope')
            ->description('shiplu2111@gmail.com')
            ->descriptionIcon('heroicon-o-envelope-open', IconPosition::Before),
        Stat::make('Phone', '+8801711002919')->icon('heroicon-m-phone')
            ->description('+8801511002919')
             ->descriptionIcon('heroicon-o-phone-arrow-up-right', IconPosition::Before),
        Stat::make('Website', 'https://shiplujs.com')->icon('heroicon-m-globe-alt')
        ->description('http://shiplujs.vercel.app/')
            ->descriptionIcon('heroicon-o-globe-alt', IconPosition::Before),
        // Stat::make('Unique views', '192.1k')
        //     ->description('32k increase')
        //     ->descriptionIcon('heroicon-m-arrow-trending-up')
        //     ->chart([5, 10, 5, 15, 10, 15, 5, 10, 5, 15, 10, 15])
        //     ->color('success'),
        ];
    }
}
