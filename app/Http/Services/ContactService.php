<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Models\Contact;

class ContactService
{
    public function deleteDuplicates(): void
    {
        $latestContacts = Contact::query()->whereIn('id', function ($query) {
            $query->selectRaw('MAX(id)')
                ->from('contacts')
                ->groupBy('phone_number');
        })->get();

        foreach ($latestContacts as $latestContact) {
            Contact::query()->where('phone_number', $latestContact->phone_number)
                ->where('id', '<>', $latestContact->id)
                ->delete();
        }
    }
}
