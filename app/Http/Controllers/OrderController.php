<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['product.category', 'product.subcategory', 'product.size', 'user'])
            ->where('user_id', Auth::id())
            ->orderByDesc('date')
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function adminIndex(Request $request)
    {
        $query = Order::with(['product.category', 'product.subcategory', 'product.size', 'user']);

        if ($request->filled('login')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('login', 'like', '%' . $request->input('login') . '%');
            });
        }

        if ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->input('date_from'));
        }

        if ($request->filled('date_to')) {
            $query->whereDate('date', '<=', $request->input('date_to'));
        }

        $orders = $query->orderByDesc('date')->paginate(15)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function create(Product $product)
    {
        return view('orders.create', compact('product'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id'        => ['required', 'exists:products,id'],
            'quantity'          => ['required', 'integer', 'min:1'],
            'customer_fullname' => ['required', 'string', 'max:255'],
        ]);

        $product = Product::findOrFail($data['product_id']);

        if ($product->quantity < $data['quantity']) {
            return back()->withErrors([
                'quantity' => 'Недостаточно товара на складе. Доступно: ' . $product->quantity,
            ])->withInput();
        }

        Order::create([
            'user_id'           => Auth::id(),
            'product_id'        => $product->id,
            'date'              => now(),
            'quantity'          => $data['quantity'],
            'total_price'       => $product->price * $data['quantity'],
            'customer_fullname' => $data['customer_fullname'],
        ]);

        $product->decrement('quantity', $data['quantity']);

        return redirect()->route('orders.index')
            ->with('success', 'Заказ оформлен');
    }

    public function show(Order $order)
    {
        $this->authorizeOrderAccess($order);

        $order->load(['product.category', 'product.subcategory', 'product.size']);

        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $order->load(['product.category', 'product.subcategory', 'product.size', 'user']);

        $users = User::orderBy('login')->get();
        $products = Product::orderBy('name')->get();

        return view('admin.orders.edit', compact('order', 'users', 'products'));
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'user_id'           => ['required', 'exists:users,id'],
            'product_id'        => ['required', 'exists:products,id'],
            'date'              => ['required', 'date'],
            'quantity'          => ['required', 'integer', 'min:1'],
            'customer_fullname' => ['required', 'string', 'max:255'],
        ]);

        $product = Product::findOrFail($data['product_id']);

        $order->update([
            'user_id'           => $data['user_id'],
            'product_id'        => $product->id,
            'date'              => $data['date'],
            'quantity'          => $data['quantity'],
            'total_price'       => $product->price * $data['quantity'],
            'customer_fullname' => $data['customer_fullname'],
        ]);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Заказ №' . $order->id . ' обновлён');
    }

    public function destroy(Order $order)
    {
        $id = $order->id;
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Заказ №' . $id . ' удалён');
    }

    private function authorizeOrderAccess(Order $order): void
    {
        $user = Auth::user();

        $isOwner = $order->user_id === $user->id;
        $isStaff = in_array($user->role->name, ['admin', 'manager'], true);

        abort_unless($isOwner || $isStaff, 403);
    }
}