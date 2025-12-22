<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Forms\Form;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Support\Str;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('Tabs')
                ->tabs([
                    Tab::make(__('catalog.general_settings'))
                        ->icon('heroicon-o-cog')
                        ->schema([
                            Section::make(__('catalog.general'))
                                ->icon('heroicon-o-information-circle')
                                ->description(__('catalog.general_setting_description'))
                                ->schema([
                                    TextInput::make('site_name')
                                        ->label(__('catalog.site_name'))
                                        ->reactive()
                                        ->translateLabel()
                                        ->markAsRequired(false),
                                    TextInput::make('slogan')
                                        ->label('Slogan')
                                        ->reactive()
                                        ->translateLabel()
                                        ->markAsRequired(false),





                                ]),



                        ]),
                    Tab::make(__('catalog.logo_and_image'))
                        ->icon('heroicon-o-photo')
                        ->schema([
                            Section::make(__('catalog.logo_manage'))
                                ->icon('heroicon-o-camera')
                                ->description(__('catalog.logo_description'))
                                ->schema([
                                    FileUpload::make('site_white_logo')->label(__('catalog.white_logo'))
                                        ->helperText(__('catalog.white_logo_description'))
                                        ->directory('settings'),
                                    FileUpload::make('site_dark_logo')->label(__('catalog.black_logo'))
                                        ->helperText(__('catalog.black_logo_description'))
                                        ->directory('settings'),
                                    FileUpload::make('footer_icon')->label(__('catalog.footer_icon'))
                                        ->helperText(__('catalog.footer_icon_description'))
                                        ->directory('settings'),
                                    FileUpload::make('favicon')->label('Favicon')
                                        ->helperText(__('catalog.favicon_description'))
                                        ->directory('settings'),
                                ]),



                        ]),
                    Tab::make('SEO & META')
                        ->icon('heroicon-o-magnifying-glass')

                        ->schema([
                            Section::make(__('catalog.meta_tags'))
                                ->description(__('catalog.meta_setting_description'))
                                ->icon('heroicon-o-chart-bar')
                                ->schema([
                                    TextInput::make('meta_title')
                                        ->label(__('catalog.meta_title'))
                                        ->helperText(__('catalog.meta_title_helper'))
                                        ->markAsRequired(false),

                                    TextInput::make('meta_description')
                                        ->label(__('catalog.meta_description'))
                                        ->helperText(__('catalog.meta_description_helper'))
                                        ->markAsRequired(false),

                                    TextInput::make('meta_keywords')
                                        ->label(__('catalog.meta_keywords'))
                                        ->helperText(__('catalog.meta_keywords_helper'))
                                        ->markAsRequired(false),
                                ]),

                        ]),
                    Tab::make(__('catalog.contact_information'))
                        ->icon('heroicon-o-phone')
                        ->schema([
                            Section::make(__('catalog.phone_number'))
                                ->icon('heroicon-o-phone')
                                ->description(__('catalog.phone_number_description'))
                                ->schema([
                                    Repeater::make('phone')
                                        ->label(__('catalog.phone'))
                                        ->schema([
                                            TextInput::make('tag')->label(__('catalog.display_name'))->markAsRequired(),
                                            TextInput::make('phone')
                                                ->label(__('catalog.phone'))
                                                ->markAsRequired(),
                                        ])
                                        ->collapsed()
                                        ->columns(2)
                                        ->itemLabel(fn (array $state): ?string => $state['tag'] ?? null),


                                ]),
                            Section::make(__('catalog.email_address'))
                                ->description(__('catalog.email_address_description'))
                                ->icon('heroicon-o-envelope')
                                ->schema([
                                    Repeater::make('email')
                                        ->label(__('catalog.email_address'))
                                        ->schema([
                                            TextInput::make('name')->label(__('catalog.display_name'))->markAsRequired(),
                                            TextInput::make('email')->label(__('catalog.email'))->markAsRequired(),

                                        ])
                                        ->collapsed()
                                        ->columns(2)
                                        ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),



                                ]),

                            Section::make(__('catalog.social_media'))
                                ->icon('heroicon-o-share')
                                ->description(__('catalog.social_media_description'))
                                ->schema([
                                    Repeater::make('social_media')->label(__('catalog.social_media'))
                                        ->schema([
                                            Select::make('platform_name')
                                                ->label(__('catalog.platform_name'))
                                                ->options([
                                                    'instagram' => 'Instagram',
                                                    'twitter' => 'Twitter / X',
                                                    'youtube' => 'YouTube',
                                                    'tiktok' => 'TikTok',
                                                    'facebook' => 'Facebook',
                                                ])
                                                ->markAsRequired()
                                                ->searchable(),
                                            TextInput::make('link')->label(__('catalog.connection_link'))->markAsRequired(),
                                        ])
                                        ->collapsed()
                                        ->columns(2)
                                        ->itemLabel(fn (array $state): ?string => isset($state['platform_name'])
                                            ? ucfirst($state['platform_name'])
                                            : null),
                                ]),
                        ]),
                    Tab::make(__('catalog.location_and_address'))
                        ->icon('heroicon-o-map-pin')
                        ->schema([
                            Section::make(__('catalog.address_info'))
                                ->icon('heroicon-o-map-pin')
                                ->description(__('catalog.address_info_description'))
                                ->schema([
                                    TextArea::make('address')
                                        ->label(__('catalog.full_address'))
                                        ->reactive()
                                        ->translateLabel()
                                        ->markAsRequired(false),
                                    TextInput::make('country')->label(__('catalog.country')),
                                    TextInput::make('city')->label(__('catalog.city')),
                                    TextInput::make('postal_code')->label(__('catalog.postal_code')),


                                ]),

                            Section::make(__('catalog.map_integrations'))
                                ->icon('heroicon-o-map')
                                ->description(__('catalog.map_integrations_description'))
                                ->schema([
                                    TextInput::make('latitude')
                                        ->label(__('catalog.latitude'))
                                        ->helperText(__('catalog.takegooglemaps'))
                                        ->markAsRequired(false),

                                    TextInput::make('longitude')
                                        ->helperText(__('catalog.takegooglemaps'))
                                        ->label(__('catalog.longitude'))
                                        ->markAsRequired(false),

                                    TextInput::make('google_embeded_url')
                                        ->helperText(__('catalog.embed_url_helpertext'))
                                        ->label('Google Embedded URL')
                                        ->markAsRequired(false),
                                ]),

                        ]),
                    Tab::make(__('catalog.working_hours'))
                        ->icon('heroicon-o-clock')
                        ->schema([
                            Section::make(__('catalog.working_program'))
                                ->icon('heroicon-o-calendar-days')
                                ->description(__('catalog.working_hours_description'))
                                ->schema([
                                    KeyValue::make('working_hours')
                                        ->label(__(__('catalog.working_hours')))
                                        ->keyLabel(__(__('catalog.day')))
                                        ->valueLabel(__('catalog.hour'))
                                        ->addButtonLabel(__('catalog.add_new_day'))
                                        ->reorderable()
                                        ->helperText(__('catalog.working_hours_helper'))
                                        ->reactive(),
                                ]),



                        ]),

                    Tab::make(__('catalog.script_entegrations'))
                        ->icon('heroicon-o-code-bracket')
                        ->schema([
                            Section::make(__('catalog.analytic_tracking'))
                                ->icon('heroicon-o-chart-bar-square')
                                ->description(__('catalog.analytic_tracking_description'))
                                ->schema([
                                    TextInput::make('google_analytics_id')
                                        ->label('Google Analytics ID')
                                        ->reactive()
                                        ->helperText(__('catalog.google_analyticid_helper'))
                                        ->translateLabel()
                                        ->markAsRequired(false),
                                    TextInput::make('google_tagmanager_id')
                                        ->label('Google Tag Manager ID')
                                        ->reactive()
                                        ->helperText(__('catalog.google_tag_manager_helper'))
                                        ->translateLabel()
                                        ->markAsRequired(false),
                                    TextInput::make('fbpixel_id')
                                        ->label('Facebook Pixel ID')
                                        ->reactive()
                                        ->helperText(__('catalog.fbpixel_helper'))
                                        ->translateLabel()
                                        ->markAsRequired(false),
                                    TextInput::make('meta_ads_id')
                                        ->label('Meta ADS ID')
                                        ->reactive()
                                        ->translateLabel()
                                        ->helperText(__('catalog.meta_ads_helper'))
                                        ->markAsRequired(false),
                                    TextInput::make('yandex_verification_id')
                                        ->label('Yandex Verification ID')
                                        ->helperText(__('catalog.yandex_verification_helper'))
                                        ->reactive()
                                        ->translateLabel()
                                        ->markAsRequired(false),
                                    TextInput::make('hotjar_id')
                                        ->label('Hotjar Site ID')
                                        ->helperText(__('catalog.hotjar_helper'))
                                        ->reactive()
                                        ->translateLabel()
                                        ->markAsRequired(false),



                                ])
                                ->columns(2)
                                ->collapsed(),

                            Section::make(__('catalog.private_codes'))
                                ->icon('heroicon-o-command-line')
                                ->description(__('catalog.private_codes_desc'))
                                ->schema([
                                    Textarea::make('head_code')
                                        ->rows(6)
                                        ->placeholder(__('catalog.head_code_placeholder'))
                                        ->label(__('catalog.head_code'))

                                        ->helperText(__('catalog.head_code_helper'))
                                        ->markAsRequired(false),

                                    Textarea::make('footer_code')
                                        ->rows(6)
                                        ->placeholder('<script>...</script>')
                                        ->label(__('catalog.footer_code'))
                                        ->helperText(__('catalog.footer_code_helper'))
                                        ->markAsRequired(false),


                                ]),

                        ]),

                    Tab::make(__('catalog.maintenance_mode'))
                        ->icon('heroicon-o-wrench-screwdriver')
                        ->schema([
                            Section::make(__('catalog.site_maintenance_setting'))
                                ->icon('heroicon-o-exclamation-triangle')
                                ->description(__('catalog.site_maintenance_desc'))
                                ->schema([
                                    Toggle::make('maintenance_mode')
                                        ->inline(false)
                                        ->label(__('catalog.is_active_maintenance'))
                                        ->reactive()
                                        ->default(false)
                                        ->helpertext(__('catalog.site_maintenance_helper'))
                                        ->translateLabel()
                                        ->markAsRequired(false),




                                ]),



                        ]),


                ])->columnSpanFull(),
        ]);
    }
}
