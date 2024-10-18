<?php

namespace App\Http\Responses;

use Filament\Facades\Filament;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;
use App\Filament\Resources\TaskResource; // Adjust this to your correct task resource

class LoginResponse extends \Filament\Http\Responses\Auth\LoginResponse
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        // Check if the current panel is 'admin'
        if (Filament::getCurrentPanel()->getId() === 'admin') {
            return redirect()->to('/admin'); // Admin dashboard, adjust as needed
        }

        // Check if the current panel is 'app' and redirect to Tasks
        if (Filament::getCurrentPanel()->getId() === 'app') {
            return redirect()->to(TaskResource::getUrl('index')); // Redirect to Task resource index
        }

        return parent::toResponse($request);
    }
}
