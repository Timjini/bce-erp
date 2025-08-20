<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;
use App\Models\Page;


class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Forms\Components\Select::make('section_id')
                    ->relationship('section', 'name')
                    ->label('Section')
                    ->required(),
                    
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Category'),

                Forms\Components\TextInput::make('title')
                    ->label('Page Title')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(Page::class, 'slug'),
                
                Forms\Components\FileUpload::make('image_url')
                ->label('Page Image')
                ->image() // ensures only image files
                ->directory('pages') // uploaded to storage/app/public/pages or S3 bucket depending on config
                ->disk('s3') // or 'public'
                ->nullable(),

                // Forms\Components\RichEditor::make('content')
                // ->label('Content')
                // ->required()
                // ->toolbarButtons([
                //     'bold', 'italic', 'link', 'bulletList', 'blockquote', 'codeBlock', 'h2', 'h3', 'attachFiles'
                // ]),
                Forms\Components\Textarea::make('content')
                ->label('Content (HTML)')
                ->rows(10),
            ]);
    }
}
