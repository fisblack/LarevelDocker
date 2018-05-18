<?php

namespace SenseBook\Http\Controllers\BackOffice\Setting;

use SenseBook\Http\Controllers\Controller;
use SenseBook\Http\Requests\BackOffice\Setting\BankRequest;
use SenseBook\Http\Requests\BackOffice\Setting\BankUpdateRequest;
use SenseBook\Repositories\BankRepository;
use Illuminate\Http\Request;
use SenseBook\Models\FactBankAccount;
use SenseBook\Models\Bank;
use Response;
use Session;

class BankAccountController extends Controller
{

    private $bankRepository;

    public function __construct(BankRepository $bankRepository)
    {
        $this->bankRepository = $bankRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        // search จาก field ไหนก็ได้ ทำเป็นแบบ OR ให้มี %search_term% ก็เจอ
        
        $search = $request->search;

        $banks = $this->bankRepository->query($request);
 
        return view('backOffice.setting.bankAccount.index', compact('banks', 'search'));
    }

    public function create()
    {

        $fact_bank = new FactBankAccount();
        $fact_banks = $fact_bank::all();
        $accounts = $fact_bank->getAccountTypes();
        
        return view('backOffice.setting.bankAccount.create', compact('fact_banks', 'accounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(BankRequest $request)
    {

        $bank = $this->bankRepository->store($request);

        return redirect()->action('BackOffice\Setting\BankAccountController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $bank = $this->bankRepository->find($id)->first();

        $fact_bank = new FactBankAccount();
        $fact_banks = $fact_bank::all();
        $accounts = $fact_bank->getAccountTypes();
        
        return view('backOffice.setting.bankAccount.show', compact('bank', 'fact_banks', 'accounts'));
    }

    /**
     * Display the specified resource for printing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        return view('backOffice.setting.bankAccount.print');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $bank = $this->bankRepository->find($id);
        
        if (!session()->has('warning') && $bank != null) {
            $bank = $bank->first();
            $fact_bank = new FactBankAccount();
            $fact_banks = $fact_bank::all();
            $accounts = $fact_bank->getAccountTypes();
        } elseif ($bank == null) {
            return redirect()
                    ->action('BackOffice\Setting\BankAccountController@index')
                    ->with('warning', 'Data not found')
                    ->withInput();
        } else {
            return back()
                ->with('warning', 'Can\'t Edit Data')
                ->withInput();
        }
        
        return view('backOffice.setting.bankAccount.show', compact('bank', 'fact_banks', 'accounts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BankUpdateRequest $request, $id)
    {

        $bank = $this->bankRepository->find($id);

        if (!session()->has('warning') && $bank != null) {
            $this->bankRepository->update($request, $id);
        } elseif ($bank == null) {
            Session::flash('warning', 'Data not found');
        } else {
            Session::flash('warning', 'Can\'t Edit Data');
        }

        return redirect()
                ->action('BackOffice\Setting\BankAccountController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $bank = $this->bankRepository->destroy($request, $id);

        return redirect()->action('BackOffice\Setting\BankAccountController@index')
                ->with('warning', 'Data not found')
                ->withInput();
    }
    /**
     * @param  Delete all
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function destroyAll(Request $request)
    {
        $bank = $this->bankRepository->destroyAll($request);
        
        return redirect()
                ->action('BackOffice\Setting\BankAccountController@index');
    }

    /**
     * Restore the specified resource from Soft Deletion.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {

        $bank = $this->bankRepository->restore($id);

        return redirect()
                ->action('BackOffice\Setting\BankAccountController@index');
    }
}
