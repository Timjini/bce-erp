<?php

namespace App\Filament\Resources\Pages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Support\Facades\URL;



class PagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('category.name')->label('Category'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('full_slug')->label('Path')->getStateUsing(function ($record) {
                $sectionSlug = $record->category?->section?->slug ?? '';
                $categorySlug = $record->category?->slug ?? '';
                $pageSlug = $record->slug;

                if ($sectionSlug && $categorySlug && $pageSlug) {
                    return "/{$sectionSlug}/{$categorySlug}/{$pageSlug}";
                }

        return null;
    })
    ->copyable(), 
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
