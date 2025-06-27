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
use Filament\Notifications\Notification;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Form extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
        FilamentColor::register([
            'primary' => '#3d9c46',
        ]);
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
                        FileUpload::make('attachments')
                            ->live()
                            ->label('Upload CV')
                            ->acceptedFileTypes(['application/pdf'])
                            ->columnSpanFull()
                            ->multiple()
                            ->maxParallelUploads(1)
                            ->maxFiles(3)
                            ->directory('attachments')
                            ->visibility('private')
                            ->moveFiles(),
                    ])
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = Application::create($data);

        try {
            Mail::to(env('APPLICATION_TO_ADDRESS'))
                ->cc(env('APPLICATION_CC_ADDRESS'))
                ->bcc(env('APPLICATION_BCC_ADDRESS'))
                ->send(new ApplicationMailer($record));
        } catch (\Exception $e) {
            \Log::error('Mail sending failed: ' . $e->getMessage());

            Notification::make()
                ->title('There was an error with your submission. ')
                ->body('Please contact us on <a href="tel:+3536731590">+353 673 1590</a> or <a href="mailto:info@agritech.ie">info@agritech.ie</a>.')
                ->danger()
                ->send();

            return;
        }

        Notification::make()
            ->title('Your application has been submitted.')
            ->body('We will be in touch shortly.')
            ->success()
            ->send();


        $this->form->fill();
    }

    public function render()
    {
        return view('livewire.form');
    }
}
