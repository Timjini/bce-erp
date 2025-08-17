<?php

namespace App\Filament\Resources\Sections\Schemas;

use App\Models\Section;
use Filament\Schemas\Schema;
use Filament\Forms;

class SectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('name')
                    ->label('Section Name')
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(Section::class, 'slug'),
            ]);
    }
}
