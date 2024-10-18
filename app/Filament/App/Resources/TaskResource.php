<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\TaskResource\Pages;
use App\Filament\App\Resources\TaskResource\RelationManagers;
use App\Models\Task;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use phpDocumentor\Reflection\Types\Boolean;


class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([ 
            Group::make()
        ->schema([
            Section::make()
            ->schema([
            TextInput::make('title'),
            TextInput::make('description'),
            Select::make('status')
                    ->options([
                        'in_progress' => 'In Progress',
                        'ready_for_review' => 'Ready for review',
                    ])
                    ->hidden(fn(string $operation):bool => $operation ==='create'),
            
            ]),
            
            ])
            ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\Layout\Split::make([
                Tables\Columns\Layout\Grid::make()
                    ->schema([
                        // Task card layout
                        Tables\Columns\Layout\Grid::make()
                            ->schema([
                                // Task Name - Larger text
                                TextColumn::make('title')  // Assuming your task title is in the 'title' field
                                    ->extraAttributes([
                                        'class' => 'text-lg font-bold text-gray-900 dark:text-gray-300' // Larger, bold task name
                                    ])
                                    ->columnSpanFull(), // Spanning full width

                                // Task Description
                                TextColumn::make('description')
                                    ->extraAttributes([
                                        'class' => 'text-sm text-gray-700 dark:text-gray-300' // Smaller, gray text for description
                                    ])
                                    ->columnSpanFull(), // Full width for description

                                // Created At
                                TextColumn::make('created_at')
                                    ->since()
                                    ->sortable()
                                    ->extraAttributes([
                                        'class' => 'text-xs text-gray-500 dark:text-gray-400 mt-2' // Smaller, lighter text for created date
                                    ])
                                    ->columnSpanFull(), // Full width for created date
                            
                                // Task Status using TextColumn with badge() method
                                TextColumn::make('status')
                                    ->label('Task Status')
                                    ->badge()
                                    ->extraAttributes([
                                        'class' => 'mt-2', 
                                    ])
                                    ->colors([
                                        'primary' => 'todo',           
                                        'warning' => 'in_progress',   
                                        'info' => 'ready_for_review', 
                                        'success' => 'done',          
                                    ])
                                    ->sortable(), // Make the status column sortable if needed
                            ])
                            ->columnSpanFull() // Spanning full width of the parent grid
                    ])
                    ->columns(1), // Single task per row
            ]),
        ])
        ->defaultSort('created_at', 'desc') // Sort by created_at descending
        ->contentGrid([
            'md' => 2, // 2 columns for medium screens
            'xl' => 4, // 4 columns for extra large screens
            '2xl' => 5, // 5 columns for 2xl screens
        ]);
        
}



    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'=>Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
            
            
            
           
        ];
    }
   
    
}
