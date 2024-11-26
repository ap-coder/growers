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
                'title' => 'team_create',
            ],
            [
                'id'    => 20,
                'title' => 'team_edit',
            ],
            [
                'id'    => 21,
                'title' => 'team_show',
            ],
            [
                'id'    => 22,
                'title' => 'team_delete',
            ],
            [
                'id'    => 23,
                'title' => 'team_access',
            ],
            [
                'id'    => 24,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 25,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 26,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 27,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 28,
                'title' => 'content_management_access',
            ],
            [
                'id'    => 29,
                'title' => 'content_category_create',
            ],
            [
                'id'    => 30,
                'title' => 'content_category_edit',
            ],
            [
                'id'    => 31,
                'title' => 'content_category_show',
            ],
            [
                'id'    => 32,
                'title' => 'content_category_delete',
            ],
            [
                'id'    => 33,
                'title' => 'content_category_access',
            ],
            [
                'id'    => 34,
                'title' => 'content_tag_create',
            ],
            [
                'id'    => 35,
                'title' => 'content_tag_edit',
            ],
            [
                'id'    => 36,
                'title' => 'content_tag_show',
            ],
            [
                'id'    => 37,
                'title' => 'content_tag_delete',
            ],
            [
                'id'    => 38,
                'title' => 'content_tag_access',
            ],
            [
                'id'    => 39,
                'title' => 'content_page_create',
            ],
            [
                'id'    => 40,
                'title' => 'content_page_edit',
            ],
            [
                'id'    => 41,
                'title' => 'content_page_show',
            ],
            [
                'id'    => 42,
                'title' => 'content_page_delete',
            ],
            [
                'id'    => 43,
                'title' => 'content_page_access',
            ],
            [
                'id'    => 44,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 45,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 46,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 47,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 48,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 49,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 50,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 51,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 52,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 53,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 54,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 55,
                'title' => 'product_management_access',
            ],
            [
                'id'    => 56,
                'title' => 'product_category_create',
            ],
            [
                'id'    => 57,
                'title' => 'product_category_edit',
            ],
            [
                'id'    => 58,
                'title' => 'product_category_show',
            ],
            [
                'id'    => 59,
                'title' => 'product_category_delete',
            ],
            [
                'id'    => 60,
                'title' => 'product_category_access',
            ],
            [
                'id'    => 61,
                'title' => 'product_tag_create',
            ],
            [
                'id'    => 62,
                'title' => 'product_tag_edit',
            ],
            [
                'id'    => 63,
                'title' => 'product_tag_show',
            ],
            [
                'id'    => 64,
                'title' => 'product_tag_delete',
            ],
            [
                'id'    => 65,
                'title' => 'product_tag_access',
            ],
            [
                'id'    => 66,
                'title' => 'product_create',
            ],
            [
                'id'    => 67,
                'title' => 'product_edit',
            ],
            [
                'id'    => 68,
                'title' => 'product_show',
            ],
            [
                'id'    => 69,
                'title' => 'product_delete',
            ],
            [
                'id'    => 70,
                'title' => 'product_access',
            ],
            [
                'id'    => 71,
                'title' => 'customer_create',
            ],
            [
                'id'    => 72,
                'title' => 'customer_edit',
            ],
            [
                'id'    => 73,
                'title' => 'customer_show',
            ],
            [
                'id'    => 74,
                'title' => 'customer_delete',
            ],
            [
                'id'    => 75,
                'title' => 'customer_access',
            ],
            [
                'id'    => 76,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 77,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 78,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 79,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 80,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 81,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 82,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 83,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 84,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 85,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 86,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 87,
                'title' => 'task_create',
            ],
            [
                'id'    => 88,
                'title' => 'task_edit',
            ],
            [
                'id'    => 89,
                'title' => 'task_show',
            ],
            [
                'id'    => 90,
                'title' => 'task_delete',
            ],
            [
                'id'    => 91,
                'title' => 'task_access',
            ],
            [
                'id'    => 92,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 93,
                'title' => 'order_create',
            ],
            [
                'id'    => 94,
                'title' => 'order_edit',
            ],
            [
                'id'    => 95,
                'title' => 'order_show',
            ],
            [
                'id'    => 96,
                'title' => 'order_delete',
            ],
            [
                'id'    => 97,
                'title' => 'order_access',
            ],
            [
                'id'    => 98,
                'title' => 'client_create',
            ],
            [
                'id'    => 99,
                'title' => 'client_edit',
            ],
            [
                'id'    => 100,
                'title' => 'client_show',
            ],
            [
                'id'    => 101,
                'title' => 'client_delete',
            ],
            [
                'id'    => 102,
                'title' => 'client_access',
            ],
            [
                'id'    => 103,
                'title' => 'client_price_create',
            ],
            [
                'id'    => 104,
                'title' => 'client_price_edit',
            ],
            [
                'id'    => 105,
                'title' => 'client_price_show',
            ],
            [
                'id'    => 106,
                'title' => 'client_price_delete',
            ],
            [
                'id'    => 107,
                'title' => 'client_price_access',
            ],
            [
                'id'    => 108,
                'title' => 'developer_access',
            ],
            [
                'id'    => 109,
                'title' => 'setting_create',
            ],
            [
                'id'    => 110,
                'title' => 'setting_edit',
            ],
            [
                'id'    => 111,
                'title' => 'setting_delete',
            ],
            [
                'id'    => 112,
                'title' => 'setting_access',
            ],
            [
                'id'    => 113,
                'title' => 'order_item_create',
            ],
            [
                'id'    => 114,
                'title' => 'order_item_edit',
            ],
            [
                'id'    => 115,
                'title' => 'order_item_show',
            ],
            [
                'id'    => 116,
                'title' => 'order_item_delete',
            ],
            [
                'id'    => 117,
                'title' => 'order_item_access',
            ],
            [
                'id'    => 118,
                'title' => 'order_management_access',
            ],
            [
                'id'    => 119,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
