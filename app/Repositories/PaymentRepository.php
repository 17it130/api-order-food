<?php

namespace App\Repositories;

use App\Models\Payment;

class PaymentRepository implements PaymentRepositoryInterface {

    public function getAll()
    {
        return Payment::all();
    }

    public function show($id)
    {
        return Payment::findOrFail($id);
    }

    public function update($data, $id)
    {
        return Payment::where('id', $id)->update($data);
    }
}
