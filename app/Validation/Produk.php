<?php

namespace App\Validation;

class Produk
{
    public function ruleStore()
    {
        return [
            'produk' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Field produk wajib diisi',
                    'min_length' => 'Field produk minimal 3 karakter',
                ]
            ],
            'harga' => [
                'rules' => 'required|regex_match[/^\d+(\.\d{1,2})?$/]',
                'errors' => [
                    'required' => 'Field harga wajib diisi',
                    'regex_match' => 'Format harga harus berupa angka (contoh: 10000 atau 10000.50)',
                ]
            ],
            'stok' => [
                'rules' => 'permit_empty|regex_match[/^\d+$/]',
                'errors' => [
                    'regex_match' => 'Stok produk harus berupa angka bulat positif',
                ]
            ],
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Field kategori wajib dipilih',
                ]
            ],
            'satuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Field satuan wajib dipilih',
                ]
            ],
        ];
    }

    public function ruleUpdate()
    {
        return [
            'produk' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Field produk wajib diisi',
                    'min_length' => 'Field produk minimal 3 karakter',
                ]
            ],
            'harga' => [
                'rules' => 'required|regex_match[/^\d+(\.\d{1,2})?$/]',
                'errors' => [
                    'required' => 'Field harga wajib diisi',
                    'regex_match' => 'Format harga harus berupa angka (contoh: 10000 atau 10000.50)',
                ]
            ],
            'stok' => [
                'rules' => 'permit_empty|regex_match[/^\d+$/]',
                'errors' => [
                    'regex_match' => 'Stok harus berupa angka bulat positif',
                ]
            ],
        ];
    }
}
