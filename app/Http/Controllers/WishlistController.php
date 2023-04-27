<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WishlistCategory;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        return view('wishlist');
    }

    public function storeCategory(Request $request)
    {
        $wishlistCategory = WishlistCategory::updateOrCreate([
            'name' => $request->name
        ]);

        return response('ok');
    }

    public function category(Request $request)
    {
        $wishlistCategories = WishlistCategory::paginate(10);
        return response()->json($wishlistCategories);
    }

    public function data(Request $request)
    {
        $wishlist = Wishlist::leftJoin("products", "product_id", "=", "products.id")->with(['product'])
            ->when($request->shop != 'All', function($q) use ($request) {
                $q->where('products.source', $request->shop);
            })
            ->when(!empty($request->search), function($q) use ($request) {
                $q->where('products.name', 'like', '%' . $request->search . '%');
            })
            ->orderBy('products.price', ($request->price == 'Low to High' ? 'asc' : 'desc'))
            ->orderBy('wishlists.created_at', ($request->date == 'Oldest to Newest' ? 'asc' : 'desc'))
            ->paginate(10);
        return response()->json($wishlist);
    }

    public function shop(Request $request)
    {
        // sorry I'm not create shop table
        return response()->json([
            'amazon.com',
            'ebay.com',
            'alibaba.com',
        ]);
    }
}
