<?php

namespace App\Http\Controllers\Admin\Adverts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Adverts\SearchRequest;
use App\Http\Requests\Adverts\AttributesRequest;
use App\Http\Requests\Adverts\EditRequest;
use App\Http\Search\Admin\AdvertsSearch;
use App\UseCases\Adverts\AdvertService;
use Illuminate\Http\Request;
use App\Entity\Adverts\Advert\Advert;
use App\Entity\User;
use App\Http\Requests\Adverts\PhotoRequest;
use App\Http\Requests\Adverts\RejectRequest;

class AdvertController extends Controller
{
    private $service;
    private $search;

    public function __construct(AdvertService $service, AdvertsSearch $search)
    {
        $this->service = $service;
        $this->search=$search;
        $this->middleware('can:manage-adverts');
    }

    public function index(SearchRequest $request)
    {
        $adverts=$this->search->search($request);
        $statuses = Advert::$statusesList;
        $classes = Advert::$statusClasses;
        $roles = User::$rolesName;

        return view('admin.adverts.adverts.index', compact('adverts', 'statuses', 'roles','classes'));
    }

    public function editForm(Advert $advert)
    {
        return view('adverts.edit.advert', compact('advert'));
    }

    public function edit(EditRequest $request, Advert $advert)
    {
        try {
            $this->service->edit($advert->id, $request);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('adverts.show', $advert);
    }

    public function attributesForm(Advert $advert)
    {
        return view('adverts.edit.attributes', compact('advert'));
    }

    public function attributes(AttributesRequest $request, Advert $advert)
    {
        try {
            $this->service->editAttributes($advert->id, $request);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('adverts.show', $advert);
    }

    public function photosForm(Advert $advert)
    {
        return view('adverts.edit.photos', compact('advert'));
    }

    public function photos(PhotoRequest $request, Advert $advert)
    {
        try {
            $this->service->addPhotos($advert->id, $request);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('adverts.show', $advert);
    }

    public function moderate(Advert $advert)
    {
        try {
            $this->service->moderate($advert->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('adverts.show', $advert);
    }

    public function rejectForm(Advert $advert)
    {
        return view('admin.adverts.adverts.reject', compact('advert'));
    }

    public function reject(RejectRequest $request, Advert $advert)
    {
        try {
            $this->service->reject($advert->id, $request);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('adverts.show', $advert);
    }

    public function destroy(Advert $advert)
    {
        try {
            $this->service->remove($advert->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }
        return redirect()->route('admin.adverts.adverts.index');
    }

}
