<?php

namespace SenseBook\Repositories;

use SenseBook\Models\Bank;
use SenseBook\Models\FactBankAccount;
use SenseBook\Http\Requests\BackOffice\Setting\BankRequest;
use SenseBook\Http\Requests\BackOffice\Setting\BankUpdateRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class BankRepository
{

    public $perPage = 15;
    public $uploadPath = '';
    
    public function find($id)
    {

        $bank = Bank::withTrashed()->whereId($id)->first();

        if (!empty($bank) && $bank != null) {
            if ($bank->trashed()) {
                Session::flash('warning', 'Can\'t Edit Data');
            }
            return $bank;
        }

        return null;
    }

    public function query(Request $request)
    {

        if ($request->has('search')) {
            $data_search = $request->search;
            $banks = Bank::withTrashed()
                ->where('name', 'LIKE', "%{$data_search}%")
                ->orWhere('account_type', 'LIKE', "%{$data_search}%")
                ->orWhere('account_no', 'LIKE', "%{$data_search}%")
                ->orWhereHas('factBankAccount', function ($query) use ($data_search) {
                    $query
                        ->where('name', 'LIKE', "%{$data_search}%");
                });
        } else {
            $banks = Bank::withTrashed();
        }

        return $banks->paginate($this->perPage);
    }

    public function store(Request $request)
    {
        $fact_bank_id = null;
        
        if (isset($request->other_bank) && $request->other_bank) {
            if ($request->hasFile('bank_logo')) {
                $this->uploadLogo($request);
            }

            if (FactBankAccount::where('name', $request->bank_name)->count() == 0) {
                $fact_bank = array(
                    'name' => $request->bank_name,
                    'logo' => $request->set_logo
                );

                $fact_bank_id = FactBankAccount::create($fact_bank)->id;
            } else {
                $fact_bank_id = FactBankAccount::where('name', $request->bank_name)
                    ->first()->id;
            }
        }

        $fact_bank_id = $fact_bank_id != null ? $fact_bank_id : $request->bank_id;

        $bank = new Bank;
        
        $bank->bank_id = $fact_bank_id;
        $bank->name = $request->name;
        $bank->account_type = $request->account_type;
        $bank->account_no = $request->account_no;
        $bank->branch = $request->branch;

        if ($bank->save()) {
            Session::flash('success', 'Updated Success');
        } else {
            Session::flash('warning', 'Data not Found');
        }
    }

    public function update(BankUpdateRequest $request, $id)
    {
        
        $fact_bank_id = null;

        if (isset($request->other_bank) && $request->other_bank) {
            if ($request->hasFile('bank_logo')) {
                $this->uploadLogo($request);
            }

            if (FactBankAccount::where('name', $request->bank_name)->count() == 0) {
                $fact_bank = array(
                    'name' => $request->bank_name,
                    'logo' => $request->set_logo
                );

                $fact_bank_id = FactBankAccount::create($fact_bank)->id;
            } else {
                $fact_bank_id = FactBankAccount::where('name', $request->bank_name)->first()->id;
            }
        }

        $fact_bank_id = $fact_bank_id != null ? $fact_bank_id : $request->bank_id;

        $bank = Bank::withTrashed()->whereId($id)->first();

        $bank->bank_id = $fact_bank_id;
        $bank->name = $request->name;
        $bank->account_type = $request->account_type;
        $bank->account_no = $request->account_no;
        $bank->branch = $request->branch;

        if ($bank->save()) {
            Session::flash('success', 'Updated Success');
        } else {
            Session::flash('warning', 'Data not Found');
        }
    }

    public function destroy(Request $request, $id)
    {

        $bank = Bank::withTrashed()->whereId($id)->first();
        if (!empty($bank)) {
            if ($bank->trashed()) {
                if ($request->has('force')) {
                    $bank->forceDelete();
                    Session::flash('success', 'Force Deleted success');
                } else {
                    Session::flash('warning', 'Data not Found');
                }
            } else {
                if (!$request->has('force')) {
                    $bank->delete();
                    Session::flash('success', 'Deleted success');
                } else {
                    Session::flash('warning', 'Data not Found');
                }
            }
        }
    }

    public function destroyAll(Request $request)
    {
        $ids = explode(',', $request->id);

        if (!empty($ids)) {
            foreach ($ids as $id) {
                $bank = Bank::withTrashed()->find($id);
                if (!empty($bank)) {
                    if ($bank->trashed()) {
                        if ($bank->image) {
                            $pathDelete = storage_path($bank->image);
                            File::delete($pathDelete);
                        }
                        $bank->forceDelete();
                    } else {
                        $bank->delete();
                    }
                }
            }
            Session::flash('success', 'Deleted Success');
        } else {
            Session::flash('warning', 'Data not Found');
        }
    }

    public function restore($id)
    {

        $bank = Bank::onlyTrashed()->whereId($id)->first();
        if (!empty($bank)) {
            $bank->restore();
            Session::flash('success', 'Restore Success');
        } else {
            Session::flash('warning', 'warning');
        }
    }

    private function uploadLogo(Request $request)
    {

        $image = Input::file('bank_logo');

        $imageName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);

        $directory = $this->getDirectory();
        File::makeDirectory(storage_path($directory), 0775, true, true);

        $filename   = $imageName . '.' . date('Ymd') . '.' . $image->getClientOriginalExtension();
        $filePath = "{$directory}/{$filename}";
        $img = Image::make($image->getRealPath());
        
        $img->resize(50, 50, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->stream();

        File::put($filePath, $img);
        
        $request->request->set('set_logo', $filePath);
    }

    private function getDirectory()
    {

        $directory = "images/backOffice/bankAcc/logo/uploaded";

        return $directory;
    }
}
