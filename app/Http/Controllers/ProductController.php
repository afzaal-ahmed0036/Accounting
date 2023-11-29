<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function rawMaterials()
    {
        try {
            Session::put('menu', 'Raw Materials');
            $pagetitle = 'Raw Materials';
            $item = Item::where('ItemType', 'RawMaterial')->get();
            $unit = DB::table('unit')->get();

            $chartofaccount = DB::table('chartofaccount')->where(DB::raw('right(ChartOfAccountID,4)'), 00000)->where(DB::raw('right(ChartOfAccountID,5)'), '!=', 00000)->get();
            return view('production.rawMaterials', compact('pagetitle', 'item', 'unit', 'chartofaccount'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->with('class', 'danger');

            //throw $th;
        }
    }
    public function RawMaterialSave(Request $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $request->validate([
                'ItemName' => 'required|max:55',
                'Unit' => 'required',
                'CostPrice' => 'required|numeric'
            ]);
            $data = array(
                'ItemName' => $request->input('ItemName'),
                'UnitName' => $request->input('Unit'),
                'CostPrice' => $request->input('CostPrice'),
                'ItemType' => 'RawMaterial'
            );
            Item::create($data);
            DB::commit();
            return redirect()->back()->with('error', 'Material Added Successfully')->with('class', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage())->with('class', 'danger');

            //throw $th;
        }
    }
    public  function rawMaterialEdit($id)
    {
        try {

            $pagetitle = 'Raw Material Edit';

            $item = Item::findOrFail($id);
            $unit = DB::table('unit')->get();
            $chartofaccount = DB::table('chartofaccount')->where(DB::raw('right(ChartOfAccountID,4)'), 00000)->where(DB::raw('right(ChartOfAccountID,5)'), '!=', 00000)->get();

            return view('production.edit_rawMaterial', compact('pagetitle', 'item', 'unit', 'chartofaccount'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage())->with('class', 'danger');

            //throw $th;
        }
    }
    public function rawMaterialUpdate(Request $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $request->validate([
                'ItemName' => 'required|max:55',
                'Unit' => 'required',
                'CostPrice' => 'required|numeric'
            ]);
            $data = array(
                'ItemName' => $request->input('ItemName'),
                'UnitName' => $request->input('Unit'),
                'CostPrice' => $request->input('CostPrice'),
                'ItemType' => 'RawMaterial'
            );
            Item::findOrFail($request->ItemID)->update($data);
            DB::commit();
            return redirect('Raw/Materials')->with('error', 'Material Updated Successfully')->with('class', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage())->with('class', 'danger');

            //throw $th;
        }
    }
    public function rawMaterialDelete($id)
    {
        try {
            DB::beginTransaction();
            Item::findOrFail($id)->delete();
            DB::commit();
            return redirect('Raw/Materials')->with('error', 'Material Deleted Successfully')->with('class', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage())->with('class', 'danger');

            //throw $th;
        }
    }
    public function productIndex()
    {
        try {
            $pagetitle = 'Products';
            $products = Product::all();
            return view('production.productIndex', compact('products', 'pagetitle'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->with('class', 'danger');
        }
    }

    public function productCreate()
    {
        try {
            $pagetitle = 'Product Create';
            $items = Item::where('ItemType', 'RawMaterial')->get();
            // $products = Product::all();
            return view('production.productCreate', compact('pagetitle', 'items'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->with('class', 'danger');
        }
    }

    public function getMaterialDetails(Request $request)
    {
        try {
            $data = Item::findOrFail($request->id);
            // dd($data);
            return response()->json(['data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()]);
        }
    }

    public function productSave(Request $request)
    {
        try {
            $rules = [
                '_token' => 'required|string',
                'name' => 'required|string',
                'price' => 'required|numeric',
                'details' => 'nullable|string',
                'itemID' => 'required|array',
                'itemQty' => 'required|array',
            ];
            $messages = [
                'itemID.*.distinct' => 'Please select distinct Materials.',
                'itemID.required' => 'Please Select atleast 1 Material for the Product',
                'itemQty.required' => 'Please Select atleast 1 Material for the Product'
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            $validator->sometimes('itemID.*', 'distinct', function ($input) {
                return count($input->itemID) > 1;
            });
            if ($validator->fails()) {
                $firstErrorMessage = $validator->errors()->first();
                return back()->with('error', $firstErrorMessage)->with('class', 'danger')->withInput();
            }
            // dd($request->all());
            DB::beginTransaction();
            $product = Product::create($request->except('_token', 'itemID', 'itemQty'));
            foreach ($request->itemID as $key => $value) {
                $item = Item::findOrFail($value);
                $detailData = [
                    'ProductID' => $product->ProductID,
                    'ItemID' => $item->ItemID,
                    'ItemName' => $item->ItemName,
                    'quantity' => $request->itemQty[$key],
                    'itemCost' => $request->itemQty[$key] * $item->CostPrice
                ];
                ProductDetail::create($detailData);
            }
            DB::commit();
            return redirect('Products')->with('error', 'Product Addedd Successfully')->with('class', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage())->with('class', 'danger')->withInput();

            //throw $th;
        }
    }
    public function productEdit($id)
    {
        try {
            $pagetitle = 'Product Update';
            $items = Item::where('ItemType', 'RawMaterial')->get();
            $product = Product::with('productDetails.Item')->findOrFail($id);
            // dd($product);
            return view('production.productEdit', compact('pagetitle', 'items', 'product'));
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage())->with('class', 'danger');
        }
    }
    public function productUpdate(Request $request)
    {
        try {
            $rules = [
                '_token' => 'required|string',
                'name' => 'required|string',
                'price' => 'required|numeric',
                'details' => 'nullable|string',
                'itemID' => 'required|array',
                'itemQty' => 'required|array',
            ];
            $messages = [
                'itemID.*.distinct' => 'Please select distinct Materials.',
                'itemID.required' => 'Please Select atleast 1 Material for the Product',
                'itemQty.required' => 'Please Select atleast 1 Material for the Product'
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            $validator->sometimes('itemID.*', 'distinct', function ($input) {
                return count($input->itemID) > 1;
            });
            if ($validator->fails()) {
                $firstErrorMessage = $validator->errors()->first();
                return back()->with('error', $firstErrorMessage)->with('class', 'danger')->withInput();
            }
            // dd($request->all());
            DB::beginTransaction();
            ProductDetail::where('ProductID', $request->id)->delete();
            Product::findOrFail($request->id)->update($request->except('_token', 'itemID', 'itemQty', 'id'));
            foreach ($request->itemID as $key => $value) {
                $item = Item::findOrFail($value);
                $detailData = [
                    'ProductID' => $request->id,
                    'ItemID' => $item->ItemID,
                    'ItemName' => $item->ItemName,
                    'quantity' => $request->itemQty[$key],
                    'itemCost' => $request->itemQty[$key] * $item->CostPrice
                ];
                ProductDetail::create($detailData);
            }
            DB::commit();
            return redirect('Products')->with('error', 'Product Addedd Successfully')->with('class', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage())->with('class', 'danger')->withInput();

            //throw $th;
        }
    }
    public function productShow($id)
    {
        try {
            $pagetitle = 'Product Details';
            $product = Product::with('productDetails')->findOrFail($id);
            // dd($product);
            return view('production.productShow', compact('pagetitle', 'product'));
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage())->with('class', 'danger');
        }
    }
    public function productDelete($id)
    {
        // dd($id);
        try {
            DB::beginTransaction();
            $product = Product::with('productDetails')->findOrFail($id);
            $product->productDetails()->delete();

            // Delete the main model
            $product->delete();
            DB::commit();
            return redirect('Products')->with('error', 'Product Deleted Successfully')->with('class', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage())->with('class', 'danger');

            //throw $th;
        }
    }
    public function getProductDetails(Request $request)
    {
        // dd($request->all());
        try {
            $data = Product::findOrFail($request->id);
            // dd($data);
            return response()->json(['data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()]);
        }
    }
}
