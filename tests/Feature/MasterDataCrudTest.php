<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Tests\TestCase;

class MasterDataCrudTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (config('database.default') !== 'sqlite') {
            return;
        }

        if (! extension_loaded('pdo_sqlite')) {
            self::markTestSkipped('The pdo_sqlite extension is required for in-memory CRUD tests.');
        }

        Schema::create('pelanggan', function (Blueprint $table): void {
            $table->id();
            $table->string('nama');
            $table->string('email')->nullable();
            $table->string('no_hp')->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
        });

        Schema::create('produk', function (Blueprint $table): void {
            $table->id();
            $table->string('nama_produk');
            $table->decimal('harga', 12, 2);
            $table->unsignedInteger('stok')->default(0);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        Schema::create('kategori', function (Blueprint $table): void {
            $table->id();
            $table->string('nama_kategori');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function test_customer_can_be_created_listed_updated_and_deleted(): void
    {
        $this->withinDatabaseTransaction(function (): void {
            $token = Str::uuid()->toString();
            $name = 'Pelanggan Uji '.$token;

            $this->post(route('pelanggan.store'), [
                'nama' => $name,
                'email' => $token.'@example.test',
                'no_hp' => '081234567890',
                'alamat' => 'Alamat uji',
            ])
                ->assertRedirect(route('pelanggan.index'))
                ->assertSessionHas('success', 'Data pelanggan berhasil ditambahkan!');

            $id = DB::table('pelanggan')->where('nama', $name)->value('id');
            $this->assertNotNull($id);
            $this->assertDatabaseHas('pelanggan', ['id' => $id, 'nama' => $name]);
            $this->get(route('pelanggan.index'))
                ->assertOk()
                ->assertSee($name)
                ->assertSee('alert-success', false)
                ->assertSee('Data pelanggan berhasil ditambahkan!');
            $this->get(route('pelanggan.edit', $id))->assertOk()->assertSee($name);

            $updatedName = 'Pelanggan Diperbarui '.$token;
            $this->put(route('pelanggan.update', $id), [
                'nama' => $updatedName,
                'email' => $token.'@example.test',
                'no_hp' => '081234567890',
                'alamat' => 'Alamat diperbarui',
            ])
                ->assertRedirect(route('pelanggan.index'))
                ->assertSessionHas('success', 'Data pelanggan berhasil diperbarui!');

            $this->assertDatabaseHas('pelanggan', ['id' => $id, 'nama' => $updatedName]);
            $this->get(route('pelanggan.index'))
                ->assertOk()
                ->assertSee('alert-success', false)
                ->assertSee('Data pelanggan berhasil diperbarui!');
            $this->delete(route('pelanggan.destroy', $id))
                ->assertRedirect(route('pelanggan.index'))
                ->assertSessionHas('success', 'Data pelanggan berhasil dihapus!');
            $this->get(route('pelanggan.index'))
                ->assertOk()
                ->assertSee('alert-success', false)
                ->assertSee('Data pelanggan berhasil dihapus!');
            $this->assertDatabaseMissing('pelanggan', ['id' => $id]);
        });
    }

    public function test_product_can_be_created_listed_updated_and_deleted(): void
    {
        $this->withinDatabaseTransaction(function (): void {
            $token = Str::uuid()->toString();
            $name = 'Produk Uji '.$token;

            $this->post(route('produk.store'), [
                'nama_produk' => $name,
                'harga' => '12500.50',
                'stok' => 5,
                'deskripsi' => 'Deskripsi uji',
            ])
                ->assertRedirect(route('produk.index'))
                ->assertSessionHas('success', 'Data produk berhasil ditambahkan.');

            $id = DB::table('produk')->where('nama_produk', $name)->value('id');
            $this->assertNotNull($id);
            $this->assertDatabaseHas('produk', ['id' => $id, 'nama_produk' => $name]);
            $this->get(route('produk.index'))
                ->assertOk()
                ->assertSee($name)
                ->assertSee('alert-success', false)
                ->assertSee('Data produk berhasil ditambahkan.');
            $this->get(route('produk.edit', $id))->assertOk()->assertSee($name);

            $updatedName = 'Produk Diperbarui '.$token;
            $this->put(route('produk.update', $id), [
                'nama_produk' => $updatedName,
                'harga' => '13500.75',
                'stok' => 8,
                'deskripsi' => 'Deskripsi diperbarui',
            ])
                ->assertRedirect(route('produk.index'))
                ->assertSessionHas('success', 'Data produk berhasil diperbarui.');

            $this->assertDatabaseHas('produk', ['id' => $id, 'nama_produk' => $updatedName]);
            $this->get(route('produk.index'))
                ->assertOk()
                ->assertSee('alert-success', false)
                ->assertSee('Data produk berhasil diperbarui.');
            $this->delete(route('produk.destroy', $id))
                ->assertRedirect(route('produk.index'))
                ->assertSessionHas('success', 'Data produk berhasil dihapus.');
            $this->get(route('produk.index'))
                ->assertOk()
                ->assertSee('alert-success', false)
                ->assertSee('Data produk berhasil dihapus.');
            $this->assertDatabaseMissing('produk', ['id' => $id]);
        });
    }

    public function test_category_can_be_created_listed_updated_and_deleted(): void
    {
        $this->withinDatabaseTransaction(function (): void {
            $token = Str::uuid()->toString();
            $name = 'Kategori Uji '.$token;

            $this->post(route('kategori.store'), [
                'nama_kategori' => $name,
                'keterangan' => 'Keterangan uji',
            ])
                ->assertRedirect(route('kategori.index'))
                ->assertSessionHas('success', 'Data kategori berhasil ditambahkan.');

            $id = DB::table('kategori')->where('nama_kategori', $name)->value('id');
            $this->assertNotNull($id);
            $this->assertDatabaseHas('kategori', ['id' => $id, 'nama_kategori' => $name]);
            $this->get(route('kategori.index'))
                ->assertOk()
                ->assertSee($name)
                ->assertSee('alert-success', false)
                ->assertSee('Data kategori berhasil ditambahkan.');
            $this->get(route('kategori.edit', $id))->assertOk()->assertSee($name);

            $updatedName = 'Kategori Diperbarui '.$token;
            $this->put(route('kategori.update', $id), [
                'nama_kategori' => $updatedName,
                'keterangan' => 'Keterangan diperbarui',
            ])
                ->assertRedirect(route('kategori.index'))
                ->assertSessionHas('success', 'Data kategori berhasil diperbarui.');

            $this->assertDatabaseHas('kategori', ['id' => $id, 'nama_kategori' => $updatedName]);
            $this->get(route('kategori.index'))
                ->assertOk()
                ->assertSee('alert-success', false)
                ->assertSee('Data kategori berhasil diperbarui.');
            $this->delete(route('kategori.destroy', $id))
                ->assertRedirect(route('kategori.index'))
                ->assertSessionHas('success', 'Data kategori berhasil dihapus.');
            $this->get(route('kategori.index'))
                ->assertOk()
                ->assertSee('alert-success', false)
                ->assertSee('Data kategori berhasil dihapus.');
            $this->assertDatabaseMissing('kategori', ['id' => $id]);
        });
    }

    private function withinDatabaseTransaction(\Closure $test): void
    {
        $connection = DB::connection();
        $connection->beginTransaction();

        try {
            $test();
        } finally {
            $connection->rollBack();
        }
    }
}
