<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use App\Filament\Resources\CRUD\BookResource;
use App\Models\Book;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns;


class LatestBooks extends BaseWidget
{
    protected static ?string $pollingInterval = '10s';
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(BookResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                Columns\TextColumn::make('created_at')
                    ->label(__('book/fields.label.status.created_at.label'))
                    ->date('Y-m-d')
                    ->sortable(),
                Columns\TextColumn::make('title')
                    ->label(__('book/fields.page.title'))
                    ->searchable()
                    ->sortable(),
                Columns\TextColumn::make('language')
                    ->label(__('book/fields.label.details.lang.label'))
                    ->sortable(),
                Columns\TextColumn::make('page_count')
                    ->label(__('book/fields.label.details.page_count.label'))
                    ->sortable(),
                Columns\ToggleColumn::make('is_fiction')
                    ->label(__('book/fields.label.status.is_fiction.label')),
                Columns\TextColumn::make('release_date')
                    ->label(__('book/fields.label.status.release_date.label'))
                    ->date('Y-m-d'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->url(fn(Book $record): string => BookResource::getUrl('view', ['record' => $record])),
                Tables\Actions\EditAction::make()
                    ->url(fn(Book $record): string => BookResource::getUrl('edit', ['record' => $record])),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
