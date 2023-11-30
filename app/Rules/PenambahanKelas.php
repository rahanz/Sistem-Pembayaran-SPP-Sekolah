<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Kelas;

class PenambahanKelas implements Rule
{
    protected $kelas;
    protected $jurusan;

    public function __construct($kelas, $jurusan)
    {
        $this->kelas = $kelas;
        $this->jurusan = $jurusan;
    }

    public function passes($attribute, $value)
    {
        return !Kelas::where('kelas', $this->kelas)
            ->where('jurusan', $this->jurusan)
            ->exists();
    }

    public function message()
    {
        return ':attribute sudah ada.';
    }
}
