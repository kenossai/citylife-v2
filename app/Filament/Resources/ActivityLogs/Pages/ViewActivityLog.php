<?php

namespace App\Filament\Resources\ActivityLogs\Pages;

use App\Filament\Resources\ActivityLogs\ActivityLogResource;
use App\Models\ActivityLog;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Schema;

class ViewActivityLog extends ViewRecord
{
    protected static string $resource = ActivityLogResource::class;

    protected string $view = 'filament.resources.activity-logs.pages.view-activity-log';

    public function getRecord(): ActivityLog
    {
        return parent::getRecord();
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema->components([]);
    }
}
