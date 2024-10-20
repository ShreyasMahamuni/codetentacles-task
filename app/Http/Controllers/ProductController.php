<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Yoeunes\Toastr\Facades\Toastr;

/**
 * @author Shreyas Mahamuni
 */

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::orderBy('id', 'desc')->paginate(2);
        return view('product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $r)
    {
        $r->validate([
            'name' => [
                'required',
                'string'
            ],
            'amount' => [
                'required',
                'numeric',
                'gte:0'
            ],
            'description' => [
                'required',
            ],
            'product_image' => [
                'nullable',
                'mimes:jpg,jpeg,png'
            ]
        ]);

        try {
            $data = [];
            $data = [
                'name' => $r->name,
                'description' => $r->description,
                'amount' => $r->amount,
            ];
            if ($r->hasFile('product_image')) {
                $file = $r->file('product_image');
                $path = Storage::disk('public')->putFileAs('product_image', $file, 'product_image-' . time() .  '.' . $file->getClientOriginalExtension());
                $data['product_image'] = $path;
            }
            Product::create($data);
            Toastr::success('Product added successfully.', 'Success');
            return redirect('/product');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            Toastr::error($ex->getMessage(), 'Exception');
            return redirect('/');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            if (!empty($id)) {
                $product = Product::find($id);
                return view('product.view', compact('product'));
            }
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            Toastr::error($ex->getMessage(), 'Exception');
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            if (!empty($id)) {
                $product = Product::find($id);
                return view('product.edit', compact('product'));
            }
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            Toastr::error($ex->getMessage(), 'Exception');
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $r, string $id)
    {

        $r->validate([
            'name' => [
                'required',
                'string'
            ],
            'amount' => [
                'required',
                'numeric',
                'gte:0'
            ],
            'description' => [
                'required',
            ],
            'product_image' => [
                'nullable',
                'mimes:jpg,jpeg,png'
            ]
        ]);

        try {
            $data = [];
            $data = [
                'name' => $r->name,
                'description' => $r->description,
                'amount' => $r->amount,
            ];
            if ($r->hasFile('product_image')) {
                $file = $r->file('product_image');
                $path = Storage::disk('public')->putFileAs('product_image', $file, 'product_image-' . time() .  '.' . $file->getClientOriginalExtension());
                $data['product_image'] = $path;
            }
            $product = Product::find($id);
            $product->update($data);
            Toastr::success('Product updated successfully.', 'Success');
            return redirect('/product');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            Toastr::error($ex->getMessage(), 'Exception');
            return redirect('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::find($id);

            if ($product) {
                $product->delete();
                Toastr::success('Product deleted successfully.', 'Success');
                return response()->json(['success' => true, 'message' => 'Product deleted successfully.']);
            } else {
                Toastr::error('Product not found', 'Error');
                return response()->json(['success' => false, 'message' => 'Product not found.']);
            }
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            Toastr::error($ex->getMessage(), 'Exception');
            return response()->json(['success' => false, 'message' => 'An error occurred while deleting the product.']);
        }
    }

    public function destroyImage($id)
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                Toastr::error('Image not found', 'Error');
                return response()->json(['message' => 'Image not found.'], 404);
            }
            if (Storage::disk('public')->exists($product->product_image)) {
                Storage::disk('public')->delete($product->product_image);
            }
            $product->update(['product_image' => null]);
            Toastr::success('Product image deleted successfully.', 'Success');
            return response()->json(['message' => 'Image deleted successfully.'], 200);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            Toastr::error($ex->getMessage(), 'Exception');
            return response()->json(['success' => false, 'message' => 'An error occurred while deleting the product image.']);
        }
    }
}
