<div class="bg-[#F2F2F2] px-4 py-12">
    <div class="container mx-auto">
        <h1 class="text-4xl text-blue text-center mb-12">Apply today</h1>
        <form wire:submit="create">
            {{ $this->form }}
            <div class="flex flex-col items-end">
                <button type="submit" class="bg-green text-white text-lg px-4 py-2 rounded-md inline-block mt-6">
                    Apply now
                </button>
                <p class="text-sm mt-4">By applying for this job you accept our <a href="#"
                        class="text-green underline">Privacy
                        Policy</a></p>
            </div>
        </form>
        <x-filament-actions::modals />
    </div>
</div>
