<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Branch;
use App\Models\StockTransfer;
use App\Models\Employee;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Category;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ==== إنشاء الفروع ====
        $branch1 = Branch::create([
            'name' => 'الفرع الرئيسي',
            'address' => 'قنا',
            'phone' => '0123456789',
        ]);

        $branch2 = Branch::create([
            'name' => 'فرع فرعي',
            'address' => 'قنا',
            'phone' => '0987654321',
        ]);

        // ==== إنشاء التحويلات ====
        // StockTransfer::create([
        //     'from_branch_id' => $branch1->id,
        //     'to_branch_id' => $branch2->id,
        //     'transfer_date' => Carbon::now(),
        //     'status' => 'pending',
        // ]);

        // StockTransfer::create([
        //     'from_branch_id' => $branch2->id,
        //     'to_branch_id' => $branch1->id,
        //     'transfer_date' => Carbon::now()->subDays(2),
        //     'status' => 'in_transit',
        // ]);

        // StockTransfer::create([
        //     'from_branch_id' => $branch1->id,
        //     'to_branch_id' => $branch2->id,
        //     'transfer_date' => Carbon::now()->subDays(5),
        //     'status' => 'received',
        // ]);

        // ==== إنشاء المستخدمين ====
        $admin = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'),
        ]);

        $user = User::create([
            'name' => 'User',
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123456789'),
        ]);

        // ==== إنشاء الموظفين والعملاء والموردين ====
        Employee::factory(5)->create();
        Customer::factory(25)->create();
        Supplier::factory(10)->create();

        // ==== إنشاء المنتجات والفئات ====
        for ($i = 0; $i < 10; $i++) {
            Product::factory()->create([
                'product_code' => IdGenerator::generate([
                    'table' => 'products',
                    'field' => 'product_code',
                    'length' => 4,
                    'prefix' => 'PC'
                ])
            ]);
        }

        Category::factory(5)->create();

        // ==== الصلاحيات والأدوار ====
        Permission::create(['name' => 'pos.menu', 'group_name' => 'pos']);
        Permission::create(['name' => 'employee.menu', 'group_name' => 'employee']);
        Permission::create(['name' => 'customer.menu', 'group_name' => 'customer']);
        Permission::create(['name' => 'supplier.menu', 'group_name' => 'supplier']);
        Permission::create(['name' => 'salary.menu', 'group_name' => 'salary']);
        Permission::create(['name' => 'attendence.menu', 'group_name' => 'attendence']);
        Permission::create(['name' => 'category.menu', 'group_name' => 'category']);
        Permission::create(['name' => 'product.menu', 'group_name' => 'product']);
        Permission::create(['name' => 'orders.menu', 'group_name' => 'orders']);
        Permission::create(['name' => 'stock.menu', 'group_name' => 'stock']);
        Permission::create(['name' => 'roles.menu', 'group_name' => 'roles']);
        Permission::create(['name' => 'user.menu', 'group_name' => 'user']);
        Permission::create(['name' => 'database.menu', 'group_name' => 'database']);
        Permission::create(['name' => 'branches.menu', 'group_name' => 'branches']);
        Permission::create(['name' => 'transfers.menu', 'group_name' => 'transfers']);



        Role::create(['name' => 'SuperAdmin'])->givePermissionTo(Permission::all());
        Role::create(['name' => 'Admin'])->givePermissionTo(['customer.menu', 'user.menu', 'supplier.menu']);
        Role::create(['name' => 'Account'])->givePermissionTo(['customer.menu', 'user.menu', 'supplier.menu']);
        Role::create(['name' => 'Manager'])->givePermissionTo(['stock.menu', 'orders.menu', 'product.menu', 'salary.menu', 'employee.menu']);
        Role::create(['name' => 'Staff'])->givePermissionTo(['pos.menu', 'orders.menu', 'branches.menu', 'transfers.menu']);

        $admin->assignRole('SuperAdmin');
        $user->assignRole('Account');
    }
}
