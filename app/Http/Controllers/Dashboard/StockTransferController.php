<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StockTransfer;
use App\Models\Branch;
use App\Models\Product;
use App\Models\BranchProduct;

class StockTransferController extends Controller
{
    /**
     * عرض كل التحويلات
     */
    public function index()
    {
        $transfers = StockTransfer::with(['from_branch', 'to_branch', 'product'])
                        ->orderBy('transfer_date', 'desc')
                        ->paginate(10);

        return view('transfers.index', compact('transfers'));
    }

    /**
     * صفحة إنشاء تحويل جديد
     */
    public function create()
    {
        $branches = Branch::all();
        $products = Product::all();

        return view('transfers.create', compact('branches', 'products'));
    }

    /**
     * حفظ التحويل الجديد
     */
    public function store(Request $request)
    {
        $request->validate([
            'from_branch' => 'required|exists:branches,id',
            'to_branch' => 'required|exists:branches,id|different:from_branch',
            'transfer_date' => 'required|date',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $transfer = StockTransfer::create([
            'from_branch_id' => $request->from_branch,
            'to_branch_id' => $request->to_branch,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'transfer_date' => $request->transfer_date,
            'status' => 'pending',
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('transfers.index')->with('success', 'تم إنشاء التحويل بنجاح.');
    }

    /**
     * عرض تفاصيل التحويل
     */
    public function show($id)
    {
        $transfer = StockTransfer::with(['from_branch', 'to_branch', 'product'])->findOrFail($id);

        return view('transfers.show', compact('transfer'));
    }

    /**
     * تعديل حالة التحويل
     */
    public function edit($id)
    {
        $transfer = StockTransfer::findOrFail($id);
        $branches = Branch::all();
        $products = Product::all();

        return view('transfers.edit', compact('transfer', 'branches', 'products'));
    }

    /**
     * تحديث التحويل
     */
    public function update(Request $request, $id)
    {
        $transfer = StockTransfer::findOrFail($id);

        $request->validate([
            'from_branch' => 'required|exists:branches,id',
            'to_branch' => 'required|exists:branches,id|different:from_branch',
            'transfer_date' => 'required|date',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:pending,in_transit,received,canceled',
        ]);

        $transfer->update([
            'from_branch_id' => $request->from_branch,
            'to_branch_id' => $request->to_branch,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'transfer_date' => $request->transfer_date,
            'status' => $request->status,
        ]);

        return redirect()->route('transfers.index')->with('success', 'تم تحديث التحويل بنجاح.');
    }

    /**
     * حذف التحويل
     */
    public function destroy($id)
    {
        $transfer = StockTransfer::findOrFail($id);
        $transfer->delete();

        return redirect()->route('transfers.index')->with('success', 'تم حذف التحويل.');
    }

    /**
     * تصفية التحويلات حسب الحالة
     */
    public function filterByStatus($status)
    {
        $transfers = StockTransfer::with(['from_branch', 'to_branch', 'product'])
                        ->where('status', $status)
                        ->orderBy('transfer_date', 'desc')
                        ->paginate(10);

        return view('transfers.' . $status, compact('transfers'));
    }



     // قبول التحويل
    public function accept($id)
    {
        $transfer = StockTransfer::findOrFail($id);

        if ($transfer->status != 'pending') {
            return redirect()->back()->with('error', 'هذا التحويل لا يمكن قبوله.');
        }

        $fromBranchProduct = BranchProduct::firstOrCreate(
            ['branch_id' => $transfer->from_branch_id, 'product_id' => $transfer->product_id],
            ['quantity' => 0]
        );

        $toBranchProduct = BranchProduct::firstOrCreate(
            ['branch_id' => $transfer->to_branch_id, 'product_id' => $transfer->product_id],
            ['quantity' => 0]
        );

        if ($fromBranchProduct->quantity < $transfer->quantity) {
            return redirect()->back()->with('error', 'الكمية في الفرع المرسل أقل من المطلوب.');
        }

        $fromBranchProduct->decrement('quantity', $transfer->quantity);
        $toBranchProduct->increment('quantity', $transfer->quantity);

        $transfer->update(['status' => 'done']);

        return redirect()->back()->with('success', 'تم قبول التحويل بنجاح.');
    }

    // رفض التحويل
    public function cancel($id)
    {
        $transfer = StockTransfer::findOrFail($id);

        if ($transfer->status != 'pending') {
            return redirect()->back()->with('error', 'لا يمكن إلغاء هذا التحويل.');
        }

        $transfer->update(['status' => 'canceled']);

        return redirect()->back()->with('success', 'تم إلغاء التحويل.');
    }
}
