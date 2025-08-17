<?php

namespace App\Filament\Resources\Categories\Schemas;

use App\Models\Category;
use Filament\Schemas\Schema;
use Filament\Forms;


class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Select::make('section_id')
                    ->relationship('section', 'name')
                    ->required(),

                Forms\Components\TextInput::make('name')
                    ->label('Category Name')
                    ->required()
                    ->maxLength(255),
                
                    Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(Category::class, 'slug'),

            ]);
    }
}
