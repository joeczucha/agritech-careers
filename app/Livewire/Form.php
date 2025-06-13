<?php

namespace App\Livewire;

// use Filament\Forms\Components\Button;
use App\Mail\ApplicationMailer;
use App\Models\Application;
use Filament\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Form extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Forms\Form $form): Forms\Form
    {
        return  $form
            ->schema([
                Grid::make()
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('first_name')
                                ->label('First name')
                                ->required(),
                            TextInput::make('last_name')
                                ->label('Last name')
                                ->required(),
                            TextInput::make('email')
                                ->label('Email')
                                ->email()
                                ->required(),
                            TextInput::make('linkedin')
                                ->label('LinkedIn profile')
                                ->placeholder('https://www.linkedin.com/in/candidatename'),
                            Select::make('phone_country')
                                ->label('Phone')
                                ->options([
                                    'IE' => '🇮🇪 +353',
                                    // Add more countries as needed
                                ])
                                ->required()
                                ->columnSpan(1),
                            TextInput::make('phone')
                                ->label('')
                                ->placeholder('+353')
                                ->required()
                                ->columnSpan(1),
                            TextInput::make('location')
                                ->label('Location')
                                ->required(),
                        ]),
                        RichEditor::make('cover_note')
                            ->label('Cover note')
                            ->placeholder('Please provide details on your most relevant skills')
                            ->columnSpanFull()
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'link',
                                'strike',
                                'bulletList',
                                'orderedList',
                                'redo',
                                'undo',
                            ]),
                        FileUpload::make('cv')
                            ->label('Upload CV')
                            ->acceptedFileTypes(['application/pdf'])
                            ->preserveFilenames()
                            ->columnSpanFull()
                            ->required(),
                    ])
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = Application::create($data);

        Mail::to('hello@doctypedigital.ie')->send(new ApplicationMailer($record));
    }

    public function render()
    {
        return view('livewire.form');
    }
}
