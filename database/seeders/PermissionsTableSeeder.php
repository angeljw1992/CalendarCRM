<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'expense_management_access',
            ],
            [
                'id'    => 20,
                'title' => 'expense_category_create',
            ],
            [
                'id'    => 21,
                'title' => 'expense_category_edit',
            ],
            [
                'id'    => 22,
                'title' => 'expense_category_show',
            ],
            [
                'id'    => 23,
                'title' => 'expense_category_delete',
            ],
            [
                'id'    => 24,
                'title' => 'expense_category_access',
            ],
            [
                'id'    => 25,
                'title' => 'income_category_create',
            ],
            [
                'id'    => 26,
                'title' => 'income_category_edit',
            ],
            [
                'id'    => 27,
                'title' => 'income_category_show',
            ],
            [
                'id'    => 28,
                'title' => 'income_category_delete',
            ],
            [
                'id'    => 29,
                'title' => 'income_category_access',
            ],
            [
                'id'    => 30,
                'title' => 'expense_create',
            ],
            [
                'id'    => 31,
                'title' => 'expense_edit',
            ],
            [
                'id'    => 32,
                'title' => 'expense_show',
            ],
            [
                'id'    => 33,
                'title' => 'expense_delete',
            ],
            [
                'id'    => 34,
                'title' => 'expense_access',
            ],
            [
                'id'    => 35,
                'title' => 'income_create',
            ],
            [
                'id'    => 36,
                'title' => 'income_edit',
            ],
            [
                'id'    => 37,
                'title' => 'income_show',
            ],
            [
                'id'    => 38,
                'title' => 'income_delete',
            ],
            [
                'id'    => 39,
                'title' => 'income_access',
            ],
            [
                'id'    => 40,
                'title' => 'expense_report_create',
            ],
            [
                'id'    => 41,
                'title' => 'expense_report_edit',
            ],
            [
                'id'    => 42,
                'title' => 'expense_report_show',
            ],
            [
                'id'    => 43,
                'title' => 'expense_report_delete',
            ],
            [
                'id'    => 44,
                'title' => 'expense_report_access',
            ],
            [
                'id'    => 45,
                'title' => 'cliente_create',
            ],
            [
                'id'    => 46,
                'title' => 'cliente_edit',
            ],
            [
                'id'    => 47,
                'title' => 'cliente_show',
            ],
            [
                'id'    => 48,
                'title' => 'cliente_delete',
            ],
            [
                'id'    => 49,
                'title' => 'cliente_access',
            ],
            [
                'id'    => 50,
                'title' => 'pago_create',
            ],
            [
                'id'    => 51,
                'title' => 'pago_edit',
            ],
            [
                'id'    => 52,
                'title' => 'pago_show',
            ],
            [
                'id'    => 53,
                'title' => 'pago_delete',
            ],
            [
                'id'    => 54,
                'title' => 'pago_access',
            ],
            [
                'id'    => 55,
                'title' => 'asistencium_create',
            ],
            [
                'id'    => 56,
                'title' => 'asistencium_edit',
            ],
            [
                'id'    => 57,
                'title' => 'asistencium_show',
            ],
            [
                'id'    => 58,
                'title' => 'asistencium_delete',
            ],
            [
                'id'    => 59,
                'title' => 'asistencium_access',
            ],
            [
                'id'    => 60,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 61,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 62,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 63,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 64,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 65,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 66,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 67,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 68,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 69,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 70,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 71,
                'title' => 'task_create',
            ],
            [
                'id'    => 72,
                'title' => 'task_edit',
            ],
            [
                'id'    => 73,
                'title' => 'task_show',
            ],
            [
                'id'    => 74,
                'title' => 'task_delete',
            ],
            [
                'id'    => 75,
                'title' => 'task_access',
            ],
            [
                'id'    => 76,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 77,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
