<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show admin login form
     */
    public function showAdminLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * Handle admin login
     */
    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            if ($user->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            } else {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'You do not have admin privileges.',
                ]);
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Show admin dashboard with order filtering
     */
    public function adminDashboard(Request $request)
    {
        $status = $request->query('status');
        
        $query = OrderDetail::with('menu')
            ->orderBy('created_at', 'desc')
            ->take(10);
        
        if ($status && $status !== 'All Orders') {
            $query->where('status', $status);
        } else {
            $query->where('status', '!=', 'Cancelled');
        }
        
        $recentOrders = $query->get()->groupBy('idorder');
        
        return view('admin.dashboard', compact('recentOrders'));
    }

    /**
     * Get order details for AJAX request
     */
    public function getOrderDetails($orderId)
    {
        try {
            $orderItems = OrderDetail::with('menu')
                ->where('idorder', $orderId)
                ->get();

            if ($orderItems->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found'
                ], 404);
            }

            $firstOrder = $orderItems->first();
            $totalAmount = $orderItems->sum('total');

            return response()->json([
                'success' => true,
                'data' => [
                    'order' => $firstOrder,
                    'items' => $orderItems,
                    'totalAmount' => $totalAmount
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to get order details', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to get order details'
            ], 500);
        }
    }

    /**
     * Update order status
     */
    public function updateOrderStatus(Request $request)
    {
        try {
            $validated = $request->validate([
                'order_id' => 'required|string',
                'status' => 'required|string|in:Pending,In Transit,Out for Delivery,Delivered,Cancelled',
            ]);

            $orderId = $validated['order_id'];
            $status = $validated['status'];

            // Update all order details with the same order ID
            $updated = OrderDetail::where('idorder', $orderId)
                ->update(['status' => $status]);

            if ($updated) {
                Log::info('Order status updated', [
                    'order_id' => $orderId,
                    'status' => $status,
                    'updated_count' => $updated
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Order status updated successfully',
                    'status' => $status
                ]);
            } else {
                Log::warning('No order details updated', [
                    'order_id' => $orderId,
                    'status' => $status
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'No order details found with the provided ID'
                ], 404);
            }
        } catch (\Exception $e) {
            Log::error('Failed to update order status', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update order status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Admin logout
     */
    public function adminLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Redirect to the admin login page
        return redirect('/admin');
    }
}
