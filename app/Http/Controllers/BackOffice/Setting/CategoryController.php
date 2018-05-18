<?php

namespace SenseBook\Http\Controllers\BackOffice\Setting;

use SenseBook\Http\Controllers\Controller;
use SenseBook\Http\Requests\BackOffice\Website\CategoryFormRequest;
use SenseBook\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use SenseBook\Models\Category;
use Response;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = request('search', '');
        if ($request->has('sort')) {
            $sort = $request->sort;
        } else {
            $sort = 'desc';
        }
        if ($request->has('sorttype')) {
            $type = $request->sorttype;
        } else {
            $type = 'created_at';
        }
        if (request()->has('search')) {
            $categories = $this->categoryRepository->search(
                [
                    ['name_th', 'LIKE', '%' . $search . '%'],
                    ['name_en', 'LIKE', '%' . $search . '%']
                ],
                15,
                $sort,
                $type
            );
        } else {
            $categories = $this->categoryRepository->getModel($type, $sort)->withTrashed()->paginate(15);
        }

        return view('backOffice.setting.category.index', compact('categories', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = 'create';

        return view('backOffice.setting.category.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \SenseBook\Http\Requests\CategoryFormRequest|\Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryFormRequest $request)
    {
        $name = $request->input('name_th');
        $oldDatas = $this->categoryRepository->all();
        foreach ($oldDatas as &$oldData) {
            if ($oldData->name_th == $name) {
                return back()->withInput()->with('failure', 'Duplicate thai name');
            }
        }
        $name = $request->input('name_en');
        $oldDatas = $this->categoryRepository->all();
        foreach ($oldDatas as &$oldData) {
            if ($oldData->name_en == $name) {
                return back()->withInput()->with('failure', 'Duplicate eng name');
            }
        }

        $category = Category::create($request->all());

        Log::info('Showing request->all: '.serialize($request->all()));
        $request->session()->flash('success', 'Create successful!');
        return redirect()->route('backOffice.setting.category.index');
        // echo $script = "<script>
        //             window.opener.location.href = window.opener.location.href;
        //              window.location = '" . route('backOffice.setting.category.index') . "';
        //              window.close() ;
        //       </script>";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->categoryRepository->findById($id);

        return view('backOffice.setting.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if (!Category::where('id', '=', $id)->exists()) {
            $request->session()->flash('failure', 'Warning Can\'t Edit Data');
            echo $script = "<script>
                        window.location = '" . route('backOffice.setting.category.index') . "';
                    </script>";
        }

        if (!Category::withTrashed()->where('id', '=', $id)->exists()) {
            $request->session()->flash('failure', 'Warning Data not found');
            echo $script = "<script>
                        window.location = '" . route('backOffice.setting.category.index') . "';
                    </script>";
        }

        $category = $this->categoryRepository->findById($id);
        $type = 'edit';

        return view('backOffice.setting.category.create', compact('category', 'type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \SenseBook\Http\Requests\CategoryFormRequest|\Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryFormRequest $request, $id)
    {
        if (!Category::withTrashed()->where('id', '=', $id)->exists()) {
            return redirect()->route('backOffice.setting.category.index')->with('success', 'Warning Data not found');
        }

        $old_category = $this->categoryRepository->findById($id);
        
        $name = $request->input('name_th');
        $oldDatas = $this->categoryRepository->all();
        foreach ($oldDatas as &$oldData) {
            if ($oldData->name_th == $name && $old_category->name_th != $name) {
                return back()->withInput()->with('failure', 'Duplicate thai name');
            }
        }
        $name = $request->input('name_en');
        $oldDatas = $this->categoryRepository->all();
        foreach ($oldDatas as &$oldData) {
            if ($oldData->name_en == $name && $old_category->name_en != $name) {
                return back()->withInput()->with('failure', 'Duplicate eng name');
            }
        }

        $category = Category::whereId($id)->update($request->only(['name_th', 'name_en']));
        $tmp_category = $this->categoryRepository->findById($id);
        $request->session()->flash('success', 'Update successful!');
        echo $script = "<script>
                    window.location = '" . route('backOffice.setting.category.index') . "';    
                </script>";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Category::withTrashed()->where('id', '=', $id)->exists()) {
            return redirect()
                ->route('backOffice.setting.category.index')
                ->with('failure', 'Warning Data not found');
        }

        $category = $this->categoryRepository->findById($id);

        if (!$this->categoryRepository->delete($id)) {
            return redirect()
                ->route('backOffice.setting.category.index')
                ->with('warning', 'Delete category failure');
        };

        if ($category->trashed()) {
            return redirect()
                ->route('backOffice.setting.category.index')
                ->with('success', 'Force delete category success');
        } else {
            return redirect()
                ->route('backOffice.setting.category.index')
                ->with('success', 'Delete category success');
        }
    }

    public function restore($id)
    {
        if (!Category::withTrashed()->where('id', '=', $id)->exists()) {
            return redirect()
                ->route('backOffice.setting.category.index')
                ->with('warning', 'Category not found');
        }

        $this->categoryRepository->restore($id);

        return redirect()
            ->route('backOffice.setting.category.index')
            ->with('success', 'Restore category success');
    }

    public function duplicate(Request $request, $id)
    {
        if (!Category::where('id', '=', $id)->exists()) {
            $request->session()->flash('failure', 'Warning Data not found');
            echo $script = "<script>
                        window.location = '" . route('backOffice.setting.category.index') . "';
                    </script>";
        }

        if (!Category::withTrashed()->where('id', '=', $id)->exists()) {
            $request->session()->flash('failure', 'Warning Data not found');
            echo $script = "<script>
                        window.location = '" . route('backOffice.setting.category.index') . "';
                    </script>";
        }

        $category = $this->categoryRepository->findById($id);
        $type = 'duplicate';
        $platforms = Platform::all();

        return view('backOffice.setting.category.create', compact('category', 'platforms', 'type'));
    }

    public function deleteAll(Request $request)
    {
        $arrCH = $request->input('checkboxId');
        foreach ($arrCH as $ch => $chIndex) {
            $type = '';
            $haveSuccess = false;
            if (!Category::withTrashed()->where('id', '=', $chIndex)->exists()) {
                $request->session()->flash('failure', 'Warning Data not found');
                $type = 'failure';
            } else {
                if (!$this->categoryRepository->delete($chIndex)) {
                    return back()->withErrors('Delete category failure');
                } else {
                    $haveSuccess = true;
                }
            }
        }

        if ($type != 'failure' || $haveSuccess) {
            $request->session()->flash('success', 'Delete category success');
            return response()->json([
                $type => 'success'
            ]);
        } else {
            return response()->json([
                $type => $type
            ]);
        }
    }

    public function checkDeleteType(Request $request, $id)
    {
        $type = '';
        if (!Category::withTrashed()->where('id', '=', $id)->exists()) {
            $request->session()->flash('failure', 'Warning Data not found');
            return response()->json([
                $type => 'failure'
            ]);
        }

        if (Category::where('id', '=', $id)->exists()) {
            $type = 'delete';
        } else {
            $type = 'forceDelete';
        }

        return response()->json([
            'type' => $type
        ]);
    }


    public function checkDeleteTypeFromDeleteAll(Request $request)
    {
        $type = '';
        $arrCH = $request->input('checkboxId');
        foreach ($arrCH as $ch => $chIndex) {
            if (!Category::where('id', '=', $chIndex)->exists()) {
                if (Category::withTrashed()->where('id', '=', $chIndex)->exists()) {
                    $type = 'forceDelete';
                }
            }
        }

        return response()->json([
            'type' => $type
        ]);
    }
}
