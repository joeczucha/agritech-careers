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
                                ->required(),
                            TextInput::make('last_name')
                                ->required(),
                            TextInput::make('email')
                                ->email()
                                ->required(),
                            TextInput::make('phone')
                                ->tel()
                                ->placeholder('+353')
                                ->required()
                                ->columnSpan(1),
                            TextInput::make('location')
                                ->required(),
                            TextInput::make('linkedin_profile')
                                ->url()
                                ->placeholder('https://www.linkedin.com/in/candidatename'),

                        ]),
                        RichEditor::make('cover_note')
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
