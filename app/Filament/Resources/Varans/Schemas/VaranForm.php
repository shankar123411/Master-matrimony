<?php

namespace App\Filament\Resources\Varans\Schemas;

use App\Support\MatrimonyConstants;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class VaranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('1. வரன் தேர்வு & அடிப்படை விபரங்கள் (Basic Details)')
                    ->schema([
                        Radio::make('varan_type')
                            ->label('வரன் பிரிவு')
                            ->options([
                                'penn' => '👰 பெண் வரன் (Bride)',
                                'aan' => '🤵 ஆண் வரன் (Groom)',
                            ])
                            ->default('penn')
                            ->inline()
                            ->required(),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('வரன் பெயர் (Candidate Name)')
                                    ->placeholder('e.g. AMIRTHAVADIVU N')
                                    ->required(),

                                Select::make('community')
                                    ->label('இனம் / சமூகம் (Community)')
                                    ->options([
                                        'செங்குந்தர்' => 'செங்குந்தர்',
                                        'கைக்கோளர்' => 'கைக்கோளர்',
                                        'செங்குந்த முதலியார்' => 'செங்குந்த முதலியார்',
                                        'இதர பிரிவுகள்' => 'இதர பிரிவுகள்',
                                    ])
                                    ->default('செங்குந்தர்'),
                            ]),

                        FileUpload::make('photo_path')
                            ->label('வரன் புகைப்படம் (Photo Upload)')
                            ->image()
                            ->directory('varan-photos')
                            ->imageEditor(),
                    ]),

                Section::make('2. பிறப்பு, கல்வி & பணி விபரம் (Birth & Career)')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                DatePicker::make('dob')
                                    ->label('பிறந்த தேதி (DOB)'),

                                TextInput::make('birth_time')
                                    ->label('பிறந்த நேரம் (Birth Time)')
                                    ->placeholder('e.g. 12:24 PM'),

                                TextInput::make('birth_place')
                                    ->label('பிறந்த ஊர் (Birth Place)')
                                    ->placeholder('e.g. திருப்பூர்'),
                            ]),

                        Grid::make(2)
                            ->schema([
                                Select::make('education')
                                    ->label('வரனின் படிப்பு (Education)')
                                    ->options(MatrimonyConstants::educations())
                                    ->searchable(),

                                Select::make('job_title')
                                    ->label('வேலை / பணி (Job Title)')
                                    ->options(MatrimonyConstants::jobs())
                                    ->searchable(),

                                TextInput::make('company_details')
                                    ->label('நிறுவனம் பெயர் & ஊர் (Company & City)')
                                    ->placeholder('e.g. Cognizant, Coimbatore'),

                                TextInput::make('monthly_income')
                                    ->label('மாத வருமானம் (Monthly Income)')
                                    ->placeholder('e.g. 95,000'),
                            ]),
                    ]),

                Section::make('3. தோற்றம், குலம் & கூட்டம் (Physical & Clan)')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextInput::make('height')
                                    ->label('உயரம் (Height)')
                                    ->placeholder('e.g. 157 cm'),

                                TextInput::make('weight')
                                    ->label('எடை (Weight)')
                                    ->placeholder('e.g. 55 kg'),

                                Select::make('complexion')
                                    ->label('நிறம் (Complexion)')
                                    ->options(MatrimonyConstants::complexions()),
                            ]),

                        Grid::make(3)
                            ->schema([
                                TextInput::make('kuladeivam')
                                    ->label('குலதெய்வம் & ஊர்')
                                    ->placeholder('e.g. செல்வநாயகி அம்மன், கீரனூர்'),

                                TextInput::make('gothram')
                                    ->label('கோத்திரம் (Gothram)')
                                    ->placeholder('e.g. சிவ கோத்திரம்'),

                                TextInput::make('kootam')
                                    ->label('கூட்டம் (Kootam)')
                                    ->placeholder('e.g. கீரனூரார் கூட்டம்'),
                            ]),
                    ]),

                Section::make('4. பெற்றோர் & குடும்ப விபரம் (Family & Address)')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('father_name')
                                    ->label('தந்தை பெயர் (Father Name)')
                                    ->placeholder('e.g. Nandhakumar D'),

                                TextInput::make('father_job')
                                    ->label('தந்தையின் பணி & பூர்வீகம்')
                                    ->placeholder('e.g. Employed / திருப்பூர்'),

                                TextInput::make('mother_name')
                                    ->label('தாய் பெயர் (Mother Name)')
                                    ->placeholder('e.g. Usha N'),

                                TextInput::make('mother_job')
                                    ->label('தாயின் பணி & பூர்வீகம்')
                                    ->placeholder('e.g. Employed / திருப்பூர்'),

                                TextInput::make('father_mobile')
                                    ->label('தொடர்பு அலைபேசி (Mobile)')
                                    ->placeholder('e.g. 9994792523, 8148478085'),

                                TextInput::make('family_wealth')
                                    ->label('குடும்ப வருமானம் / வசதிகள் (Assets)')
                                    ->placeholder('e.g. 60,000 / சொந்த வீடு'),
                            ]),

                        TextInput::make('siblings_details')
                            ->label('உடன் பிறந்தோர் விவரம் (Siblings)')
                            ->placeholder('e.g. 1 தங்கை, Designer'),

                        Textarea::make('address')
                            ->label('முழு முகவரி (Address)')
                            ->placeholder('e.g. 31/18, காமாட்சியம்மன் கோவில் தெரு, திருப்பூர்')
                            ->columnSpanFull(),
                    ]),

                Section::make('5. ஜோதிட விபரம் (மாறாத விபரங்கள் - Select Dropdowns)')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Select::make('rasi')
                                    ->label('ராசி (Zodiac Rasi)')
                                    ->options(MatrimonyConstants::rasis())
                                    ->searchable(),

                                Select::make('natchathiram')
                                    ->label('நட்சத்திரம் (27 Stars)')
                                    ->options(MatrimonyConstants::natchathirams())
                                    ->searchable(),

                                Select::make('lagnam')
                                    ->label('லக்னம் (Lagnam)')
                                    ->options(MatrimonyConstants::lagnams())
                                    ->searchable(),
                            ]),

                        Grid::make(2)
                            ->schema([
                                Select::make('dosham')
                                    ->label('தோஷ விபரம் (Dosham)')
                                    ->options(MatrimonyConstants::doshams()),

                                TextInput::make('thisai_iruppu')
                                    ->label('திசை இருப்பு (Thisai Iruppu)')
                                    ->placeholder('e.g. சுக்கிரன் திசை'),
                            ]),
                    ]),

                Section::make('6. எதிர்பார்ப்புகள் & இதர குறிப்புகள் (Expectations)')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('marriage_type')
                                    ->label('திருமண வகை (Marriage Type)')
                                    ->options([
                                        'mudhal_manama' => 'முதல் மணமா (First Marriage)',
                                        'marumanama' => 'மறுமணமா (Remarriage)',
                                    ])
                                    ->default('mudhal_manama'),

                                Select::make('blood_group')
                                    ->label('ரத்த வகை (Blood Group)')
                                    ->options(MatrimonyConstants::bloodGroups()),

                                TextInput::make('email')
                                    ->label('மின்னஞ்சல் (Email ID)')
                                    ->email()
                                    ->placeholder('e.g. example@gmail.com'),
                            ]),

                        Textarea::make('expectations')
                            ->label('எதிர்பார்ப்புகள் மற்றும் இதர குறிப்புகள்')
                            ->placeholder('e.g. நன்கு படித்த, நல்ல குணமுள்ள IT அல்லது பிற துறையில் பணிபுரியும் வரன்')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
