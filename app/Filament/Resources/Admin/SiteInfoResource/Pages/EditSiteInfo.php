<?php

namespace App\Filament\Resources\Admin\SiteInfoResource\Pages;

use App\Filament\Resources\Admin\SiteInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSiteInfo extends EditRecord
{
    protected static string $resource = SiteInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
