<?php

namespace App\Filament\Resources\Media\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;

class MediaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('name')
                ->label('Image Name')
                ->maxLength(255),

                Forms\Components\FileUpload::make('file_path')
                    ->label('Upload Image')
                    ->image()
                    ->directory('galleries')
                    ->preserveFilenames()
                    ->required(),
            ]);
    }
}
