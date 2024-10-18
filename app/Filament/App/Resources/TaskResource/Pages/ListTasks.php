<?php

namespace App\Filament\App\Resources\TaskResource\Pages;

use App\Filament\App\Resources\TaskResource;
use Filament\Actions;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Infolists\Components\Card;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ListTasks extends ListRecords
{
    protected static string $resource = TaskResource::class;
    protected static ?string $title = 'Custom Page Title';
   
    

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
            ->mutateFormDataUsing(function (array $data): array {
                $data['user_id'] = Auth::id();
         
                return $data;
            })
            
        ];
    }
    public function getHeader(): ?View
{
    return view('filament.settings.custom-header');
}
    
    
}
