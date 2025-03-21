<?php

namespace App\Filament\Resources\Admin;

use App\Filament\Resources\Admin\SiteInfoResource\Pages;
use App\Models\SiteInfo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SiteInfoResource extends Resource
{
    protected static ?string $model = SiteInfo::class;

    protected static ?string $slug = '/page/info';
    protected static ?string $navigationGroup = 'Menu';
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    public static function getLabel(): string
    {
        return __('site-info.page.title');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('shortname')
                    ->label(__('site-info.shortname.label'))
                    ->helperText(__('site-info.shortname.desc'))
                    ->placeholder('libravel_')
                    ->maxLength(255),

                Forms\Components\TextInput::make('fullname')
                    ->label(__('site-info.fullname.label'))
                    ->helperText(__('site-info.fullname.desc'))
                    ->placeholder('Libravel')
                    ->maxLength(255),

                Forms\Components\TextInput::make('url')
                    ->label(__('site-info.url.label'))
                    ->helperText(__('site-info.url.desc'))
                    ->placeholder('https://getlibravel.com')
                    ->url()
                    ->suffixIcon('heroicon-m-globe-alt')
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('email')
                    ->label(__('site-info.email.label'))
                    ->helperText(__('site-info.email.desc'))
                    ->placeholder('info@libravel.com')
                    ->email(),

                Forms\Components\TextInput::make('phone')
                    ->label(__('site-info.phone.label'))
                    ->helperText(__('site-info.phone.desc'))
                    ->placeholder('+1 555 555 5555')
                    ->tel(),

                Forms\Components\RichEditor::make('description')
                    ->label(__('site-info.description.label'))
                    ->helperText(__('site-info.description.desc'))
                    ->toolbarButtons(['undo', 'redo', 'bold', 'italic', 'underline'])
                    ->columnSpan('full')
                    ->maxLength(5000),

                Forms\Components\SpatieMediaLibraryFileUpload::make('logo')
                    ->label(__('site-info.logo.label'))
                    ->helperText(__('site-info.logo.desc'))
                    ->collection('logo')
                    ->image()
                    ->disk('public')
                    ->directory('site/logo'),

                Forms\Components\SpatieMediaLibraryFileUpload::make('favicon')
                    ->label(__('site-info.favicon.label'))
                    ->helperText(__('site-info.favicon.desc'))
                    ->collection('favicon')
                    ->image()
                    ->disk('public')
                    ->directory('site/favicon'),

                Forms\Components\Toggle::make('is_default')
                    ->label(__('site-info.is_default.label'))
                    ->helperText(__('site-info.is_default.desc'))
                    ->default(false)
                    ->disabled(fn($record) => SiteInfo::count() === 1)
                    ->afterStateUpdated(function ($state, $record) {
                        if ($state) {
                            SiteInfo::where('id', '!=', $record->id)->update(['is_default' => false]);
                        } else {
                            if (SiteInfo::where('is_default', true)->count() === 0) {
                                Notification::make()
                                    ->title(__('site-info.messages.site_info_default'))
                                    ->danger()
                                    ->send();

                                $record->is_default = true;
                                $record->save();
                            }
                        }
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('shortname')
                    ->label(__('site-info.shortname.label'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('fullname')
                    ->label(__('site-info.fullname.label'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('url')
                    ->label(__('site-info.url.label'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('site-info.email.label'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label(__('site-info.phone.label'))
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_default')
                    ->label(__('site-info.is_default.label'))
                    ->disabled(fn($record) => SiteInfo::count() === 1)
                    ->afterStateUpdated(function ($state, $record) {
                        if ($state) {
                            SiteInfo::where('id', '!=', $record->id)->update(['is_default' => false]);
                        } else {
                            if (SiteInfo::where('is_default', true)->count() === 0) {
                                Notification::make()
                                    ->title(__('site-info.messages.site_info_default'))
                                    ->danger()
                                    ->send();

                                $record->is_default = true;
                                $record->save();
                            }
                        }
                    }),
            ])
            ->filters([
                // 
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->disabled(fn($record) => SiteInfo::count() === 1)
                    ->before(function ($record) {
                        if (SiteInfo::count() === 1) {
                            Notification::make()
                                ->title('You cannot delete the only site info.')
                                ->danger()
                                ->send();
                            return false; // Batalkan penghapusan
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiteInfos::route('/'),
        ];
    }
}
