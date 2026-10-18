<?php

namespace Tests\Feature;

use Tests\TestCase;

class MasterDataRoutesTest extends TestCase
{
    public function test_admin_dashboard_is_accessible(): void
    {
        $this->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Kelola Data Pelanggan')
            ->assertSee('Kelola Data Produk')
            ->assertSee('Kelola Data Kategori');
    }

    public function test_master_create_forms_are_accessible(): void
    {
        foreach (['pelanggan', 'produk', 'kategori'] as $resource) {
            $this->get(route($resource.'.create'))
                ->assertOk()
                ->assertSee('Adit Chocolate');
        }
    }

    public function test_master_forms_validate_required_fields_without_writing_to_database(): void
    {
        $requiredFields = [
            'pelanggan' => ['nama'],
            'produk' => ['nama_produk', 'harga', 'stok'],
            'kategori' => ['nama_kategori'],
        ];

        foreach ($requiredFields as $resource => $fields) {
            $response = $this->followingRedirects()
                ->from(route($resource.'.create'))
                ->post(route($resource.'.store'), []);

            $response
                ->assertOk()
                ->assertSee('alert-danger', false)
                ->assertSee('Periksa kembali data yang diisi.');

            foreach ($fields as $field) {
                $this->assertStringContainsString(
                    str_replace('_', ' ', $field),
                    strtolower($response->getContent()),
                );
            }
        }
    }

    public function test_customer_input_is_preserved_after_validation_fails(): void
    {
        $response = $this->followingRedirects()
            ->from(route('pelanggan.create'))
            ->post(route('pelanggan.store'), [
                'nama' => 'Adit',
                'email' => 'bukan-email',
            ]);

        $response
            ->assertOk()
            ->assertSee('alert-danger', false)
            ->assertSee('value="Adit"', false);
        $this->assertStringContainsString('email', strtolower($response->getContent()));
    }
}
