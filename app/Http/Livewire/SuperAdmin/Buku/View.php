<?php

namespace App\Http\Livewire\SuperAdmin\Buku;

use App\Attribute\AttibuteBuku;
use App\Attribute\AttributeKategori;
use App\Attribute\AttributeSubjek;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\KategoriBuku;
use App\Models\Subjek;
use App\Models\SubjekBuku;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\PdfToImage\Pdf;

class View extends Component
{
    use WithPagination, AttibuteBuku, AttributeSubjek, AttributeKategori, WithFileUploads;

    public $opt_order_by = [
        'latest' => 'terbaru',
        'older' => 'terlama'
    ];
    public $cari;
    public $modal = false;
    public $order_by = 'latest';
    public $buku_id = false;
    public $rules = [
        'judul_buku' => 'required',
        'jenis_buku' => 'required',
        'penerbit' => 'required',
        'bahasa' => 'required',
        'isbn' => 'required',
        'file' => 'mimes:pdf',
    ];
    protected $listeners = [
        'kategori_select',
        'subjek_select'
    ];

    public function save()
    {

        if ($this->jenis_buku == Buku::DIGITAL && !is_string($this->file)) {
            $this->rules['file'] = 'required|mimes:pdf';
        } else {
            $this->rules['file'] = 'sometimes|nullable';
        }
        $data = $this->validate();
        if ($this->jenis_buku == Buku::DIGITAL && !is_string($this->file)) {
            $data['file'] = $this->file->store("doc");
            $pdfO = new Pdf(Storage::path($data['file']));
            $fileName = rand(0, 100000000) . '.png';
            $thumbnailPath = public_path('/storage/thumb' . '/' . $fileName);
            $thumbnail = $pdfO->setPage(1)
                ->setOutputFormat('png')
                ->saveImage($thumbnailPath);
            $data['cover'] = "thumb/" . $fileName;
        }elseif(!is_string($this->file)){
            unset($data['file']);
        }
        //create buku
        $data['users_id'] = auth()->user()->getAuthIdentifier();
        $buku = Buku::updateOrCreate(['id' => $this->buku_id], $data);

        //kategori
        KategoriBuku::where('buku_id', $buku->id)->delete();
        foreach ($this->kategori_id as $key => $item) {
            KategoriBuku::create([
                'buku_id' => $buku->id,
                'kategori_id' => $key
            ]);
        }
        //subjek
        SubjekBuku::where('buku_id', $buku->id)->delete();
        foreach ($this->subjek_id as $key => $item) {
            SubjekBuku::create([
                'buku_id' => $buku->id,
                'subjek_id' => $key
            ]);
        }
        $this->modal = false;
        $this->emit("alert", ['body' => 'Buku berhasil disimpan.', 'tipe' => 'success']);
    }

    public function change($id)
    {
        $buku = Buku::findOrFail($id);
        $this->mountBuku($buku);
        foreach ($buku->subjek_buku as $item){
            $this->subjek_id[$item->subjek_id] = $item->subjek->nama;
        }
        foreach ($buku->kategori_buku as $item){
            $this->kategori_id[$item->kategori_id] = $item->kategori->nama;
        }
        $this->buku_id = $id;
        $this->modal = true;
    }

    public function removeBuku($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();
        $this->emit("alert", ['body' => 'Buku berhasil dihapus.', 'tipe' => 'success']);

    }

    public function render()
    {
        $table = Buku::when($this->order_by == "latest", function ($q) {
            $q->latest();
        })
            ->when($this->order_by == "older", function ($q) {
                $q->oldest();
            })
            ->when($this->cari, function ($q) {
                $q->where('judul_buku', 'like', '%' . $this->cari . '%');
            })
            ->paginate(10);
        return view('livewire.super-admin.buku.view')->with(compact('table'));
    }
}
